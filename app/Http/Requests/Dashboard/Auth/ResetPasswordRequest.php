<?php

namespace App\Http\Requests\Dashboard\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255', 'exists:admins,email'],
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ];
    }

    // /**
    //  * Get custom messages for validator errors.
    //  */
    // public function messages(): array
    // {
    //     return [
    //         'email.required' => 'البريد الإلكتروني مطلوب',
    //         'email.email' => 'البريد الإلكتروني غير صحيح',
    //         'email.exists' => 'البريد الإلكتروني غير موجود',
    //         'token.required' => 'التوكن مطلوب',
    //         'password.required' => 'كلمة السر مطلوبة',
    //         'password.min' => 'كلمة السر يجب أن تكون 8 أحرف على الأقل',
    //         'password.confirmed' => 'تأكيد كلمة السر غير متطابق',
    //         'password_confirmation.required' => 'تأكيد كلمة السر مطلوب',
    //     ];
    // }
}
