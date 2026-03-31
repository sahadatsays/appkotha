<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where(function ($builder) use ($request) {
                $builder->where('name_en', 'like', '%'.$request->search.'%')
                    ->orWhere('name_bn', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        $products = $query->orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name_en']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['features_en'] = $this->parseArrayInput($request->string('features_en_text')->toString());
        $validated['features_bn'] = $this->parseArrayInput($request->string('features_bn_text')->toString());
        $validated['use_cases_en'] = $this->parseArrayInput($request->string('use_cases_en_text')->toString());
        $validated['use_cases_bn'] = $this->parseArrayInput($request->string('use_cases_bn_text')->toString());
        $validated['name'] = $validated['name_en'];
        $validated['tagline'] = $validated['tagline_en'] ?? null;
        $validated['short_description'] = $validated['short_description_en'] ?? null;
        $validated['description'] = $validated['description_en'] ?? null;
        $validated['features'] = $validated['features_en'];
        $validated['use_cases'] = $validated['use_cases_en'];
        $validated['meta_title'] = $validated['meta_title_en'] ?? null;
        $validated['meta_description'] = $validated['meta_description_en'] ?? null;
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name_en']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['features_en'] = $this->parseArrayInput($request->string('features_en_text')->toString());
        $validated['features_bn'] = $this->parseArrayInput($request->string('features_bn_text')->toString());
        $validated['use_cases_en'] = $this->parseArrayInput($request->string('use_cases_en_text')->toString());
        $validated['use_cases_bn'] = $this->parseArrayInput($request->string('use_cases_bn_text')->toString());
        $validated['name'] = $validated['name_en'];
        $validated['tagline'] = $validated['tagline_en'] ?? null;
        $validated['short_description'] = $validated['short_description_en'] ?? null;
        $validated['description'] = $validated['description_en'] ?? null;
        $validated['features'] = $validated['features_en'];
        $validated['use_cases'] = $validated['use_cases_en'];
        $validated['meta_title'] = $validated['meta_title_en'] ?? null;
        $validated['meta_description'] = $validated['meta_description_en'] ?? null;
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function togglePublish(Product $product)
    {
        $product->update(['is_published' => ! $product->is_published]);

        return back()->with('success', 'Product status updated.');
    }

    private function parseArrayInput(?string $input): array
    {
        if (empty($input)) {
            return [];
        }

        return array_filter(
            array_map('trim', explode("\n", $input))
        );
    }
}
