<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'page_title' => 'Home',
                'slug' => 'home',
                'page_content' => '<p>Welcome to our travel portal. Discover top destinations, hotels and tour packages.</p>',
                'meta_title' => 'Home - Explore Tours & Hotels',
                'meta_description' => 'Discover top tour packages, hotels and destinations curated for you.',
                'meta_keywords' => 'home, tours, hotels, destinations',
            ],
            [
                'page_title' => 'Tours',
                'slug' => 'tours',
                'page_content' => '<p>Explore our range of tour packages tailored for every traveler.</p>',
                'meta_title' => 'Tour Packages - Explore Our Exciting Tours',
                'meta_description' => 'Browse tour packages by destination, experience and price.',
                'meta_keywords' => 'tours, tour packages, travel',
            ],
            [
                'page_title' => 'Hotels',
                'slug' => 'hotels',
                'page_content' => '<p>Find and book hotels across popular destinations.</p>',
                'meta_title' => 'Hotels - Find & Book Hotels',
                'meta_description' => 'Search hotels by destination, category and amenities.',
                'meta_keywords' => 'hotels, accommodation, booking',
            ],
            [
                'page_title' => 'Destinations',
                'slug' => 'destinations',
                'page_content' => '<p>Discover destinations and travel inspiration for your next trip.</p>',
                'meta_title' => 'Destinations - Explore Destinations',
                'meta_description' => 'Explore destinations and top attractions for your trip.',
                'meta_keywords' => 'destinations, travel, attractions',
            ],
            [
                'page_title' => 'Experiences',
                'slug' => 'experiences',
                'page_content' => '<p>Browse experiences to customize your travel itinerary.</p>',
                'meta_title' => 'Experiences - Browse Experiences',
                'meta_description' => 'Find experiences like adventure, relaxation and cultural tours.',
                'meta_keywords' => 'experiences, activities, tours',
            ],
            [
                'page_title' => 'Blog',
                'slug' => 'blog',
                'page_content' => '<p>Read articles, travel guides and tips from our blog.</p>',
                'meta_title' => 'Blog - Latest Posts',
                'meta_description' => 'Read travel articles, tips and destination guides.',
                'meta_keywords' => 'blog, travel tips, guides',
            ],
            [
                'page_title' => 'About Us',
                'slug' => 'about',
                'page_content' => '<p>Welcome to our travel agency. We create memorable experiences for travelers.</p>',
                'meta_title' => 'About Us - Learn About Our Travel Agency',
                'meta_description' => 'Learn about our mission, values, and the team behind our travel packages.',
                'meta_keywords' => 'about, travel agency, company',
            ],
            [
                'page_title' => 'Contact Us',
                'slug' => 'contact',
                'page_content' => '<p>Get in touch with us for bookings and enquiries.</p>',
                'meta_title' => 'Contact Us - Get in Touch',
                'meta_description' => 'Contact our support team for bookings, enquiries, and assistance.',
                'meta_keywords' => 'contact, support, enquiries',
            ],
         
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(
                ['slug' => $p['slug']],
                $p
            );
        }
    }
}
