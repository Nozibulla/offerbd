<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Models\Admin;

use App\Models\Profile;

use Auth;

class ProfileController extends Controller
{

	public function __construct()
	{
		$this->middleware('adminAccess');
	}

	public function showProfile()
	{

		$profile_info = Profile::whereadmin_id(Auth::guard('admin')->user()->id)->firstOrFail();

		return view('Backend.Admin.profile.show_profile',compact('profile_info'));
	}

	public function getInfo()
	{
		$profile_info = Admin::find(1)->profile;

		return $profile_info;
	}

	public function updateProfileInfo(Request $request)
	{
		$id = Auth::guard('admin')->user()->id;

		// $id = $request->pk;

		$column_name = $request->name; //this the field name from the js file

		$updateInfo = Profile::whereadmin_id($id)->firstOrFail();

		$updateInfo->$column_name = $request->value;

		$updateInfo->save();

	}

	// showing the specific member for a brand (brand owner)
	public function showMemberProfile(Request $request)
	{
		$profile_id = $request->profile_id;

		$member_profile = Profile::findOrFail($profile_id);

		return view('Backend.Admin.profile.show_specific_brand_owner',compact('member_profile'));
	}

}
