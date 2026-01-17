<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'published_products' => Product::where('is_published', true)->count(),
            'total_services' => Service::count(),
            'published_services' => Service::where('is_published', true)->count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total'),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'total_messages' => ContactMessage::count(),
            'total_posts' => BlogPost::count(),
            'published_posts' => BlogPost::where('is_published', true)->count(),
        ];

        $recentOrders = Order::with('items')
            ->latest()
            ->take(5)
            ->get();

        $recentMessages = ContactMessage::where('is_read', false)
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'recentMessages'));
    }
}
