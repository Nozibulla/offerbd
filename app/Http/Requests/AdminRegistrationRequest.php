<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminRegistrationRequest extends Request
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

        "email" => "required|unique:admins|email",
        "password" => "required|min:3",
        "confirm_password"   => "required|same:password"
        
        ];

    }

    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array
 */
    // public function errors()
    // {
    //     $errors = [

    //     'email.required' => 'email required.',
    //     //'email.unique' => 'email already used.',
    //     'user_password.required'  => 'password required',
    //     'confirm_user_password.required'  => 'confirm password required',
    //     'confirm_user_password.same'  => 'confirm password doesn\'t match'

    //     ];

    //     return $errors;
    // }
}
