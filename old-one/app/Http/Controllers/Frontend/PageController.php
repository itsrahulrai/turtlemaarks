<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\NewsletterSubscriber;
use App\Models\Page;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function newsletter(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        NewsletterSubscriber::firstOrCreate(['email' => $request->email]);

        return back()->with('success', 'Subscribed successfully!');
    }

    public function sitemap()
    {
        $products = Product::active()->get(['slug', 'updated_at']);
        $services = Service::active()->get(['slug', 'updated_at']);
        $blogs    = Blog::published()->get(['slug', 'updated_at']);

        return response()
            ->view('site.sitemap', compact('products', 'services', 'blogs'))
            ->header('Content-Type', 'application/xml');
    }

    public function robots()
    {
        $content = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /account/\nDisallow: /checkout/\nSitemap: " . url('/sitemap.xml');

        return response($content)->header('Content-Type', 'text/plain');
    }

    /** Admin-managed CMS pages (catch-all route). */
    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)->where('status', 'published')->firstOrFail();

        return view('site.page', compact('page'));
    }
}
