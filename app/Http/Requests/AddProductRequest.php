<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddProductRequest extends Request
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
            
            "product_name" => "required|unique:products",
            "category_id" => "required"
        ];
    }

    // custom error messages
    public function messages()
    {
        return [

            "product_name.required" => "Please enter a product name.",
            "product_name.unique" => "This product is already added.",
            "category_id.required" => "Please select a category from the list."
        ];
    }
}
