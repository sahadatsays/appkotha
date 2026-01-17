<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'What makes appKotha different from other development agencies?',
                'answer' => 'We combine the quality of Western agencies with competitive Bangladesh rates. Our senior-only team (5+ years experience minimum), clear communication, and proven processes ensure you get premium results without premium prices.',
                'category' => 'general',
                'is_published' => true,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'question' => 'How do your ready-made products work?',
                'answer' => 'Our digital products are production-ready solutions you can purchase and deploy immediately. You get the complete source code, documentation, and lifetime updates. No subscriptions, no hidden fees—you own it forever.',
                'category' => 'products',
                'is_published' => true,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'question' => 'What is your typical project timeline?',
                'answer' => 'Timelines vary based on project complexity. Simple websites: 2-4 weeks. Web applications: 4-12 weeks. Complex enterprise solutions: 3-6 months. We provide detailed timelines during our discovery phase.',
                'category' => 'services',
                'is_published' => true,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'question' => 'Do you offer ongoing support after launch?',
                'answer' => 'Absolutely! All projects include a warranty period with free bug fixes. We also offer flexible maintenance plans for ongoing updates, monitoring, and support. 24/7 emergency support is available.',
                'category' => 'support',
                'is_published' => true,
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'question' => 'How do you handle communication and timezone differences?',
                'answer' => 'We maintain significant overlap with US and UK business hours. You will have a dedicated project manager, access to our project portal, and weekly video calls. Response time: under 4 hours during business hours.',
                'category' => 'general',
                'is_published' => true,
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'question' => 'What technologies do you specialize in?',
                'answer' => 'We specialize in Laravel, Vue.js, React, React Native, Node.js, and WordPress. We also work with AWS, DigitalOcean, and other cloud platforms. We choose the best technology for each project\'s needs.',
                'category' => 'technical',
                'is_published' => true,
                'is_featured' => true,
                'sort_order' => 6,
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept all major credit cards, PayPal, bank transfers, and cryptocurrency payments. For enterprise clients, we also offer NET terms and custom payment schedules.',
                'category' => 'payment',
                'is_published' => true,
                'is_featured' => false,
                'sort_order' => 7,
            ],
            [
                'question' => 'Can you work with our existing team?',
                'answer' => 'Yes! We love collaborating with in-house teams. We can provide full development services, code reviews, technical consulting, or staff augmentation. We\'ll adapt to your workflow and tools.',
                'category' => 'services',
                'is_published' => true,
                'is_featured' => false,
                'sort_order' => 8,
            ],
            [
                'question' => 'Do you provide training and documentation?',
                'answer' => 'Every project includes comprehensive documentation and training sessions. We provide user manuals, technical documentation, video tutorials, and hands-on training for your team.',
                'category' => 'support',
                'is_published' => true,
                'is_featured' => false,
                'sort_order' => 9,
            ],
            [
                'question' => 'What if I need custom modifications to your products?',
                'answer' => 'We offer customization services for all our products. Whether you need minor tweaks or major feature additions, our team can help. Contact us for a free consultation and quote.',
                'category' => 'products',
                'is_published' => true,
                'is_featured' => false,
                'sort_order' => 10,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }

        $this->command->info('Default FAQs seeded successfully!');
    }
}
