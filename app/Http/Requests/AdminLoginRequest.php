<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminLoginRequest extends Request
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
            
            'email'=>'required|email',
            'password'=>'required|min:3'
        ];
    }

    // custom messages
    public function messages()
    {
        return [

            'email.required' => 'Email is required',
            'email.email' => 'Enter a valid email.',
            'password.required' => 'Password is required.',
            // 'password.min:3' => 'Password is too short.',
        ];
    }
}
