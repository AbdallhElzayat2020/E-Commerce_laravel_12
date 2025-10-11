<?php

namespace App\Http\Requests\Dashboard\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFaqRequest extends FormRequest
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
            'question.ar' => 'required|string|max:255',
            'question.en' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'answer.ar' => 'required|string',
            'answer.en' => 'required|string',
        ];
    }
}
