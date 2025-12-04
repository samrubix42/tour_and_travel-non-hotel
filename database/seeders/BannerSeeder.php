<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $baseUrl = rtrim(env('APP_URL'), '/'); // Read from .env

        $banners = [
            [
                'title' => 'Digital and very trusted transport logistic agency.',
                'subtitle' => 'Providing flexible, improved service levels, and delivery.',
                'image_url' => $baseUrl . '/asset/images/demo-logistics-slider-01.jpg',
                'button_text' => 'Explore agency',
                'button_url' => $baseUrl . '/about',
                'status' => true,
            ],
            [
                'title' => 'Your airborne shipping trusted globally partner.',
                'subtitle' => 'Swift and reliable air freight solutions worldwide.',
                'image_url' => $baseUrl . '/asset/images/demo-logistics-slider-02.jpg',
                'button_text' => 'Explore agency',
                'button_url' => $baseUrl . '/about',
                'status' => true,
            ],
            [
                'title' => 'Provided authentic train cargo solutions nationwide.',
                'subtitle' => 'Reliable train freight services for seamless transport.',
                'image_url' => $baseUrl . '/asset/images/demo-logistics-slider-03.jpg',
                'button_text' => 'Explore agency',
                'button_url' => $baseUrl . '/about',
                'status' => true,
            ],
        ];

        foreach ($banners as $banner) {
            DB::table('banners')->insert(array_merge($banner, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}
