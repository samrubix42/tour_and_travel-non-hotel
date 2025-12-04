<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TourPackage;
use App\Models\Category;
use App\Models\Experience;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class TourPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $experiences = Experience::pluck('id')->toArray();

        $categories = Category::where('status', true)->get();

        foreach ($categories as $category) {
            // create 12 packages per category
            for ($i = 0; $i < 12; $i++) {
                $title = trim($faker->sentence(3));
                $slug = Str::slug($title . '-' . substr(Str::uuid(), 0, 6));

                // build a simple itinerary JSON with random days
                $days = rand(3, 7);
                $itinerary = [];
                for ($d = 1; $d <= $days; $d++) {
                    $points = [];
                    $pCount = rand(1, 4);
                    for ($p = 0; $p < $pCount; $p++) {
                        $points[] = $faker->sentence(6);
                    }
                    $itinerary['day' . $d] = [
                        'title' => $faker->sentence(2),
                        'points' => $points,
                    ];
                }

                $package = TourPackage::create([
                    'title' => $title,
                    'slug' => $slug,
                    'meta_title' => $title,
                    'meta_description' => $faker->sentence(10),
                    'meta_keywords' => implode(', ', $faker->words(5)),
                    'itinerary' => json_encode($itinerary),
                    'description' => $faker->paragraph(3),
                    'price' => $faker->randomFloat(2, 200, 5000),
                    'includes' => json_encode([$faker->word(), $faker->word()]),
                    'optional' => json_encode([$faker->word()]),
                    // mark all generated packages as featured so each category has 10+
                    'is_featured' => true,
                    'status' => true,
                ]);

                // attach category
                $package->categories()->attach($category->id);

                // attach some destinations from this category if available
                $destIds = $category->destinations()->pluck('destinations.id')->toArray();
                if (!empty($destIds)) {
                    $pick = (array) array_rand(array_flip($destIds), min(count($destIds), rand(1, 3)));
                    $package->destinations()->sync($pick);
                }

                // attach random experiences
                if (!empty($experiences)) {
                    $countExp = rand(1, min(3, count($experiences)));
                    $picked = (array) array_rand(array_flip($experiences), $countExp);
                    $package->experiences()->sync($picked);
                }
            }
        }
    }
}
