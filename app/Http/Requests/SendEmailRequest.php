<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SendEmailRequest extends Request
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
            
            "email" => "required|email"
        ];
    }

    // custom messages
    public function messages()
    {
        return [
            "email.required" => "Email is required.",
            "email.email" => "Please enter a valid email.",

        ];
    }
}
