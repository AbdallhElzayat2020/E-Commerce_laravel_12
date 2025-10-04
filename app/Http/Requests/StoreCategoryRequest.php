<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', 'in:active,inactive'],
            'parent_id' => ['nullable', 'integer'],
            'icon' => ['nullable'],
            'description' => ['nullable', 'max:1000'],
            'slug' => ['required'],
            'name' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
