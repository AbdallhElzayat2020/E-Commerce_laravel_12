<?php

namespace App\Http\Requests\Dashboard\Update;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class UpdateBrandRequest extends FormRequest
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
        $brandId = $this->route('brand');
        return [
            'name' => ['required', 'array'],
            'name.en' => ['required', 'string', 'max:255', UniqueTranslationRule::for('brands', 'name')->ignore($brandId)],
            'name.ar' => ['required', 'string', 'max:255', UniqueTranslationRule::for('brands', 'name')->ignore($brandId)],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name.en' => __('dashboard.name_en'),
            'name.ar' => __('dashboard.name_ar'),
            'logo' => __('dashboard.logo'),
            'status' => __('dashboard.status'),
        ];
    }
}
