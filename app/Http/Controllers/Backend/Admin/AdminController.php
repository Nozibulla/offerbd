<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Models\Admin;

use App\Models\Profile;

class AdminController extends Controller
{
	public function __construct()
	{
    	// this admin menu has only owner access
		$this->middleware('adminAccess:owner');
	}

	// approved admin list
	public function approvedAdminList()
	{
		$approved_admin = Admin::wherestatus(1)->get();

		return view('Backend.Admin.admin.approved_admin_list',compact('approved_admin'));
	}	

	// pending admin list
	public function pendingAdminList()
	{
		$pending_admin = Admin::wherestatus(0)->get();

		return view('Backend.Admin.admin.pending_admin_list',compact('pending_admin'));
	}

	public function rolewiseAdminList()
	{
		$adminList = Admin::wherestatus(1)->get();

		return view('Backend.Admin.admin.rolewise_admin_list',compact('adminList'));
	}

	public function showSingleAdmin(Request $request)
	{
		$admin_id = $request->admin_id;

		$profile = Profile::whereadmin_id($admin_id)->firstOrFail();

		return view('Backend.Admin.admin.admin_details',compact('profile'));
	}

	// approving an admin
	public function approveAdmin(Request $request)
	{
		$admin_id = $request->admin_id;

		$find_admin = Admin::findOrFail($admin_id);

		$find_admin->status = 1;

		$find_admin->save();
	}

	// deleting an admin
	public function deleteAdmin(Request $request)
	{
		$admin_id = $request->admin_id;

		$find_admin = Admin::findOrFail($admin_id);

		$find_admin->delete();
	}

	// changing the admin's privilege
	public function changeAdminPrivilege(Request $request)
	{
		$admin_id = $request->admin_id;

		$find_admin = Admin::findOrFail($admin_id)->role()->attach(1);
	}
}
