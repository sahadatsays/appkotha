<?php

namespace Database\Seeders;

use App\Models\CaseStudy;
use Illuminate\Database\Seeder;

class CaseStudySeeder extends Seeder
{
    public function run(): void
    {
        $caseStudies = [
            [
                'title' => 'Fashion House BD E-commerce Platform',
                'slug' => 'fashion-house-bd-ecommerce',
                'client' => 'Fashion House BD',
                'industry' => 'E-commerce / Fashion',
                'excerpt' => 'Custom e-commerce platform that increased conversions by 40% and reduced cart abandonment by 60%.',
                'challenge' => 'Fashion House BD was struggling with their existing platform. High cart abandonment rates, slow page loads, and poor mobile experience were significantly impacting their online sales. They needed a modern, fast, and user-friendly e-commerce solution.',
                'solution' => 'We built a custom Laravel-based e-commerce platform with a mobile-first approach. Key features included one-page checkout, integrated bKash and SSL Commerz payments, real-time inventory management, and advanced product filtering.',
                'results' => 'The new platform launched with immediate impact. Page load times improved by 3x, cart abandonment dropped by 60%, and overall conversions increased by 40% within the first three months.',
                'metrics' => [
                    ['label' => 'Conversion Increase', 'value' => '40%'],
                    ['label' => 'Cart Abandonment Reduction', 'value' => '60%'],
                    ['label' => 'Page Speed Improvement', 'value' => '3x'],
                    ['label' => 'Mobile Traffic Increase', 'value' => '85%']
                ],
                'tech_stack' => ['Laravel', 'Vue.js', 'Tailwind CSS', 'MySQL', 'Redis'],
                'testimonial_quote' => 'appKotha transformed our business. The new platform is fast, beautiful, and our customers love it.',
                'testimonial_author' => 'Rashid Hossain',
                'testimonial_position' => 'CEO, Fashion House BD',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'TechStart BD Invoicing Automation',
                'slug' => 'techstart-bd-invoicing',
                'client' => 'TechStart BD',
                'industry' => 'Technology / SaaS',
                'excerpt' => 'Automated invoicing system that reduced billing time by 80% and improved payment collection.',
                'challenge' => 'TechStart BD was manually creating invoices in Excel and tracking payments in spreadsheets. This was time-consuming, error-prone, and made it difficult to track outstanding payments.',
                'solution' => 'We implemented Invoice Pro with custom integrations for their project management system. Invoices are now automatically generated based on project milestones, and clients receive reminders for pending payments.',
                'results' => 'The team now spends 80% less time on billing tasks. Payment collection improved significantly with automatic reminders, and the company has better visibility into their cash flow.',
                'metrics' => [
                    ['label' => 'Time Saved on Billing', 'value' => '80%'],
                    ['label' => 'On-time Payments', 'value' => '+45%'],
                    ['label' => 'Invoice Errors', 'value' => '0%'],
                    ['label' => 'Monthly Revenue Tracked', 'value' => '৳5M+']
                ],
                'tech_stack' => ['Invoice Pro', 'API Integration', 'bKash', 'Email Automation'],
                'testimonial_quote' => 'Invoice Pro has saved us hours every week. The automatic reminders alone have improved our cash flow significantly.',
                'testimonial_author' => 'Fatema Akter',
                'testimonial_position' => 'Managing Director, TechStart BD',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Global Traders HR System Implementation',
                'slug' => 'global-traders-hr-system',
                'client' => 'Global Traders Ltd',
                'industry' => 'Import/Export',
                'excerpt' => 'Complete HR and payroll automation for a company with 200+ employees across multiple locations.',
                'challenge' => 'Managing attendance, leave, and payroll for over 200 employees across multiple warehouses was becoming increasingly difficult. Different locations used different systems, making consolidation a nightmare.',
                'solution' => 'We deployed HR Manager with customizations for their specific payroll rules and multi-location requirements. The system includes biometric integration, mobile attendance for field staff, and centralized reporting.',
                'results' => 'Payroll processing time reduced from 5 days to 1 day. Attendance discrepancies dropped to near zero, and management gained real-time visibility across all locations.',
                'metrics' => [
                    ['label' => 'Payroll Processing Time', 'value' => '-80%'],
                    ['label' => 'Attendance Accuracy', 'value' => '99.9%'],
                    ['label' => 'Employees Managed', 'value' => '200+'],
                    ['label' => 'Locations Connected', 'value' => '5']
                ],
                'tech_stack' => ['HR Manager', 'Biometric Integration', 'Mobile App', 'Cloud Hosting'],
                'testimonial_quote' => 'The system has transformed our HR operations. What used to take a week now takes a day.',
                'testimonial_author' => 'Karim Ahmed',
                'testimonial_position' => 'Operations Manager, Global Traders Ltd',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Organic Foods BD Mobile Ordering App',
                'slug' => 'organic-foods-mobile-app',
                'client' => 'Organic Foods BD',
                'industry' => 'Food & Agriculture',
                'excerpt' => 'Mobile app for organic produce delivery that grew orders by 150% in 6 months.',
                'challenge' => 'Organic Foods BD was taking orders via Facebook and WhatsApp, which was inefficient and led to order mistakes. They needed a proper ordering system that could handle their growing customer base.',
                'solution' => 'We developed a cross-platform mobile app using React Native. Features included product catalog, subscription boxes, scheduled deliveries, and integrated payment processing with multiple options.',
                'results' => 'The app simplified ordering for customers and operations for the team. Orders increased by 150% within 6 months, and the subscription feature created predictable recurring revenue.',
                'metrics' => [
                    ['label' => 'Order Increase', 'value' => '150%'],
                    ['label' => 'Subscription Revenue', 'value' => '+120%'],
                    ['label' => 'Order Errors', 'value' => '-95%'],
                    ['label' => 'App Downloads', 'value' => '10,000+']
                ],
                'tech_stack' => ['React Native', 'Laravel API', 'Firebase', 'SSL Commerz'],
                'testimonial_quote' => 'Our customers love the app. It\'s so easy to order fresh organic produce now.',
                'testimonial_author' => 'Sultana Rahman',
                'testimonial_position' => 'Founder, Organic Foods BD',
                'is_published' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($caseStudies as $caseStudy) {
            CaseStudy::create($caseStudy);
        }
    }
}
