<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTestimonialRequest;
use App\Http\Requests\Admin\UpdateTestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::query();

        if ($request->filled('search')) {
            $query->where(function ($builder) use ($request) {
                $builder->where('name_en', 'like', '%'.$request->search.'%')
                    ->orWhere('name_bn', 'like', '%'.$request->search.'%')
                    ->orWhere('company_en', 'like', '%'.$request->search.'%')
                    ->orWhere('company_bn', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        $testimonials = $query->orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(StoreTestimonialRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $validated['name'] = $validated['name_en'];
        $validated['position'] = $validated['position_en'] ?? null;
        $validated['company'] = $validated['company_en'] ?? null;
        $validated['content'] = $validated['content_en'];
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $validated['name'] = $validated['name_en'];
        $validated['position'] = $validated['position_en'] ?? null;
        $validated['company'] = $validated['company_en'] ?? null;
        $validated['content'] = $validated['content_en'];
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }

    public function togglePublish(Testimonial $testimonial)
    {
        $testimonial->update(['is_published' => ! $testimonial->is_published]);

        return back()->with('success', 'Testimonial status updated.');
    }
}
