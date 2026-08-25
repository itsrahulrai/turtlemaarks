<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Order $order)
    {
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Order Received - ' . $this->order->order_number)
            ->greeting('New order received!')
            ->line('Order Number: ' . $this->order->order_number)
            ->line('Customer: ' . $this->order->shipping_name . ' (' . $this->order->shipping_phone . ')')
            ->line('Total: ₹' . number_format((float) $this->order->total, 2))
            ->line('Payment: ' . strtoupper($this->order->payment_method) . ' — ' . ucfirst($this->order->payment_status))
            ->action('View in Admin Panel', route('admin.orders.show', $this->order));
    }

    public function toArray($notifiable): array
    {
        return [
            'type'         => 'new_order_admin',
            'order_id'     => $this->order->id,
            'order_number' => $this->order->order_number,
            'total'        => (float) $this->order->total,
            'message'      => 'New order ' . $this->order->order_number . ' received.',
        ];
    }
}
