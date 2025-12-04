<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'News', 'slug' => 'news', 'status' => true],
            ['name' => 'Tips', 'slug' => 'tips', 'status' => true],
            ['name' => 'Guides', 'slug' => 'guides', 'status' => true],
            ['name' => 'Announcements', 'slug' => 'announcements', 'status' => true],
            ['name' => 'Reviews', 'slug' => 'reviews', 'status' => true],
        ];

        foreach ($items as $item) {
            BlogCategory::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
