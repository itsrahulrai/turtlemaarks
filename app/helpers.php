<?php

if (!function_exists('base_public_url')) {

    function base_public_url($path = '')
    {
        return url('/public') . '/' . ltrim($path, '/');
    }

}

if (!function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        return \App\Models\Setting::where('key', $key)->value('value') ?? $default;
    }
}

if (!function_exists('money')) {
    function money(float $amount): string
    {
        return setting('currency_symbol', '₹') . number_format($amount, 2);
    }
}

if (!function_exists('storage_url')) {
    function storage_url(?string $path, string $default = ''): string
    {
        if (!$path) return $default;
        return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
    }
}

if (!function_exists('site_phone')) {
    function site_phone(): string
    {
        try {
            return (string) (setting('site_phone') ?: '+91 8130495476');
        } catch (\Throwable $e) {
            return '+91 8130495476';
        }
    }
}

if (!function_exists('site_phone_raw')) {
    function site_phone_raw(): string
    {
        $phone = site_phone();
        $cleaned = preg_replace('/[^0-9+]/', '', $phone);
        return $cleaned ?: '+918130495476';
    }
}

if (!function_exists('site_whatsapp')) {
    function site_whatsapp(): string
    {
        $raw = site_phone_raw();
        $digits = ltrim(preg_replace('/[^0-9]/', '', $raw), '0');
        return $digits ?: '918130495476';
    }
}

if (!function_exists('site_email')) {
    function site_email(): string
    {
        try {
            return (string) (setting('site_email') ?: 'info@turtlemaarks.com');
        } catch (\Throwable $e) {
            return 'info@turtlemaarks.com';
        }
    }
}

if (!function_exists('site_address')) {
    function site_address(): string
    {
        try {
            return (string) (setting('site_address') ?: '15th Floor, Gaur City Mall, 1509, Greater Noida W Rd, Gaur City 1, Sector IV, Sector 4, Noida, Ghaziabad, UP 201306');
        } catch (\Throwable $e) {
            return '15th Floor, Gaur City Mall, 1509, Greater Noida W Rd, Gaur City 1, Sector IV, Sector 4, Noida, Ghaziabad, UP 201306';
        }
    }
}

if (!function_exists('site_name')) {
    function site_name(): string
    {
        try {
            return (string) (setting('site_name') ?: 'Turtle Maarks Hearing Health');
        } catch (\Throwable $e) {
            return 'Turtle Maarks Hearing Health';
        }
    }
}

/*
|--------------------------------------------------------------------------
| Turtle Maarks front-end constants (new 2026 design)
|--------------------------------------------------------------------------
| Single source of truth for brand + contact details used by the site layout,
| header, footer and every marketing page. Values fall back to the DB
| `settings` table where the admin has configured them.
*/
if (!defined('SITE_NAME')) {
    try {
        $dbSettings = \Illuminate\Support\Facades\Schema::hasTable('settings')
            ? \App\Models\Setting::whereIn('key', ['site_name', 'site_tagline', 'site_phone', 'site_email', 'site_address'])->pluck('value', 'key')
            : collect();
    } catch (\Throwable $e) {
        $dbSettings = collect();
    }

    $dbPhone    = $dbSettings['site_phone'] ?? '+91 8130495476';
    $dbPhoneRaw = preg_replace('/[^0-9+]/', '', $dbPhone) ?: '+918130495476';
    $dbWhatsApp = ltrim(preg_replace('/[^0-9]/', '', $dbPhoneRaw), '0') ?: '918130495476';

    define('SITE_NAME',        $dbSettings['site_name'] ?? 'Turtle Maarks Hearing Health');
    define('SITE_SHORT',       'Turtle Maarks');
    define('SITE_TAGLINE',     $dbSettings['site_tagline'] ?? 'Modern Hearing Aids & Audiology Clinic');
    define('SITE_LOGO',        'frontend-assets/images/logo.png');
    define('SITE_FAVICON',     'frontend-assets/images/favicon.png');
    define('SITE_PHONE',       $dbPhone);
    define('SITE_PHONE_RAW',   $dbPhoneRaw);
    define('SITE_WHATSAPP',    $dbWhatsApp);
    define('SITE_EMAIL',       $dbSettings['site_email'] ?? 'info@turtlemaarks.com');
    define('SITE_ADDRESS',     $dbSettings['site_address'] ?? '15th Floor, Gaur City Mall, 1509, Greater Noida W Rd, Gaur City 1, Sector IV, Sector 4, Noida, Ghaziabad, UP 201306');
    define('SITE_HOURS_SHORT', 'Mon-Sat: 10AM-7:30PM');
    define('SITE_HOURS_DAYS',  'Monday &ndash; Saturday');
    define('SITE_HOURS_TIME',  '10:00 AM &ndash; 7:30 PM');
    define('SITE_HOURS_SUNDAY','By Prior Appointment');
}

if (!function_exists('tm_asset')) {
    /** Front-end asset URL: tm_asset('css/custom.css') => /public/frontend-assets/css/custom.css */
    function tm_asset(string $path): string
    {
        return asset('frontend-assets/' . ltrim($path, '/'));
    }
}

if (!function_exists('inr')) {
    /** Indian-format currency, e.g. ₹2,85,000 */
    function inr($amount, bool $symbol = true): string
    {
        $rounded = (int) round((float) $amount);
        $str     = (string) abs($rounded);

        if (strlen($str) > 3) {
            $last3 = substr($str, -3);
            $rest  = substr($str, 0, -3);
            $rest  = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $rest);
            $str   = $rest . ',' . $last3;
        }

        return ($symbol ? '₹' : '') . ($rounded < 0 ? '-' : '') . $str;
    }
}

if (!function_exists('js_str')) {
    /** Escape a value for use inside a single-quoted JS string in an inline handler */
    function js_str($value): string
    {
        return htmlspecialchars(
            str_replace(["\\", "'", "\r", "\n"], ["\\\\", "\\'", '', ' '], (string) $value),
            ENT_QUOTES,
            'UTF-8'
        );
    }
}

if (!function_exists('tm_setting')) {
    /** setting() that never explodes when the settings table is missing. */
    function tm_setting(string $key, mixed $default = null): mixed
    {
        try {
            return setting($key, $default);
        } catch (\Throwable $e) {
            return $default;
        }
    }
}

if (!function_exists('tm_page_url')) {
    /** Pagination URL that preserves the current query string. */
    function tm_page_url(int $page, string $routeName = 'products'): string
    {
        $params = array_merge(request()->query(), ['page' => max(1, $page)]);
        return route($routeName, $params);
    }
}
