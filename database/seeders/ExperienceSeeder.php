<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'Adventure', 'slug' => 'adventure', 'status' => true],
            ['name' => 'Relaxation', 'slug' => 'relaxation', 'status' => true],
            ['name' => 'Cultural', 'slug' => 'cultural', 'status' => true],
            ['name' => 'Family', 'slug' => 'family', 'status' => true],
            ['name' => 'Romantic', 'slug' => 'romantic', 'status' => true],
        ];

        foreach ($items as $item) {
            Experience::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
