@extends('Backend.Admin.layouts.app')

@section('title')

<title>Reset Password | offerbd</title>

@stop

@section('content')

<div id="container" class="password_reset_email">

	<!-- successful registration message -->
	<div class="alert alert-success send_email_div" style="display:none">
		<strong class="se_successful"></strong>
	</div>
	<!-- end of message -->

	<div class="sendEmailForm">

		{!! Form::open(['method' => 'POST', 'url' => '/admin/password/email' , 'name'=> 'sendEmailForm', 'data-remote' => 'data-remote', 'data-remote-success' => 'Email sent successfully']) !!}

		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

			{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'required' => 'required']) !!}
			<small class="text-danger req_email">{{ $errors->first('email') }}</small>

		</div>

		<div id="lower">

			{!! Form::submit('Send Link', ['class' => 'btn btn-info pull-right']) !!}

		</div>

		{!! Form::close() !!}

	</div>

</div>

@endsection