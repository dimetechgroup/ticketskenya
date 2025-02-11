<?php

namespace App\Http\Requests;

use App\Utilities\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
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
            'image' => 'required|image|max:2048',
            'meeting_link' => [
                'required_if:location,online',
                'nullable',
                'url',
                'max:255',
            ],
            'currency' => 'required|string|max:3|in:' . implode(',', [Constants::CURRENCY_KES, Constants::CURRENCY_USD]),
            'contact_number' => 'required|string|max:15',
            'contact_email' => 'required|email|max:255',
            'is_private' => 'nullable|boolean',
        ];
    }
}
