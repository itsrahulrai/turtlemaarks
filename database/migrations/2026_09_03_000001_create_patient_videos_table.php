<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patient_videos', function (Blueprint $table) {
            $table->id();

            // YouTube source
            $table->string('youtube_id');           // e.g. vrF2ciqFfrg
            $table->string('thumbnail')->nullable(); // optional custom uploaded thumbnail, else auto YouTube thumb

            // Card (grid) content
            $table->string('topic_label');           // small line above title, e.g. "Veteran Testimonial"
            $table->string('title');                 // card h5 title, e.g. "Clear Speech Restored for Veteran"
            $table->string('card_description');      // short 1-2 line card body text
            $table->string('badge')->default('Patient Story'); // category chip over the thumbnail
            $table->string('duration')->nullable();  // e.g. "3:12"
            $table->string('location')->nullable();  // e.g. "Noida Clinic"

            // Modal (player) content
            $table->string('modal_title')->nullable();       // full title shown in the player modal
            $table->string('modal_badge')->nullable();       // badge shown in the player modal
            $table->string('speaker')->nullable();            // e.g. "Wg Cdr S.K. Bhatia (Shaurya Chakra)"
            $table->text('modal_description')->nullable();   // longer description shown in the player modal

            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_videos');
    }
};
