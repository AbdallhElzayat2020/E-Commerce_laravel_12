<?php

namespace App\Http\Requests\Dashboard\Update;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCouponRequest extends FormRequest
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
        $couponId = $this->route('coupon');

        return [
            'code' => ['required', 'string', 'max:255', Rule::unique('coupons', 'code')->ignore($couponId)],
            'discount_percentage' => ['required', 'numeric', 'between:0,100'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'limit' => ['required', 'integer', 'min:1'],
            'status' => 'required|in:active,inactive',
        ];
    }
}
