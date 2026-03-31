<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('production')) {
            $this->command->info('Skipping ServiceSeeder in production (demo data).');

            return;
        }

        $services = [
            [
                'name' => 'Custom Web Development',
                'slug' => 'custom-web-development',
                'tagline' => 'Tailored solutions for your business',
                'short_description' => 'We build custom web applications from scratch, designed specifically for your unique business needs.',
                'description' => '<p>Every business is unique, and sometimes off-the-shelf solutions just don\'t cut it. Our custom web application development service delivers tailored solutions that perfectly match your business requirements.</p><h3>End-to-End Development</h3><p>From initial concept to deployment and beyond, our team handles every aspect of your project. We use modern technologies like Laravel, Vue.js, and React to build scalable, maintainable applications.</p><h3>Why Choose Custom Development?</h3><ul><li>Software built exactly for your workflow</li><li>No unnecessary features you\'ll never use</li><li>Scales as your business grows</li><li>Full ownership of your code</li></ul>',
                'process_steps' => [
                    ['step' => 1, 'title' => 'Discovery', 'description' => 'We analyze your requirements and business processes'],
                    ['step' => 2, 'title' => 'Planning', 'description' => 'Detailed project roadmap and technical architecture'],
                    ['step' => 3, 'title' => 'Design', 'description' => 'UI/UX design with your brand guidelines'],
                    ['step' => 4, 'title' => 'Development', 'description' => 'Agile development with regular updates'],
                    ['step' => 5, 'title' => 'Testing', 'description' => 'Comprehensive testing and quality assurance'],
                    ['step' => 6, 'title' => 'Launch', 'description' => 'Deployment and training for your team'],
                ],
                'starting_price' => 50000.00,
                'icon' => 'code',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'E-Commerce Development',
                'slug' => 'ecommerce-development',
                'tagline' => 'Sell online with confidence',
                'short_description' => 'Complete e-commerce solutions with bKash, Nagad payment integration and local courier support.',
                'description' => '<p>Launch your online store with our comprehensive e-commerce development service. We build feature-rich online stores that convert visitors into customers.</p><h3>Local Payment Integration</h3><p>We integrate with local payment gateways like bKash, Nagad, and SSLCommerz for seamless transactions in Bangladesh.</p><h3>Courier Integration</h3><p>Automatic shipping calculation and tracking with Pathao, RedX, Steadfast, and other local couriers.</p>',
                'process_steps' => [
                    ['step' => 1, 'title' => 'Consultation', 'description' => 'Understand your products and target market'],
                    ['step' => 2, 'title' => 'Platform Selection', 'description' => 'Choose the right e-commerce platform'],
                    ['step' => 3, 'title' => 'Design', 'description' => 'Create a conversion-optimized design'],
                    ['step' => 4, 'title' => 'Development', 'description' => 'Build your store with all features'],
                    ['step' => 5, 'title' => 'Integration', 'description' => 'Payment gateways and shipping setup'],
                    ['step' => 6, 'title' => 'Launch', 'description' => 'Go live with marketing support'],
                ],
                'starting_price' => 75000.00,
                'icon' => 'shopping-cart',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Mobile App Development',
                'slug' => 'mobile-app-development',
                'tagline' => 'Apps that users love',
                'short_description' => 'Native and cross-platform mobile apps for iOS and Android that delight your customers.',
                'description' => '<p>Reach your customers on their smartphones with our mobile app development service. We build native and cross-platform apps that provide excellent user experiences.</p><h3>Cross-Platform Excellence</h3><p>Using React Native and Flutter, we can build apps for both iOS and Android from a single codebase, saving you time and money.</p><h3>Full App Lifecycle</h3><p>From idea to App Store/Play Store launch, we handle everything including ongoing updates and maintenance.</p>',
                'process_steps' => [
                    ['step' => 1, 'title' => 'Ideation', 'description' => 'Define app features and user flows'],
                    ['step' => 2, 'title' => 'Wireframing', 'description' => 'Create app blueprints and navigation'],
                    ['step' => 3, 'title' => 'UI Design', 'description' => 'Beautiful, intuitive interface design'],
                    ['step' => 4, 'title' => 'Development', 'description' => 'Build the app with clean code'],
                    ['step' => 5, 'title' => 'Testing', 'description' => 'Thorough testing on multiple devices'],
                    ['step' => 6, 'title' => 'Store Launch', 'description' => 'Publish to App Store and Play Store'],
                ],
                'starting_price' => 100000.00,
                'icon' => 'smartphone',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Software Customization',
                'slug' => 'software-customization',
                'tagline' => 'Make our products yours',
                'short_description' => 'Customize our ready-made products to perfectly fit your business requirements.',
                'description' => '<p>Our ready-made products are powerful out of the box, but we understand every business has unique needs. Our customization service adapts our products to work exactly the way you need.</p><h3>What We Can Customize</h3><ul><li>Add new features specific to your business</li><li>Integrate with your existing systems</li><li>Custom reports and dashboards</li><li>Branding and white-labeling</li><li>Workflow modifications</li></ul>',
                'process_steps' => [
                    ['step' => 1, 'title' => 'Assessment', 'description' => 'Review your current setup and needs'],
                    ['step' => 2, 'title' => 'Planning', 'description' => 'Define customization scope and timeline'],
                    ['step' => 3, 'title' => 'Development', 'description' => 'Implement the customizations'],
                    ['step' => 4, 'title' => 'Testing', 'description' => 'Ensure everything works perfectly'],
                    ['step' => 5, 'title' => 'Deployment', 'description' => 'Deploy to your environment'],
                    ['step' => 6, 'title' => 'Training', 'description' => 'Train your team on new features']
                ],
                'starting_price' => 15000.00,
                'icon' => 'settings',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'tagline' => 'Design that converts',
                'short_description' => 'User-centered design that creates delightful experiences and drives conversions.',
                'description' => '<p>Great design is more than just aesthetics—it\'s about creating experiences that users love and that drive business results. Our UI/UX design service focuses on user research, usability, and conversion optimization.</p><h3>Our Design Process</h3><p>We start by understanding your users, then create designs that guide them towards your business goals while providing a delightful experience.</p>',
                'process_steps' => [
                    ['step' => 1, 'title' => 'Research', 'description' => 'User research and competitor analysis'],
                    ['step' => 2, 'title' => 'Strategy', 'description' => 'Define user personas and journeys'],
                    ['step' => 3, 'title' => 'Wireframes', 'description' => 'Low-fidelity layouts and flows'],
                    ['step' => 4, 'title' => 'Visual Design', 'description' => 'High-fidelity UI design'],
                    ['step' => 5, 'title' => 'Prototyping', 'description' => 'Interactive prototypes for testing'],
                    ['step' => 6, 'title' => 'Handoff', 'description' => 'Design system for developers'],
                ],
                'starting_price' => 20000.00,
                'icon' => 'layout',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Maintenance & Support',
                'slug' => 'maintenance-support',
                'tagline' => 'Keep your software running smoothly',
                'short_description' => 'Ongoing maintenance, updates, and technical support for your applications.',
                'description' => '<p>Your applications need regular care to stay secure and perform well. Our maintenance and support service ensures your systems are always up-to-date and running smoothly.</p><h3>What\'s Included</h3><ul><li>Security updates and patches</li><li>Performance monitoring</li><li>Bug fixes and issue resolution</li><li>Regular backups</li><li>Technical support via email/phone</li></ul>',
                'process_steps' => [
                    ['step' => 1, 'title' => 'Assessment', 'description' => 'Review current application state'],
                    ['step' => 2, 'title' => 'Planning', 'description' => 'Create maintenance schedule'],
                    ['step' => 3, 'title' => 'Updates', 'description' => 'Regular security and feature updates'],
                    ['step' => 4, 'title' => 'Monitoring', 'description' => 'Uptime and performance monitoring'],
                    ['step' => 5, 'title' => 'Support', 'description' => 'Quick response to issues'],
                    ['step' => 6, 'title' => 'Reports', 'description' => 'Monthly performance reports'],
                ],
                'starting_price' => 5000.00,
                'icon' => 'wrench',
                'is_published' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
