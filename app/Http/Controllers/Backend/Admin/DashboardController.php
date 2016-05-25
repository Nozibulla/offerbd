<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Models\Admin;

use Auth;

class DashboardController extends Controller
{
	public function __construct() {

		$this->middleware('adminAccess');

	}

    public function showDashboard()
    {

    	return view('Backend.Admin.dashboard');
    }

}
