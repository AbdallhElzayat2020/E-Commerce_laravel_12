<?php

namespace App\Http\Requests\Dashboard\Store;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'note.*' => ['required', 'string', 'min:10', 'max:35'],
            'note.ar' => 'required|string|min:10|max:35',
            'note.en' => 'required|string|min:10|max:35',
            'file_name' => ['required', 'image', 'mimes:jpg,png,jpeg,svg,webp', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'file_name' => __('dashboard.image'),
            'note.ar' => __('dashboard.note_ar'),
            'note.en' => __('dashboard.note_en'),
        ];
    }
}
