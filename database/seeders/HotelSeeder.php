<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\HotelGallery;
use App\Models\Destination;
use App\Models\HotelCategory;
use Illuminate\Support\Str;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $destinationIds = Destination::pluck('id')->toArray();
        $categoryIds = HotelCategory::pluck('id')->toArray();

        if (empty($destinationIds) || empty($categoryIds)) {
            // nothing to seed against
            return;
        }

        for ($i = 0; $i < 30; $i++) {
            $name = $faker->company . ' Hotel';
            $longDesc = '<h2>About ' . e($name) . '</h2>'
                . '<p>' . implode('</p><p>', $faker->paragraphs(3)) . '</p>'
                . '<h3>Highlights</h3><ul>'
                . '<li>' . $faker->sentence() . '</li>'
                . '<li>' . $faker->sentence() . '</li>'
                . '<li>' . $faker->sentence() . '</li>'
                . '</ul>'
                . '<p><strong>Location:</strong> ' . $faker->address . '</p>';

            $hotel = Hotel::create([
                'category_id' => $faker->randomElement($categoryIds),
                'destination_id' => $faker->randomElement($destinationIds),
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(4),
                'address' => $faker->address,
                'rating' => $faker->randomFloat(1, 3, 5),
                'description' => $faker->paragraphs(2, true),
                'long_description' => $longDesc,
                // use image_url/storage_path fields (placeholders)
                'image_url' => 'https://placehold.co/800x600',
                'storage_path' => null,
                'imagekit_file_id' => null,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'amenities' => [
                    'Free Wi-Fi',
                    'Air conditioning',
                    'Breakfast included',
                ],
                'facilities' => [
                    '24/7 Reception',
                    'Swimming Pool',
                    'Parking',
                ],
                'meta_title' => $name . ' - Book Now',
                'meta_description' => $faker->sentence(12),
                'meta_keywords' => 'hotel,' . implode(',', array_map('strtolower', ['wifi','pool','parking'])),
                'status' => 1,
            ]);

            // create 2-4 gallery items per hotel using placeholder images
            $count = rand(2,4);
            for ($g = 0; $g < $count; $g++) {
                HotelGallery::create([
                    'hotel_id' => $hotel->id,
                    'image_url' => 'https://placehold.co/600x400?text=' . urlencode($hotel->name . ' Gallery ' . ($g+1)),
                    'storage_path' => null,
                    'imagekit_file_id' => null,
                ]);
            }
        }
    }
}
