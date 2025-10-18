<?php

namespace App\Http\Requests\Dashboard\Store;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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

            'name.*' => ['required', 'string', 'max:60', UniqueTranslationRule::for('attributes')->ignore($this->id)],
            'value.*.*' => ['required', 'string', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name.*' => __('dashboard.attribute_name'),
            'value.*.ar' => __('dashboard.attribute_value_ar'),
            'value.*.en' => __('dashboard.attribute_value_en'),
        ];
    }
}
