<?php

namespace App\Notifications;

use App\Models\Order;
use App\Notifications\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Order $order, public string $previousStatus)
    {
    }

    // Note: email for this event is already sent by the legacy
    // SendOrderStatusUpdateEmail listener (OrderStatusMail). This
    // notification adds the in-app/DB record + SMS so we don't double-mail.
    public function via($notifiable): array
    {
        return ['database', SmsChannel::class];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Order Update - ' . $this->order->order_number)
            ->greeting('Your order status has changed')
            ->line('Order ' . $this->order->order_number . ' is now: ' . ucfirst($this->order->status))
            ->action('View Order', route('account.orders.show', $this->order));
    }

    public function toArray($notifiable): array
    {
        return [
            'type'         => 'order_status_updated',
            'order_id'     => $this->order->id,
            'order_number' => $this->order->order_number,
            'status'       => $this->order->status,
            'message'      => 'Order ' . $this->order->order_number . ' status changed to ' . ucfirst($this->order->status) . '.',
        ];
    }

    public function toSms($notifiable): string
    {
        return "Order {$this->order->order_number} status updated to " . ucfirst($this->order->status) . '.';
    }
}
