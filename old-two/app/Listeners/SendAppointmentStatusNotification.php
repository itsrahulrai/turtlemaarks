<?php

namespace App\Listeners;

use App\Events\AppointmentStatusUpdated;
use App\Notifications\AppointmentStatusUpdatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendAppointmentStatusNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(AppointmentStatusUpdated $event): void
    {
        $appointment = $event->appointment->load('service');

        if ($appointment->user) {
            $appointment->user->notify(new AppointmentStatusUpdatedNotification($appointment));
        } elseif ($appointment->email || $appointment->phone) {
            Notification::route('mail', $appointment->email)
                ->route('sms', $appointment->phone)
                ->route('whatsapp', $appointment->phone)
                ->notify(new AppointmentStatusUpdatedNotification($appointment));
        }
    }

    public function failed(AppointmentStatusUpdated $event, \Throwable $exception): void
    {
        \Log::error('Appointment status notification failed: ' . $exception->getMessage(), [
            'appointment_id' => $event->appointment->id,
        ]);
    }
}
