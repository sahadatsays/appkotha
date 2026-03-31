<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        $featuredMembers = TeamMember::query()
            ->active()
            ->featured()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(4)
            ->get();

        $teamMembers = TeamMember::query()
            ->active()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $seoMeta = [
            'title' => 'Meet Our Team | AppKotha',
            'description' => 'Meet the AppKotha team building premium software products and custom solutions for modern businesses.',
            'type' => 'website',
        ];

        return view('pages.team.index', compact('featuredMembers', 'teamMembers', 'seoMeta'));
    }

    public function show(string $slug): View
    {
        $member = TeamMember::query()
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedMembers = TeamMember::query()
            ->active()
            ->where('id', '!=', $member->id)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(3)
            ->get();

        $seoMeta = [
            'title' => $member->name.' | Team | AppKotha',
            'description' => $member->short_bio ?: 'View profile, skills, and contact links for '.$member->name.' at AppKotha.',
            'type' => 'profile',
        ];

        return view('pages.team.show', compact('member', 'relatedMembers', 'seoMeta'));
    }
}
