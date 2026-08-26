<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Get existing category
        |--------------------------------------------------------------------------
        */
        $category = DB::table('categories')
            ->where('slug', 'hearing-aids')
            ->first();

        if (!$category) {
            $category = DB::table('categories')
                ->where('name', 'Hearing Aids')
                ->first();
        }

        if (!$category) {
            throw new \Exception(
                'Hearing Aids category not found. Please create the category first.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Helper: Find brand
        |--------------------------------------------------------------------------
        */
        $brand = function (string $name) {
            return DB::table('brands')
                ->where('name', $name)
                ->orWhere('slug', Str::slug($name))
                ->first();
        };

        /*
        |--------------------------------------------------------------------------
        | Helper: Find subcategory
        |--------------------------------------------------------------------------
        */
        $subcategory = function (string $name) use ($category) {
            return DB::table('subcategories')
                ->where('category_id', $category->id)
                ->where(function ($query) use ($name) {
                    $query->where('name', $name)
                        ->orWhere('slug', Str::slug($name));
                })
                ->first();
        };

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        |
        | Product names/models are based on the supplied manufacturer
        | price lists.
        |
        |--------------------------------------------------------------------------
        */

        $products = [

            // =============================================================
            // PHONAK
            // =============================================================

            [
                'brand' => 'Phonak',
                'name' => 'Phonak Audéo Infinio Ultra 90',
                'model_number' => 'Infinio Ultra 90',
                'form_factor' => 'RIC',
                'kit_configuration' => 'Premium',
                'price' => 0,
                'features' => [
                    'technology' => 'Phonak Infinio Ultra',
                    'technology_level' => '90 Premium',
                    'platform' => 'Phonak Sphere Infinio',
                    'wireless' => true,
                    'rechargeable' => true,
                ],
            ],

            [
                'brand' => 'Phonak',
                'name' => 'Phonak Audéo Infinio Ultra 70',
                'model_number' => 'Infinio Ultra 70',
                'form_factor' => 'RIC',
                'kit_configuration' => 'Advanced',
                'price' => 0,
                'features' => [
                    'technology' => 'Phonak Infinio Ultra',
                    'technology_level' => '70 Advanced',
                    'platform' => 'Phonak Sphere Infinio',
                    'wireless' => true,
                    'rechargeable' => true,
                ],
            ],

            [
                'brand' => 'Phonak',
                'name' => 'Phonak Audéo Infinio Ultra 50',
                'model_number' => 'Infinio Ultra 50',
                'form_factor' => 'RIC',
                'kit_configuration' => 'Standard',
                'price' => 0,
                'features' => [
                    'technology' => 'Phonak Infinio Ultra',
                    'technology_level' => '50 Standard',
                    'platform' => 'Phonak Sphere Infinio',
                    'wireless' => true,
                    'rechargeable' => true,
                ],
            ],

            // =============================================================
            // OTICON
            // =============================================================

            [
                'brand' => 'Oticon',
                'name' => 'Oticon More 1',
                'model_number' => 'More 1',
                'form_factor' => 'Mini RITE Power',
                'kit_configuration' => 'Rechargeable',
                'price' => 250000,
                'features' => [
                    'platform' => 'Polaris',
                    'channels' => '24',
                    'full_on_gain' => '105 dB',
                    'battery' => 'Li-ion',
                    'wireless' => true,
                    'app_control' => true,
                    'technology' => 'MoreSound Intelligence',
                ],
            ],

            [
                'brand' => 'Oticon',
                'name' => 'Oticon More 3',
                'model_number' => 'More 3',
                'form_factor' => 'Mini RITE Power',
                'kit_configuration' => 'Rechargeable',
                'price' => 175000,
                'features' => [
                    'platform' => 'Polaris',
                    'channels' => '18',
                    'full_on_gain' => '105 dB',
                    'battery' => 'Li-ion',
                    'wireless' => true,
                    'app_control' => true,
                    'technology' => 'MoreSound Intelligence',
                ],
            ],

            [
                'brand' => 'Oticon',
                'name' => 'Oticon Real 1',
                'model_number' => 'Real 1',
                'form_factor' => 'Mini RITE Power',
                'kit_configuration' => 'Rechargeable',
                'price' => 375000,
                'features' => [
                    'platform' => 'Polaris',
                    'channels' => '24',
                    'full_on_gain' => '105 dB',
                    'battery' => 'Li-ion',
                    'wireless' => true,
                    'app_control' => true,
                    'technology' => 'MoreSound Intelligence 2.0',
                ],
            ],

            [
                'brand' => 'Oticon',
                'name' => 'Oticon Real 2',
                'model_number' => 'Real 2',
                'form_factor' => 'Mini RITE Power',
                'kit_configuration' => 'Rechargeable',
                'price' => 280000,
                'features' => [
                    'platform' => 'Polaris',
                    'channels' => '20',
                    'full_on_gain' => '105 dB',
                    'battery' => 'Li-ion',
                    'wireless' => true,
                    'app_control' => true,
                    'technology' => 'MoreSound Intelligence 2.0',
                ],
            ],

            // =============================================================
            // UNITRON
            // =============================================================

            [
                'brand' => 'Unitron',
                'name' => 'Unitron Moxi S-R Premium',
                'model_number' => 'Moxi S-R',
                'form_factor' => 'RIC',
                'kit_configuration' => 'Premium',
                'price' => 307000,
                'features' => [
                    'technology' => 'Smile',
                    'technology_level' => 'Level 9 Premium',
                    'channels' => '20',
                    'battery' => 'Rechargeable',
                    'charger' => 'ChargerGo RIC S',
                    'wireless' => true,
                ],
            ],

            [
                'brand' => 'Unitron',
                'name' => 'Unitron Moxi S-R Advanced',
                'model_number' => 'Moxi S-R',
                'form_factor' => 'RIC',
                'kit_configuration' => 'Advanced',
                'price' => 212000,
                'features' => [
                    'technology' => 'Smile',
                    'technology_level' => 'Level 7 Advanced',
                    'channels' => '20',
                    'battery' => 'Rechargeable',
                    'wireless' => true,
                ],
            ],

            [
                'brand' => 'Unitron',
                'name' => 'Unitron Moxi S-R Standard',
                'model_number' => 'Moxi S-R',
                'form_factor' => 'RIC',
                'kit_configuration' => 'Standard',
                'price' => 127000,
                'features' => [
                    'technology' => 'Smile',
                    'technology_level' => 'Level 5 Standard',
                    'channels' => '16',
                    'battery' => 'Rechargeable',
                    'wireless' => true,
                ],
            ],

            [
                'brand' => 'Unitron',
                'name' => 'Unitron Moxi S-R Essential',
                'model_number' => 'Moxi S-R',
                'form_factor' => 'RIC',
                'kit_configuration' => 'Essential',
                'price' => 87000,
                'features' => [
                    'technology' => 'Smile',
                    'technology_level' => 'Level 3 Essential',
                    'channels' => '12',
                    'battery' => 'Rechargeable',
                ],
            ],

            // =============================================================
            // RESOUND
            // =============================================================

            [
                'brand' => 'ReSound',
                'name' => 'ReSound Vivia 9 MicroRIE',
                'model_number' => 'Vivia 9',
                'form_factor' => 'MicroRIE',
                'kit_configuration' => '2 Hearing Aids + Premium Charger',
                'price' => 849995,
                'features' => [
                    'channels' => '17',
                    'battery' => 'Li-ion',
                    'technology' => 'Intelligent Focus Directionality',
                    'noise_reduction' => 'Intelligent Noise Tracker',
                    'battery_life' => '24 hours',
                    'waterproof' => 'IP68',
                ],
            ],

            [
                'brand' => 'ReSound',
                'name' => 'ReSound Vivia 7 MicroRIE',
                'model_number' => 'Vivia 7',
                'form_factor' => 'MicroRIE',
                'kit_configuration' => '2 Hearing Aids + Premium Charger',
                'price' => 483995,
                'features' => [
                    'channels' => '14',
                    'battery' => 'Li-ion',
                    'battery_life' => '24 hours',
                    'waterproof' => 'IP68',
                    'wireless' => true,
                ],
            ],

            [
                'brand' => 'ReSound',
                'name' => 'ReSound Vivia 5 MicroRIE',
                'model_number' => 'Vivia 5',
                'form_factor' => 'MicroRIE',
                'kit_configuration' => '2 Hearing Aids + Premium Charger',
                'price' => 273995,
                'features' => [
                    'channels' => '12',
                    'battery' => 'Li-ion',
                    'battery_life' => '24 hours',
                    'waterproof' => 'IP68',
                ],
            ],

            [
                'brand' => 'ReSound',
                'name' => 'ReSound Savi',
                'model_number' => 'Savi',
                'form_factor' => 'RIE',
                'kit_configuration' => 'Rechargeable',
                'price' => 0,
                'features' => [
                    'platform' => '360 Chip',
                    'battery' => '24 hours',
                    'waterproof' => 'IP68',
                    'connectivity' => 'Bluetooth LE Audio, Auracast',
                    'directionality' => 'Binaural Directionality III',
                    'receiver' => 'SF3',
                ],
            ],

            [
                'brand' => 'ReSound',
                'name' => 'ReSound Enzo IA',
                'model_number' => 'Enzo IA',
                'form_factor' => 'BTE',
                'kit_configuration' => 'Hearing Aid',
                'price' => 0,
                'features' => [
                    'platform' => 'Intelligent Augmented platform',
                    'waterproof' => 'IP68',
                    'wireless' => true,
                ],
            ],

            // =============================================================
            // STARKEY
            // =============================================================

            [
                'brand' => 'Starkey',
                'name' => 'Starkey Genesis AI 12 CIC NW',
                'model_number' => 'Genesis AI 12',
                'form_factor' => 'CIC',
                'kit_configuration' => 'Wireless',
                'price' => 70000,
                'features' => [
                    'technology' => 'Genesis AI',
                    'processor' => 'Starkey Neuro Processor',
                    'channels' => '12',
                    'bands' => '12',
                    'wireless' => true,
                    'healthable' => true,
                ],
            ],

            [
                'brand' => 'Starkey',
                'name' => 'Starkey Genesis AI 12 ITC R',
                'model_number' => 'Genesis AI 12',
                'form_factor' => 'ITC R',
                'kit_configuration' => 'Rechargeable',
                'price' => 80000,
                'features' => [
                    'technology' => 'Genesis AI',
                    'processor' => 'Starkey Neuro Processor',
                    'channels' => '12',
                    'bands' => '12',
                    'wireless' => true,
                ],
            ],

            [
                'brand' => 'Starkey',
                'name' => 'Starkey Genesis AI 12 mRIC R',
                'model_number' => 'Genesis AI 12',
                'form_factor' => 'mRIC R',
                'kit_configuration' => 'Rechargeable',
                'price' => 100000,
                'features' => [
                    'technology' => 'Genesis AI',
                    'processor' => 'Starkey Neuro Processor',
                    'channels' => '12',
                    'bands' => '12',
                    'wireless' => true,
                ],
            ],

            [
                'brand' => 'Starkey',
                'name' => 'Starkey Omega AI 24 RIC RT',
                'model_number' => 'Omega AI 24',
                'form_factor' => 'RIC RT',
                'kit_configuration' => 'Rechargeable',
                'price' => 410000,
                'features' => [
                    'technology' => 'Omega AI',
                    'platform' => 'DNN 360',
                    'channels' => '24',
                    'bands' => '24',
                    'battery_life' => 'Up to 51 hours',
                    'connectivity' => 'LE Audio, Auracast',
                    'waterproof' => 'Enhanced waterproof coating',
                ],
            ],

            [
                'brand' => 'Starkey',
                'name' => 'Starkey Omega AI 20 RIC RT',
                'model_number' => 'Omega AI 20',
                'form_factor' => 'RIC RT',
                'kit_configuration' => 'Rechargeable',
                'price' => 290000,
                'features' => [
                    'technology' => 'Omega AI',
                    'platform' => 'DNN 360',
                    'channels' => '20',
                    'bands' => '20',
                    'battery' => 'Rechargeable',
                ],
            ],

            [
                'brand' => 'Starkey',
                'name' => 'Starkey Omega AI 16 RIC RT',
                'model_number' => 'Omega AI 16',
                'form_factor' => 'RIC RT',
                'kit_configuration' => 'Rechargeable',
                'price' => 190000,
                'features' => [
                    'technology' => 'Omega AI',
                    'platform' => 'DNN 360',
                    'channels' => '16',
                    'bands' => '16',
                    'battery' => 'Rechargeable',
                ],
            ],

            // =============================================================
            // SIGNIA
            // =============================================================

            [
                'brand' => 'Signia',
                'name' => 'Signia Pure Charge&Go IX 7',
                'model_number' => 'Pure Charge&Go IX 7',
                'form_factor' => 'RIC',
                'kit_configuration' => 'Rechargeable',
                'price' => 0,
                'features' => [
                    'platform' => 'Integrated Xperience',
                    'battery' => 'Rechargeable',
                    'wireless' => true,
                    'app_control' => true,
                ],
            ],

            [
                'brand' => 'Signia',
                'name' => 'Signia Pure Charge&Go IX 5',
                'model_number' => 'Pure Charge&Go IX 5',
                'form_factor' => 'RIC',
                'kit_configuration' => 'Rechargeable',
                'price' => 0,
                'features' => [
                    'platform' => 'Integrated Xperience',
                    'battery' => 'Rechargeable',
                    'wireless' => true,
                ],
            ],

            [
                'brand' => 'Signia',
                'name' => 'Signia Pure Charge&Go IX 3',
                'model_number' => 'Pure Charge&Go IX 3',
                'form_factor' => 'RIC',
                'kit_configuration' => 'Rechargeable',
                'price' => 0,
                'features' => [
                    'platform' => 'Integrated Xperience',
                    'battery' => 'Rechargeable',
                    'wireless' => true,
                ],
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | Insert Products
        |--------------------------------------------------------------------------
        */

        foreach ($products as $item) {

            $brandRecord = $brand($item['brand']);

            // Skip if brand does not exist.
            if (!$brandRecord) {
                continue;
            }

            $subcat = $subcategory($item['form_factor']);

            $slug = Str::slug($item['name']);

            DB::table('products')->updateOrInsert(
                [
                    'slug' => $slug,
                ],
                [
                    'category_id' => $category->id,
                    'subcategory_id' => $subcat?->id,
                    'brand_id' => $brandRecord->id,

                    'name' => $item['name'],
                    'slug' => $slug,
                    'sku' => 'HA-' . strtoupper(Str::random(8)),

                    'short_description' =>
                        $item['brand'] . ' ' .
                        $item['model_number'] .
                        ' hearing aid.',

                    'description' =>
                        $item['name'] .
                        ' is a hearing-aid solution from ' .
                        $item['brand'] .
                        '.',

                    'price' => $item['price'],
                    'sale_price' => null,
                    'cost_price' => null,

                    'stock' => 20,
                    'low_stock_threshold' => 5,
                    'manage_stock' => true,

                    'status' => 'active',

                    'is_featured' => in_array(
                        $item['model_number'],
                        [
                            'Infinio Ultra 90',
                            'Real 1',
                            'Vivia 9',
                            'Omega AI 24',
                            'Genesis AI 12',
                        ]
                    ),

                    'is_trending' => in_array(
                        $item['brand'],
                        [
                            'Phonak',
                            'ReSound',
                            'Starkey',
                        ]
                    ),

                    'is_new_arrival' => in_array(
                        $item['brand'],
                        [
                            'ReSound',
                            'Starkey',
                        ]
                    ),

                    'is_best_seller' => in_array(
                        $item['model_number'],
                        [
                            'Real 1',
                            'Moxi S-R',
                            'Vivia 7',
                        ]
                    ),

                    'is_on_sale' => false,

                    'tax_rate' => 0,

                    'product_kind' => 'hearing_aid',
                    'model_number' => $item['model_number'],
                    'form_factor' => $item['form_factor'],
                    'kit_configuration' => $item['kit_configuration'],

                    'warranty_months' => 24,

                    'channels' => $item['features']['channels'] ?? null,

                    'fitting_range' =>
                        $item['features']['fitting_range'] ?? null,

                    'battery_type' =>
                        $item['features']['battery'] ?? 'Rechargeable',

                    'receiver_options' =>
                        $item['features']['receiver'] ?? null,

                    'connectivity' =>
                        $item['features']['connectivity'] ??
                        'Wireless',

                    'colour_options' => json_encode([
                        'Standard Beige',
                        'Black',
                        'Brown',
                    ]),

                    'specifications' => json_encode(
                        $item['features'],
                        JSON_UNESCAPED_UNICODE
                    ),

                    'tags' => json_encode([
                        'hearing aid',
                        strtolower($item['brand']),
                        strtolower($item['model_number']),
                        strtolower($item['form_factor']),
                    ]),

                    'meta_title' =>
                        $item['name'] . ' | Hearing Aid',

                    'meta_description' =>
                        'Buy ' . $item['name'] .
                        ' hearing aid. Explore features, technology and pricing.',

                    'meta_keywords' =>
                        strtolower(
                            $item['brand'] . ', ' .
                            $item['model_number'] . ', hearing aid'
                        ),

                    'views' => 0,

                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}