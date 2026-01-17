<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\CaseStudy;
use App\Models\BlogPost;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $products = Product::published()
            ->featured()
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        $services = Service::published()
            ->featured()
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        $testimonials = Testimonial::published()
            ->featured()
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        $caseStudies = CaseStudy::published()
            ->featured()
            ->orderBy('sort_order')
            ->take(2)
            ->get();

        $latestPosts = BlogPost::published()
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('pages.home', compact(
            'products',
            'services',
            'testimonials',
            'caseStudies',
            'latestPosts'
        ));
    }
}
