<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class StoreCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', 'in:active,inactive'],
            'parent_id' => ['nullable', 'integer'],
            'icon' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'description' => ['nullable', 'max:2000'],
            'slug' => ['nullable'],
            'name' => ['required', 'array'],
            'name.*' => ['required', 'string', 'max:255', UniqueTranslationRule::for('categories', 'name')],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'name.ar' => __('dashboard.name_ar'),
            'name.en' => __('dashboard.name_en'),
            'status' => __('dashboard.status'),
            'parent_id' => __('dashboard.select_Parent'),
        ];
    }
}
