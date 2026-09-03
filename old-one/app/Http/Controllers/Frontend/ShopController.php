<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Subcategory;
use App\Support\TmCatalog;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private const PER_PAGE = 9;

    /**
     * Catalogue page. Honours ?brand[] ?style[] ?category[] ?q ?sort ?max_price ?page
     * so the grid is populated (and indexable) before filter.js takes over.
     */
    public function index(Request $request)
    {
        $criteria = array_filter([
            'brand'       => (array) $request->input('brand', []),
            'style'       => (array) $request->input('style', []),
            'category'    => (array) $request->input('category', []),
            'search'      => $request->input('q'),
            'sort'        => $request->input('sort'),
            'maxPrice'    => $request->input('max_price'),
            'minPrice'    => $request->input('min_price'),
        ], fn ($v) => $v !== null && $v !== '' && $v !== []);

        $matches = TmCatalog::filter($criteria);

        $total       = count($matches);
        $lastPage    = max(1, (int) ceil($total / self::PER_PAGE));
        $currentPage = max(1, min($lastPage, (int) $request->input('page', 1)));
        $offset      = ($currentPage - 1) * self::PER_PAGE;

        return view('site.products', [
            'products'           => array_slice($matches, $offset, self::PER_PAGE),
            'total'              => $total,
            'from'               => $offset + 1,
            'to'                 => min($offset + self::PER_PAGE, $total),
            'currentPage'        => $currentPage,
            'lastPage'           => $lastPage,
            'catalogueBrands'    => TmCatalog::brands(),
            'styles'             => TmCatalog::styles(),
            'categories'         => Category::active()->orderBy('sort_order')->get(),
            'subcategories'      => Subcategory::active()->orderBy('sort_order')->get(),
            'categoryCounts'     => TmCatalog::categoryCounts(),
            'subcategoryCounts'  => TmCatalog::subcategoryCounts(),
            'priceBounds'        => TmCatalog::priceBounds(),
        ]);
    }

    public function show(string $slug)
    {
        $product = Product::active()
            ->with(['category', 'subcategory', 'brand', 'images', 'variants'])
            ->where('slug', $slug)
            ->firstOrFail();

        $product->increment('views');

        $p = TmCatalog::map($product->loadCount('reviews')->loadAvg('reviews', 'rating'));

        // Related = same brand first, topped up with the same form factor.
        $related = array_values(array_filter(
            TmCatalog::filter(['brand' => $p['brand'], 'limit' => 5]),
            fn ($r) => $r['id'] !== $p['id']
        ));

        if (count($related) < 4) {
            foreach (TmCatalog::filter(['style' => $p['style'], 'limit' => 8]) as $m) {
                if ($m['id'] !== $p['id'] && !in_array($m['id'], array_column($related, 'id'), true)) {
                    $related[] = $m;
                }
            }
        }
        $related = array_slice($related, 0, 4);

        $reviews = Review::with('user')
            ->where('product_id', $product->id)
            ->where('status', 'approved')
            ->latest()
            ->take(10)
            ->get();

        // Star distribution for the ratings bar chart.
        $counts = Review::where('product_id', $product->id)
            ->where('status', 'approved')
            ->selectRaw('rating, COUNT(*) as total')
            ->groupBy('rating')
            ->pluck('total', 'rating');

        $totalReviews    = max(1, (int) $counts->sum());
        $ratingBreakdown = [];
        for ($star = 1; $star <= 5; $star++) {
            $ratingBreakdown[$star] = (int) round((($counts[$star] ?? 0) / $totalReviews) * 100);
        }

        return view('site.product-detail', compact('product', 'p', 'related', 'reviews', 'ratingBreakdown'));
    }

    public function search(Request $request)
    {
        $q = trim((string) $request->input('q', ''));

        return view('site.search', [
            'q'       => $q,
            'results' => TmCatalog::filter($q !== '' ? ['search' => $q] : []),
        ]);
    }

    public function ajaxSearch(Request $request)
    {
        $q = trim((string) $request->input('q', ''));
        if (mb_strlen($q) < 2) {
            return response()->json([]);
        }

        return response()->json(
            collect(TmCatalog::filter(['search' => $q, 'limit' => 8]))
                ->map(fn ($p) => [
                    'id'    => $p['id'],
                    'name'  => $p['name'],
                    'price' => $p['price'],
                    'image' => $p['image'],
                    'url'   => $p['url'],
                ])->values()
        );
    }
}
