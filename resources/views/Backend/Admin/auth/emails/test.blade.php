Dear Sakil;

Please click the following link to reset your password.

<!-- random $token variable comes from the PasswordController->postMail function -->

<a href="{{ url('/admin/password/reset/'.$token) }}">Reset link</a>