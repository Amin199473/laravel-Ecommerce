<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'last_name' => 'required|min:3',
            'mobile' => 'required|',
            'address1' => 'required|min:3',
            'address2' => 'nullable|min:3',
            'country' => 'required|min:3',
            'province' => 'required|min:3',
            'city' => 'required|min:3',
            'zip' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => 'The last name field must be at least 3 characters and required.',
            'mobile.required' => 'The mobile field must be right format and required.',
            'address1.required' => 'The address field must be at least 3 characters and required.',
            'address2.required' => 'The address2 field must be at least 3 characters',
            'country.required' => 'the country field must be 3 characters and required',
            'province.required' => 'the province field must be 3 characters and required',
            'city.required' => 'the city field must be 3 characters and required',
            'zip.required' => 'zip code field must be right format and required',
        ];
    }
}
