<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'site_title' => 'required|min:3',
            'site_description' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required|filled',
            'copy_right' => 'required|filled',
            'whatsapp' => 'nullable|url',
            'youTube' => 'nullable|url',
            'telegram' => 'nullable|url',
            'tweeter' => 'nullable|url',
            'instagram' => 'nullable|url',
        ];
    }


    public function messages()
    {
        return [
            'site_title.required' => 'the title site must be at least 3 characters',
            'site_description.required' => 'the site description site must be at least 3 characters',
            'email.required' => 'the email site must be at right format',
            'phone.required' => 'the phone number is required',
            'address.required' => 'the address is required',
            'copy_right.required' => 'the copy right is required',
            'whatsapp.url' => 'the whatsapp site must be at right format',
            'youTube.url' => 'the youTube site must be at right format',
            'telegram.url' => 'the telegram site must be at right format',
            'tweeter.url' => 'the tweeter site must be at right format',
            'instagram.url' => 'the instagram site must be at right format',
        ];
    }
}
