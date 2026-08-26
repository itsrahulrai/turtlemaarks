<?php

namespace App\Notifications;

use App\Models\Appointment;
use App\Notifications\Channels\SmsChannel;
use App\Notifications\Channels\WhatsAppChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentBookedNotification extends Notification implements ShouldQueue
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

        return (new MailMessage)
            ->subject('Appointment Request Received - ' . $a->appointment_number)
            ->greeting('Hi ' . $a->name . ',')
            ->line('Your appointment request for "' . $a->service->name . '" has been received.')
            ->line('Requested date: ' . $a->appointment_date->format('d M Y') . ' at ' . \Carbon\Carbon::parse($a->appointment_time)->format('h:i A'))
            ->line('We will confirm your slot shortly.')
            ->line('Appointment reference: ' . $a->appointment_number);
    }

    public function toArray($notifiable): array
    {
        $a = $this->appointment;

        return [
            'type'               => 'appointment_booked',
            'appointment_id'     => $a->id,
            'appointment_number' => $a->appointment_number,
            'message'            => 'Appointment ' . $a->appointment_number . ' requested for ' . $a->appointment_date->format('d M Y') . '.',
        ];
    }

    public function toSms($notifiable): string
    {
        $a = $this->appointment;

        return "Your appointment request {$a->appointment_number} for " . $a->appointment_date->format('d M Y')
            . ' at ' . \Carbon\Carbon::parse($a->appointment_time)->format('h:i A') . ' has been received.';
    }

    public function toWhatsApp($notifiable): string
    {
        return $this->toSms($notifiable);
    }
}
