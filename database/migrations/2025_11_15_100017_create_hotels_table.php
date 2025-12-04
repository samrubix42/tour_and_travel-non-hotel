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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('hotel_categories');
            $table->foreignId('destination_id')->constrained('destinations');
            $table->string('name');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('slug')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->json('facilities')->nullable();
            $table->json('amenities')->nullable();
            $table->tinyInteger('rating')->nullable();
            $table->longText('description')->nullable();
            $table->longText('long_description')->nullable();
            $table->text('map_embed')->nullable();
            $table->string('image_url')->nullable();
            $table->string('storage_path')->nullable();
            $table->string('imagekit_file_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
