<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\AdminLoginRequest;

use App\Http\Requests\AdminRegistrationRequest;

use App\Http\Controllers\Controller;

use App\Models\Admin;

use App\Models\Profile;

use Hash;

use Auth;

use Redirect;

use URL;

class AuthController extends Controller
{

	public function getRegister()
	{
		// redirecting the logged in user to dashboard page
		if (auth()->guard('admin')->check()) {
			
			return redirect('/admin/dashboard');
		}
		// returning the registration page
		return view('Backend.Admin.auth.register');
	}

	public function postRegister(AdminRegistrationRequest $request)
	{
		$admin = new Admin;

		$admin->email = $request->email;

		$admin->password = Hash::make($request->password);

		if($admin->save()){

			$profile = new Profile;

			$profile->admin_id = $admin->id;

			$profile->membership_id = 1;

			$profile->save();

		//"administrator" access by default to newly registered user
			$admin->role()->attach(2);
		}

	}

	public function getLogin()
	{
		// redirecting the logged in user to dashboard page
		if (auth()->guard('admin')->check()) {
			
			return redirect('/admin/dashboard');
		}
		// returning the logged in user to login page
		return view('Backend.Admin.auth.login');
	}

	public function postLogin(AdminLoginRequest $request)
	{

		$admin = [

		"email" => $request->email,

		"password" => $request->password,

		];

		$remember = $request->remember;

		if(auth()->guard('admin')->attempt($admin,$remember)){

			// return redirect()->intended('/admin/dashboard');

			// successfully logged in

			return 1;

		}
		else
		{
			// return Redirect::back()->withErrors(['msg'=>'The credentials doesn\'t match'])->withInput();

			return 0;

		}
		
	}

	public function getLogout()
	{
		auth()->guard('admin')->logout();

		return redirect('/admin/login');
	}


	public function underReview()
	{
		return view('Backend.Admin.profile.under_review');
	}


}
