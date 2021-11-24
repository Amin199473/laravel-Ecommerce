<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialsRequest extends FormRequest
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
            'customer_name' => 'required|min:3',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:2048',
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
            'customer_name.min:3' => 'The customer name field must be at least 3 characters',
            'image.max:2048' => 'The Image must be jpeg,jpg,png and size 2MB',
        ];
    }
}