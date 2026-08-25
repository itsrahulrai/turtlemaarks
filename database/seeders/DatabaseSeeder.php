<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        Admin::updateOrCreate(
            ['email' => 'admin@turtlemaarks.com'],
            [
                'name'      => 'TurtleMaarks',
                'password'  => Hash::make('Admin@12345'),
                'role'      => 'super_admin',
                'is_active' => true,
            ]
        );

       // Categories
$categories = [

    [
        'name' => 'Hearing Aids',
        'icon' => '',
        'is_featured' => true,
    ],

    [
        'name' => 'Rechargeable Hearing Aids',
        'icon' => '',
        'is_featured' => true,
    ],

    [
        'name' => 'RIC & RITE Hearing Aids',
        'icon' => '',
        'is_featured' => true,
    ],

    [
        'name' => 'BTE Hearing Aids',
        'icon' => '',
        'is_featured' => true,
    ],

    [
        'name' => 'ITE & ITC Hearing Aids',
        'icon' => '',
        'is_featured' => true,
    ],

    [
        'name' => 'CROS & BiCROS Hearing Aids',
        'icon' => '',
        'is_featured' => true,
    ],

    [
        'name' => 'Hearing Aid Accessories',
        'icon' => '',
        'is_featured' => true,
    ],

    [
        'name' => 'Hearing Batteries',
        'icon' => '',
        'is_featured' => true,
    ],

    [
        'name' => 'Hearing Care & Services',
        'icon' => '',
        'is_featured' => true,
    ],

];

foreach ($categories as $cat) {

    $slug = Str::slug($cat['name']);

    $created = Category::updateOrCreate(
        ['slug' => $slug],
        array_merge(
            $cat,
            [
                'slug' => $slug,
                'is_active' => true,
            ]
        )
    );

    // Subcategories
    $subs = match ($cat['name']) {

        'Hearing Aids' => [
            'Digital Hearing Aids',
            'Premium Hearing Aids',
            'Advanced Hearing Aids',
            'Basic Hearing Aids',
            'AI Hearing Aids',
            'Bluetooth Hearing Aids',
        ],

        'Rechargeable Hearing Aids' => [
            'Rechargeable RIC Hearing Aids',
            'Rechargeable RITE Hearing Aids',
            'Rechargeable BTE Hearing Aids',
            'Lithium-Ion Hearing Aids',
            'Long Battery Life Hearing Aids',
        ],

        'RIC & RITE Hearing Aids' => [
            'Micro RIC Hearing Aids',
            'Mini RITE Hearing Aids',
            'RIE Hearing Aids',
            'M&RIE Hearing Aids',
            'Power RIC Hearing Aids',
        ],

        'BTE Hearing Aids' => [
            'Standard BTE Hearing Aids',
            'Power BTE Hearing Aids',
            'Super Power BTE Hearing Aids',
            'Rechargeable BTE Hearing Aids',
            'Thin Tube BTE Hearing Aids',
        ],

        'ITE & ITC Hearing Aids' => [
            'In-The-Ear Hearing Aids',
            'In-The-Canal Hearing Aids',
            'Completely-In-Canal Hearing Aids',
            'Custom Hearing Aids',
            'Invisible Hearing Aids',
        ],

        'CROS & BiCROS Hearing Aids' => [
            'CROS Hearing Aids',
            'BiCROS Hearing Aids',
            'CROS RIC Hearing Aids',
            'Rechargeable CROS',
            'Wireless CROS Solutions',
        ],

        'Hearing Aid Accessories' => [
            'Hearing Aid Chargers',
            'Remote Controls',
            'TV Streamers',
            'Bluetooth Streamers',
            'Remote Microphones',
            'Phone Adapters',
            'Hearing Aid Receivers',
            'Ear Domes',
            'Ear Tips',
        ],

        'Hearing Batteries' => [
            'Size 10 Hearing Aid Batteries',
            'Size 13 Hearing Aid Batteries',
            'Size 312 Hearing Aid Batteries',
            'Size 675 Hearing Aid Batteries',
            'Rechargeable Batteries',
            'Hearing Aid Battery Accessories',
        ],

        'Hearing Care & Services' => [
            'Hearing Test',
            'Pure Tone Audiometry',
            'Speech Audiometry',
            'Tympanometry',
            'Hearing Aid Fitting',
            'Hearing Aid Programming',
            'Hearing Aid Repair',
            'Hearing Aid Cleaning',
            'Follow Up & Aftercare',
        ],

        default => [],
    };

    foreach ($subs as $sub) {

        $subSlug = Str::slug($sub);

        Subcategory::updateOrCreate(
            [
                'slug' => $subSlug,
            ],
            [
                'name' => $sub,
                'slug' => $subSlug,
                'category_id' => $created->id,
                'is_active' => true,
            ]
        );
    }
}



        // TurtleMaarks Settings
        $settings = [

            [
                'key' => 'site_name',
                'value' => 'Turtle Maarks Hearing Health',
                'group' => 'general',
            ],

            [
                'key' => 'site_tagline',
                'value' => 'Advanced Hearing Care & Hearing Solutions',
                'group' => 'general',
            ],

            [
                'key' => 'site_email',
                'value' => 'info@turtlemaarks.com',
                'group' => 'general',
            ],

            [
                'key' => 'site_phone',
                'value' => '+91 81304 95476',
                'group' => 'general',
            ],

            [
                'key' => 'currency_symbol',
                'value' => '₹',
                'group' => 'general',
            ],

            [
                'key' => 'currency_code',
                'value' => 'INR',
                'group' => 'general',
            ],

            [
                'key' => 'free_shipping_threshold',
                'value' => '500',
                'group' => 'general',
            ],

            [
                'key' => 'shipping_charge',
                'value' => '60',
                'group' => 'general',
            ],

            [
                'key' => 'meta_description',
                'value' => 'Turtle Maarks Hearing Health provides quality hearing care, hearing solutions and professional hearing health services.',
                'group' => 'seo',
            ],
        ];

        foreach ($settings as $setting) {

            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info(
            'Seeded: TurtleMaarks Admin, Categories, Subcategories & Settings'
        );

        $this->command->info(
            'Admin login: admin@turtlemaarks.com / Admin@12345'
        );
    }
}