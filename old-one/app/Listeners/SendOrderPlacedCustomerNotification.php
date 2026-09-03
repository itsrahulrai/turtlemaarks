<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Notifications\OrderPlacedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderPlacedCustomerNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderPlaced $event): void
    {
        try {
            $order = $event->order->load(['items', 'user']);

            $order->user?->notify(new OrderPlacedNotification($order));
        } catch (\Throwable $e) {
            // Never let a mail/SMTP outage break the customer-facing transaction.
            \Illuminate\Support\Facades\Log::error('SendOrderPlacedCustomerNotification failed: ' . $e->getMessage());
        }
    }

    public function failed(OrderPlaced $event, \Throwable $exception): void
    {
        \Log::error('OrderPlaced customer notification failed: ' . $exception->getMessage(), [
            'order_id' => $event->order->id,
        ]);
    }
}
