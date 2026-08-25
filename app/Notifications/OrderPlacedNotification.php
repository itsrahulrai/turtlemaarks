<?php

namespace App\Notifications;

use App\Models\Order;
use App\Notifications\Channels\SmsChannel;
use App\Notifications\Channels\WhatsAppChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Order $order)
    {
    }

    public function via($notifiable): array
    {
        return ['mail', 'database', SmsChannel::class, WhatsAppChannel::class];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Order Confirmation - ' . $this->order->order_number)
            ->greeting('Thank you for your order!')
            ->line('Your order ' . $this->order->order_number . ' has been placed successfully.')
            ->line('Order total: ₹' . number_format((float) $this->order->total, 2))
            ->line('Payment method: ' . strtoupper($this->order->payment_method))
            ->action('View Order', route('account.orders.show', $this->order))
            ->line('We will notify you once your order status changes.');
    }

    public function toArray($notifiable): array
    {
        return [
            'type'         => 'order_placed',
            'order_id'     => $this->order->id,
            'order_number' => $this->order->order_number,
            'total'        => (float) $this->order->total,
            'message'      => 'Order ' . $this->order->order_number . ' placed successfully.',
        ];
    }

    public function toSms($notifiable): string
    {
        return "Your order {$this->order->order_number} of ₹{$this->order->total} has been placed. Thank you!";
    }

    public function toWhatsApp($notifiable): string
    {
        return $this->toSms($notifiable);
    }
}
