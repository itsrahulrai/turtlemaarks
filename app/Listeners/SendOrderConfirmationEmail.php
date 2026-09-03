<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Mail\OrderConfirmationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmationEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderPlaced $event): void
    {
        try {
            $order = $event->order->load(['items.product', 'user']);
            $email = $order->user?->email;
            if ($email) {
                Mail::to($email)->send(new OrderConfirmationMail($order));
            }
        } catch (\Throwable $e) {
            \Log::error('OrderConfirmation mail failed: ' . $e->getMessage(), [
                'order_id' => $event->order->id,
            ]);
        }
    }

    public function failed(OrderPlaced $event, \Throwable $exception): void
    {
        \Log::error('OrderConfirmation mail failed: ' . $exception->getMessage(), [
            'order_id' => $event->order->id,
        ]);
    }
}
