<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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
            'title' => 'required|min:8',
            'subtitle' => 'required',
            'link' => 'required|url',
            'button' => 'required|min:3',
            'image' => ['nullable', 'mimes:jpeg,jpg,png', 'max:5048'],
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
            'title.required' => 'The title field must be at least 8 characters',
            'subtitle.required' => 'The subtitle field can not be blank.',
            'link.required' => 'The Link field must be URL',
            'button.required' => 'The content of button must be 3 characters',
            'image.max' => 'The Image must be jpeg,jpg,png and Max Size 2MB',
        ];
    }
}