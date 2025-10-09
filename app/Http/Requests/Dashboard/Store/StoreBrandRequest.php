<?php

namespace App\Http\Requests\Dashboard\Store;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'name.ar' => ['required', 'string', 'max:255', UniqueTranslationRule::for('brands', 'name')],
            'name.en' => ['required', 'string', 'max:255', UniqueTranslationRule::for('brands', 'name')],
            'status' => ['required', 'in:active,inactive'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'logo' => __('dashboard.logo'),
            'name.ar' => __('dashboard.name_ar'),
            'name.en' => __('dashboard.name_en'),
            'status' => __('dashboard.status'),
        ];
    }
}
