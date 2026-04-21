<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSupportTicketRequest extends FormRequest
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
            'subject' => ['sometimes', 'required', 'string', 'max:200'],
            'category' => ['sometimes', 'required', 'string', 'max:100'],
            'priority' => ['sometimes', 'required', Rule::in(['low', 'medium', 'high'])],
            'message' => ['sometimes', 'required', 'string', 'min:20'],
            'status' => ['sometimes', 'required', Rule::in(['open', 'in_progress', 'resolved', 'closed'])],
            'attachment' => ['nullable', 'file', 'max:5120'],
        ];
    }
}
