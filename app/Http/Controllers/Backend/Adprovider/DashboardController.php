<?php

namespace App\Http\Controllers\Backend\Adprovider;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

	public function __construct()
	{
		$this->middleware('adProviderAccess');//custom middleware for adProvider
	}

	public function showDashboard()
	{
		return view('Backend.Adprovider.others.dashboard');
	}
}
