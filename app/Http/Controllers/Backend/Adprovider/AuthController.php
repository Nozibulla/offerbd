<?php

namespace App\Http\Controllers\Backend\Adprovider;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\AdproviderLoginRequest;

use App\Http\Requests\AdproviderRegistrationRequest;

use App\Http\Controllers\Controller;

use App\Models\Adprovider;

use App\Models\Profile;

use Hash;

use Auth;

use Redirect;

class AuthController extends Controller
{

	public function getRegister()
	{
		return view('Backend.Adprovider.auth.register');
	}

	public function postRegister(AdproviderRegistrationRequest $request)
	{
		$adprovider = new Adprovider;

		$adprovider->email = $request->email;

		$adprovider->password = Hash::make($request->password);

		if($adprovider->save())
		{

			$profile = new Profile;

			$profile->adprovider_id = $adprovider->id;

			$profile->save();

			return redirect('/adprovider/login');

		}

	}

	public function getLogin()
	{
		return view('Backend.Adprovider.auth.login');
	}

	public function postLogin(AdproviderLoginRequest $request)
	{

		$adprovider = [

		"email" => $request->email,

		"password" => $request->password,

		];

		$remember = $request->remember;

		if(auth()->guard('adProvider')->attempt($adprovider,$remember)){

			return redirect('/adprovider/dashboard');
		}

		return Redirect::back()->withErrors(['msg'=>'The credentials doesn\'t match'])->withInput();
		;
		
	}

	public function getLogout()
	{
		auth()->guard('adProvider')->logout();

		return redirect('/adprovider/login');
	}


}
