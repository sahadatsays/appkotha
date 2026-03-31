<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', 'unique:team_members,slug'],
            'designation' => ['required', 'string', 'max:255'],
            'short_bio' => ['nullable', 'string', 'max:500'],
            'full_bio' => ['required', 'string'],
            'profile_image_file' => ['nullable', 'image', 'max:4096'],
            'profile_image_url' => ['nullable', 'string', 'max:2048', 'url', 'required_without:profile_image_file'],
            'cover_image_file' => ['nullable', 'image', 'max:5120'],
            'cover_image_url' => ['nullable', 'string', 'max:2048', 'url'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:255'],
            'skills_text' => ['nullable', 'string'],
            'social_linkedin' => ['nullable', 'url', 'max:2048'],
            'social_github' => ['nullable', 'url', 'max:2048'],
            'social_twitter' => ['nullable', 'url', 'max:2048'],
            'social_website' => ['nullable', 'url', 'max:2048'],
            'experience_years' => ['nullable', 'integer', 'min:0', 'max:80'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
        ];
    }
}
