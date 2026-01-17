<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use App\Models\Product;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        $testimonials = Testimonial::published()
            ->featured()
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('pages.about', compact('testimonials'));
    }

    public function pricing(): View
    {
        $products = Product::published()
            ->orderBy('sort_order')
            ->get();

        $services = Service::published()
            ->orderBy('sort_order')
            ->get();

        return view('pages.pricing', compact('products', 'services'));
    }

    public function portfolio(): View
    {
        $caseStudies = CaseStudy::published()
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('pages.portfolio', compact('caseStudies'));
    }

    public function portfolioShow(CaseStudy $caseStudy): View
    {
        if (!$caseStudy->is_published) {
            abort(404);
        }

        $relatedStudies = CaseStudy::published()
            ->where('id', '!=', $caseStudy->id)
            ->take(3)
            ->get();

        return view('pages.portfolio-show', compact('caseStudy', 'relatedStudies'));
    }
}
