<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|email:rfc,dns,filter|unique:users,email',
            'dateOfBirth' => 'required',
            'gender' => 'required',
            'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|confirmed',
            'role' => 'required',
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
            'name.required' => 'The title field must be at least 3 characters',
            'email.required' => 'The email field must be unique and email formt.',
            'dateOfBirth.required' => 'please select date of birth',
            'gender.reduired' => 'please select one gender',
            'password.regex' => 'The Password Consis of English uppercase characters (A – Z) and lowercase characters (a – z) and Base 10 digits (0 – 9) and Non-alphanumeric (For example: !, $, #, or %) Unicode characters',
            'role.required' => 'please select an role',
        ];
    }
}