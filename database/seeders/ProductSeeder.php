<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('production')) {
            $this->command->info('Skipping ProductSeeder in production (demo data).');

            return;
        }

        $products = [
            [
                'name' => 'Invoice Pro',
                'slug' => 'invoice-pro',
                'tagline' => 'Professional invoicing made simple',
                'short_description' => 'Generate professional invoices in seconds. Perfect for freelancers and small businesses in Bangladesh.',
                'description' => '<p>Invoice Pro is a comprehensive invoicing solution designed specifically for Bangladeshi businesses. Create professional invoices, track payments, and manage your finances with ease.</p><h3>Why Choose Invoice Pro?</h3><p>Built for the Bangladeshi market, Invoice Pro supports BDT currency, VAT calculations, and generates invoices that meet local business requirements. Whether you\'re a freelancer, consultant, or running a small business, Invoice Pro helps you get paid faster.</p><h3>Key Benefits</h3><ul><li>Save hours on manual invoicing</li><li>Never miss a payment with automated reminders</li><li>Look professional with beautiful invoice templates</li><li>Track your income and outstanding payments at a glance</li></ul>',
                'features' => [
                    'Professional invoice templates (10+ designs)',
                    'BDT & multi-currency support',
                    'Automatic VAT/tax calculations',
                    'Payment tracking & reminders',
                    'Client management system',
                    'Export to PDF & Excel',
                    'Mobile-friendly dashboard',
                    'Email invoices directly to clients',
                    'Recurring invoices for subscriptions',
                    'Payment history & reports',
                ],
                'use_cases' => [
                    'Freelancers billing clients',
                    'Small business invoicing',
                    'Agency project billing',
                    'Consultant fee management',
                ],
                'price' => 4999.00,
                'sale_price' => 2999.00,
                'license_type' => 'yearly',
                'demo_url' => null,
                'documentation_url' => null,
                'icon' => 'receipt',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'POS System',
                'slug' => 'pos-system',
                'tagline' => 'Point of sale for modern retail',
                'short_description' => 'Fast, reliable point of sale system with integrated inventory and customer management for retail businesses.',
                'description' => '<p>AppKotha POS System is built for speed and reliability. Perfect for retail shops, restaurants, pharmacies, and service businesses across Bangladesh.</p><h3>Fast & Reliable</h3><p>Process sales quickly with an intuitive touchscreen interface. Works offline and automatically syncs when connected - never lose a sale due to internet issues.</p><h3>Complete Business Solution</h3><p>More than just a cash register, our POS system includes inventory management, customer tracking, employee management, and detailed analytics to help you grow your business.</p>',
                'features' => [
                    'Quick sale processing with touchscreen support',
                    'Cash, card, bKash, Nagad payment support',
                    'Customer loyalty program & points',
                    'Thermal receipt printing',
                    'Real-time sales dashboard',
                    'Offline mode - works without internet',
                    'Built-in inventory management',
                    'Multi-terminal & multi-branch support',
                    'Employee access control',
                    'Daily, weekly, monthly reports',
                ],
                'use_cases' => [
                    'Retail shops & showrooms',
                    'Restaurants & cafes',
                    'Pharmacies & medicine shops',
                    'Grocery stores & supermarkets',
                    'Mobile phone shops',
                ],
                'price' => 9999.00,
                'sale_price' => 6999.00,
                'license_type' => 'lifetime',
                'demo_url' => 'https://demo.appkotha.com/pos-system',
                'documentation_url' => 'https://docs.appkotha.com/pos-system',
                'icon' => 'credit-card',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'E-Commerce Platform',
                'slug' => 'ecommerce-platform',
                'tagline' => 'Launch your online store today',
                'short_description' => 'Complete e-commerce solution with local payment gateways, inventory management, and beautiful storefront.',
                'description' => '<p>Start selling online with AppKotha E-Commerce Platform. A complete solution designed for Bangladeshi businesses to launch and grow their online stores.</p><h3>Everything You Need to Sell Online</h3><p>From product management to order fulfillment, our platform handles it all. Integrated with bKash, Nagad, SSLCommerz, and other local payment gateways.</p><h3>Built for Bangladesh</h3><p>Supports Pathao, RedX, and other local courier integrations. Calculate shipping costs automatically and track deliveries in real-time.</p>',
                'features' => [
                    'Employee database management',
                    'Attendance tracking system',
                    'Leave management',
                    'Payroll processing',
                    'Performance reviews',
                    'Document storage',
                    'Employee self-service portal',
                    'Custom reports',
                ],
                'use_cases' => [
                    'SME human resource management',
                    'Factory workforce management',
                    'Office attendance tracking',
                    'Payroll automation',
                ],
                'price' => 14999.00,
                'sale_price' => 9999.00,
                'license_type' => 'yearly',
                'demo_url' => null,
                'documentation_url' => null,
                'icon' => 'shopping-cart',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Inventory Manager',
                'slug' => 'inventory-manager',
                'tagline' => 'Smart inventory management',
                'short_description' => 'Track stock, manage warehouses, and never run out of inventory again.',
                'description' => '<p>Inventory Manager is a powerful stock management system designed for retail and wholesale businesses in Bangladesh. Track every item across multiple locations with ease.</p><h3>Complete Stock Control</h3><p>Real-time inventory tracking, low stock alerts, and detailed reports help you make smarter purchasing decisions and never miss a sale due to stockouts.</p><h3>Multi-Location Support</h3><p>Managing multiple warehouses or branches? Inventory Manager lets you track stock across all locations and easily transfer items between them.</p>',
                'features' => [
                    'Real-time stock tracking',
                    'Multi-warehouse/branch support',
                    'Barcode scanning support',
                    'Low stock alerts & notifications',
                    'Purchase order management',
                    'Supplier management',
                    'Stock transfer between locations',
                    'Comprehensive reports',
                ],
                'use_cases' => [
                    'Retail shop inventory',
                    'Wholesale distribution',
                    'E-commerce stock management',
                    'Manufacturing raw materials',
                ],
                'price' => 5999.00,
                'sale_price' => 3999.00,
                'license_type' => 'yearly',
                'demo_url' => null,
                'documentation_url' => null,
                'icon' => 'package',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'HR & Payroll',
                'slug' => 'hr-payroll',
                'tagline' => 'Complete HR & payroll solution',
                'short_description' => 'Manage employees, attendance, leave, and payroll in one powerful system designed for Bangladesh.',
                'description' => '<p>HR & Payroll is an all-in-one human resource management system that simplifies employee management for businesses of all sizes in Bangladesh.</p><h3>Streamline Your HR Operations</h3><p>From attendance tracking to payroll processing, HR & Payroll handles it all. Designed to comply with Bangladeshi labor laws and practices.</p><h3>Payroll Made Easy</h3><p>Calculate salaries, bonuses, deductions, and taxes automatically. Generate pay slips and maintain complete payroll records for compliance.</p>',
                'features' => [
                    'Double-entry bookkeeping',
                    'Chart of accounts',
                    'Bank reconciliation',
                    'Financial statements',
                    'Tax calculation & reports',
                    'Multi-branch accounting',
                    'Audit trail',
                    'Budget management',
                ],
                'use_cases' => [
                    'SME human resource management',
                    'Factory workforce management',
                    'Office attendance tracking',
                    'Payroll automation',
                    'HR compliance',
                ],
                'price' => 7999.00,
                'sale_price' => null,
                'license_type' => 'yearly',
                'demo_url' => null,
                'documentation_url' => null,
                'icon' => 'users',
                'is_published' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }
}
