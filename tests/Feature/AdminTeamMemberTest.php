<?php

use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create([
        'is_admin' => true,
    ]);
});

it('allows admins to view the team members index', function () {
    $response = $this->actingAs($this->admin)->get(route('admin.team-members.index'));

    $response->assertSuccessful();
    $response->assertSee('Team Members');
});

it('allows admins to create a team member with a profile image URL', function () {
    $response = $this->actingAs($this->admin)->post(route('admin.team-members.store'), [
        'name' => 'Test Member',
        'designation' => 'Software Engineer',
        'full_bio' => 'A long biography for the profile page.',
        'profile_image_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&q=80',
        'short_bio' => 'Short line for cards.',
        'skills_text' => "Laravel\nTailwind CSS",
        'social_linkedin' => 'https://www.linkedin.com/in/example',
        'status' => '1',
        'is_featured' => '0',
        'sort_order' => 0,
    ]);

    $response->assertRedirect(route('admin.team-members.index'));

    $member = TeamMember::query()->where('slug', 'test-member')->first();
    expect($member)->not->toBeNull()
        ->and($member->profile_image)->toStartWith('https://');
});

it('forbids non-admin users from the team admin area', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->actingAs($user)->get(route('admin.team-members.index'));

    $response->assertForbidden();
});
