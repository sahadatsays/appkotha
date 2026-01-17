<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $categories = [
            ['name' => 'Development', 'slug' => 'development', 'description' => 'Web and software development insights'],
            ['name' => 'Business Tips', 'slug' => 'business-tips', 'description' => 'Tips for growing your business'],
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Latest technology trends and news'],
            ['name' => 'Tutorials', 'slug' => 'tutorials', 'description' => 'Step-by-step guides and tutorials'],
            ['name' => 'Case Studies', 'slug' => 'case-studies', 'description' => 'Success stories and project analyses'],
        ];

        foreach ($categories as $category) {
            BlogCategory::create($category);
        }

        // Get first user as author
        $author = User::first();
        if (!$author) {
            $author = User::create([
                'name' => 'Admin',
                'email' => 'admin@appkotha.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Create blog posts
        $posts = [
            [
                'title' => 'Why Bangladeshi Businesses Should Invest in Custom Software',
                'slug' => 'why-bangladeshi-businesses-should-invest-in-custom-software',
                'excerpt' => 'Discover how custom software solutions can give your Bangladeshi business a competitive edge in the digital marketplace.',
                'content' => '<p>In today\'s competitive business landscape, having the right software tools can make all the difference. While off-the-shelf solutions work for many, Bangladeshi businesses often have unique needs that require custom solutions.</p>

<h2>The Growing Digital Economy</h2>
<p>Bangladesh\'s digital economy is booming. More businesses are going online, and consumer expectations are rising. To stay competitive, businesses need software that adapts to their specific workflows and requirements.</p>

<h2>Benefits of Custom Software</h2>
<p>Custom software offers several advantages over generic solutions:</p>
<ul>
<li><strong>Perfect Fit:</strong> Built specifically for your business processes</li>
<li><strong>Scalability:</strong> Grows with your business needs</li>
<li><strong>Integration:</strong> Works seamlessly with existing systems</li>
<li><strong>Competitive Advantage:</strong> Features your competitors don\'t have</li>
</ul>

<h2>Cost Considerations</h2>
<p>While custom software requires a higher upfront investment, the long-term ROI often exceeds that of subscription-based alternatives. No more paying for features you don\'t use or working around limitations.</p>

<h2>Conclusion</h2>
<p>For businesses looking to stand out in Bangladesh\'s growing digital economy, custom software is a strategic investment that pays dividends for years to come.</p>',
                'category_id' => 1,
                'author_id' => $author->id,
                'is_published' => true,
                'is_featured' => true,
                'meta_title' => 'Custom Software for Bangladeshi Businesses',
                'meta_description' => 'Learn why custom software development is a smart investment for Bangladeshi businesses looking to compete in the digital economy.',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Top 5 Laravel Packages Every Developer Should Know',
                'slug' => 'top-5-laravel-packages-every-developer-should-know',
                'excerpt' => 'Boost your Laravel development productivity with these essential packages that we use in our own projects.',
                'content' => '<p>Laravel\'s ecosystem is one of its greatest strengths. Here are five packages we use in almost every project at appKotha.</p>

<h2>1. Laravel Debugbar</h2>
<p>Essential for development, Debugbar shows queries, routes, views, and performance metrics right in your browser.</p>

<h2>2. Spatie Laravel Permission</h2>
<p>The go-to package for roles and permissions. Clean API, well-maintained, and works perfectly with any Laravel project.</p>

<h2>3. Laravel Sanctum</h2>
<p>For API authentication, Sanctum provides a featherweight authentication system that\'s perfect for SPAs and mobile apps.</p>

<h2>4. Laravel Media Library</h2>
<p>Another Spatie gem, this package handles file uploads, conversions, and management with ease.</p>

<h2>5. Laravel Livewire</h2>
<p>Build dynamic interfaces without writing JavaScript. Perfect for admin panels and interactive components.</p>

<h2>Conclusion</h2>
<p>These packages have saved us countless hours and improved the quality of our applications. Give them a try in your next project!</p>',
                'category_id' => 1,
                'author_id' => $author->id,
                'is_published' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'How to Choose the Right Invoicing Software for Your Business',
                'slug' => 'how-to-choose-the-right-invoicing-software',
                'excerpt' => 'A practical guide to selecting invoicing software that fits your business needs and budget.',
                'content' => '<p>Choosing the right invoicing software can streamline your billing process and improve cash flow. Here\'s what to look for.</p>

<h2>Key Features to Consider</h2>
<ul>
<li><strong>Easy Invoice Creation:</strong> How quickly can you create and send invoices?</li>
<li><strong>Payment Integration:</strong> Does it connect with your payment providers?</li>
<li><strong>Multi-Currency:</strong> Important if you work with international clients</li>
<li><strong>Reporting:</strong> Can you track outstanding payments easily?</li>
</ul>

<h2>For Bangladeshi Businesses</h2>
<p>Look for software that supports BDT, works with local payment gateways like bKash and Nagad, and generates tax-compliant invoices.</p>

<h2>Our Recommendation</h2>
<p>We built Invoice Pro specifically for Bangladeshi businesses. It includes all these features and more, with a focus on ease of use.</p>',
                'category_id' => 2,
                'author_id' => $author->id,
                'is_published' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Getting Started with Laravel 11: What\'s New',
                'slug' => 'getting-started-with-laravel-11',
                'excerpt' => 'Explore the exciting new features in Laravel 11 and how to use them in your projects.',
                'content' => '<p>Laravel 11 brings exciting improvements that make development even more enjoyable. Let\'s explore the key changes.</p>

<h2>Streamlined Application Structure</h2>
<p>Laravel 11 introduces a leaner application skeleton with fewer files to manage. The bootstrap folder has been simplified significantly.</p>

<h2>Per-Second Rate Limiting</h2>
<p>You can now define rate limits per second, providing more granular control over API throttling.</p>

<h2>Health Endpoint</h2>
<p>The new /up endpoint makes it easy to check if your application is running, perfect for load balancers and monitoring.</p>

<h2>Conclusion</h2>
<p>Laravel 11 continues the tradition of developer-friendly improvements while maintaining backward compatibility.</p>',
                'category_id' => 4,
                'author_id' => $author->id,
                'is_published' => true,
                'is_featured' => true,
                'published_at' => now()->subDays(14),
            ],
            [
                'title' => 'How We Built an E-commerce Platform for a Local Fashion Brand',
                'slug' => 'ecommerce-platform-case-study',
                'excerpt' => 'A behind-the-scenes look at how we developed a custom e-commerce solution for a growing fashion brand.',
                'content' => '<p>When Fashion House BD approached us, they needed more than just an online store. They needed a complete digital transformation.</p>

<h2>The Challenge</h2>
<p>Fashion House BD was struggling with their existing platform. High cart abandonment, slow load times, and poor mobile experience were hurting sales.</p>

<h2>Our Solution</h2>
<p>We built a custom Laravel-based e-commerce platform with:</p>
<ul>
<li>Fast, responsive design optimized for mobile</li>
<li>One-page checkout to reduce abandonment</li>
<li>Integration with bKash and SSL Commerz</li>
<li>Inventory management with real-time stock updates</li>
</ul>

<h2>The Results</h2>
<p>Within 3 months:</p>
<ul>
<li>40% increase in conversion rate</li>
<li>60% reduction in cart abandonment</li>
<li>2x faster page load times</li>
</ul>',
                'category_id' => 5,
                'author_id' => $author->id,
                'is_published' => true,
                'is_featured' => false,
                'published_at' => now()->subDays(21),
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }
    }
}
