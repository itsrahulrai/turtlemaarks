<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;

/**
 * Minimal WhatsApp channel stub — same idea as SmsChannel.
 * Notification classes expose `toWhatsApp($notifiable)` returning a string.
 *
 * To go live: set WHATSAPP_DRIVER/WHATSAPP_API_KEY/WHATSAPP_PHONE_ID in .env
 * and replace the body of send() with a call to the Meta Cloud API,
 * Gupshup, or your provider of choice.
 */
class WhatsAppChannel
{
    public function send($notifiable, Notification $notification): void
    {
        if (!method_exists($notification, 'toWhatsApp')) {
            return;
        }

        $phone   = $notifiable->routeNotificationFor('whatsapp', $notification) ?? $notifiable->phone ?? null;
        $message = $notification->toWhatsApp($notifiable);

        if (!$phone || !$message) {
            return;
        }

        $driver = config('services.whatsapp.driver', 'log');

        if ($driver === 'log') {
            logger()->info("[WhatsApp:stub] would send to {$phone}: {$message}");
            return;
        }

        // Example real integration (Meta Cloud API, adapt as needed):
        // Http::withToken(config('services.whatsapp.api_key'))
        //     ->post('https://graph.facebook.com/v20.0/' . config('services.whatsapp.phone_id') . '/messages', [
        //         'messaging_product' => 'whatsapp',
        //         'to'                => $phone,
        //         'type'              => 'text',
        //         'text'              => ['body' => $message],
        //     ]);
    }
}
