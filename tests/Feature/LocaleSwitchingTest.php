<?php

use Illuminate\Support\Facades\Route;

beforeEach(function (): void {
    Route::middleware('web')->get('/test-locale', function () {
        return response()->json([
            'locale' => app()->getLocale(),
        ]);
    });
});

it('uses english by default when no locale is in session', function () {
    $response = $this->get('/test-locale');

    $response->assertSuccessful();
    $response->assertJson([
        'locale' => 'en',
    ]);
});

it('stores the selected locale in session', function () {
    $response = $this->post(route('locale.update', 'bn'));

    $response->assertRedirect();
    $response->assertSessionHas('locale', 'bn');
});

it('applies the selected locale from session through middleware', function () {
    $this->withSession(['locale' => 'bn']);

    $response = $this->get('/test-locale');

    $response->assertSuccessful();
    $response->assertJson([
        'locale' => 'bn',
    ]);
});

it('ignores unsupported locales', function () {
    $response = $this->post(route('locale.update', 'fr'));

    $response->assertRedirect();
    $response->assertSessionMissing('locale');
});
