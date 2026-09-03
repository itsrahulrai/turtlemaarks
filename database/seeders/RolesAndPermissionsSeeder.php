<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // One permission per admin panel module — grouped for the Role builder UI.
        $modules = [
            'Catalog' => [
                'categories'    => 'Categories',
                'subcategories' => 'Subcategories',
                'brands'        => 'Brands',
                'products'      => 'Products',
            ],
            'Services & Appointments' => [
                'services'     => 'Services',
                'appointments' => 'Appointments',
            ],
            'Sales' => [
                'orders'    => 'Orders',
                'customers' => 'Customers',
                'coupons'   => 'Coupons',
                'reviews'   => 'Reviews',
            ],
            'Content' => [
                'banners'         => 'Banners',
                'blogs'           => 'Blogs',
                'patient-videos'  => 'Patient Story Videos',
                'testimonials'    => 'Testimonials',
                'pages'           => 'Pages',
            ],
            'Reports' => [
                'reports' => 'Reports',
            ],
            'Settings' => [
                'settings' => 'Web Settings',
            ],
            'Access Control' => [
                'roles'       => 'Roles & Permissions',
                'admin-users' => 'Admin Users',
            ],
        ];

        $allPermissionIds = [];
        $catalogSalesContentIds = [];

        foreach ($modules as $group => $items) {
            foreach ($items as $slug => $name) {
                $permission = Permission::updateOrCreate(
                    ['slug' => $slug],
                    ['name' => $name, 'module' => $group]
                );

                $allPermissionIds[] = $permission->id;

                if (in_array($group, ['Catalog', 'Services & Appointments', 'Sales', 'Content'], true)) {
                    $catalogSalesContentIds[] = $permission->id;
                }
            }
        }

        // Super Admin — every module. (Super admin accounts already bypass
        // permission checks via Admin::isSuperAdmin(), this role is provided
        // so it can also be assigned explicitly if ever needed.)
        $superAdmin = Role::updateOrCreate(
            ['slug' => 'super-admin'],
            ['name' => 'Super Admin', 'description' => 'Full access to every admin panel module.']
        );
        $superAdmin->permissions()->sync($allPermissionIds);

        // Store Manager — day-to-day catalog, sales & content, no settings/roles.
        $manager = Role::updateOrCreate(
            ['slug' => 'store-manager'],
            ['name' => 'Store Manager', 'description' => 'Manages products, orders, content and customers.']
        );
        $manager->permissions()->sync($catalogSalesContentIds);

        // Support Staff — orders, customers, reviews & appointments only.
        $supportSlugs = ['orders', 'customers', 'reviews', 'appointments'];
        $supportIds = Permission::whereIn('slug', $supportSlugs)->pluck('id');
        $support = Role::updateOrCreate(
            ['slug' => 'support-staff'],
            ['name' => 'Support Staff', 'description' => 'Handles orders, customer queries and appointments.']
        );
        $support->permissions()->sync($supportIds);
    }
}
