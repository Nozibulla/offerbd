<?php

namespace App\Http\Controllers\Backend\adprovider;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Models\Adprovider;

use App\Models\Profile;

use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
    	return $this->middleware('adProviderAccess');
    }

    public function showProfile()
    {
    	$id = Auth::guard('adProvider')->user()->id;

    	$profile_info = Profile::whereadprovider_id($id)->firstOrFail();

    	return view('Backend.Adprovider.profile.show_profile',compact('profile_info'));

    }

    // profile setting
    public function profileSetting()
    {
        $profile_info = Profile::whereadprovider_id(Auth::guard('adProvider')->user()->id)->firstOrFail();

        return view('Backend.Adprovider.profile.profile_setting',compact('profile_info'));
    }


    public function updateProfileInfo(Request $request)
	{
		$id = Auth::guard('adProvider')->user()->id;

		$column_name = $request->name; //this the field name from the js file

		$updateInfo = Profile::whereadprovider_id($id)->firstOrFail();

		$updateInfo->$column_name = $request->value;

		$updateInfo->save();

	}

    // saving admin profile picture
    public function setProfilePicture(Request $request)
    {
        $profile_id = auth()->guard('adProvider')->user()->profile->id;

        $find_profile = Profile::findOrFail($profile_id);

        $profile_image = $request->profile_image->getClientOriginalName();

        $store_image = $request->profile_image->move('profile_images/adprovider', $profile_image);

        $destinationPath = '/profile_images/adprovider/' . $profile_image;

        $find_profile->image = $destinationPath;

        $find_profile->save();
    }


}
