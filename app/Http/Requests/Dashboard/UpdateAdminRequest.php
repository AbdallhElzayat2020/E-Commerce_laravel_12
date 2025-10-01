<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
        $adminId = $this->route('admin');
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email,' . $adminId],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('validation.attributes.name')]),
            'name.max' => __('validation.max.string', ['attribute' => __('validation.attributes.name'), 'max' => 255]),
            'email.required' => __('validation.required', ['attribute' => __('validation.attributes.email')]),
            'email.email' => __('validation.email', ['attribute' => __('validation.attributes.email')]),
            'email.unique' => __('validation.unique', ['attribute' => __('validation.attributes.email')]),
            'password.min' => __('validation.min.string', ['attribute' => __('validation.attributes.password'), 'min' => 8]),
            'password.confirmed' => __('validation.confirmed', ['attribute' => __('validation.attributes.password')]),
            'role_id.required' => __('validation.required', ['attribute' => __('validation.attributes.role_id')]),
            'role_id.exists' => __('validation.exists', ['attribute' => __('validation.attributes.role_id')]),
            'status.required' => __('validation.required', ['attribute' => __('validation.attributes.status')]),
            'status.in' => __('validation.in', ['attribute' => __('validation.attributes.status')]),
        ];
    }
}
