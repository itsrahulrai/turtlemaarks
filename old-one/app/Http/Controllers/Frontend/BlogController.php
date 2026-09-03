<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /** Icons used by the category pill bar in the 2026 design. */
    private const CATEGORY_ICONS = [
        'All'          => 'bi-grid-fill',
        'Buying Guide' => 'bi-bag-check-fill',
        'Diagnostics'  => 'bi-activity',
        'Senior Care'  => 'bi-heart-pulse-fill',
        'Therapy'      => 'bi-soundwave',
        'Technology'   => 'bi-cpu-fill',
        'Wellness'     => 'bi-shield-check',
    ];

    public function index(Request $request)
    {
        $query = Blog::with(['blogCategory', 'admin'])->published();

        if ($request->filled('category')) {
            $query->whereHas('blogCategory', fn ($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('q')) {
            $term = $request->q;
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                  ->orWhere('excerpt', 'like', "%{$term}%")
                  ->orWhere('tags', 'like', "%{$term}%");
            });
        }

        match ($request->input('sort', 'newest')) {
            'oldest'  => $query->oldest('published_at'),
            'popular' => $query->orderByDesc('views'),
            default   => $query->latest('published_at'),
        };

        $blogs = $query->paginate(6)->withQueryString();

        $categories = collect([[
            'id'    => null,
            'name'  => 'All',
            'slug'  => null,
            'count' => Blog::published()->count(),
        ]])->concat(
            BlogCategory::withCount(['blogs' => fn ($q) => $q->published()])
                ->get()
                ->map(fn ($c) => [
                    'id'    => $c->id,
                    'name'  => $c->name,
                    'slug'  => $c->slug,
                    'count' => $c->blogs_count,
                ])
        );

        return view('site.blogs', [
            'blogs'           => $blogs,
            'categories'      => $categories,
            'category_icons'  => self::CATEGORY_ICONS,
        ]);
    }

    public function show(string $slug)
    {
        $blog = Blog::with(['blogCategory', 'admin'])->published()->where('slug', $slug)->firstOrFail();
        $blog->increment('views');

        $related = Blog::published()
            ->where('id', '!=', $blog->id)
            ->when($blog->blog_category_id, fn ($q) => $q->where('blog_category_id', $blog->blog_category_id))
            ->with('blogCategory')
            ->latest('published_at')
            ->take(2)
            ->get();

        $prevBlog = Blog::published()->where('id', '<', $blog->id)->orderByDesc('id')->first();
        $nextBlog = Blog::published()->where('id', '>', $blog->id)->orderBy('id')->first();

        $recentPosts = Blog::published()->where('id', '!=', $blog->id)->latest('published_at')->take(4)->get();

        $categories = BlogCategory::withCount(['blogs' => fn ($q) => $q->published()])
            ->get()
            ->map(fn ($c) => [
                'id'    => $c->id,
                'name'  => $c->name,
                'slug'  => $c->slug,
                'count' => $c->blogs_count,
                'icon'  => self::CATEGORY_ICONS[$c->name] ?? 'bi-tag-fill',
            ]);

        return view('site.blog-detail', [
            'blog'        => $blog,
            'related'     => $related,
            'prevBlog'    => $prevBlog,
            'nextBlog'    => $nextBlog,
            'recentPosts' => $recentPosts,
            'categories'  => $categories,
            'totalBlogs'  => Blog::published()->count(),
        ]);
    }
}
