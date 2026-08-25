<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            // Image + ALT
            $table->string('image')->nullable();
            $table->string('alt')->nullable();
            // Meta SEO Fields
            $table->string('meta_title')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            // OG (Open Graph) Fields
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            // Visibility & Status
            $table->tinyInteger('visibility')->default(1)->comment('1 = Visible, 0 = Hidden');
            $table->tinyInteger('index_status')->default(1)->comment('1 = Index, 0 = No Index');
            $table->tinyInteger('follow_status')->default(1)->comment('1 = Follow, 0 = No Follow');

            $table->tinyInteger('status')->default(1)->comment('1 = Active, 0 = Inactive');

            $table->softDeletes();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
