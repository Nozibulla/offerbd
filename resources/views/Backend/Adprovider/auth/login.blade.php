@extends('Backend.Adprovider.layouts.app')

@section('content')

<div id="container">

   @if ($errors->has('msg'))

   <div class="alert alert-danger"><strong>{{ $errors->first('msg') }}</strong></div>

   @endif

   {!! Form::open(['method' => 'POST', 'url' => '/adprovider/login' , 'name'=> 'login']) !!}

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

<p><a href="#">Forgot your password?</a>

    <div id="lower">

        <input type="checkbox" name="remember">

        <label class="check" for="remember">Keep me logged in</label>

        <!-- <i class="fa fa-btn fa-sign-in"></i> -->

        {!! Form::submit('Sign In', ['class' => 'btn btn-info pull-right']) !!}

    </div>

    {!! Form::close() !!}

    <p class="registration">

        <a href="/adprovider/registration">Registration</a>

    </p>

</div>

@endsection
