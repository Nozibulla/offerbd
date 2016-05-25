<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddCategoryRequest extends Request
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
            "category_name" => "required|unique:categorys"
        ];
    }

    //custom error messages
    public function messages()
    {
        return [

            "category_name.required" => "Please enter a category name.",
            "category_name.unique" => "This category is already added."
        ];
    }
}
