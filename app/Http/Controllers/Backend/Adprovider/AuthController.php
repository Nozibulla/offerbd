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

use Mail;

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

		$token = str_random(60); // random token generation

		$adprovider->remember_token = $token;

		if($adprovider->save())
		{

			$profile = new Profile;

			$profile->adprovider_id = $adprovider->id;

			$profile->membership_id = 1;

			// saving the profile after registering the adprovider
			if($profile->save()){

				// sending confirmation email for newly registered adprovider
				Mail::send('Backend.Adprovider.profile.confirm_registration', ['adprovider' => $adprovider], function ($message) use ($adprovider) {

					$message->to($adprovider->email, $adprovider->email)->subject('Account Confirmation');
				});
			}

		}

	}

	// registration confirmation by email verification
	public function confirmRegistration(Request $request)
	{
		$token = $request->token_email;

		$email = $request->email;

		// return $token;

		$find_adprovider_with_matched_email_token = Adprovider::whereemail($email)->whereremember_token($token)->firstOrFail();

		// return $find_adprovider_with_matched_email_token;

		if($find_adprovider_with_matched_email_token->status == 1){

			echo "You are already a confirmed user.Please login...";
		}
		else{

			$find_adprovider_with_matched_email_token->status = 1;

			$find_adprovider_with_matched_email_token->save();

			echo "Email verification successful.Please login...";

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

			// return redirect()->intended('/adprovider/dashboard');

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
		auth()->guard('adProvider')->logout();

		return redirect('/adprovider/login');
	}


}
