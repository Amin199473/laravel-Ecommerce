<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|min:3',
            'value' => 'nullable|min:3|numeric',
            'percent_off' => 'nullable|min:3|numeric',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'code.required' => 'The code field must be at least 3 characters and required.',
            'value.min:3' => 'The value field must be number of value and integer.',
            'percent_off.min:3' => 'The percent off field must be number of percent and integer.',
        ];
    }
}