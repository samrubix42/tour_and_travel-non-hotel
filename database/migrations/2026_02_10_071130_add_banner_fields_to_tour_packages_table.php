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
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->string('banner_image')->nullable()->after('featured_image');
            $table->string('banner_storage_path')->nullable()->after('banner_image');
            $table->string('banner_imagekit_file_id')->nullable()->after('banner_storage_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropColumn(['banner_image', 'banner_storage_path', 'banner_imagekit_file_id']);
        });
    }
};
