<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Models\Admin;
use App\Notifications\NewOrderAdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewOrderAdminNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderPlaced $event): void
    {
        $order  = $event->order;
        $admins = Admin::where('is_active', true)->whereNotNull('email')->get();

        if ($admins->isNotEmpty()) {
            Notification::send($admins, new NewOrderAdminNotification($order));
        } elseif ($fallback = config('services.admin_notifications.email')) {
            Notification::route('mail', $fallback)->notify(new NewOrderAdminNotification($order));
        }
    }

    public function failed(OrderPlaced $event, \Throwable $exception): void
    {
        \Log::error('New order admin notification failed: ' . $exception->getMessage(), [
            'order_id' => $event->order->id,
        ]);
    }
}
