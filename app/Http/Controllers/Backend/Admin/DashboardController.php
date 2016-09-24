<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Models\Admin;

use App\Models\Adprovider;

use App\Models\Profile;

use Auth;

class DashboardController extends Controller
{
	public function __construct() {

		$this->middleware('adminAccess');

	}

    public function showDashboard()
    {

    	return view('Backend.Admin.others.dashboard');
    }

    // showing all the adproviders from the backend panel
    public function adproviderList()
    {
    	$adproviders = Adprovider::paginate(10);

    	return view('Backend.Admin.adproviders.adprovider_list',compact('adproviders'));
    }

    // showing the details of adprovider
    public function showAdproviderDetail(Request $request)
    {
    	$adprovider_id = $request->adprovider_id;

    	$profile_info = Profile::whereadprovider_id($adprovider_id)->firstOrFail();

    	return view('Backend.Admin.adproviders.adprovider_detail',compact('profile_info'));
    }

}
