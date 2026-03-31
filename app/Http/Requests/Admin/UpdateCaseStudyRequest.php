<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCaseStudyRequest extends FormRequest
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
        $caseStudy = $this->route('caseStudy');
        $caseStudyId = is_object($caseStudy) ? $caseStudy->id : null;

        return [
            'title_en' => ['required', 'string', 'max:255'],
            'title_bn' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:case_studies,slug,'.$caseStudyId],
            'client_en' => ['required', 'string', 'max:255'],
            'client_bn' => ['nullable', 'string', 'max:255'],
            'industry_en' => ['nullable', 'string', 'max:255'],
            'industry_bn' => ['nullable', 'string', 'max:255'],
            'excerpt_en' => ['nullable', 'string', 'max:500'],
            'excerpt_bn' => ['nullable', 'string', 'max:500'],
            'challenge_en' => ['nullable', 'string'],
            'challenge_bn' => ['nullable', 'string'],
            'solution_en' => ['nullable', 'string'],
            'solution_bn' => ['nullable', 'string'],
            'results_en' => ['nullable', 'string'],
            'results_bn' => ['nullable', 'string'],
            'metrics_text' => ['nullable', 'string'],
            'tech_stack_text' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'image', 'max:2048'],
            'testimonial_quote_en' => ['nullable', 'string'],
            'testimonial_quote_bn' => ['nullable', 'string'],
            'testimonial_author_en' => ['nullable', 'string', 'max:255'],
            'testimonial_author_bn' => ['nullable', 'string', 'max:255'],
            'testimonial_position_en' => ['nullable', 'string', 'max:255'],
            'testimonial_position_bn' => ['nullable', 'string', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ];
    }
}
