<?php

use App\Models\TeamMember;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the team listing page with active members', function () {
    $featured = TeamMember::factory()->create([
        'name' => 'Jane Featured',
        'slug' => 'jane-featured',
        'is_featured' => true,
        'status' => true,
    ]);
    $active = TeamMember::factory()->create([
        'name' => 'John Active',
        'slug' => 'john-active',
        'status' => true,
    ]);
    TeamMember::factory()->create([
        'name' => 'Hidden Inactive',
        'slug' => 'hidden-inactive',
        'status' => false,
    ]);

    $response = $this->get(route('team.index'));

    $response->assertSuccessful();
    $response->assertSee('Meet Our Team');
    $response->assertSee($featured->name);
    $response->assertSee($active->name);
    $response->assertDontSee('Hidden Inactive');
});

it('shows the team member profile page by slug', function () {
    $member = TeamMember::factory()->create([
        'name' => 'Sarah Smith',
        'slug' => 'sarah-smith',
        'status' => true,
        'skills' => ['Laravel', 'Tailwind CSS'],
    ]);

    $response = $this->get(route('team.show', $member->slug));

    $response->assertSuccessful();
    $response->assertSee($member->name);
    $response->assertSee($member->designation);
    $response->assertSee('Skills');
    $response->assertSee('Laravel');
});

it('returns 404 for inactive member profile', function () {
    $inactiveMember = TeamMember::factory()->create([
        'slug' => 'inactive-member',
        'status' => false,
    ]);

    $response = $this->get(route('team.show', $inactiveMember->slug));

    $response->assertNotFound();
});
