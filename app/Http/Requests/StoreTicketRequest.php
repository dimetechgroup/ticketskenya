<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTicketRequest extends FormRequest
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
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'currency' => 'required|string|size:3',
            'available_qty' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'max_per_user' => 'required|integer|min:1',
            'min_per_user' => 'required|integer|min:1',
            'promo_code' => 'nullable|string|max:50',

        ];
    }
}
