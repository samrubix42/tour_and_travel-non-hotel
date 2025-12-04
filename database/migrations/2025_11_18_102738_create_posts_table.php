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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->string('featured_storage_path')->nullable();
            $table->string('thumbnail_storage_path')->nullable();
            $table->string('featured_image_kit_file_id')->nullable();
            $table->string('thumbnail_image_kit_file_id')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('main_content');
            $table->text('tags');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
