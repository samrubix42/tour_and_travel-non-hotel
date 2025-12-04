<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(\Database\Seeders\AdminUserSeeder::class);
        $this->call(\Database\Seeders\DestinationSeeder::class);
        $this->call(\Database\Seeders\CategorySeeder::class);
        $this->call(\Database\Seeders\HotelCategorySeeder::class);
        $this->call(\Database\Seeders\HotelSeeder::class);
        $this->call(\Database\Seeders\BannerSeeder::class);
        $this->call(\Database\Seeders\BlogCategorySeeder::class);
        $this->call(\Database\Seeders\PostSeeder::class);
        $this->call(\Database\Seeders\ExperienceSeeder::class);
        $this->call(\Database\Seeders\TourPackageSeeder::class);
        $this->call(\Database\Seeders\PagesSeeder::class);
    }
}
