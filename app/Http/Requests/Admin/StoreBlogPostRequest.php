<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title_en' => ['required', 'string', 'max:255'],
            'title_bn' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blog_posts,slug'],
            'excerpt_en' => ['nullable', 'string', 'max:500'],
            'excerpt_bn' => ['nullable', 'string', 'max:500'],
            'content_en' => ['required', 'string'],
            'content_bn' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'image', 'max:2048'],
            'category_id' => ['nullable', 'exists:blog_categories,id'],
            'is_published' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'meta_title_en' => ['nullable', 'string', 'max:255'],
            'meta_title_bn' => ['nullable', 'string', 'max:255'],
            'meta_description_en' => ['nullable', 'string', 'max:255'],
            'meta_description_bn' => ['nullable', 'string', 'max:255'],
        ];
    }
}
