<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_for_tours', function (Blueprint $table) {
            $table->unsignedInteger('no_of_days')->nullable()->after('no_of_adults');
        });
    }

    public function down(): void
    {
        Schema::table('contact_for_tours', function (Blueprint $table) {
            $table->dropColumn('no_of_days');
        });
    }
};
