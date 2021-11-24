<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|min:3',
            'model_type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The  category Name must be at least 3 characters',
            'model_type.required' => 'The related Model is required'
        ];
    }
}