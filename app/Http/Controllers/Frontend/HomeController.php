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

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::active()->get();
        $featuredCategories = Category::active()->featured()->with('subcategories')->take(8)->get();
        $featuredProducts = Product::active()->featured()->with(['images', 'category', 'brand'])->take(8)->get();
        $trendingProducts = Product::active()->trending()->with(['images', 'category', 'brand'])->take(8)->get();
        $newArrivals      = Product::active()->newArrivals()->with(['images', 'category', 'brand'])->take(8)->get();
        $bestSellers      = Product::active()->bestSellers()->with(['images', 'category', 'brand'])->take(8)->get();
        $saleProducts     = Product::active()->onSale()->with(['images', 'category', 'brand'])->take(8)->get();
        $testimonials     = Testimonial::active()->take(6)->get();
        $latestBlogs      = Blog::published()->latest('published_at')->take(3)->get();
        $brands           = Brand::active()->orderBy('sort_order')->get();
        $services         = Service::active()->orderBy('sort_order')->take(6)->get();

        return view('site.index', compact(
            'banners', 'featuredCategories', 'featuredProducts',
            'trendingProducts', 'newArrivals', 'bestSellers',
            'saleProducts', 'testimonials', 'latestBlogs',
            'brands', 'services'
        ));
    }
}
