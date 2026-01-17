<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Rashid Hossain',
                'position' => 'CEO',
                'company' => 'Fashion House BD',
                'content' => 'appKotha transformed our business with their custom e-commerce platform. Our sales increased by 40% within 3 months. The team was professional, responsive, and delivered exactly what we needed.',
                'rating' => 5,
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Fatema Akter',
                'position' => 'Managing Director',
                'company' => 'TechStart BD',
                'content' => 'Invoice Pro has saved us hours every week. It\'s simple, works perfectly for our needs, and the support team is always helpful. Highly recommended for any Bangladeshi business.',
                'rating' => 5,
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Karim Ahmed',
                'position' => 'Operations Manager',
                'company' => 'Global Traders Ltd',
                'content' => 'We\'ve been using HR Manager for over a year now. It\'s made payroll processing so much easier. The attendance tracking feature is particularly useful for managing our team.',
                'rating' => 5,
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Sultana Rahman',
                'position' => 'Founder',
                'company' => 'Organic Foods BD',
                'content' => 'Working with appKotha was a great experience. They built our mobile app exactly as we envisioned. Our customers love the easy ordering experience.',
                'rating' => 5,
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Jamal Uddin',
                'position' => 'IT Director',
                'company' => 'Dhaka Pharmaceuticals',
                'content' => 'Their custom development service is top-notch. They understood our complex requirements and delivered a solution that streamlined our entire workflow.',
                'rating' => 4,
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Nazmul Haque',
                'position' => 'Owner',
                'company' => 'Quick Mart',
                'content' => 'Inventory Plus has been a game-changer for our retail business. Real-time stock tracking and low stock alerts have reduced our stockouts significantly.',
                'rating' => 5,
                'is_published' => true,
                'is_featured' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
