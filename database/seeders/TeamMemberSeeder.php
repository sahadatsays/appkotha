<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('production')) {
            $this->command?->info('Skipping TeamMemberSeeder in production (demo data).');

            return;
        }

        $members = [
            [
                'name' => 'Sahadat Hossain',
                'slug' => 'sahadat-hossain',
                'designation' => 'Chief Executive Officer',
                'short_bio' => 'Leads product vision, business strategy, and client success for AppKotha.',
                'full_bio' => 'Sahadat leads AppKotha with a strong focus on product quality, customer outcomes, and team growth. He works closely with engineering and design teams to deliver scalable software solutions for modern businesses.',
                'profile_image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=640&q=80&auto=format&fit=crop',
                'cover_image' => 'https://images.unsplash.com/photo-1485217988980-11786ced9454?w=1800&q=80&auto=format&fit=crop',
                'email' => 'sahadat@appkotha.com',
                'phone' => '+8801700000001',
                'location' => 'Dhaka, Bangladesh',
                'skills' => ['Leadership', 'Product Strategy', 'Client Success', 'Business Development'],
                'social_links' => [
                    'linkedin' => 'https://www.linkedin.com/in/sahadat-hossain',
                    'website' => 'https://appkotha.com',
                ],
                'experience_years' => 12,
                'is_featured' => true,
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Farzana Akter',
                'slug' => 'farzana-akter',
                'designation' => 'Head of Engineering',
                'short_bio' => 'Architects robust Laravel systems and mentors the backend team.',
                'full_bio' => 'Farzana drives backend architecture, API quality, and engineering excellence. She specializes in Laravel, database optimization, and reliable deployment pipelines.',
                'profile_image' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=640&q=80&auto=format&fit=crop',
                'cover_image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1800&q=80&auto=format&fit=crop',
                'email' => 'farzana@appkotha.com',
                'phone' => '+8801700000002',
                'location' => 'Dhaka, Bangladesh',
                'skills' => ['Laravel', 'System Design', 'MySQL', 'DevOps'],
                'social_links' => [
                    'linkedin' => 'https://www.linkedin.com/in/farzana-akter',
                    'github' => 'https://github.com/farzana-akter',
                ],
                'experience_years' => 10,
                'is_featured' => true,
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Nafis Rahman',
                'slug' => 'nafis-rahman',
                'designation' => 'Senior Software Engineer',
                'short_bio' => 'Builds high-performance features across backend services and integrations.',
                'full_bio' => 'Nafis focuses on scalable APIs, payment integrations, and performance tuning. He plays a key role in delivering complex product features with clean and maintainable code.',
                'profile_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=640&q=80&auto=format&fit=crop',
                'cover_image' => null,
                'email' => 'nafis@appkotha.com',
                'phone' => '+8801700000003',
                'location' => 'Chattogram, Bangladesh',
                'skills' => ['PHP', 'Laravel', 'Redis', 'Queue Systems'],
                'social_links' => [
                    'linkedin' => 'https://www.linkedin.com/in/nafis-rahman',
                    'github' => 'https://github.com/nafis-rahman',
                ],
                'experience_years' => 7,
                'is_featured' => false,
                'status' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Tanjina Islam',
                'slug' => 'tanjina-islam',
                'designation' => 'UI/UX Designer',
                'short_bio' => 'Designs user-friendly interfaces with a strong product mindset.',
                'full_bio' => 'Tanjina crafts modern and intuitive user experiences across AppKotha products. She collaborates with developers to ensure design quality from concept to implementation.',
                'profile_image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=640&q=80&auto=format&fit=crop',
                'cover_image' => null,
                'email' => 'tanjina@appkotha.com',
                'phone' => null,
                'location' => 'Dhaka, Bangladesh',
                'skills' => ['UI Design', 'UX Research', 'Figma', 'Design Systems'],
                'social_links' => [
                    'linkedin' => 'https://www.linkedin.com/in/tanjina-islam',
                    'website' => 'https://dribbble.com/tanjina-islam',
                ],
                'experience_years' => 6,
                'is_featured' => false,
                'status' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Mehedi Hasan',
                'slug' => 'mehedi-hasan',
                'designation' => 'Frontend Engineer',
                'short_bio' => 'Implements polished interfaces with Tailwind and Alpine.js.',
                'full_bio' => 'Mehedi works on responsive frontend experiences, interactive components, and accessibility improvements across customer-facing pages.',
                'profile_image' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=640&q=80&auto=format&fit=crop',
                'cover_image' => null,
                'email' => 'mehedi@appkotha.com',
                'phone' => null,
                'location' => 'Sylhet, Bangladesh',
                'skills' => ['Blade', 'Tailwind CSS', 'Alpine.js', 'JavaScript'],
                'social_links' => [
                    'github' => 'https://github.com/mehedi-hasan',
                    'twitter' => 'https://x.com/mehedi_hasan',
                ],
                'experience_years' => 5,
                'is_featured' => false,
                'status' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Raihan Kabir',
                'slug' => 'raihan-kabir',
                'designation' => 'QA Engineer',
                'short_bio' => 'Ensures reliability with automated and manual testing strategies.',
                'full_bio' => 'Raihan owns product quality and release confidence through robust testing workflows, regression checks, and bug triage.',
                'profile_image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=640&q=80&auto=format&fit=crop',
                'cover_image' => null,
                'email' => 'raihan@appkotha.com',
                'phone' => null,
                'location' => 'Khulna, Bangladesh',
                'skills' => ['Test Automation', 'Pest', 'Manual QA', 'Performance Testing'],
                'social_links' => [
                    'linkedin' => 'https://www.linkedin.com/in/raihan-kabir',
                ],
                'experience_years' => 4,
                'is_featured' => false,
                'status' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($members as $member) {
            TeamMember::updateOrCreate(
                ['slug' => $member['slug']],
                $member
            );
        }
    }
}
