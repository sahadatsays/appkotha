<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTeamMemberRequest;
use App\Http\Requests\Admin\UpdateTeamMemberRequest;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    public function index(Request $request): View
    {
        $query = TeamMember::query()->orderBy('sort_order')->orderBy('name');

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('designation', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('slug', 'like', '%'.$search.'%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        $teamMembers = $query->paginate(15)->withQueryString();

        return view('admin.team-members.index', compact('teamMembers'));
    }

    public function create(): View
    {
        return view('admin.team-members.create');
    }

    public function store(StoreTeamMemberRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $payload = [
            'name' => $validated['name'],
            'slug' => filled($validated['slug'] ?? null)
                ? Str::slug($validated['slug'])
                : Str::slug($validated['name']),
            'designation' => $validated['designation'],
            'short_bio' => $validated['short_bio'] ?? null,
            'full_bio' => $validated['full_bio'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'location' => $validated['location'] ?? null,
            'experience_years' => $validated['experience_years'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'status' => $request->boolean('status', true),
            'sort_order' => $validated['sort_order'] ?? 0,
            'skills' => $this->parseSkillsFromText($request->input('skills_text')),
            'social_links' => $this->buildSocialLinks($request),
        ];

        if ($request->hasFile('profile_image_file')) {
            $payload['profile_image'] = $request->file('profile_image_file')->store('team-members', 'public');
        } else {
            $payload['profile_image'] = $request->string('profile_image_url')->toString();
        }

        $payload['cover_image'] = $this->resolveCoverImage($request, null);

        TeamMember::create($payload);

        return redirect()->route('admin.team-members.index')
            ->with('success', 'Team member created successfully.');
    }

    public function edit(TeamMember $teamMember): View
    {
        return view('admin.team-members.edit', compact('teamMember'));
    }

    public function update(UpdateTeamMemberRequest $request, TeamMember $teamMember): RedirectResponse
    {
        $validated = $request->validated();

        $payload = [
            'name' => $validated['name'],
            'slug' => filled($validated['slug'] ?? null)
                ? Str::slug($validated['slug'])
                : Str::slug($validated['name']),
            'designation' => $validated['designation'],
            'short_bio' => $validated['short_bio'] ?? null,
            'full_bio' => $validated['full_bio'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'location' => $validated['location'] ?? null,
            'experience_years' => $validated['experience_years'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'status' => $request->boolean('status', true),
            'sort_order' => $validated['sort_order'] ?? 0,
            'skills' => $this->parseSkillsFromText($request->input('skills_text')),
            'social_links' => $this->buildSocialLinks($request),
        ];

        if ($request->hasFile('profile_image_file')) {
            $this->deletePublicFileIfStored($teamMember->profile_image);
            $payload['profile_image'] = $request->file('profile_image_file')->store('team-members', 'public');
        } elseif (filled($request->input('profile_image_url'))) {
            $this->deletePublicFileIfStored($teamMember->profile_image);
            $payload['profile_image'] = $request->string('profile_image_url')->toString();
        }

        if ($request->boolean('remove_cover_image')) {
            $this->deletePublicFileIfStored($teamMember->cover_image);
            $payload['cover_image'] = null;
        } else {
            $payload['cover_image'] = $this->resolveCoverImage($request, $teamMember->cover_image);
        }

        $teamMember->update($payload);

        return redirect()->route('admin.team-members.index')
            ->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        $this->deletePublicFileIfStored($teamMember->profile_image);
        $this->deletePublicFileIfStored($teamMember->cover_image);
        $teamMember->delete();

        return redirect()->route('admin.team-members.index')
            ->with('success', 'Team member deleted successfully.');
    }

    public function toggleStatus(TeamMember $teamMember): RedirectResponse
    {
        $teamMember->update(['status' => ! $teamMember->status]);

        return back()->with('success', 'Team member status updated.');
    }

    /**
     * @return array<int, string>
     */
    private function parseSkillsFromText(?string $text): array
    {
        if ($text === null || trim($text) === '') {
            return [];
        }

        $lines = preg_split('/\r\n|\r|\n/', $text) ?: [];

        return array_values(array_filter(array_map('trim', $lines)));
    }

    /**
     * @return array<string, string>
     */
    private function buildSocialLinks(Request $request): array
    {
        return array_filter([
            'linkedin' => $request->input('social_linkedin'),
            'github' => $request->input('social_github'),
            'twitter' => $request->input('social_twitter'),
            'website' => $request->input('social_website'),
        ], fn ($value) => filled($value));
    }

    private function resolveCoverImage(Request $request, ?string $previous): ?string
    {
        if ($request->hasFile('cover_image_file')) {
            $this->deletePublicFileIfStored($previous);

            return $request->file('cover_image_file')->store('team-members', 'public');
        }

        if (filled($request->input('cover_image_url'))) {
            $this->deletePublicFileIfStored($previous);

            return $request->string('cover_image_url')->toString();
        }

        return $previous;
    }

    private function deletePublicFileIfStored(?string $path): void
    {
        if ($path === null || $path === '') {
            return;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
