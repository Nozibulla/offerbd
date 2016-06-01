@extends('Backend.Adprovider.layouts.app')

@section('title')

<title>Login | offerbd</title>

@stop

@section('content')

<div id="container" class="adprovider_login">

 <!-- displaying the credentials doesn't match error -->
 <div class="alert alert-danger error_div" style="display:none">
     <strong class="match_error"></strong>
 </div>
 <!-- successful login message -->
 <div class="alert alert-success ls_div" style="display:none">
     <strong class="login_successful"></strong>
 </div>

 <div class="loginForm">

 {!! Form::open(['method' => 'POST', 'url' => '/adprovider/login' , 'name'=> 'loginForm', 'data-remote' => 'data-remote', 'data-remote-success' => 'Successfully logged in']) !!}

   <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
       {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter Email']) !!}
       <small class="text-danger req_email">{{ $errors->first('email') }}</small>
   </div>

   <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
       {!! Form::password('password', ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Password']) !!}
       <small class="text-danger req_password">{{ $errors->first('password') }}</small>
   </div>

   <p><a href="/adprovider/password/email">Forgot your password?</a></p>

   <div id="lower">

       <input type="checkbox" name="remember"/>

       <label class="check">Keep me logged in</label>

       {!! Form::submit('Sign In', ['class' => 'btn btn-info pull-right']) !!}

   </div>

   {!! Form::close() !!}

</div>

<p class="registration"><a href="/adprovider/registration">Registration</a></p>

</div>

@endsection
