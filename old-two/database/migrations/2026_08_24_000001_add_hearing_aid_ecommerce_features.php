<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ---------------------------------------------------------------
        // Brands (Widex, Oticon, Horizon, Signia, etc.)
        // ---------------------------------------------------------------
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // ---------------------------------------------------------------
        // Hearing-aid specific fields on products
        // ---------------------------------------------------------------
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('brand_id')->nullable()->after('subcategory_id')
                ->constrained()->nullOnDelete();
            $table->enum('product_kind', ['hearing_aid', 'accessory'])
                ->default('hearing_aid')->after('brand_id');
            $table->string('model_number')->nullable()->after('product_kind');
            // BTE, RIC, ITC, CIC, etc.
            $table->string('form_factor')->nullable()->after('model_number');
            // e.g. "Standard kit", "Premium kit with charger"
            $table->string('kit_configuration')->nullable()->after('form_factor');
            $table->integer('warranty_months')->nullable()->after('kit_configuration');
            $table->string('channels')->nullable()->after('warranty_months');
            // e.g. "Mild to Severe"
            $table->string('fitting_range')->nullable()->after('channels');
            // e.g. "Rechargeable", "Zinc Air 312"
            $table->string('battery_type')->nullable()->after('fitting_range');
            $table->string('receiver_options')->nullable()->after('battery_type');
            // e.g. "Bluetooth, App Control"
            $table->string('connectivity')->nullable()->after('receiver_options');
            // list of available colours
            $table->json('colour_options')->nullable()->after('connectivity');
            // free-form additional feature specs (label => value), admin editable
            $table->json('specifications')->nullable()->after('colour_options');
        });

        // ---------------------------------------------------------------
        // Services (hearing tests, fittings, repairs, etc.)
        // ---------------------------------------------------------------
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('duration_minutes')->default(30);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // ---------------------------------------------------------------
        // Weekly working-hours template (one row per weekday 0=Sun..6=Sat)
        // ---------------------------------------------------------------
        Schema::create('appointment_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('day_of_week'); // 0 (Sun) - 6 (Sat)
            $table->boolean('is_working_day')->default(true);
            $table->time('start_time')->default('10:00:00');
            $table->time('end_time')->default('19:00:00');
            $table->integer('slot_duration_minutes')->default(30);
            $table->timestamps();
            $table->unique('day_of_week');
        });

        // ---------------------------------------------------------------
        // Admin-blocked dates / slots (holidays, leave, etc.)
        // ---------------------------------------------------------------
        Schema::create('appointment_blocks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->boolean('full_day')->default(true);
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('reason')->nullable();
            $table->timestamps();
            $table->index('date');
        });

        // ---------------------------------------------------------------
        // Appointments
        // ---------------------------------------------------------------
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('appointment_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('service_id')->constrained()->restrictOnDelete();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->enum('status', [
                'pending', 'confirmed', 'rejected', 'rescheduled', 'cancelled', 'completed',
            ])->default('pending');
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->index(['appointment_date', 'appointment_time']);
            $table->index(['status']);
        });

        // ---------------------------------------------------------------
        // Allow cart / order_items to carry a *service* line item alongside
        // the existing product line items (existing e-commerce untouched).
        // ---------------------------------------------------------------
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable()->change();
            $table->enum('item_type', ['product', 'service'])->default('product')->after('user_id');
            $table->foreignId('service_id')->nullable()->after('product_variant_id')
                ->constrained()->cascadeOnDelete();
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable()->change();
            $table->enum('item_type', ['product', 'service'])->default('product')->after('order_id');
            $table->foreignId('service_id')->nullable()->after('product_variant_id')
                ->constrained()->restrictOnDelete();
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn(['item_type', 'service_id']);
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn(['item_type', 'service_id']);
        });

        Schema::dropIfExists('appointments');
        Schema::dropIfExists('appointment_blocks');
        Schema::dropIfExists('appointment_settings');
        Schema::dropIfExists('services');

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropColumn([
                'brand_id', 'product_kind', 'model_number', 'form_factor',
                'kit_configuration', 'warranty_months', 'channels', 'fitting_range',
                'battery_type', 'receiver_options', 'connectivity', 'colour_options',
                'specifications',
            ]);
        });

        Schema::dropIfExists('brands');
    }
};
