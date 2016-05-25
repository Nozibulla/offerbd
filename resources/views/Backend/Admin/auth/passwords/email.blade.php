@extends('Backend.Admin.layouts.app')

@section('content')

<div id="container">

 @if ($errors->has('msg'))

 <div class="alert alert-danger">

     <strong>{{ $errors->first('msg') }}</strong>

 </div>

 @endif

 @if (session('status'))

 <div class="alert alert-success">

    {{ session('status') }}

</div>

@endif

{!! Form::open(['method' => 'POST', 'url' => '/admin/password/email' , 'name'=> 'password-reset']) !!}

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email']) !!}

    @if ($errors->has('email'))

    <span class="help-block">

        <strong>{{ $errors->first('email') }}</strong>

    </span>

    @endif

</div>

<div id="lower">

    {!! Form::submit('Send Password Reset Link', ['class' => 'btn btn-info pull-right']) !!}

</div>

{!! Form::close() !!}

</div>

@endsection