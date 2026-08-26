<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use App\Models\Page;
use App\Models\Service;
use App\Services\CartService;



class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // Share global settings with all views
        View::composer('*', function ($view) {
            try {
                $siteName    = Setting::get('site_name', 'Turtle Maarks Hearing Health');
                $siteLogo    = Setting::get('site_logo');

                $footerPages = Page::where('status', 'published')
                    ->whereIn('slug', [
                        'privacy-policy',
                        'terms-and-conditions',
                        'shipping-policy',
                        'return-refund-policy'
                    ])
                    ->orderBy('title')
                    ->get();

                // Used by the quick-booking widget dropdown that appears on
                // most marketing pages (resources/views/site/includes/booking.blade.php).
                $activeServices = Service::active()->orderBy('sort_order')->get();

                $cartCount = app(CartService::class)->count();

                $view->with(compact('siteName', 'siteLogo', 'footerPages', 'activeServices', 'cartCount'));
            } catch (\Exception $e) {
                // DB not ready yet (during migrations etc.)
            }
        });
    }
}
