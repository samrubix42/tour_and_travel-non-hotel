<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            [
                'name' => 'Religious',
                'slug' => 'religious',
                'description' => 'Spiritual and pilgrimage destinations.',
                'status' => true,
                'category_image' => null,
                'storage_path' => null,
                'imagekit_file_id' => null,
            ],
            [
                'name' => 'International',
                'slug' => 'international',
                'description' => 'Destinations outside your country.',
                'status' => true,
                'category_image' => null,
                'storage_path' => null,
                'imagekit_file_id' => null,
            ],
            [
                'name' => 'Domestic',
                'slug' => 'domestic',
                'description' => 'Destinations within your country.',
                'status' => true,
                'category_image' => null,
                'storage_path' => null,
                'imagekit_file_id' => null,
            ],
            [
                'name' => 'Honeymoon',
                'slug' => 'honeymoon',
                'description' => 'Romantic honeymoon destinations.',
                'status' => true,
                'category_image' => null,
                'storage_path' => null,
                'imagekit_file_id' => null,
            ],
        ];

        $categoryIds = [];
        foreach ($categories as $cat) {
            $id = DB::table('categories')->insertGetId(array_merge($cat, ['created_at' => $now, 'updated_at' => $now]));
            $categoryIds[$cat['name']] = $id;
        }

        // Get all destination IDs by name
        $destinations = DB::table('destinations')->get();
        $destinationIds = [];
        foreach ($destinations as $dest) {
            $destinationIds[$dest->name] = $dest->id;
        }

        // Assign 8 destinations to each category
        $categoryDestinationMap = [
            'Religious' => ['Varanasi','Haridwar','Amritsar','Tirupati','Bodh Gaya','Shirdi','Rameswaram','Dwarka'],
            'International' => ['Paris','London','New York','Dubai','Singapore','Bangkok','Rome','Maldives'],
            'Domestic' => ['Goa','Jaipur','Kerala','Shimla','Manali','Udaipur','Agra','Mysore'],
            'Honeymoon' => ['Maldives','Goa','Shimla','Kerala','Bali','Mauritius','Santorini','Venice'],
        ];
        foreach ($categoryDestinationMap as $catName => $destNames) {
            $catId = $categoryIds[$catName] ?? null;
            foreach ($destNames as $dName) {
                $destId = $destinationIds[$dName] ?? null;
                if ($catId && $destId) {
                    DB::table('destination_categories')->insert([
                        'destination_id' => $destId,
                        'category_id' => $catId,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }
}
