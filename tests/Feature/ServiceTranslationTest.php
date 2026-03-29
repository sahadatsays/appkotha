<?php

use App\Models\Service;

it('returns translated attribute by active locale', function () {
    $service = Service::query()->create([
        'name' => 'Web Development',
        'name_en' => 'Web Development',
        'name_bn' => 'ওয়েব ডেভেলপমেন্ট',
        'slug' => 'web-development',
        'is_published' => true,
    ]);

    app()->setLocale('bn');

    expect($service->name)->toBe('ওয়েব ডেভেলপমেন্ট')
        ->and($service->name_translated)->toBe('ওয়েব ডেভেলপমেন্ট');
});

it('falls back to english when localized value is missing', function () {
    $service = Service::query()->create([
        'name' => 'API Development',
        'name_en' => 'API Development',
        'name_bn' => null,
        'slug' => 'api-development',
        'is_published' => true,
    ]);

    app()->setLocale('bn');

    expect($service->name)->toBe('API Development');
});

it('keeps raw localized columns accessible', function () {
    $service = Service::query()->create([
        'name' => 'Mobile App Development',
        'name_en' => 'Mobile App Development',
        'name_bn' => 'মোবাইল অ্যাপ ডেভেলপমেন্ট',
        'slug' => 'mobile-app-development',
        'is_published' => true,
    ]);

    expect($service->name_en)->toBe('Mobile App Development')
        ->and($service->name_bn)->toBe('মোবাইল অ্যাপ ডেভেলপমেন্ট');
});

it('shows translated service title on frontend without view-level locale logic', function () {
    Service::query()->create([
        'name' => 'Custom Software',
        'name_en' => 'Custom Software',
        'name_bn' => 'কাস্টম সফটওয়্যার',
        'slug' => 'custom-software',
        'short_description_en' => 'English short description',
        'short_description_bn' => 'বাংলা সংক্ষিপ্ত বিবরণ',
        'is_published' => true,
    ]);

    $response = $this->withSession(['locale' => 'bn'])->get(route('services.index'));

    $response->assertSuccessful();
    $response->assertSee('কাস্টম সফটওয়্যার');
    $response->assertSee('বাংলা সংক্ষিপ্ত বিবরণ');
});
