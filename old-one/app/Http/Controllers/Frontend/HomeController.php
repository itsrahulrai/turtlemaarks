<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use App\Models\Testimonial;
use App\Support\TmCatalog;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Featured/Popular products directly queried from database via Product model
        $popularProducts = Product::active()
            ->with(['brand', 'category', 'subcategory'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('is_featured')
            ->orderByDesc('is_best_seller')
            ->orderBy('name')
            ->take(8)
            ->get()
            ->map(fn (Product $p) => TmCatalog::map($p))
            ->all();

        // 2. Default 4 products across authorized brands directly from database via Product model
        $brandProducts = Product::active()
            ->with(['brand', 'category', 'subcategory'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderBy('name')
            ->take(4)
            ->get()
            ->map(fn (Product $p) => TmCatalog::map($p))
            ->all();

        $topBrand      = 'all';

        $banners      = Banner::active()->get();
        $categories   = Category::active()->orderBy('sort_order')->with('subcategories')->get();
        $testimonials = Testimonial::active()->take(6)->get();
        $latestBlogs  = Blog::published()->with('blogCategory')->latest('published_at')->take(3)->get();
        $brands       = Brand::active()->orderBy('sort_order')->get();
        $services     = Service::active()->orderBy('sort_order')->take(6)->get();

        return view('site.index', compact(
            'popularProducts', 'brandProducts', 'topBrand',
            'banners', 'categories', 'testimonials', 'latestBlogs', 'brands', 'services'
        ));
    }
}
