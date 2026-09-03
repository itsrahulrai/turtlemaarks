<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Wishlist;
use App\Services\CartService;
use App\Support\TmCatalog;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Global data shared with every view
        View::composer('*', function ($view) {
            try {
                $sitePhone    = site_phone();
                $sitePhoneRaw = site_phone_raw();
                $siteWhatsApp = site_whatsapp();
                $siteEmail    = site_email();
                $siteAddress  = site_address();
                $siteName     = site_name();
                $siteLogo     = Setting::where('key', 'site_logo')->value('value');

                $footerPages = Page::where('status', 'published')
                    ->whereIn('slug', [
                        'privacy-policy',
                        'terms-and-conditions',
                        'shipping-policy',
                        'return-refund-policy',
                    ])
                    ->orderBy('title')
                    ->get();

                $footerCategories = Category::active()->orderByDesc('is_featured')->orderBy('sort_order')->take(6)->get();
                $activeServices   = Service::active()->orderBy('sort_order')->get();
                $cartCount        = app(CartService::class)->count();

                $view->with(compact(
                    'siteName', 'siteLogo',
                    'sitePhone', 'sitePhoneRaw', 'siteWhatsApp', 'siteEmail', 'siteAddress',
                    'footerPages', 'footerCategories', 'activeServices', 'cartCount'
                ));
            } catch (\Throwable $e) {
                // DB not ready yet (during migrations / first install)
            }
        });

        /*
         | The 2026 front-end renders product cards, the filter sidebar, live
         | search and compare from window.TURTLE_PRODUCTS. Share the DB-backed
         | catalogue and the user's wishlist ids with the site layout so those
         | scripts keep working without the old hardcoded data file.
         */
        View::composer('site.layouts.app', function ($view) {
            try {
                $view->with([
                    'tmCatalogue'    => TmCatalog::all(),
                    'tmWishlistIds'  => Auth::check()
                        ? Wishlist::where('user_id', Auth::id())->pluck('product_id')->map(fn ($id) => (string) $id)->all()
                        : [],
                ]);
            } catch (\Throwable $e) {
                $view->with(['tmCatalogue' => [], 'tmWishlistIds' => []]);
            }
        });
    }
}
