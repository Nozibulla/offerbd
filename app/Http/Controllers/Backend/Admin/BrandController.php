<?php

namespace App\Http\Controllers\Backend\Adprovider;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Http\Requests\addBrandRequest;

use App\Models\Brand;

class BrandController extends Controller
{
	public function __construct()
	{
		$this->middleware('adminAccess');
	}

	//adding new brand page
	public function addBrand()
	{
		return view('Backend.Admin.brands.add_brand');
	}

	//adding a new brand
	public function addBrandProcess(addBrandRequest $request)
	{
		$brand = new Brand;

    	//finding the profile id of the currently logged in admin
		$profile_id = auth()->guard('admin')->user()->profile->id;

		$brand->brand_name = $request->brand_name;

		$brand->profile_id = $profile_id;

		$brand->save();

	}

	public function pendingBrandList()
	{
		$pending_brands = Brand::wherestatus(0)->get();

		return view('Backend.Admin.brands.pending_brand',compact('pending_brands'));
	}

	public function approvedBrandList()
	{
		$approved_brands = Brand::wherestatus(1)->get();

		return view('Backend.Admin.brands.approved_brand',compact('approved_brands'));
	}

	public function approvedPendingBrand(Request $request)
	{
		$brand_id = $request->brand_id;

		$find_brand = Brand::findOrFail($brand_id);

		$find_brand->status = 1;

		$find_brand->save();

	}

	public function deletePendingBrand(Request $request)
	{
		$brand_id = $request->brand_id;

		$find_brand = Brand::findOrFail($brand_id);

		$find_brand->delete();

	}

	public function showBrandDetail(Request $request)
	{
		$brand_info = Brand::findOrFail($request->brand_id);

		return view('Backend.Admin.brands.show_brand_detail',compact('brand_info'));
	}

	// save brand after editing
	public function saveEditedBrand(addBrandRequest $request)
	{
		$brand_id = $request->brand_id;

		$find_brand = Brand::findOrFail($brand_id);

		$find_brand->brand_name = $request->brand_name;

		$find_brand->save();
	}
}
