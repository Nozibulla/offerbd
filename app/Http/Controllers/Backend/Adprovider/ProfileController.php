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

    	$adproviderInfo = Profile::whereadprovider_id($id)->firstOrFail();

    	return view('Backend.Adprovider.profile.show_profile',compact('adproviderInfo'));

    }

    public function updateProfileInfo(Request $request)
	{
		$id = Auth::guard('adProvider')->user()->id;

		$column_name = $request->name; //this the field name from the js file

		$updateInfo = Profile::whereadprovider_id($id)->firstOrFail();

		$updateInfo->$column_name = $request->value;

		$updateInfo->save();

	}

}
