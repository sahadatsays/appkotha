<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Custom Web Application',
                'slug' => 'custom-web-application',
                'tagline' => 'Tailored solutions for your business',
                'short_description' => 'We build custom web applications from scratch, designed specifically for your business needs.',
                'description' => '<p>Every business is unique, and sometimes off-the-shelf solutions just don\'t cut it. Our custom web application development service delivers tailored solutions that perfectly match your business requirements.</p><h3>End-to-End Development</h3><p>From initial concept to deployment and beyond, our team handles every aspect of your project. We use modern technologies like Laravel, Vue.js, and React to build scalable, maintainable applications.</p>',
                'process_steps' => [
                    ['step' => 1, 'title' => 'Discovery', 'description' => 'We analyze your requirements and business processes'],
                    ['step' => 2, 'title' => 'Planning', 'description' => 'Detailed project roadmap and technical architecture'],
                    ['step' => 3, 'title' => 'Design', 'description' => 'UI/UX design with your brand guidelines'],
                    ['step' => 4, 'title' => 'Development', 'description' => 'Agile development with regular updates'],
                    ['step' => 5, 'title' => 'Testing', 'description' => 'Comprehensive testing and quality assurance'],
                    ['step' => 6, 'title' => 'Launch', 'description' => 'Deployment and training for your team']
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
                'short_description' => 'Complete e-commerce solutions with payment integration, inventory management, and more.',
                'description' => '<p>Launch your online store with our comprehensive e-commerce development service. We build feature-rich online stores that convert visitors into customers.</p><h3>Local Payment Integration</h3><p>We integrate with local payment gateways like bKash, Nagad, and SSL Commerz for seamless transactions in Bangladesh.</p>',
                'process_steps' => [
                    ['step' => 1, 'title' => 'Consultation', 'description' => 'Understand your products and target market'],
                    ['step' => 2, 'title' => 'Platform Selection', 'description' => 'Choose the right e-commerce platform'],
                    ['step' => 3, 'title' => 'Design', 'description' => 'Create a conversion-optimized design'],
                    ['step' => 4, 'title' => 'Development', 'description' => 'Build your store with all features'],
                    ['step' => 5, 'title' => 'Integration', 'description' => 'Payment gateways and shipping setup'],
                    ['step' => 6, 'title' => 'Launch', 'description' => 'Go live with marketing support']
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
                'short_description' => 'Native and cross-platform mobile apps for iOS and Android platforms.',
                'description' => '<p>Reach your customers on their smartphones with our mobile app development service. We build native and cross-platform apps that provide excellent user experiences.</p><h3>Cross-Platform Excellence</h3><p>Using React Native and Flutter, we can build apps for both iOS and Android from a single codebase, saving you time and money.</p>',
                'process_steps' => [
                    ['step' => 1, 'title' => 'Ideation', 'description' => 'Define app features and user flows'],
                    ['step' => 2, 'title' => 'Wireframing', 'description' => 'Create app blueprints and navigation'],
                    ['step' => 3, 'title' => 'UI Design', 'description' => 'Beautiful, intuitive interface design'],
                    ['step' => 4, 'title' => 'Development', 'description' => 'Build the app with clean code'],
                    ['step' => 5, 'title' => 'Testing', 'description' => 'Thorough testing on multiple devices'],
                    ['step' => 6, 'title' => 'Store Launch', 'description' => 'Publish to App Store and Play Store']
                ],
                'starting_price' => 100000.00,
                'icon' => 'smartphone',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'API Development',
                'slug' => 'api-development',
                'tagline' => 'Connect your systems',
                'short_description' => 'RESTful APIs and integrations to connect your applications and services.',
                'description' => '<p>Modern applications need to communicate. Our API development service helps you build robust, secure APIs that connect your systems and enable third-party integrations.</p>',
                'process_steps' => [
                    ['step' => 1, 'title' => 'Requirements', 'description' => 'Define API endpoints and data structures'],
                    ['step' => 2, 'title' => 'Architecture', 'description' => 'Design scalable API architecture'],
                    ['step' => 3, 'title' => 'Development', 'description' => 'Build secure, well-documented APIs'],
                    ['step' => 4, 'title' => 'Testing', 'description' => 'Automated testing for reliability'],
                    ['step' => 5, 'title' => 'Documentation', 'description' => 'Comprehensive API documentation'],
                    ['step' => 6, 'title' => 'Deployment', 'description' => 'Deploy with monitoring and support']
                ],
                'starting_price' => 30000.00,
                'icon' => 'link',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'tagline' => 'Design that converts',
                'short_description' => 'User-centered design that creates delightful experiences and drives conversions.',
                'description' => '<p>Great design is more than just aesthetics—it\'s about creating experiences that users love and that drive business results. Our UI/UX design service focuses on user research, usability, and conversion optimization.</p>',
                'process_steps' => [
                    ['step' => 1, 'title' => 'Research', 'description' => 'User research and competitor analysis'],
                    ['step' => 2, 'title' => 'Strategy', 'description' => 'Define user personas and journeys'],
                    ['step' => 3, 'title' => 'Wireframes', 'description' => 'Low-fidelity layouts and flows'],
                    ['step' => 4, 'title' => 'Visual Design', 'description' => 'High-fidelity UI design'],
                    ['step' => 5, 'title' => 'Prototyping', 'description' => 'Interactive prototypes for testing'],
                    ['step' => 6, 'title' => 'Handoff', 'description' => 'Design system for developers']
                ],
                'starting_price' => 25000.00,
                'icon' => 'layout',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Maintenance & Support',
                'slug' => 'maintenance-support',
                'tagline' => 'Keep your apps running smoothly',
                'short_description' => 'Ongoing maintenance, updates, and technical support for your applications.',
                'description' => '<p>Your applications need regular care to stay secure and perform well. Our maintenance and support service ensures your systems are always up-to-date and running smoothly.</p>',
                'process_steps' => [
                    ['step' => 1, 'title' => 'Assessment', 'description' => 'Review current application state'],
                    ['step' => 2, 'title' => 'Planning', 'description' => 'Create maintenance schedule'],
                    ['step' => 3, 'title' => 'Updates', 'description' => 'Regular security and feature updates'],
                    ['step' => 4, 'title' => 'Monitoring', 'description' => '24/7 uptime monitoring'],
                    ['step' => 5, 'title' => 'Support', 'description' => 'Quick response to issues'],
                    ['step' => 6, 'title' => 'Reports', 'description' => 'Monthly performance reports']
                ],
                'starting_price' => 10000.00,
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
