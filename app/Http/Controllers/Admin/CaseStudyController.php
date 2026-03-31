<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCaseStudyRequest;
use App\Http\Requests\Admin\UpdateCaseStudyRequest;
use App\Models\CaseStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CaseStudyController extends Controller
{
    public function index(Request $request)
    {
        $query = CaseStudy::query();

        if ($request->filled('search')) {
            $query->where(function ($builder) use ($request) {
                $builder->where('title_en', 'like', '%'.$request->search.'%')
                    ->orWhere('title_bn', 'like', '%'.$request->search.'%')
                    ->orWhere('client_en', 'like', '%'.$request->search.'%')
                    ->orWhere('client_bn', 'like', '%'.$request->search.'%');
            });
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

    public function store(StoreCaseStudyRequest $request)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title_en']);
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('case-studies', 'public');
        }

        $validated['tech_stack'] = $this->parseArrayInput($request->input('tech_stack_text'));
        $validated['metrics'] = $this->parseMetrics($request->input('metrics_text'));
        $validated['title'] = $validated['title_en'];
        $validated['client'] = $validated['client_en'];
        $validated['industry'] = $validated['industry_en'] ?? null;
        $validated['excerpt'] = $validated['excerpt_en'] ?? null;
        $validated['challenge'] = $validated['challenge_en'] ?? null;
        $validated['solution'] = $validated['solution_en'] ?? null;
        $validated['results'] = $validated['results_en'] ?? null;
        $validated['testimonial_quote'] = $validated['testimonial_quote_en'] ?? null;
        $validated['testimonial_author'] = $validated['testimonial_author_en'] ?? null;
        $validated['testimonial_position'] = $validated['testimonial_position_en'] ?? null;
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');

        CaseStudy::create($validated);

        return redirect()->route('admin.case-studies.index')
            ->with('success', 'Case study created successfully.');
    }

    public function edit(CaseStudy $caseStudy)
    {
        return view('admin.case-studies.edit', compact('caseStudy'));
    }

    public function update(UpdateCaseStudyRequest $request, CaseStudy $caseStudy)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title_en']);
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('case-studies', 'public');
        }

        $validated['tech_stack'] = $this->parseArrayInput($request->input('tech_stack_text'));
        $validated['metrics'] = $this->parseMetrics($request->input('metrics_text'));
        $validated['title'] = $validated['title_en'];
        $validated['client'] = $validated['client_en'];
        $validated['industry'] = $validated['industry_en'] ?? null;
        $validated['excerpt'] = $validated['excerpt_en'] ?? null;
        $validated['challenge'] = $validated['challenge_en'] ?? null;
        $validated['solution'] = $validated['solution_en'] ?? null;
        $validated['results'] = $validated['results_en'] ?? null;
        $validated['testimonial_quote'] = $validated['testimonial_quote_en'] ?? null;
        $validated['testimonial_author'] = $validated['testimonial_author_en'] ?? null;
        $validated['testimonial_position'] = $validated['testimonial_position_en'] ?? null;
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
