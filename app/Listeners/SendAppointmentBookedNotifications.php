<?php

namespace App\Listeners;

use App\Events\AppointmentBooked;
use App\Models\Admin;
use App\Notifications\AppointmentBookedNotification;
use App\Notifications\NewAppointmentAdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendAppointmentBookedNotifications implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(AppointmentBooked $event): void
    {
        $appointment = $event->appointment->load('service');

        // Notify the customer — via their account if logged in, otherwise
        // route the notification on-demand to whatever contact details they gave.
        if ($appointment->user) {
            $appointment->user->notify(new AppointmentBookedNotification($appointment));
        } elseif ($appointment->email || $appointment->phone) {
            Notification::route('mail', $appointment->email)
                ->route('sms', $appointment->phone)
                ->route('whatsapp', $appointment->phone)
                ->notify(new AppointmentBookedNotification($appointment));
        }

        // Notify admins
        $admins = Admin::where('is_active', true)->whereNotNull('email')->get();
        if ($admins->isNotEmpty()) {
            Notification::send($admins, new NewAppointmentAdminNotification($appointment));
        } elseif ($fallback = config('services.admin_notifications.email')) {
            Notification::route('mail', $fallback)->notify(new NewAppointmentAdminNotification($appointment));
        }
    }

    public function failed(AppointmentBooked $event, \Throwable $exception): void
    {
        \Log::error('Appointment booked notification failed: ' . $exception->getMessage(), [
            'appointment_id' => $event->appointment->id,
        ]);
    }
}
