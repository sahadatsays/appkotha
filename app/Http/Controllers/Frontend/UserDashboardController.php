<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\SupportTicketStatus;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $latestTickets = $user->supportTickets()
            ->latest()
            ->take(5)
            ->get();

        $likedBlogs = $user->likedBlogPosts()
            ->latest('blog_likes.created_at')
            ->take(5)
            ->get();

        $stats = [
            'tickets_total' => $user->supportTickets()->count(),
            'tickets_open' => $user->supportTickets()->where('status', SupportTicketStatus::Open->value)->count(),
            'liked_blogs' => $user->likedBlogPosts()->count(),
            'saved_items' => 0,
            'upcoming_features' => 8,
        ];

        $profileCompletion = collect([
            filled($user->name),
            filled($user->email),
            filled($user->phone),
            filled($user->terms_accepted_at),
        ])->filter()->count() * 25;

        return view('user.dashboard', [
            'user' => $user,
            'latestTickets' => $latestTickets,
            'likedBlogs' => $likedBlogs,
            'stats' => $stats,
            'profileCompletion' => $profileCompletion,
        ]);
    }

    public function likedBlogs(): View
    {
        $likedBlogs = auth()->user()
            ->likedBlogPosts()
            ->with(['category', 'author'])
            ->latest('blog_likes.created_at')
            ->paginate(12);

        return view('user.liked-blogs', [
            'likedBlogs' => $likedBlogs,
        ]);
    }

    public function features(): View
    {
        $featurePlaceholders = [
            ['title' => 'My Orders', 'description' => 'Track your product and service purchases from one place.'],
            ['title' => 'Downloads', 'description' => 'Access purchased files, updates, and release notes.'],
            ['title' => 'Notifications', 'description' => 'Stay updated on account, tickets, and product activity.'],
            ['title' => 'Saved Solutions', 'description' => 'Bookmark helpful solutions and references for later.'],
            ['title' => 'Service Requests', 'description' => 'Request custom service tasks and monitor delivery.'],
            ['title' => 'Project Updates', 'description' => 'View progress updates for your active projects.'],
            ['title' => 'Subscription Area', 'description' => 'Manage recurring plans and billing preferences.'],
            ['title' => 'Account Activity', 'description' => 'Review sign-ins, changes, and security activity logs.'],
        ];

        return view('user.features', [
            'featurePlaceholders' => $featurePlaceholders,
        ]);
    }
}
