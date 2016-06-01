<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PasswordResetRequest extends Request
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

        "email" => "required|email",
        "password" => "required|min:3",
        "confirm_password"   => "required|same:password"
        
        ];
    }

    // custom messages
     public function messages()
    {
        return [

        'email.required' => 'Email required.',
        'user_password.required'  => 'Password required',
        'confirm_password.required'  => 'Retype password please.',
        'confirm_password.same'  => 'Password doesn\'t match.'

        ];

    }
}
