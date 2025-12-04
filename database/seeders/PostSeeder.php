<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $categories = BlogCategory::pluck('id')->all();
        if (empty($categories)) {
            return; // ensure categories exist (BlogCategorySeeder should run first)
        }

        for ($i = 0; $i < 12; $i++) {
            $title = $faker->sentence(rand(3, 7));
            $slug = Str::slug($title) . '-' . uniqid();

            Post::create([
                'category_id' => $faker->randomElement($categories),
                'meta_title' => $title,
                'meta_description' => $faker->paragraph(),
                'meta_keywords' => implode(',', $faker->words(5)),
                'featured_image' => 'https://placehold.co/1200x800',
                'thumbnail_image' => 'https://placehold.co/800x1015',
                'featured_storage_path' => null,
                'thumbnail_storage_path' => null,
                'featured_image_kit_file_id' => null,
                'thumbnail_image_kit_file_id' => null,
                'title' => $title,
                'slug' => $slug,
                'main_content' => $faker->paragraphs(5, true),
                'tags' => implode(',', $faker->words(3)),
            ]);
        }
    }
}
