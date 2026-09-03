<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\AppointmentBlock;
use App\Models\AppointmentSetting;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AppointmentService
{
    /**
     * Return the list of bookable time slots ("H:i") for a given date.
     * Already-booked and admin-blocked slots are excluded.
     */
    public function availableSlots(string $date): Collection
    {
        $carbonDate = Carbon::parse($date);

        $setting = AppointmentSetting::where('day_of_week', $carbonDate->dayOfWeek)->first();

        // No row configured yet in the admin panel: fall back to published clinic
        // hours (Mon-Sat 10:00-19:30, Sunday by prior appointment only) so the
        // booking page still works on a fresh install.
        if (!$setting) {
            $setting = new AppointmentSetting([
                'day_of_week'           => $carbonDate->dayOfWeek,
                'is_working_day'        => $carbonDate->dayOfWeek !== 0,
                'start_time'            => '10:00:00',
                'end_time'              => '19:30:00',
                'slot_duration_minutes' => 30,
                'break_start'           => '14:00:00',
                'break_end'             => '15:00:00',
                'gap_minutes'           => 0,
            ]);
        }

        if (!$setting->is_working_day) {
            return collect();
        }

        // Fully blocked day?
        $fullDayBlocked = AppointmentBlock::whereDate('date', $carbonDate)
            ->where('full_day', true)->exists();

        if ($fullDayBlocked) {
            return collect();
        }

        $blockedRanges = AppointmentBlock::whereDate('date', $carbonDate)
            ->where('full_day', false)
            ->get(['start_time', 'end_time']);

        $bookedTimes = Appointment::whereDate('appointment_date', $carbonDate)
            ->whereNotIn('status', ['cancelled', 'rejected'])
            ->pluck('appointment_time')
            ->map(fn ($t) => substr($t, 0, 5))
            ->all();

        $slots = collect();
        $cursor = Carbon::parse($carbonDate->toDateString() . ' ' . $setting->start_time);
        $end    = Carbon::parse($carbonDate->toDateString() . ' ' . $setting->end_time);

        while ($cursor->lt($end)) {
            $slotTime = $cursor->format('H:i');

            $isBooked = in_array($slotTime, $bookedTimes, true);

            $isBlocked = $blockedRanges->contains(function ($range) use ($cursor) {
                return $cursor->format('H:i:s') >= $range->start_time
                    && $cursor->format('H:i:s') < $range->end_time;
            });

            // Don't offer slots in the past for today
            $isPast = $carbonDate->isToday() && $cursor->lt(now());

            $isOnBreak = $setting->break_start && $setting->break_end
                && $cursor->format('H:i:s') >= $setting->break_start
                && $cursor->format('H:i:s') < $setting->break_end;

            if (!$isBooked && !$isBlocked && !$isOnBreak && !$isPast) {
                $slots->push($slotTime);
            }

            $cursor->addMinutes($setting->slot_duration_minutes + ($setting->gap_minutes ?? 0));
        }

        return $slots;
    }

    public function isSlotAvailable(string $date, string $time): bool
    {
        return $this->availableSlots($date)->contains(substr($time, 0, 5));
    }

    /**
     * @throws \RuntimeException when the slot is no longer available (double booking)
     */
    public function book(array $data): Appointment
    {
        return DB::transaction(function () use ($data) {
            // Lock against race conditions: re-check availability inside the transaction.
            $clash = Appointment::whereDate('appointment_date', $data['appointment_date'])
                ->where('appointment_time', $data['appointment_time'])
                ->whereNotIn('status', ['cancelled', 'rejected'])
                ->lockForUpdate()
                ->exists();

            if ($clash) {
                throw new \RuntimeException('This slot has just been booked by someone else. Please choose another time.');
            }

            $appointment = Appointment::create([
                'appointment_number' => Appointment::generateAppointmentNumber(),
                'user_id'            => $data['user_id'] ?? null,
                'service_id'         => $data['service_id'],
                'name'               => $data['name'],
                'email'              => $data['email'] ?? null,
                'phone'              => $data['phone'],
                'appointment_date'   => $data['appointment_date'],
                'appointment_time'   => $data['appointment_time'],
                'notes'              => $data['notes'] ?? null,
                'status'             => 'pending',
            ]);

            event(new \App\Events\AppointmentBooked($appointment));

            return $appointment;
        });
    }

    public function updateStatus(Appointment $appointment, string $status, ?string $adminNotes = null): Appointment
    {
        $appointment->update([
            'status'      => $status,
            'admin_notes' => $adminNotes ?? $appointment->admin_notes,
        ]);

        $appointment = $appointment->fresh();

        event(new \App\Events\AppointmentStatusUpdated($appointment));

        return $appointment;
    }
}
