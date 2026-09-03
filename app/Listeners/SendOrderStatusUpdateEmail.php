<?php

namespace App\Listeners;

use App\Events\OrderStatusUpdated;
use App\Mail\OrderStatusMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderStatusUpdateEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderStatusUpdated $event): void
    {
        try {
            $order = $event->order->load(['items.product', 'user']);
            $email = $order->user?->email;
            if ($email) {
                Mail::to($email)->send(new OrderStatusMail($order, $event->previousStatus));
            }
        } catch (\Throwable $e) {
            \Log::error('OrderStatusUpdate mail failed: ' . $e->getMessage(), [
                'order_id' => $event->order->id,
            ]);
        }
    }

    public function failed(OrderStatusUpdated $event, \Throwable $exception): void
    {
        \Log::error('OrderStatusUpdate mail failed: ' . $exception->getMessage(), [
            'order_id' => $event->order->id,
        ]);
    }
}
