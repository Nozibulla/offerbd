<!-- custom reset_email from PasswordController->postEmail() -->

Click here to reset your password:

<a href="{{ $link = url('/adprovider/password/reset', array($profile_info->token,urlencode($profile_info->reset_email))) }}">

	{{ $link }}

</a>
<br>
<strong>This link will expire after one hour</strong>
