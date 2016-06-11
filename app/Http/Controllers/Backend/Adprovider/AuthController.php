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
		// redirecting the logged in user to dashboard page
		if (auth()->guard('adProvider')->check()) {
			
			return redirect('/adprovider/dashboard');
		}
		// returning the registration page
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
		$token = $request->token;

		$email = $request->email;

		// return $token;

		$find_adprovider_with_matched_email_token = Adprovider::whereemail($email)->whereremember_token($token)->first();

		// checking whether the token is valid or not
		if (!$find_adprovider_with_matched_email_token) {
				
				return "This link is dead";
		}

		// return $find_adprovider_with_matched_email_token;

		if($find_adprovider_with_matched_email_token->status == 1){

			echo "You are already a confirmed user.Please login...";

			return redirect('/adprovider/login');
			
		}
		else{

			// updating the status
			$find_adprovider_with_matched_email_token->status = 1;

			$find_adprovider_with_matched_email_token->save();

			echo "Email verification successful.Please login...";

			return redirect('/adprovider/login');
		}

	}

	public function getLogin()
	{
		// redirecting the logged in user to dashboard page
		if (auth()->guard('adProvider')->check()) {
			
			return redirect('/adprovider/dashboard');
		}
		// returning the registration page
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

			// successfully logged in

			// email verified and login successful
			if (auth()->guard('adProvider')->user()->status == 1) {
				
				return 1;

			} else {

				// email not verified yet
				auth()->guard('adProvider')->logout(); // logging out

				return 2;
			}

		}
		else
		{
			// credentials doesn't match
			return 0;
		}
		
	}

	public function getLogout()
	{
		auth()->guard('adProvider')->logout();

		return redirect('/adprovider/login');
	}


}
