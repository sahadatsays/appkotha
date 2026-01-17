<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\-\.\']+$/'], // Only letters, spaces, hyphens, dots, apostrophes
            'email' => ['required', 'email:rfc,dns', 'max:255'], // RFC and DNS validation
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^[\d\s\-+()]{7,20}$/'], // Phone number format
            'company' => ['nullable', 'string', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'message_type' => ['nullable', 'in:general,quote,support,partnership'],
            // Honeypot field for spam prevention (hidden field, should be empty)
            'website' => ['nullable', 'max:0'], // Honeypot - bots will fill this
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Honeypot check - if filled, it's likely a bot
            if ($this->has('website') && !empty($this->input('website'))) {
                $validator->errors()->add('website', 'Spam detected.');
                \Log::warning('Spam detected in contact form', [
                    'ip' => $this->ip(),
                    'email' => $this->input('email'),
                ]);
            }
        });
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Sanitize inputs
        $this->merge([
            'name' => strip_tags($this->input('name', '')),
            'email' => filter_var($this->input('email', ''), FILTER_SANITIZE_EMAIL),
            'message' => strip_tags($this->input('message', '')),
        ]);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'message.required' => 'Please enter your message.',
            'message.min' => 'Your message should be at least 10 characters.',
        ];
    }
}
