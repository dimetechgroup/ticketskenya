<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'venue' => 'required|string|max:255',
            'location' => 'required|in:online,offline',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            // 'status' => 'required|in:draft,pending,approved,cancelled,completed',
            'image' => 'nullable|image|max:2048',
            'meeting_link' => 'nullable|url',
            'currency' => 'required|string|max:3',
            'contact_number' => 'required|string|max:15',
            'contact_email' => 'required|email|max:255',
            'processing_fee' => 'nullable|numeric|min:0',
            'is_private' => 'required|boolean',
        ];
    }
}
