<?php

namespace App\Http\Requests\Dashboard\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'site_name.*' => ['required', 'string', 'max:255'],
            'site_desc.*' => ['required', 'string', 'max:10000'],
            'site_address.*' => ['required', 'string', 'max:255'],
            'meta_description.*' => ['required', 'string', 'min:1', 'max:160'],

            'site_phone*' => ['required', 'string', 'max:20'],
            'site_email' => ['required', 'email', 'string', 'max:255'],
            'email_support' => ['required', 'email', 'string', 'max:255'],

            'facebook_url' => ['required', 'url', 'max:255'],
            'youtube_url' => ['required', 'url', 'max:255'],
            'x_url' => ['required', 'url', 'max:255'],
            'promotion_video_url' => ['required', 'url', 'max:255'],

            'logo' => ['nullable', 'mimes:jpeg,jpg,png,gif,webp,svg', 'max:3000'],
            'favicon' => ['nullable', 'mimes:jpeg,jpg,png,gif,webp,svg', 'max:3000'],
            'site_copyright' => ['required', 'string', 'max:255'],
        ];
    }
}
