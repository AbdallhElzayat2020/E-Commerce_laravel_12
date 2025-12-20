<?php

namespace App\Http\Requests\Website\OrderShipping;

use Illuminate\Foundation\Http\FormRequest;

class OrderShippingRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            'last_name' => ['required', 'string', 'min:2', 'max:255'],
            'user_email' => ['required', 'string', 'email', 'max:255'],
            'user_phone' => ['required', 'string', 'min:8', 'max:255'],
            'country_id' => ['required', 'exists:countries,id'],
            'governorate_id' => ['required', 'exists:governorates,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'street' => ['required', 'string', 'min:2', 'max:255'],
            'notes' => ['nullable', 'string', 'min:2', 'max:255'],
        ];
    }
}
