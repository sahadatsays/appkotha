<?php

use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('allows user to create support ticket', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('tickets.store'), [
        'subject' => 'Need billing help',
        'category' => 'Billing',
        'priority' => 'high',
        'message' => 'I need clarification on my latest invoice and payment method.',
    ]);

    $response->assertRedirect(route('tickets.index'));

    $this->assertDatabaseHas('support_tickets', [
        'user_id' => $user->id,
        'subject' => 'Need billing help',
        'category' => 'Billing',
        'priority' => 'high',
        'status' => 'open',
    ]);
});

it('prevents users from viewing other users tickets', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();

    $ticket = SupportTicket::query()->create([
        'user_id' => $owner->id,
        'ticket_number' => 'AKT-TEST-001',
        'subject' => 'Private issue',
        'category' => 'Technical Issue',
        'priority' => 'medium',
        'status' => 'open',
        'message' => 'This issue is private and should not be visible to others.',
    ]);

    $this->actingAs($intruder)
        ->get(route('tickets.show', $ticket))
        ->assertForbidden();
});
