<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSupportTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'subject' => ['required', 'string', 'max:200'],
            'category' => ['required', 'string', 'max:100'],
            'priority' => ['required', Rule::in(['low', 'medium', 'high'])],
            'message' => ['required', 'string', 'min:20'],
            'attachment' => ['nullable', 'file', 'max:5120'],
        ];
    }
}
