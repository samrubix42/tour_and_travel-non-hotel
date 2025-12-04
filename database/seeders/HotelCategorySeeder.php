<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelCategory;
use Illuminate\Support\Str;

class HotelCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Luxury',
            'Budget',
            'Boutique',
            'Resort',
            'Homestay',
        ];

        foreach ($categories as $name) {
            HotelCategory::firstOrCreate([
                'slug' => Str::slug($name),
            ], [
                'name' => $name,
                'description' => $name . ' hotels',
                'status' => 1,
            ]);
        }
    }
}
