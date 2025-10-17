<?php

namespace App\Http\Requests\Dashboard\Store;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
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
            'name.*' => ['required', 'string', 'max:255', UniqueTranslationRule::for('attributes', 'name')],
            'value.*.*' => ['required', 'string', 'max:255'],

            'name.ar' => ['required', 'string', 'max:255', UniqueTranslationRule::for('attributes', 'name')],
            'name.en' => ['required', 'string', 'max:255', UniqueTranslationRule::for('attributes', 'name')],
        ];
    }

    public function attributes(): array
    {
        return [
            'name.*' => __('dashboard.attribute_name'),
            'value.*.*' => __('dashboard.attribute_values'),

            'name.ar' => __('dashboard.attribute_name_ar'),
            'name.en' => __('dashboard.attribute_name_en'),
        ];
    }
}
