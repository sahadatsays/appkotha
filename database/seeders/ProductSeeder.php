<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Invoice Pro',
                'slug' => 'invoice-pro',
                'tagline' => 'Professional invoicing made simple',
                'short_description' => 'Generate professional invoices in seconds. Perfect for freelancers and small businesses.',
                'description' => '<p>Invoice Pro is a comprehensive invoicing solution designed for Bangladeshi businesses. Create professional invoices, track payments, and manage your finances with ease.</p><h3>Why Choose Invoice Pro?</h3><p>Built specifically for the Bangladeshi market, Invoice Pro supports BDT currency, local tax formats, and integrates with popular payment gateways used in Bangladesh.</p>',
                'features' => [
                    'Professional invoice templates',
                    'Multi-currency support (BDT, USD)',
                    'Automatic tax calculations',
                    'Payment tracking & reminders',
                    'Client management system',
                    'Export to PDF & Excel',
                    'Mobile-friendly dashboard',
                    'Email notifications'
                ],
                'use_cases' => [
                    'Freelancers billing clients',
                    'Small business invoicing',
                    'Agency project billing',
                    'Consultant fee management'
                ],
                'price' => 2999.00,
                'sale_price' => 1999.00,
                'license_type' => 'yearly',
                'demo_url' => 'https://demo.appkotha.com/invoice-pro',
                'documentation_url' => 'https://docs.appkotha.com/invoice-pro',
                'icon' => 'receipt',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'HR Manager',
                'slug' => 'hr-manager',
                'tagline' => 'Complete HR & payroll solution',
                'short_description' => 'Manage employees, attendance, leave, and payroll in one powerful system.',
                'description' => '<p>HR Manager is an all-in-one human resource management system that simplifies employee management for businesses of all sizes.</p><h3>Streamline Your HR Operations</h3><p>From attendance tracking to payroll processing, HR Manager handles it all. Designed for Bangladeshi labor laws and practices.</p>',
                'features' => [
                    'Employee database management',
                    'Attendance tracking system',
                    'Leave management',
                    'Payroll processing',
                    'Performance reviews',
                    'Document storage',
                    'Employee self-service portal',
                    'Custom reports'
                ],
                'use_cases' => [
                    'SME human resource management',
                    'Factory workforce management',
                    'Office attendance tracking',
                    'Payroll automation'
                ],
                'price' => 4999.00,
                'sale_price' => null,
                'license_type' => 'yearly',
                'demo_url' => 'https://demo.appkotha.com/hr-manager',
                'documentation_url' => 'https://docs.appkotha.com/hr-manager',
                'icon' => 'users',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Inventory Plus',
                'slug' => 'inventory-plus',
                'tagline' => 'Smart inventory management',
                'short_description' => 'Track stock, manage warehouses, and never run out of inventory again.',
                'description' => '<p>Inventory Plus is a powerful inventory management system designed for retail and wholesale businesses. Track every item across multiple locations.</p><h3>Complete Stock Control</h3><p>Real-time inventory tracking, low stock alerts, and detailed reports help you make smarter purchasing decisions.</p>',
                'features' => [
                    'Real-time stock tracking',
                    'Multi-warehouse support',
                    'Barcode scanning',
                    'Low stock alerts',
                    'Purchase order management',
                    'Supplier management',
                    'Stock transfer between locations',
                    'Comprehensive reports'
                ],
                'use_cases' => [
                    'Retail shop inventory',
                    'Wholesale distribution',
                    'E-commerce stock management',
                    'Manufacturing raw materials'
                ],
                'price' => 3999.00,
                'sale_price' => 2999.00,
                'license_type' => 'yearly',
                'demo_url' => 'https://demo.appkotha.com/inventory-plus',
                'documentation_url' => 'https://docs.appkotha.com/inventory-plus',
                'icon' => 'package',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'POS System',
                'slug' => 'pos-system',
                'tagline' => 'Point of sale for modern retail',
                'short_description' => 'Fast, reliable point of sale system with integrated inventory and customer management.',
                'description' => '<p>Our POS System is built for speed and reliability. Perfect for retail shops, restaurants, and service businesses.</p><h3>Fast & Reliable</h3><p>Process sales quickly with an intuitive interface. Works offline and syncs when connected.</p>',
                'features' => [
                    'Quick sale processing',
                    'Multiple payment methods',
                    'Customer loyalty program',
                    'Receipt printing',
                    'Daily sales reports',
                    'Offline mode support',
                    'Inventory integration',
                    'Multi-terminal support'
                ],
                'use_cases' => [
                    'Retail shops',
                    'Restaurants & cafes',
                    'Service centers',
                    'Supermarkets'
                ],
                'price' => 5999.00,
                'sale_price' => null,
                'license_type' => 'lifetime',
                'demo_url' => 'https://demo.appkotha.com/pos-system',
                'documentation_url' => 'https://docs.appkotha.com/pos-system',
                'icon' => 'credit-card',
                'is_published' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Accounting Suite',
                'slug' => 'accounting-suite',
                'tagline' => 'Professional accounting software',
                'short_description' => 'Complete double-entry accounting with financial reports and tax management.',
                'description' => '<p>Accounting Suite is a professional-grade accounting software designed for Bangladeshi businesses. Maintain accurate books and generate compliance-ready reports.</p>',
                'features' => [
                    'Double-entry bookkeeping',
                    'Chart of accounts',
                    'Bank reconciliation',
                    'Financial statements',
                    'Tax calculation & reports',
                    'Multi-branch accounting',
                    'Audit trail',
                    'Budget management'
                ],
                'use_cases' => [
                    'Business accounting',
                    'Tax preparation',
                    'Financial reporting',
                    'Audit compliance'
                ],
                'price' => 7999.00,
                'sale_price' => 5999.00,
                'license_type' => 'yearly',
                'demo_url' => 'https://demo.appkotha.com/accounting-suite',
                'documentation_url' => 'https://docs.appkotha.com/accounting-suite',
                'icon' => 'calculator',
                'is_published' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
