<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Company Information
        Setting::setValue('company', 'name', 'appKotha', [
            'label' => 'Company Name',
            'description' => 'The name of your company',
            'type' => 'text',
            'sort_order' => 1,
        ]);

        Setting::setValue('company', 'description', 'Premium digital products and custom software development services from Bangladesh. Trusted by 500+ clients globally.', [
            'label' => 'Company Description',
            'description' => 'Brief description of your company',
            'type' => 'textarea',
            'sort_order' => 2,
        ]);

        Setting::setValue('company', 'privacy_policy_url', '/privacy-policy', [
            'label' => 'Privacy Policy URL',
            'description' => 'Link to your privacy policy page',
            'type' => 'url',
            'sort_order' => 3,
        ]);

        Setting::setValue('company', 'terms_url', '/terms-of-service', [
            'label' => 'Terms of Service URL',
            'description' => 'Link to your terms of service page',
            'type' => 'url',
            'sort_order' => 4,
        ]);

        Setting::setValue('company', 'refund_policy_url', '/refund-policy', [
            'label' => 'Refund Policy URL',
            'description' => 'Link to your refund policy page',
            'type' => 'url',
            'sort_order' => 5,
        ]);

        // Hero Section
        Setting::setValue('hero', 'trust_badge_text', 'Trusted by 500+ companies worldwide', [
            'label' => 'Trust Badge Text',
            'description' => 'Text shown in the trust badge above the hero headline',
            'type' => 'text',
            'sort_order' => 1,
        ]);

        Setting::setValue('hero', 'headline', 'Premium Software Solutions<br><span class="text-primary-500 animate-gradient bg-gradient-to-r from-primary-500 via-accent-500 to-primary-500 bg-clip-text text-transparent">Built in Bangladesh</span>', [
            'label' => 'Hero Headline',
            'description' => 'Main headline text (HTML allowed)',
            'type' => 'richtext',
            'sort_order' => 2,
        ]);

        Setting::setValue('hero', 'subheadline', 'Ready-to-use digital products and custom development services. International quality at competitive rates, delivered by experts who care.', [
            'label' => 'Hero Subheadline',
            'description' => 'Subheadline text below the main headline',
            'type' => 'textarea',
            'sort_order' => 3,
        ]);

        Setting::setValue('hero', 'primary_button_text', 'Browse Products', [
            'label' => 'Primary Button Text',
            'description' => 'Text for the main CTA button',
            'type' => 'text',
            'sort_order' => 4,
        ]);

        Setting::setValue('hero', 'primary_button_url', '/products', [
            'label' => 'Primary Button URL',
            'description' => 'URL for the main CTA button',
            'type' => 'url',
            'sort_order' => 5,
        ]);

        Setting::setValue('hero', 'secondary_button_text', 'Get Custom Quote', [
            'label' => 'Secondary Button Text',
            'description' => 'Text for the secondary CTA button',
            'type' => 'text',
            'sort_order' => 6,
        ]);

        Setting::setValue('hero', 'secondary_button_url', '/contact/quote', [
            'label' => 'Secondary Button URL',
            'description' => 'URL for the secondary CTA button',
            'type' => 'url',
            'sort_order' => 7,
        ]);

        // Statistics
        Setting::setValue('stats', 'clients_count', '500', [
            'label' => 'Happy Clients Count',
            'description' => 'Number of happy clients',
            'type' => 'number',
            'sort_order' => 1,
        ]);

        Setting::setValue('stats', 'clients_suffix', '+', [
            'label' => 'Clients Count Suffix',
            'description' => 'Suffix to show after clients count (e.g., +)',
            'type' => 'text',
            'sort_order' => 2,
        ]);

        Setting::setValue('stats', 'clients_label', 'Happy Clients', [
            'label' => 'Clients Label',
            'description' => 'Label for the clients statistic',
            'type' => 'text',
            'sort_order' => 3,
        ]);

        Setting::setValue('stats', 'countries_count', '50', [
            'label' => 'Countries Served Count',
            'description' => 'Number of countries served',
            'type' => 'number',
            'sort_order' => 4,
        ]);

        Setting::setValue('stats', 'countries_suffix', '+', [
            'label' => 'Countries Count Suffix',
            'description' => 'Suffix to show after countries count (e.g., +)',
            'type' => 'text',
            'sort_order' => 5,
        ]);

        Setting::setValue('stats', 'countries_label', 'Countries Served', [
            'label' => 'Countries Label',
            'description' => 'Label for the countries statistic',
            'type' => 'text',
            'sort_order' => 6,
        ]);

        Setting::setValue('stats', 'satisfaction_count', '99', [
            'label' => 'Client Satisfaction Count',
            'description' => 'Client satisfaction percentage',
            'type' => 'number',
            'sort_order' => 7,
        ]);

        Setting::setValue('stats', 'satisfaction_suffix', '%', [
            'label' => 'Satisfaction Count Suffix',
            'description' => 'Suffix to show after satisfaction count (e.g., %)',
            'type' => 'text',
            'sort_order' => 8,
        ]);

        Setting::setValue('stats', 'satisfaction_label', 'Client Satisfaction', [
            'label' => 'Satisfaction Label',
            'description' => 'Label for the satisfaction statistic',
            'type' => 'text',
            'sort_order' => 9,
        ]);

        Setting::setValue('stats', 'support_text', '24/7', [
            'label' => 'Support Text',
            'description' => 'Support availability text',
            'type' => 'text',
            'sort_order' => 10,
        ]);

        Setting::setValue('stats', 'support_label', 'Support Available', [
            'label' => 'Support Label',
            'description' => 'Label for the support statistic',
            'type' => 'text',
            'sort_order' => 11,
        ]);

        // Contact Information
        Setting::setValue('contact', 'address', 'Dhaka, Bangladesh', [
            'label' => 'Company Address',
            'description' => 'Your company address',
            'type' => 'text',
            'sort_order' => 1,
        ]);

        Setting::setValue('contact', 'email', 'hello@appkotha.com', [
            'label' => 'Contact Email',
            'description' => 'Primary contact email',
            'type' => 'text',
            'sort_order' => 2,
        ]);

        Setting::setValue('contact', 'phone', '+880 1234-567890', [
            'label' => 'Contact Phone',
            'description' => 'Primary contact phone number',
            'type' => 'text',
            'sort_order' => 3,
        ]);

        // Social Media
        Setting::setValue('social', 'facebook_url', 'https://facebook.com/appkotha', [
            'label' => 'Facebook URL',
            'description' => 'Your Facebook page URL',
            'type' => 'url',
            'sort_order' => 1,
        ]);

        Setting::setValue('social', 'twitter_url', 'https://twitter.com/appkotha', [
            'label' => 'Twitter URL',
            'description' => 'Your Twitter profile URL',
            'type' => 'url',
            'sort_order' => 2,
        ]);

        Setting::setValue('social', 'linkedin_url', 'https://linkedin.com/company/appkotha', [
            'label' => 'LinkedIn URL',
            'description' => 'Your LinkedIn company page URL',
            'type' => 'url',
            'sort_order' => 3,
        ]);

        Setting::setValue('social', 'github_url', 'https://github.com/appkotha', [
            'label' => 'GitHub URL',
            'description' => 'Your GitHub organization URL',
            'type' => 'url',
            'sort_order' => 4,
        ]);

        // Color Configuration
        Setting::setValue('colors', 'primary_color', '#3B82F6', [
            'label' => 'Primary Color',
            'description' => 'Main brand color',
            'type' => 'color',
            'sort_order' => 1,
        ]);

        Setting::setValue('colors', 'accent_color', '#8B5CF6', [
            'label' => 'Accent Color',
            'description' => 'Secondary accent color',
            'type' => 'color',
            'sort_order' => 2,
        ]);

        Setting::setValue('colors', 'gradient_start', '#3B82F6', [
            'label' => 'Gradient Start Color',
            'description' => 'Start color for gradients',
            'type' => 'color',
            'sort_order' => 3,
        ]);

        Setting::setValue('colors', 'gradient_end', '#8B5CF6', [
            'label' => 'Gradient End Color',
            'description' => 'End color for gradients',
            'type' => 'color',
            'sort_order' => 4,
        ]);

        $this->command->info('Default settings seeded successfully!');
    }
}
