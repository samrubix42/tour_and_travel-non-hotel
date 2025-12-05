<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Aisha Mwangi',
                'feedback' => 'The safari package was brilliantly organized — saw the Big Five and the guides were exceptional. Highly recommend for anyone visiting Kenya!',
                'rating' => 5,
            ],
            [
                'name' => 'Liam & Zoe',
                'feedback' => 'Our honeymoon stay at the beachfront hotel exceeded expectations. Romantic setup and delicious local cuisine.',
                'rating' => 5,
            ],
            [
                'name' => 'Carlos Hernandez',
                'feedback' => 'Great value tour to the ancient ruins. Knowledgeable guide and comfortable transport made the day perfect.',
                'rating' => 4,
            ],
            [
                'name' => 'Mei Lin',
                'feedback' => 'Loved the mountain trek package — well planned rest stops and stunning views. The team was supportive the whole way.',
                'rating' => 5,
            ],
            [
                'name' => 'Olivia Parker',
                'feedback' => 'Hotel was clean and centrally located. Staff were friendly and the breakfast buffet had great variety.',
                'rating' => 4,
            ],
            [
                'name' => 'Rajesh Kumar',
                'feedback' => 'Smooth booking and responsive customer service. The guided city tour covered all the highlights.',
                'rating' => 4,
            ],
            // Indian customers
            [
                'name' => 'Anita Sharma',
                'feedback' => 'Amazing Kerala backwaters tour — the houseboat stay and local food were unforgettable. Excellent service throughout.',
                'rating' => 5,
            ],
            [
                'name' => 'Vikram Patel',
                'feedback' => 'Booked a family package to Goa. Great beaches, friendly hotel staff and smooth transfers. Kids loved the activities.',
                'rating' => 5,
            ],
            [
                'name' => 'Neha Gupta',
                'feedback' => 'The Rajasthan heritage tour was a dream — palaces, forts and authentic cuisine made it special. Well-paced itinerary.',
                'rating' => 5,
            ],
            [
                'name' => 'Sanjay Rao',
                'feedback' => 'Excellent trekking experience in Himachal. Guides were professional and the local arrangements were top-notch.',
                'rating' => 5,
            ],
            [
                'name' => 'Priya Menon',
                'feedback' => 'Lovely boutique hotel in Pondicherry with great coastal views and a calm atmosphere. Perfect weekend getaway.',
                'rating' => 4,
            ],
            [
                'name' => 'Sofia Rossi',
                'feedback' => 'An unforgettable boat excursion with crystal-clear waters and fantastic snorkeling spots. Highly recommended!',
                'rating' => 5,
            ],
            [
                'name' => 'Mohammed Ali',
                'feedback' => 'Loved the cultural experience tour. Authentic food tastings and warm local hosts.',
                'rating' => 5,
            ],
            [
                'name' => 'Emma Johansson',
                'feedback' => 'Comfortable accommodation and quick check-in. The concierge arranged great local trips for our family.',
                'rating' => 4,
            ],
            [
                'name' => 'Daniel Smith',
                'feedback' => 'Professional guides and flexible itinerary. The trip felt personalized and well-paced.',
                'rating' => 5,
            ],
        ];

        foreach ($data as $item) {
            Testimonial::create($item);
        }
    }
}
