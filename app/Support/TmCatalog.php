<?php

namespace App\Support;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * TURTLE MAARKS — CATALOGUE BRIDGE
 *
 * The 2026 front-end (cards, filter sidebar, compare, wishlist, live search)
 * expects every product as a flat array with a fixed set of keys. This class
 * is the single place where an Eloquent Product is translated into that shape,
 * so the Blade card, assets/js/products.js and assets/js/filter.js all keep
 * working while the data itself comes from the database / admin panel.
 *
 * Key map (front-end key => DB source)
 *   id               => product id
 *   slug/url         => slug / route('product.show')
 *   name             => name
 *   brand            => brand.name
 *   brandOrigin      => brand origin lookup (falls back to "Global")
 *   style            => form_factor (RIC / BTE / CIC / IIC / ITC / ITE / Accessory)
 *   price / mrp      => effective_price / price
 *   channels         => channels
 *   rechargeable     => battery_type contains "recharge" OR tag
 *   bluetooth        => connectivity contains "bluetooth"
 *   image            => thumbnail_url
 *   rating / reviews => reviews aggregate
 *   category         => category.slug
 *   badge            => discount badge
 *   featureHighlight => short_description first clause
 *   isPopular        => is_best_seller || is_trending
 *   isFeatured       => is_featured
 */
class TmCatalog
{
    /** Country of origin shown on every card next to the brand name. */
    public const BRAND_ORIGINS = [
        'phonak'  => 'Switzerland',
        'oticon'  => 'Denmark',
        'resound' => 'Denmark',
        'gn resound' => 'Denmark',
        'signia'  => 'Germany',
        'widex'   => 'Denmark',
        'starkey' => 'USA',
        'unitron' => 'Canada',
        'vesuvio' => 'Italy',
        'alps'    => 'India',
        'alps international' => 'India',
        'earkart' => 'India',
    ];

