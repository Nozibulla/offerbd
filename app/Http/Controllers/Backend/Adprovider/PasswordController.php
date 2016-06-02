<?php

namespace App\Http\Controllers\Backend\Adprovider;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\SendEmailRequest;

use App\Http\Requests\PasswordResetRequest;

use App\Http\Controllers\Controller;

use App\Models\Admin;

use App\Models\Passwordreset;

use Config;

use Mail;

use Carbon\Carbon;

use Hash;

class PasswordController extends Controller
{
	public function __construct()
	{
    	//$this->middleware('adminAccess');
	}

    // showing the password reset email page
	public function getEmail()
	{
		return view('Backend.Admin.auth.passwords.email');
	}

    // sending an email
	public function postEmail(SendEmailRequest $request)
	{
		$reset_email = $request->email;

		// checking whether the email is registered or not
		$check_user = Admin::whereemail($reset_email)->firstOrFail();

		$profile_info = $check_user->profile;

		$profile_info->reset_email = $reset_email;

		$token = str_random(50);

		$profile_info->token = $token;

		// checking the user has already reset password for once or not

		$find_admin = Passwordreset::whereemail($reset_email)->first();

		if ($find_admin) {

			// admin already reset password for at least once.so updating the token and timestamps

			$find_admin->token = $token;

			$find_admin->save();
			
		}
		else{

			// first time password reset & saving the random token to database for verification

			$password_reset = new Passwordreset;

			$password_reset->email = $reset_email;

			$password_reset->token = $token;

			$password_reset->save();

		}

		// sending password reset link 
		Mail::send('Backend.Admin.auth.emails.password', ['profile_info' => $profile_info], function ($message) use ($profile_info) {

			$message->to($profile_info->reset_email, $profile_info->first_name." ".$profile_info->last_name)->subject('Password Reset');
		});
	}

	// showing the password reset page
	public function getReset(Request $request)
	{
		$token = $request->token;

		// checking whether the token is valid or not and the token is generated before 1 hour
		$find_admin_with_token_matched = Passwordreset::wheretoken($token)->where('updated_at', '>', Carbon::now()->subHours(1))->first();

		if ($find_admin_with_token_matched) {
			
			return view('Backend.Admin.auth.passwords.reset',compact('token'));
		}
		else{

			return "It seems the link is invalid or expired.";
		}

		
	}

	// resetting password process
	public function postReset(PasswordResetRequest $request)
	{
		$email = $request->email;

		$new_password = Hash::make($request->password);

		$find_admin = Admin::whereemail($email)->firstOrFail();

		$find_admin->password = $new_password;

		$find_admin->save();

	}

}
