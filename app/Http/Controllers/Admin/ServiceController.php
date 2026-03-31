<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->filled('search')) {
            $query->where(function ($builder) use ($request) {
                $builder->where('name_en', 'like', '%'.$request->search.'%')
                    ->orWhere('name_bn', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        $services = $query->orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(StoreServiceRequest $request)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name_en']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['process_steps'] = $this->parseProcessSteps($request->string('process_steps_text')->toString());
        $validated['name'] = $validated['name_en'];
        $validated['tagline'] = $validated['tagline_en'] ?? null;
        $validated['short_description'] = $validated['short_description_en'] ?? null;
        $validated['description'] = $validated['description_en'] ?? null;
        $validated['meta_title'] = $validated['meta_title_en'] ?? null;
        $validated['meta_description'] = $validated['meta_description_en'] ?? null;
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name_en']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['process_steps'] = $this->parseProcessSteps($request->string('process_steps_text')->toString());
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['name'] = $validated['name_en'];
        $validated['tagline'] = $validated['tagline_en'] ?? null;
        $validated['short_description'] = $validated['short_description_en'] ?? null;
        $validated['description'] = $validated['description_en'] ?? null;
        $validated['meta_title'] = $validated['meta_title_en'] ?? null;
        $validated['meta_description'] = $validated['meta_description_en'] ?? null;

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    public function togglePublish(Service $service)
    {
        $service->update(['is_published' => ! $service->is_published]);

        return back()->with('success', 'Service status updated.');
    }

    private function parseProcessSteps(?string $input): array
    {
        if (empty($input)) {
            return [];
        }

        $lines = array_filter(array_map('trim', explode("\n", $input)));
        $steps = [];

        foreach ($lines as $index => $line) {
            $steps[] = [
                'step' => $index + 1,
                'title' => $line,
            ];
        }

        return $steps;
    }
}