    /** Whole catalogue as front-end arrays directly from database. */
    public static function all(): array
    {
        return Product::active()
            ->with(['brand', 'category', 'subcategory'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('is_featured')
            ->orderByDesc('is_best_seller')
            ->orderBy('name')
            ->get()
            ->map(fn (Product $p) => self::map($p))
            ->all();
    }

    public static function flushCache(): void
    {
        Cache::forget('tm.catalogue.v1');
    }

    /** Map one Eloquent product into the front-end array shape. */
    public static function map(Product $p): array
    {
        $brand        = $p->brand?->name ?: 'Turtle Maarks';
        $price        = (float) $p->effective_price;
        $mrp          = (float) $p->price;
        $connectivity = strtolower((string) $p->connectivity);
        $battery      = strtolower((string) $p->battery_type);
        $tags         = array_map('strtolower', (array) ($p->tags ?? []));

        $rechargeable = str_contains($battery, 'recharge')
            || str_contains($battery, 'li-ion')
            || str_contains($battery, 'lithium')
            || in_array('rechargeable', $tags, true);

        $bluetooth = str_contains($connectivity, 'bluetooth')
            || str_contains($connectivity, 'ble')
            || str_contains($connectivity, 'wireless')
            || in_array('bluetooth', $tags, true);

        $discount = $p->discount_percent;

        return [
            'id'               => (string) $p->id,
            'slug'             => $p->slug,
            'url'              => route('product.show', $p->slug),
            'name'             => $p->name,
            'brand'            => $brand,
            'brandOrigin'      => self::BRAND_ORIGINS[strtolower($brand)] ?? 'Global',
            'style'            => self::style($p),
            'price'            => $price,
            'mrp'              => $mrp,
            'channels'         => $p->channels ? (int) $p->channels : null,
            'rechargeable'     => $rechargeable,
            'bluetooth'        => $bluetooth,
            'image'            => $p->thumbnail_url,
            'rating'           => round((float) ($p->reviews_avg_rating ?: 4.8), 1),
            'reviews'          => (int) ($p->reviews_count ?: 0),
            'category'         => $p->category?->slug ?: 'hearing-aids',
            'categoryName'     => $p->category?->name ?: 'Hearing Aids',
            'categoryId'       => $p->category_id,
            'subcategory'      => $p->subcategory?->slug ?: '',
            'subcategoryName'  => $p->subcategory?->name ?: '',
            'subcategoryId'    => $p->subcategory_id,
            'techLevel'        => $p->model_number ?: '',
            'badge'            => $discount > 0 ? $discount . '% OFF' : 'Authorized',
            'featureHighlight' => self::highlight($p),
            'isPopular'        => (bool) ($p->is_best_seller || $p->is_trending),
            'isFeatured'       => (bool) $p->is_featured,
            'inStock'          => $p->isInStock(),
        ];
    }

    /** Normalised form factor used by the filter sidebar. */
    private static function style(Product $p): string
    {
        $raw = strtoupper(trim((string) ($p->form_factor ?: $p->subcategory?->name ?: '')));

        foreach (['IIC', 'CIC', 'ITC', 'ITE', 'RIC', 'RIE', 'BTE'] as $code) {
            if (str_contains($raw, $code)) {
                return $code === 'RIE' ? 'RIC' : $code;
            }
        }

        if ($p->product_kind === 'accessory') {
            return 'Accessory';
        }

        return $raw !== '' ? $raw : 'RIC';
    }

    /** Short marketing chip shown on the card. */
    private static function highlight(Product $p): string
    {
        $text = trim(strip_tags((string) $p->short_description));
        if ($text === '') {
            return '';
        }
        $first = preg_split('/[.,;•|]/', $text)[0] ?? $text;
        $first = trim($first);

        return mb_strlen($first) > 34 ? mb_substr($first, 0, 32) . '…' : $first;
    }

    /* -----------------------------------------------------------------
     | Query helpers — mirror of the front-end TurtleProducts.filter()
     ----------------------------------------------------------------- */

    /**
     * Supported keys: brand, style, subcategory, category, isPopular, isFeatured,
     * rechargeableOnly, bluetoothOnly, minPrice, maxPrice, search, sort, limit
     */
    public static function filter(array $c = []): array
    {
        $list = collect(self::all());

        if (!empty($c['brand'])) {
            $brands = array_map('strtolower', (array) $c['brand']);
            $list = $list->filter(function ($p) use ($brands) {
                $pBrand = strtolower($p['brand'] ?? '');
                $pSlug = Str::slug($p['brand'] ?? '');
                foreach ($brands as $b) {
                    $bSlug = Str::slug($b);
                    if ($pBrand === $b || $pSlug === $bSlug || $pBrand === $bSlug || $pSlug === $b) {
                        return true;
                    }
                }
                return false;
            });
        }

        if (!empty($c['category'])) {
            $cats = array_map('strtolower', (array) $c['category']);
            $list = $list->filter(function ($p) use ($cats) {
                $cat = strtolower($p['category']);
                $catName = strtolower($p['categoryName'] ?? '');
                foreach ($cats as $c) {
                    if ($cat === $c || $catName === $c || str_contains($cat, $c) || str_contains($c, $cat)) {
                        return true;
                    }
                }
                if (in_array('rechargeable', $cats, true) && $p['rechargeable']) return true;
                if (in_array('bluetooth', $cats, true) && $p['bluetooth'])       return true;
                if (in_array('accessories', $cats, true) || in_array('chargers', $cats, true)) {
                    return in_array($cat, ['accessories', 'batteries', 'chargers', 'hearing-aid-charger'], true)
                        || $p['style'] === 'Accessory';
                }
                return false;
            });
        }

        if (!empty($c['subcategory'])) {
            $subs = array_map('strtolower', (array) $c['subcategory']);
            $list = $list->filter(function ($p) use ($subs) {
                $sub = strtolower($p['subcategory'] ?? '');
                $subName = strtolower($p['subcategoryName'] ?? '');
                return in_array($sub, $subs, true) || in_array($subName, $subs, true);
            });
        }

        $styles = (array) ($c['style'] ?? []);
        if (!empty($styles)) {
            $styles = array_map('strtolower', $styles);
            $list = $list->filter(function ($p) use ($styles) {
                $style = strtolower($p['style'] ?? '');
                if (in_array($style, $styles, true)) return true;
                if (in_array('itc', $styles, true) && in_array($style, ['itc', 'ite'], true)) return true;
                if (in_array('accessory', $styles, true)) {
                    return $style === 'accessory'
                        || in_array($p['category'], ['accessories', 'batteries', 'chargers', 'hearing-aid-charger'], true);
                }
                return false;
            });
        }

        if (!empty($c['isPopular']))        $list = $list->filter(fn ($p) => $p['isPopular']);
        if (!empty($c['isFeatured']))       $list = $list->filter(fn ($p) => $p['isFeatured']);
        if (!empty($c['rechargeableOnly'])) $list = $list->filter(fn ($p) => $p['rechargeable']);
        if (!empty($c['bluetoothOnly']))    $list = $list->filter(fn ($p) => $p['bluetooth']);
        if (isset($c['minPrice']))          $list = $list->filter(fn ($p) => $p['price'] >= (float) $c['minPrice']);
        if (isset($c['maxPrice']))          $list = $list->filter(fn ($p) => $p['price'] <= (float) $c['maxPrice']);

        if (!empty($c['search'])) {
            $q = mb_strtolower(trim($c['search']));
            $list = $list->filter(function ($p) use ($q) {
                $hay = mb_strtolower($p['name'] . ' ' . $p['brand'] . ' ' . $p['style'] . ' '
                    . $p['techLevel'] . ' ' . $p['featureHighlight'] . ' ' . $p['categoryName']);
                return str_contains($hay, $q);
            });
        }

        $list = $list->values();

        $list = match ($c['sort'] ?? '') {
            'price-asc', 'price-low'   => $list->sortBy('price')->values(),
            'price-desc', 'price-high' => $list->sortByDesc('price')->values(),
            'rating'                   => $list->sortByDesc('rating')->values(),
            'name'                     => $list->sortBy('name')->values(),
            default                    => $list,
        };

        if (!empty($c['limit'])) {
            $list = $list->take((int) $c['limit'])->values();
        }

        return $list->all();
    }

    public static function find(string|int $id): ?array
    {
        foreach (self::all() as $p) {
            if ((string) $p['id'] === (string) $id || $p['slug'] === (string) $id) {
                return $p;
            }
        }
        return null;
    }

    /** All active brands from the database with live product counts. */
    public static function brands(): Collection
    {
        $productsByBrand = collect(self::all())->groupBy(fn ($p) => strtolower($p['brand'] ?? ''));

        $dbBrands = Brand::active()->orderBy('sort_order')->get();

        if ($dbBrands->isEmpty()) {
            return collect(self::all())
                ->groupBy('brand')
                ->map(fn ($items, $name) => [
                    'name'   => $name,
                    'slug'   => Str::slug($name),
                    'origin' => $items->first()['brandOrigin'] ?? 'Global',
                    'count'  => $items->count(),
                ])
                ->sortByDesc('count')
                ->values();
        }

        return $dbBrands->map(function ($b) use ($productsByBrand) {
            $key = strtolower($b->name);
            $items = $productsByBrand->get($key, collect());
            $origin = self::BRAND_ORIGINS[$key] ?? ($items->first()['brandOrigin'] ?? 'Global');

            return [
                'name'   => $b->name,
                'slug'   => $b->slug,
                'origin' => $origin,
                'count'  => $items->count(),
            ];
        });
    }

    /** Distinct form factors with counts. */
    public static function styles(): Collection
    {
        return collect(self::all())
            ->groupBy('style')
            ->map(fn ($items, $style) => ['style' => $style, 'count' => $items->count()])
            ->sortByDesc('count')
            ->values();
    }

    /** Counts used by the "Category" block of the filter sidebar. */
    public static function categoryCounts(): array
    {
        $all = collect(self::all());
        $counts = [];
        foreach ($all as $p) {
            $slug = strtolower($p['category'] ?? '');
            if ($slug !== '') {
                $counts[$slug] = ($counts[$slug] ?? 0) + 1;
            }
        }
        return $counts;
    }

    /** Counts used by the "Subcategory" block of the filter sidebar. */
    public static function subcategoryCounts(): array
    {
        $all = collect(self::all());
        $counts = [];
        foreach ($all as $p) {
            $slug = strtolower($p['subcategory'] ?? '');
            if ($slug !== '') {
                $counts[$slug] = ($counts[$slug] ?? 0) + 1;
            }
        }
        return $counts;
    }

    public static function priceBounds(): array
    {
        $prices = collect(self::all())->pluck('price');

        return [
            'min' => (int) floor(($prices->min() ?: 0) / 1000) * 1000,
            'max' => (int) ceil(($prices->max() ?: 500000) / 1000) * 1000,
        ];
    }
}
