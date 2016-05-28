<?php

namespace App\Http\Controllers\Backend\Adprovider;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\AddAdvertisementRequest;

use App\Http\Requests\EditAdvertisementRequest;

use App\Http\Controllers\Controller;

use App\Models\Brand;

use App\Models\Branch;

use App\Models\Product;

use App\Models\Advertisement;

class APAdvertisementController extends Controller
{
	public function __construct()
	{
		$this->middleware('adProviderAccess');
	}

    // adding new advertisement page
	public function addAdvertisement()
	{
		$brands = Brand::pluck('brand_name','id');

		$branchs = Branch::pluck('branch_name','id');

		$products = Product::pluck('product_name','id');

		return view('Backend.Adprovider.advertisements.post_advertisement',compact('brands','branchs','products'));
	}

    // adding new advertisement process
	public function addAdvertisementProcess(AddAdvertisementRequest $request)
	{
		$advertisement = new Advertisement;

		$profile_id = auth()->guard('adProvider')->user()->profile->id;

		$ad_image = $request->ad_image->getClientOriginalName();

		$store_image = $request->ad_image->move('offer_images', $ad_image);

		if ($store_image) {

			$destinationPath = '/offer_images/' . $ad_image;
			
			$advertisement->ad_image = $destinationPath;

			$advertisement->brand_id = $request->brand_id;

			$advertisement->branch_id = $request->branch_id;

			$advertisement->product_id = $request->product_id;

			$advertisement->profile_id = $profile_id; 

			$advertisement->discount = $request->discount;

			$advertisement->actual_price = $request->actual_price;

			$present_price = $request->actual_price - ($request->actual_price*$request->discount)/100;

			$advertisement->present_price = $present_price;

			$advertisement->expire_date = $request->expire_date;

			$advertisement->save();

		}
	}

	// pending advertisement
	public function pendingAdvertisement()
	{

		$profile_id = auth()->guard('adProvider')->user()->profile->id;

		$pending_advertisements = Advertisement::wherestatus(0)->whereprofile_id($profile_id)->paginate(15);

		return view('Backend.Adprovider.advertisements.pending_advertisement',compact('pending_advertisements'));
	}

	// approved advertisement
	public function approvedAdvertisement()
	{
		$profile_id = auth()->guard('adProvider')->user()->profile->id;
		
		$approved_advertisements = Advertisement::wherestatus(1)->whereprofile_id($profile_id)->paginate(15);

		return view('Backend.Adprovider.advertisements.approved_advertisement',compact('approved_advertisements'));
	}

	// show advertisement detail page
	public function showAdvertisementDetail(Request $request)
	{

		$brands = Brand::pluck('brand_name','id');

		$branchs = Branch::pluck('branch_name','id');

		$products = Product::pluck('product_name','id');

		$advertisement_id = $request->advertisement_id;

		$advertisement_info = Advertisement::findOrFail($advertisement_id);

		return view('Backend.Admin.advertisements.show_advertisement_detail',compact('advertisement_info','brands','branchs','products'));
	}

}
