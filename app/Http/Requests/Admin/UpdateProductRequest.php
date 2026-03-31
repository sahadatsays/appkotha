<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $product = $this->route('product');
        $productId = is_object($product) ? $product->id : null;

        return [
            'name_en' => ['required', 'string', 'max:255'],
            'name_bn' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug,'.$productId],
            'tagline_en' => ['nullable', 'string', 'max:255'],
            'tagline_bn' => ['nullable', 'string', 'max:255'],
            'short_description_en' => ['nullable', 'string', 'max:500'],
            'short_description_bn' => ['nullable', 'string', 'max:500'],
            'description_en' => ['nullable', 'string'],
            'description_bn' => ['nullable', 'string'],
            'features_en_text' => ['nullable', 'string'],
            'features_bn_text' => ['nullable', 'string'],
            'use_cases_en_text' => ['nullable', 'string'],
            'use_cases_bn_text' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'sale_price' => ['nullable', 'numeric', 'min:0'],
            'license_type' => ['nullable', 'string', 'max:100'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'documentation_url' => ['nullable', 'url', 'max:255'],
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
}
