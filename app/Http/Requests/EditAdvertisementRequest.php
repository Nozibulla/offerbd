<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditAdvertisementRequest extends Request
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
           
           // "ad_image" => "required",
           "brand_id" => "required|alpha_num",
           "branch_id" => "required|alpha_num",
           "product_id" => "required|alpha_num",
           "discount" => "required",
           "actual_price" => "required|alpha_num|between:0,9999999",
           "expire_date" => "required|date"
        ];
    }

    // custom error messages
    public function messages()
    {
        return [

        // "ad_image.required" => "Please select an image.",
        "brand_id.required" => "Please select a brand.",
        "branch_id.required" => "Please select a branch.",
        "product_id.required" => "Please select a product.",
        "discount.required" => "Please select a discount.",
        "actual_price.required" => "Please select a price.",
        "actual_price.alpha_num" => "Only numeric values allowed."

        ];
    }
}
