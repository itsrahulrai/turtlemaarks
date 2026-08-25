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
        $order = $event->order->load('user');

        $order->user?->notify(new OrderStatusUpdatedNotification($order, $event->previousStatus));
    }

    public function failed(OrderStatusUpdated $event, \Throwable $exception): void
    {
        \Log::error('Order status customer notification failed: ' . $exception->getMessage(), [
            'order_id' => $event->order->id,
        ]);
    }
}
