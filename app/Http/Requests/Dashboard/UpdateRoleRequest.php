<?php

namespace App\Http\Requests\Dashboard;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
        $roleId = $this->route('role');

        return [
            'name.en' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for('roles')->ignore($roleId)
            ],

            'name.ar' => [
                'required',
                'string',
                'max:255',
                UniqueTranslationRule::for('roles')->ignore($roleId)
            ],

            'permissions' => 'required|array|min:1',
            'permissions.*' => 'required',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function attributes(): array
    {
        return [
            'name.en' => __('dashboard_roles.role_name_english'),
            'name.ar' => __('dashboard_roles.role_name_arabic'),
            'permissions' => __('dashboard_roles.permissions'),
        ];
    }
}
