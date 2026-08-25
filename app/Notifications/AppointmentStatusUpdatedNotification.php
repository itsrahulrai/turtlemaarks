<?php

namespace App\Notifications;

use App\Models\Appointment;
use App\Notifications\Channels\SmsChannel;
use App\Notifications\Channels\WhatsAppChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentStatusUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Appointment $appointment)
    {
    }

    public function via($notifiable): array
    {
        return ['mail', 'database', SmsChannel::class, WhatsAppChannel::class];
    }

    public function toMail($notifiable): MailMessage
    {
        $a = $this->appointment;

        $mail = (new MailMessage)
            ->subject('Appointment ' . ucfirst($a->status) . ' - ' . $a->appointment_number)
            ->greeting('Hi ' . $a->name . ',')
            ->line('Your appointment ' . $a->appointment_number . ' is now: ' . ucfirst($a->status))
            ->line('Date: ' . $a->appointment_date->format('d M Y') . ' at ' . \Carbon\Carbon::parse($a->appointment_time)->format('h:i A'));

        if ($a->admin_notes) {
            $mail->line('Note: ' . $a->admin_notes);
        }

        return $mail;
    }

    public function toArray($notifiable): array
    {
        $a = $this->appointment;

        return [
            'type'               => 'appointment_status_updated',
            'appointment_id'     => $a->id,
            'appointment_number' => $a->appointment_number,
            'status'             => $a->status,
            'message'            => 'Appointment ' . $a->appointment_number . ' is now ' . ucfirst($a->status) . '.',
        ];
    }

    public function toSms($notifiable): string
    {
        $a = $this->appointment;

        return "Appointment {$a->appointment_number} is now " . ucfirst($a->status) . '.';
    }

    public function toWhatsApp($notifiable): string
    {
        return $this->toSms($notifiable);
    }
}
