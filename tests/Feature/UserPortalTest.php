<?php

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('redirects authenticated user to customer dashboard after login', function () {
    $password = 'password123';
    $user = User::factory()->create([
        'password' => bcrypt($password),
        'is_admin' => false,
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => $password,
    ]);

    $response->assertRedirect(route('dashboard'));
});

it('allows users to like and unlike blog posts', function () {
    $user = User::factory()->create();
    $post = BlogPost::query()->create([
        'title' => 'Portal Update',
        'slug' => 'portal-update',
        'excerpt' => 'Release notes',
        'content' => 'Customer portal launched.',
        'author_id' => $user->id,
        'is_published' => true,
        'published_at' => now(),
    ]);

    $this->actingAs($user)
        ->post(route('blog.like', $post))
        ->assertRedirect();

    expect($user->fresh()->blogLikes()->where('blog_post_id', $post->id)->exists())->toBeTrue();

    $this->actingAs($user)
        ->delete(route('blog.unlike', $post))
        ->assertRedirect();

    expect($user->fresh()->blogLikes()->where('blog_post_id', $post->id)->exists())->toBeFalse();
});
