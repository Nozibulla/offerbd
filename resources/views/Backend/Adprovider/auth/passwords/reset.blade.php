@extends('Backend.Adprovider.layouts.app')

@section('title')

<title>Reset Password | offerbd</title>

@stop

@section('content')

<div class="adprovider_password_reset" id="container">

   <!-- successful registration message -->
   <div class="alert alert-success password_reset_successful_div" style="display:none">
       <strong class="pr_successful"></strong>
   </div>
   <!-- end of message -->

   <div class="passwordResetForm">

    {!! Form::open(['method' => 'POST', 'url' => '/adprovider/password/reset' , 'name'=> 'passwordResetForm', 'data-remote' => 'data-remote', 'data-remote-success' => 'Password Reset Successful']) !!}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
     {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter Email']) !!}
     <small class="text-danger req_email">{{ $errors->first('email') }}</small>
 </div>

 <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
   {!! Form::password('password', ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'New Password']) !!}
   <small class="text-danger req_password">{{ $errors->first('password') }}</small>
</div>

<div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
   {!! Form::password('confirm_password', ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Confirm New Password']) !!}
   <small class="text-danger req_confirm_password">{{ $errors->first('confirm_password') }}</small>
</div>

<div id="lower">
    {!! Form::submit('Reset', ['class' => 'btn btn-info pull-right']) !!}
</div>

{!! Form::close() !!}

</div>

</div>

@endsection