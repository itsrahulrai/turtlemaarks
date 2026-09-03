<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // IMPORTANT:
        // Categories and subcategories are ALREADY in the database.
        // This seeder inserts PRODUCTS ONLY. It never creates categories,
        // subcategories, or brands.

        $products = [

            // =============================================================
            // WIDEX — 18 PRODUCTS
            // =============================================================
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Magnify 50 MBR3D mBTE Hearing Aids', 'model' => 'Magnify 50 MBR3D', 'form' => 'mBTE', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Magnify MRBO 30 Hearing Aids', 'model' => 'Magnify MRBO 30', 'form' => 'BTE', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Kit Moment 110 MBR3D Hearing Aid', 'model' => 'Kit Moment 110 MBR3D', 'form' => 'BTE', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Evoke 440 RIC Hearing Aids', 'model' => 'Evoke 440', 'form' => 'RIC', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Kit Moment 220 Hearing Aids', 'model' => 'Kit Moment 220', 'form' => 'RIC', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Moment 330 BTE Hearing Aids', 'model' => 'Moment 330', 'form' => 'BTE', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Enjoy 100 Hearing Aids', 'model' => 'Enjoy 100', 'form' => 'BTE', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Evoke 110 Hearing Aids', 'model' => 'Evoke 110', 'form' => 'RIC', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Evoke 30 Hearing Aids', 'model' => 'Evoke 30', 'form' => 'RIC', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Evoke 50 Hearing Aids', 'model' => 'Evoke 50', 'form' => 'RIC', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Moment Sheer MRR4D RIC Rechargeable Hearing Aid', 'model' => 'Moment Sheer MRR4D', 'form' => 'RIC', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Magnify 100 BTE Hearing Aid', 'model' => 'Magnify 100', 'form' => 'BTE', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Evoke 220 Hearing Aids', 'model' => 'Evoke 220', 'form' => 'RIC', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Evoke 330 Hearing Aids', 'model' => 'Evoke 330', 'form' => 'RIC', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Kit Magnify Hearing Aid', 'model' => 'Kit Magnify', 'form' => 'BTE', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Kit Moment 110 Hearing Aids', 'model' => 'Kit Moment 110', 'form' => 'RIC', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Kit Moment 440 Hearing Aids', 'model' => 'Kit Moment 440', 'form' => 'RIC', 'price' => 0],
            ['category' => 'widex-hearing-aids', 'brand' => 'Widex', 'name' => 'Widex Kit Moment SmartRIC Hearing Aids', 'model' => 'Kit Moment SmartRIC', 'form' => 'RIC', 'price' => 0],

            // =============================================================
            // STARKEY — 12 PRODUCTS
            // =============================================================
            ['category' => 'starkey-hearing-aids', 'brand' => 'Starkey', 'name' => 'Starkey Genesis AI 20 RIC Hearing Aid', 'model' => 'Genesis AI 20 RIC', 'form' => 'RIC', 'price' => 0],
            ['category' => 'starkey-hearing-aids', 'brand' => 'Starkey', 'name' => 'Starkey Genesis AI 24 MRIC Hearing Aids', 'model' => 'Genesis AI 24 MRIC', 'form' => 'mRIC', 'price' => 0],
            ['category' => 'starkey-hearing-aids', 'brand' => 'Starkey', 'name' => 'Starkey Genesis AI 24 ITC Hearing Aids', 'model' => 'Genesis AI 24 ITC', 'form' => 'ITC', 'price' => 0],
            ['category' => 'starkey-hearing-aids', 'brand' => 'Starkey', 'name' => 'Starkey Genesis AI 16 ITC Hearing Aids', 'model' => 'Genesis AI 16 ITC', 'form' => 'ITC', 'price' => 0],
            ['category' => 'starkey-hearing-aids', 'brand' => 'Starkey', 'name' => 'Starkey Genesis AI 24 CIC Hearing Aids', 'model' => 'Genesis AI 24 CIC', 'form' => 'CIC', 'price' => 0],
            ['category' => 'starkey-hearing-aids', 'brand' => 'Starkey', 'name' => 'Starkey Genesis AI 24 CIC Hearing Aids - Second', 'model' => 'Genesis AI 24 CIC - Second', 'form' => 'CIC', 'price' => 0],
            ['category' => 'starkey-hearing-aids', 'brand' => 'Starkey', 'name' => 'Starkey Genesis AI 16 CIC Hearing Aids', 'model' => 'Genesis AI 16 CIC', 'form' => 'CIC', 'price' => 0],
            ['category' => 'starkey-hearing-aids', 'brand' => 'Starkey', 'name' => 'Starkey Genesis AI 20 MRIC R Rechargeable Hearing Aid', 'model' => 'Genesis AI 20 MRIC R', 'form' => 'mRIC', 'price' => 0],
            ['category' => 'starkey-hearing-aids', 'brand' => 'Starkey', 'name' => 'Starkey Genesis AI 16 MRIC Aids', 'model' => 'Genesis AI 16 MRIC', 'form' => 'mRIC', 'price' => 0],
            ['category' => 'starkey-hearing-aids', 'brand' => 'Starkey', 'name' => 'Starkey Genesis AI 24 RIC Hearing Aids', 'model' => 'Genesis AI 24 RIC', 'form' => 'RIC', 'price' => 0],
            ['category' => 'starkey-hearing-aids', 'brand' => 'Starkey', 'name' => 'Starkey Genesis AI 24 RIC RT Hearing Aids', 'model' => 'Genesis AI 24 RIC RT', 'form' => 'RIC', 'price' => 0],
            ['category' => 'starkey-hearing-aids', 'brand' => 'Starkey', 'name' => 'Starkey Genesis AI 20 ITC R Hearing Aids', 'model' => 'Genesis AI 20 ITC R', 'form' => 'ITC', 'price' => 0],

            // =============================================================
            // PHONAK — 7 PRODUCTS
            // =============================================================
            ['category' => 'phonak-hearing-aid', 'brand' => 'Phonak', 'name' => 'Phonak Naida L70-UP BTE Hearing Aid', 'model' => 'Naida L70-UP', 'form' => 'BTE', 'price' => 0],
            ['category' => 'phonak-hearing-aid', 'brand' => 'Phonak', 'name' => 'Phonak Naida L90-UP BTE Hearing Aid', 'model' => 'Naida L90-UP', 'form' => 'BTE', 'price' => 0],
            ['category' => 'phonak-hearing-aid', 'brand' => 'Phonak', 'name' => 'Phonak Naida P50-UP Hearing Aid', 'model' => 'Naida P50-UP', 'form' => 'BTE', 'price' => 0],
            ['category' => 'phonak-hearing-aid', 'brand' => 'Phonak', 'name' => 'Phonak Naida P90-UP Hearing Aid', 'model' => 'Naida P90-UP', 'form' => 'BTE', 'price' => 0],
            ['category' => 'phonak-hearing-aid', 'brand' => 'Phonak', 'name' => 'Phonak Naida L50-UP BTE Hearing Aid', 'model' => 'Naida L50-UP', 'form' => 'BTE', 'price' => 0],
            ['category' => 'phonak-hearing-aid', 'brand' => 'Phonak', 'name' => 'Phonak Naida P30 UP Hearing Aid', 'model' => 'Naida P30-UP', 'form' => 'BTE', 'price' => 0],
            ['category' => 'phonak-hearing-aid', 'brand' => 'Phonak', 'name' => 'Phonak Naida P70-UP Hearing Aid', 'model' => 'Naida P70-UP', 'form' => 'BTE', 'price' => 0],

            // =============================================================
            // RESOUND — 4 PRODUCTS
            // =============================================================
            ['category' => 'resound-hearing-aids', 'brand' => 'ReSound', 'name' => 'Resound NEXIA RIE Hearing Aid', 'model' => 'NEXIA RIE', 'form' => 'RIE', 'price' => 0],
            ['category' => 'resound-hearing-aids', 'brand' => 'ReSound', 'name' => 'Resound Omnia 4 Mini RIC Rechargeable Hearing Aid', 'model' => 'Omnia 4 Mini RIC', 'form' => 'RIC', 'price' => 0],
            ['category' => 'resound-hearing-aids', 'brand' => 'ReSound', 'name' => 'Resound GN NEXIA 760S MicroRIE Rechargeable Hearing Aid', 'model' => 'GN NEXIA 760S', 'form' => 'MicroRIE', 'price' => 0],
            ['category' => 'resound-hearing-aids', 'brand' => 'ReSound', 'name' => 'Resound NEXIA 560S CROS MicroRIE Rechargeable Hearing Aid', 'model' => 'NEXIA 560S CROS', 'form' => 'MicroRIE', 'price' => 0],

            // =============================================================
            // VESUVIO — 4 PRODUCTS
            // =============================================================
            ['category' => 'vesuvio-hearung-aids', 'brand' => 'Vesuvio', 'name' => 'Vesuvio XTM XP P4 Hearing Aid', 'model' => 'XTM XP P4', 'form' => 'BTE', 'price' => 0],
            ['category' => 'vesuvio-hearung-aids', 'brand' => 'Vesuvio', 'name' => 'Vesuvio SFT P3 Hearing Aid', 'model' => 'SFT P3', 'form' => 'BTE', 'price' => 0],
            ['category' => 'vesuvio-hearung-aids', 'brand' => 'Vesuvio', 'name' => 'Vesuvio XTM P4 Hearing Aid', 'model' => 'XTM P4', 'form' => 'BTE', 'price' => 0],
            ['category' => 'vesuvio-hearung-aids', 'brand' => 'Vesuvio', 'name' => 'Vesuvio SFT XP T3 Hearing Aid', 'model' => 'SFT XP T3', 'form' => 'BTE', 'price' => 0],

            // =============================================================
            // UNITRON — 4 PRODUCTS
            // =============================================================
            ['category' => 'unitron-hearing-aids', 'brand' => 'Unitron', 'name' => 'Unitron Moxi S-R Premium', 'model' => 'Moxi S-R Premium', 'form' => 'RIC', 'price' => 0],
            ['category' => 'unitron-hearing-aids', 'brand' => 'Unitron', 'name' => 'Unitron Moxi S-R Advanced', 'model' => 'Moxi S-R Advanced', 'form' => 'RIC', 'price' => 0],
            ['category' => 'unitron-hearing-aids', 'brand' => 'Unitron', 'name' => 'Unitron Moxi S-R Standard', 'model' => 'Moxi S-R Standard', 'form' => 'RIC', 'price' => 0],
            ['category' => 'unitron-hearing-aids', 'brand' => 'Unitron', 'name' => 'Unitron Moxi S-R Essential', 'model' => 'Moxi S-R Essential', 'form' => 'RIC', 'price' => 0],

            // =============================================================
            // HEARING AID CHARGER — 1 PRODUCT
            // =============================================================
            ['category' => 'hearing-aid-charger', 'brand' => 'Unitron', 'name' => 'Unitron Moxi RS Hearing Aid Charger', 'model' => 'Moxi RS Charger', 'form' => 'Charger', 'price' => 0],
        ];

        foreach ($products as $item) {

            // Existing category only. NEVER create one.
            $category = DB::table('categories')
                ->where('slug', $item['category'])
                ->first();

            if (!$category) {
                continue;
            }

            // Existing brand only. NEVER create one.
            $brand = DB::table('brands')
                ->where('name', $item['brand'])
                ->orWhere('slug', Str::slug($item['brand']))
                ->first();

            if (!$brand) {
                continue;
            }

            // Existing subcategory only. NEVER create one.
            $subcategory = DB::table('subcategories')
                ->where('category_id', $category->id)
                ->where(function ($q) use ($item) {
                    $q->where('name', $item['form'])
                      ->orWhere('slug', Str::slug($item['form']));
                })
                ->first();

            $slug = Str::slug($item['name']);

            DB::table('products')->updateOrInsert(
                ['slug' => $slug],
                [
                    'category_id' => $category->id,
                    'subcategory_id' => $subcategory?->id,
                    'brand_id' => $brand->id,

                    'name' => $item['name'],
                    'slug' => $slug,
                    'sku' => 'HA-' . strtoupper(substr(md5($slug), 0, 8)),

                    'short_description' =>
                        $item['brand'] . ' ' . $item['model'] .
                        ' designed for clear, comfortable everyday hearing.',

                    'description' =>
                        $item['name'] .
                        ' is a hearing solution from ' .
                        $item['brand'] .
                        ', designed for reliable performance and everyday listening comfort.',

                    'price' => $item['price'],
                    'sale_price' => null,
                    'cost_price' => null,

                    'stock' => 20,
                    'low_stock_threshold' => 5,
                    'manage_stock' => true,

                    'status' => 'active',

                    'is_featured' => false,
                    'is_trending' => false,
                    'is_new_arrival' => false,
                    'is_best_seller' => false,
                    'is_on_sale' => false,

                    'tax_rate' => 0,

                    'product_kind' =>
                        $item['form'] === 'Charger'
                            ? 'accessory'
                            : 'hearing_aid',

                    'model_number' => $item['model'],
                    'form_factor' => $item['form'],
                    'kit_configuration' => 'Standard',

                    'warranty_months' => 24,

                    'channels' => null,
                    'fitting_range' => null,
                    'battery_type' => 'Rechargeable',
                    'receiver_options' => null,
                    'connectivity' => 'Wireless',

                    'colour_options' => json_encode([
                        'Standard Beige',
                        'Black',
                        'Brown',
                    ]),

                    'specifications' => json_encode([
                        'brand' => $item['brand'],
                        'model' => $item['model'],
                        'form_factor' => $item['form'],
                    ]),

                    'tags' => json_encode([
                        'hearing aid',
                        strtolower($item['brand']),
                        strtolower($item['model']),
                        strtolower($item['form']),
                    ]),

                    'meta_title' => $item['name'] . ' | Hearing Aid',

                    'meta_description' =>
                        'Explore ' . $item['name'] .
                        '. View features, specifications and pricing.',

                    'meta_keywords' =>
                        strtolower(
                            $item['brand'] . ', ' .
                            $item['model'] . ', hearing aid'
                        ),

                    'views' => 0,

                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
