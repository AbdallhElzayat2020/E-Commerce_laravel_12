<?php

namespace App\Http\Requests\Dashboard\Store;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'title.ar' => 'required|string|max:255|min:3',
            'title.en' => 'required|string|max:255|min:3',
            'content.ar' => 'required|string',
            'content.en' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg,webp|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'title.ar' => __('dashboard.title_ar'),
            'title.en' => __('dashboard.title_en'),
            'content.ar' => __('dashboard.content_ar'),
            'content.en' => __('dashboard.content_en'),
            'image' => __('dashboard.image'),
        ];
    }
}
