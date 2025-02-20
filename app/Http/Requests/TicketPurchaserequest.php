<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketPurchaserequest extends FormRequest
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
            'attendees' => 'required|array|min:1',
            'attendees.*.name' => 'required|string|max:255',
            'attendees.*.email' => 'required|email|max:255',
            'attendees.*.phone_number' => 'required|string|max:20',
            'number_tickets' => 'required|integer|min:1',
        ];
    }
}
