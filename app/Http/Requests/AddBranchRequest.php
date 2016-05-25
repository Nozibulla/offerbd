<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddBranchRequest extends Request
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
            
            "branch_name" => "required|unique:branchs",

            "brand_id" => "required"
        ];
    }

    // custom error messages
    public function messages()
    {
        return [

            "branch_name.required" => "Please enter a branch name",
            "branch_name.unique" => "This branch is already added.",
            "brand_id.required" => "Please select a brand from the list"

        ];
    }
}
