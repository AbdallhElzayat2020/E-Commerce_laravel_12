<?php

namespace App\Http\Requests;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('category');

        return [
            'status' => ['required', 'in:active,inactive'],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'icon' => ['nullable'],
            'description' => ['nullable', 'max:1000'],
            'name' => ['required', 'array'],
            'name.*' => ['required', 'string', 'max:255', UniqueTranslationRule::for('categories', 'name')->ignore($categoryId)],
        ];
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
