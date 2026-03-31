<?php

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\User;

it('returns bangla product content when locale is bn', function () {
    $product = Product::query()->create([
        'name' => 'Starter',
        'name_en' => 'Starter',
        'name_bn' => 'স্টার্টার',
        'slug' => 'starter',
        'features_en' => ['Fast setup'],
        'features_bn' => ['দ্রুত সেটআপ'],
        'price' => 99,
    ]);

    app()->setLocale('bn');

    expect($product->name)->toBe('স্টার্টার')
        ->and($product->features)->toBe(['দ্রুত সেটআপ']);
});

it('falls back to english for missing bangla on blog post', function () {
    $author = User::factory()->create();
    $category = BlogCategory::query()->create([
        'name' => 'Tech',
        'name_en' => 'Tech',
        'slug' => 'tech',
    ]);

    $post = BlogPost::query()->create([
        'title' => 'English Title',
        'title_en' => 'English Title',
        'title_bn' => null,
        'slug' => 'english-title',
        'content' => 'English body',
        'content_en' => 'English body',
        'author_id' => $author->id,
        'category_id' => $category->id,
    ]);

    app()->setLocale('bn');

    expect($post->title)->toBe('English Title');
});

it('keeps raw testimonial columns accessible', function () {
    $testimonial = Testimonial::query()->create([
        'name' => 'John',
        'name_en' => 'John',
        'name_bn' => 'জন',
        'content' => 'Great product',
        'content_en' => 'Great product',
        'content_bn' => 'দারুণ পণ্য',
        'rating' => 5,
    ]);

    expect($testimonial->name_en)->toBe('John')
        ->and($testimonial->name_bn)->toBe('জন')
        ->and($testimonial->content_bn)->toBe('দারুণ পণ্য');
});
