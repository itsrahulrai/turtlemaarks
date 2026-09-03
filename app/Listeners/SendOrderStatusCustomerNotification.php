<?php

namespace App\Listeners;

use App\Events\OrderStatusUpdated;
use App\Notifications\OrderStatusUpdatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderStatusCustomerNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderStatusUpdated $event): void
    {
        try {
            $order = $event->order->load('user');

            $order->user?->notify(new OrderStatusUpdatedNotification($order, $event->previousStatus));
        } catch (\Throwable $e) {
            // Never let a mail/SMTP outage break the customer-facing transaction.
            \Illuminate\Support\Facades\Log::error('SendOrderStatusCustomerNotification failed: ' . $e->getMessage());
        }
    }

    public function failed(OrderStatusUpdated $event, \Throwable $exception): void
    {
        \Log::error('Order status customer notification failed: ' . $exception->getMessage(), [
            'order_id' => $event->order->id,
        ]);
    }
}
