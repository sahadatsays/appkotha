<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::published()
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $featuredProducts = Product::published()
            ->featured()
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('products.index', compact('products', 'featuredProducts'));
    }

    public function show(Product $product): View
    {
        if (!$product->is_published) {
            abort(404);
        }

        $relatedProducts = Product::published()
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
