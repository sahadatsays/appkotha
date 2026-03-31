<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_en' => ['required', 'string', 'max:255'],
            'name_bn' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:services,slug'],
            'tagline_en' => ['nullable', 'string', 'max:255'],
            'tagline_bn' => ['nullable', 'string', 'max:255'],
            'short_description_en' => ['nullable', 'string', 'max:500'],
            'short_description_bn' => ['nullable', 'string', 'max:500'],
            'description_en' => ['nullable', 'string'],
            'description_bn' => ['nullable', 'string'],
            'process_steps_text' => ['nullable', 'string'],
            'starting_price' => ['nullable', 'numeric', 'min:0'],
            'icon' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'meta_title_en' => ['nullable', 'string', 'max:255'],
            'meta_title_bn' => ['nullable', 'string', 'max:255'],
            'meta_description_en' => ['nullable', 'string', 'max:255'],
            'meta_description_bn' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'name_en.required' => 'English service name is required.',
        ];
    }
}
