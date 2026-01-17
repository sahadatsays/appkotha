<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CaseStudyController extends Controller
{
    public function index(Request $request)
    {
        $query = CaseStudy::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('client', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        $caseStudies = $query->orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.case-studies.index', compact('caseStudies'));
    }

    public function create()
    {
        return view('admin.case-studies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:case_studies,slug',
            'client' => 'required|string|max:255',
            'industry' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'challenge' => 'nullable|string',
            'solution' => 'nullable|string',
            'results' => 'nullable|string',
            'metrics' => 'nullable|string',
            'tech_stack' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'testimonial_quote' => 'nullable|string',
            'testimonial_author' => 'nullable|string|max:255',
            'testimonial_position' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('case-studies', 'public');
        }

        $validated['tech_stack'] = $this->parseArrayInput($request->input('tech_stack_text'));
        $validated['metrics'] = $this->parseMetrics($request->input('metrics_text'));

        CaseStudy::create($validated);

        return redirect()->route('admin.case-studies.index')
            ->with('success', 'Case study created successfully.');
    }

    public function edit(CaseStudy $caseStudy)
    {
        return view('admin.case-studies.edit', compact('caseStudy'));
    }

    public function update(Request $request, CaseStudy $caseStudy)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:case_studies,slug,' . $caseStudy->id,
            'client' => 'required|string|max:255',
            'industry' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'challenge' => 'nullable|string',
            'solution' => 'nullable|string',
            'results' => 'nullable|string',
            'metrics' => 'nullable|string',
            'tech_stack' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'testimonial_quote' => 'nullable|string',
            'testimonial_author' => 'nullable|string|max:255',
            'testimonial_position' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('case-studies', 'public');
        }

        $validated['tech_stack'] = $this->parseArrayInput($request->input('tech_stack_text'));
        $validated['metrics'] = $this->parseMetrics($request->input('metrics_text'));
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');

        $caseStudy->update($validated);

        return redirect()->route('admin.case-studies.index')
            ->with('success', 'Case study updated successfully.');
    }

    public function destroy(CaseStudy $caseStudy)
    {
        $caseStudy->delete();

        return redirect()->route('admin.case-studies.index')
            ->with('success', 'Case study deleted successfully.');
    }

    private function parseArrayInput(?string $input): array
    {
        if (empty($input)) {
            return [];
        }

        return array_filter(array_map('trim', explode("\n", $input)));
    }

    private function parseMetrics(?string $input): array
    {
        if (empty($input)) {
            return [];
        }

        $lines = array_filter(array_map('trim', explode("\n", $input)));
        $metrics = [];

        foreach ($lines as $line) {
            if (str_contains($line, ':')) {
                [$label, $value] = explode(':', $line, 2);
                $metrics[] = [
                    'label' => trim($label),
                    'value' => trim($value),
                ];
            }
        }

        return $metrics;
    }
}
