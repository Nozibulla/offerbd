<?php

namespace App\Http\Controllers\Backend\Adprovider;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\addBrandRequest;

use App\Http\Controllers\Controller;

use App\Models\Brand;

class BrandController extends Controller
{
	public function __construct()
	{
		$this->middleware('adProviderAccess');
	}

    //adding new brand page
	public function addBrand()
	{
		return view('Backend.Adprovider.brands.add_brand');
	}

	//adding a new brand
	public function addBrandProcess(addBrandRequest $request)
	{
		$brand = new Brand;

    	//finding the profile id of the currently logged in adprovider
		$profile_id = auth()->guard('adProvider')->user()->profile->id;

		$brand->brand_name = $request->brand_name;

		$brand->profile_id = $profile_id;

		$brand->save();

	}

}
