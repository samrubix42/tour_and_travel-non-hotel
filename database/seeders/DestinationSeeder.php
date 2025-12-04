<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $destinations = [
            // Religious
            ['name' => 'Varanasi', 'slug' => 'varanasi', 'description' => 'Holy city on the Ganges.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Haridwar', 'slug' => 'haridwar', 'description' => 'Gateway to the gods.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Amritsar', 'slug' => 'amritsar', 'description' => 'Golden Temple city.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Tirupati', 'slug' => 'tirupati', 'description' => 'Famous pilgrimage site.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Bodh Gaya', 'slug' => 'bodh-gaya', 'description' => 'Buddhist spiritual center.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Shirdi', 'slug' => 'shirdi', 'description' => 'Sai Baba shrine.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Rameswaram', 'slug' => 'rameswaram', 'description' => 'Sacred island town.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Dwarka', 'slug' => 'dwarka', 'description' => 'Ancient temple city.', 'image' => null, 'status' => true, 'is_featured' => true],
            // International
            ['name' => 'Paris', 'slug' => 'paris', 'description' => 'City of lights and romance.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'London', 'slug' => 'london', 'description' => 'Historic and modern capital.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'New York', 'slug' => 'new-york', 'description' => 'The city that never sleeps.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Dubai', 'slug' => 'dubai', 'description' => 'Luxury and innovation.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Singapore', 'slug' => 'singapore', 'description' => 'Clean and green city.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Bangkok', 'slug' => 'bangkok', 'description' => 'Vibrant Thai capital.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Rome', 'slug' => 'rome', 'description' => 'Ancient and artistic.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Maldives', 'slug' => 'maldives', 'description' => 'Tropical paradise.', 'image' => null, 'status' => true, 'is_featured' => true],
            // Domestic
            ['name' => 'Goa', 'slug' => 'goa', 'description' => 'Popular beach destination.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Jaipur', 'slug' => 'jaipur', 'description' => 'Pink city of India.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Kerala', 'slug' => 'kerala', 'description' => 'God’s own country.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Shimla', 'slug' => 'shimla', 'description' => 'Queen of hills.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Manali', 'slug' => 'manali', 'description' => 'Adventure and nature.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Udaipur', 'slug' => 'udaipur', 'description' => 'City of lakes.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Agra', 'slug' => 'agra', 'description' => 'Home of the Taj Mahal.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Mysore', 'slug' => 'mysore', 'description' => 'Palaces and gardens.', 'image' => null, 'status' => true, 'is_featured' => true],
            // Honeymoon
            ['name' => 'Maldives', 'slug' => 'maldives-hm', 'description' => 'Honeymoon paradise.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Goa', 'slug' => 'goa-hm', 'description' => 'Romantic beaches.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Shimla', 'slug' => 'shimla-hm', 'description' => 'Snowy honeymoon retreat.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Kerala', 'slug' => 'kerala-hm', 'description' => 'Backwaters and romance.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Bali', 'slug' => 'bali', 'description' => 'Exotic island honeymoon.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Mauritius', 'slug' => 'mauritius', 'description' => 'Tropical honeymoon.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Santorini', 'slug' => 'santorini', 'description' => 'Greek romance.', 'image' => null, 'status' => true, 'is_featured' => true],
            ['name' => 'Venice', 'slug' => 'venice', 'description' => 'Canals and love.', 'image' => null, 'status' => true, 'is_featured' => true],
        ];
        foreach ($destinations as $dest) {
            DB::table('destinations')->insert(array_merge($dest, ['created_at' => $now, 'updated_at' => $now]));
        }
    }
}
