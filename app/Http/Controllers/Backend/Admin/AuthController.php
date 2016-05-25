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

class AuthController extends Controller
{

	public function getRegister()
	{
		return view('Backend.Admin.auth.register');
	}

	public function postRegister(AdminRegistrationRequest $request)
	{
		$admin = new Admin;

		$admin->email = $request->email;

		$admin->password = Hash::make($request->password);

		$admin->save();

		$profile = new Profile;

		$profile->admin_id = $admin->id;

		$profile->save();

		//"administrator" access by default to newly registered user

		$admin->role()->attach(2);

		return redirect('/admin/login');
	}

	public function getLogin()
	{
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

			// return redirect('/admin/dashboard');
			return redirect()->intended('/admin/dashboard');
		}

		return Redirect::back()->withErrors(['msg'=>'The credentials doesn\'t match'])->withInput();
		;
		
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
