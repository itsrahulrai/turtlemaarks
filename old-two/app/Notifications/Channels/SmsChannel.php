<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;

/**
 * Minimal SMS channel stub.
 *
 * The notifiable/notification just needs to expose a `toSms($notifiable)`
 * method returning a plain string. Today this only logs the message so
 * nothing breaks in local/dev environments without SMS credentials.
 *
 * To go live: set SMS_DRIVER/SMS_API_KEY/SMS_SENDER_ID in .env and replace
 * the body of send() with a call to your provider's HTTP API
 * (e.g. MSG91, Twilio, Gupshup).
 */
class SmsChannel
{
    public function send($notifiable, Notification $notification): void
    {
        if (!method_exists($notification, 'toSms')) {
            return;
        }

        $phone   = $notifiable->routeNotificationFor('sms', $notification) ?? $notifiable->phone ?? null;
        $message = $notification->toSms($notifiable);

        if (!$phone || !$message) {
            return;
        }

        $driver = config('services.sms.driver', 'log');

        if ($driver === 'log') {
            logger()->info("[SMS:stub] would send to {$phone}: {$message}");
            return;
        }

        // Example real integration (uncomment & adapt for your provider):
        // Http::post('https://api.your-sms-provider.com/send', [
        //     'api_key'    => config('services.sms.api_key'),
        //     'sender_id'  => config('services.sms.sender_id'),
        //     'to'         => $phone,
        //     'message'    => $message,
        // ]);
    }
}
