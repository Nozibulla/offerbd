<?php

namespace App\Http\Controllers\Backend\Adprovider;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\addBrandRequest;

use App\Http\Controllers\Controller;

use App\Models\Brand;

class APBrandController extends Controller
{
	function __construct()
	{
		$this->middleware('adProviderAccess');
	}

    // ad brand page
	public function addBrand()
	{
		return view('Backend.Adprovider.brands.add_brand');
	}

    //adding a new brand
	public function addBrandProcess(addBrandRequest $request)
	{
		$brand = new Brand;

    	//finding the profile id of the currently logged in admin
		$profile_id = auth()->guard('adProvider')->user()->profile->id;

		$brand->brand_name = $request->brand_name;

		$brand->profile_id = $profile_id;

		$brand->save();

	}

	public function pendingBrandList()
	{

		$profile_id = auth()->guard('adProvider')->user()->profile->id;

		$pending_brands = Brand::wherestatus(0)->whereprofile_id($profile_id)->get();

		return view('Backend.Adprovider.brands.pending_brand',compact('pending_brands'));
	}

	public function approvedBrandList()
	{
		$approved_brands = Brand::wherestatus(1)->whereprofile_id($profile_id)->get();

		return view('Backend.Adprovider.brands.approved_brand',compact('approved_brands'));
	}
}
