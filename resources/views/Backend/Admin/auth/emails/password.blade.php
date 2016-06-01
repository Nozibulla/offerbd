<!-- custom reset_email from PasswordController->postEmail() -->

Click here to reset your password:

<a href="{{ $link = url('/admin/password/reset', $profile_info->token).'?email='.urlencode($profile_info->reset_email) }}">

	{{ $link }}

</a>
<br>
<strong>This link will expire after one hour</strong>
