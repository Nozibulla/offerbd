@extends('Backend.Adprovider.layouts.app')

@section('content')

<div id="container">

 @if ($errors->has('msg'))

 <div class="alert alert-danger"><strong>{{ $errors->first('msg') }}</strong></div>

 @endif

 {!! Form::open(['method' => 'POST', 'url' => '/adprovider/registration' , 'name'=> 'registration']) !!}

 <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email']) !!}

    @if ($errors->has('email'))

    <span class="help-block">

        <strong>{{ $errors->first('email') }}</strong>

    </span>

    @endif

</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password','required']) !!}

    @if ($errors->has('password'))

    <span class="help-block">

        <strong>{{ $errors->first('password') }}</strong>

    </span>

    @endif

</div>

<div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">

    {!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Confirm Password','required']) !!}

    @if ($errors->has('confirm_password'))

    <span class="help-block">

        <strong>{{ $errors->first('confirm_password') }}</strong>

    </span>

    @endif

</div>

<div id="lower">

    {!! Form::submit('Sign Up', ['class' => 'btn btn-info pull-right','ng-disabled'=>'registration.$invalid']) !!}

</div>

{!! Form::close() !!}

<p class="registration">

    <a href="/adprovider/login">Login</a>

</p>

</div>

@endsection
