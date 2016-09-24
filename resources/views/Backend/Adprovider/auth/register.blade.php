@extends('Backend.Adprovider.layouts.app')

@section('title')

<title>Registration | offerbd</title>

@stop

@section('content')

<div id="container" class="adprovider_registration">

 <!-- successful registration message -->
 <div class="alert alert-success rs_div" style="display:none">
   <strong class="reg_successful"></strong>
</div>
<!-- end of message -->

<div class="registrationForm">

    {!! Form::open(['method' => 'POST', 'url' => '/adprovider/registration' , 'name'=> 'registrationForm', 'data-remote' => 'data-remote', 'data-remote-success' => 'Please confirm your mail to complete the registration.']) !!}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
       {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter Email']) !!}
       <small class="text-danger req_email">{{ $errors->first('email') }}</small>
   </div>

   <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
       {!! Form::password('password', ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Password']) !!}
       <small class="text-danger req_password">{{ $errors->first('password') }}</small>
   </div>

   <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
    {!! Form::password('confirm_password', ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Confirm Password']) !!}
    <small class="text-danger req_confirm_password">{{ $errors->first('confirm_password') }}</small>
</div>

<div id="lower">
    {!! Form::submit('Sign Up', ['class' => 'btn btn-info pull-right']) !!}
</div>

{!! Form::close() !!}

</div>

<p class="registration"><a href="{{ url('/adprovider/login') }}">Login</a></p>

</div>

@endsection