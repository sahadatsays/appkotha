<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamMember>
 */
class TeamMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(10, 999),
            'designation' => fake()->randomElement([
                'Software Engineer',
                'Senior Product Designer',
                'Project Manager',
                'CEO',
                'CTO',
            ]),
            'short_bio' => fake()->sentence(14),
            'full_bio' => fake()->paragraphs(3, true),
            'profile_image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=640&q=80&auto=format&fit=crop',
            'cover_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=1920&q=80&auto=format&fit=crop',
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'location' => fake()->city().', Bangladesh',
            'skills' => fake()->randomElements([
                'Laravel',
                'Vue.js',
                'Tailwind CSS',
                'MySQL',
                'DevOps',
                'System Design',
                'API Architecture',
            ], fake()->numberBetween(3, 6)),
            'social_links' => [
                'linkedin' => 'https://linkedin.com/in/'.Str::slug($name),
                'github' => 'https://github.com/'.Str::slug($name),
                'twitter' => 'https://x.com/'.Str::slug($name),
                'website' => 'https://'.Str::slug($name).'.dev',
            ],
            'experience_years' => fake()->numberBetween(1, 15),
            'is_featured' => false,
            'status' => true,
            'sort_order' => fake()->numberBetween(0, 20),
        ];
    }
}
