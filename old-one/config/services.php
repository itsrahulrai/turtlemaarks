<?php
return [
    'mailgun'    => ['domain' => env('MAILGUN_DOMAIN'), 'secret' => env('MAILGUN_SECRET'), 'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net')],
    'postmark'   => ['token' => env('POSTMARK_TOKEN')],
    'ses'        => ['key' => env('AWS_ACCESS_KEY_ID'), 'secret' => env('AWS_SECRET_ACCESS_KEY'), 'region' => env('AWS_DEFAULT_REGION', 'us-east-1')],
    'google'     => ['client_id' => env('GOOGLE_CLIENT_ID'), 'client_secret' => env('GOOGLE_CLIENT_SECRET'), 'redirect' => env('GOOGLE_REDIRECT_URI')],
    'razorpay'   => ['key_id' => env('RAZORPAY_KEY_ID'), 'key_secret' => env('RAZORPAY_KEY_SECRET')],

    // Placeholder config for SMS/WhatsApp providers. Wire up a real provider
    // (e.g. Twilio, MSG91, Gupshup, Meta Cloud API) by filling these in and
    // updating app/Notifications/Channels/SmsChannel.php & WhatsAppChannel.php.
    'sms' => [
        'driver'   => env('SMS_DRIVER', 'log'), // log | msg91 | twilio ...
        'api_key'  => env('SMS_API_KEY'),
        'sender_id'=> env('SMS_SENDER_ID'),
    ],
    'whatsapp' => [
        'driver'      => env('WHATSAPP_DRIVER', 'log'), // log | meta_cloud | gupshup ...
        'api_key'     => env('WHATSAPP_API_KEY'),
        'phone_id'    => env('WHATSAPP_PHONE_ID'),
    ],
    'admin_notifications' => [
        // Fallback recipient used when no Admin has an email, or for quick testing.
        'email' => env('ADMIN_NOTIFICATION_EMAIL'),
    ],
];
