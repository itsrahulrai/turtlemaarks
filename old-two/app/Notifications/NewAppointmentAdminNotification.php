<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAppointmentAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Appointment $appointment)
    {
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        $a = $this->appointment;

        return (new MailMessage)
            ->subject('New Appointment Request - ' . $a->appointment_number)
            ->greeting('New appointment request')
            ->line('Service: ' . $a->service->name)
            ->line('Customer: ' . $a->name . ' (' . $a->phone . ')')
            ->line('Requested: ' . $a->appointment_date->format('d M Y') . ' at ' . \Carbon\Carbon::parse($a->appointment_time)->format('h:i A'))
            ->action('Manage Appointments', route('admin.appointments.index'));
    }

    public function toArray($notifiable): array
    {
        $a = $this->appointment;

        return [
            'type'               => 'new_appointment_admin',
            'appointment_id'     => $a->id,
            'appointment_number' => $a->appointment_number,
            'message'            => 'New appointment request ' . $a->appointment_number . ' from ' . $a->name . '.',
        ];
    }
}
