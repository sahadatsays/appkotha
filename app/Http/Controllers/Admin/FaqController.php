<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFaqRequest;
use App\Http\Requests\Admin\UpdateFaqRequest;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::query();

        if ($request->filled('search')) {
            $query->where(function ($builder) use ($request) {
                $builder->where('question_en', 'like', '%'.$request->search.'%')
                    ->orWhere('question_bn', 'like', '%'.$request->search.'%')
                    ->orWhere('answer_en', 'like', '%'.$request->search.'%')
                    ->orWhere('answer_bn', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        $faqs = $query->orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(15);
        $categories = Faq::getCategories();

        return view('admin.faqs.index', compact('faqs', 'categories'));
    }

    public function create()
    {
        $categories = Faq::getCategories();

        return view('admin.faqs.create', compact('categories'));
    }

    public function store(StoreFaqRequest $request)
    {
        $validated = $request->validated();

        $validated['question'] = $validated['question_en'];
        $validated['answer'] = $validated['answer_en'];
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq)
    {
        $categories = Faq::getCategories();

        return view('admin.faqs.edit', compact('faq', 'categories'));
    }

    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        $validated = $request->validated();

        $validated['question'] = $validated['question_en'];
        $validated['answer'] = $validated['answer_en'];
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }

    public function togglePublish(Faq $faq)
    {
        $faq->update(['is_published' => ! $faq->is_published]);

        return back()->with('success', 'FAQ status updated.');
    }
}
