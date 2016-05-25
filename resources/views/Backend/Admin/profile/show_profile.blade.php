@extends('Backend.Admin.layouts.master')

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper">

	<div class="row">

		<div class="col-lg-12">

			<h1 class="page-header">Profile of {{ Auth::guard('admin')->user()->email }}</h1>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="profile">

		<div class="profile_left">

			<div class="profile_com profile_first_name">First Name:

				<a href="#" id="first_name" data-pk={{Auth::guard('admin')->user()->id }}>{{ ($profile_info->first_name) ? $profile_info->first_name : "Set First Name" }}
				</a>

			</div>

			<div class="profile_com profile_last_name">Last Name:

				<a href="#" id="last_name" data-pk={{Auth::guard('admin')->user()->id }}>{{ ($profile_info->last_name) ? $profile_info->last_name : "Set Last Name" }}
				</a>
				
			</div>

			<div class="profile_com profile_mobile">Mobile:

				<a href="#" id="mobile" data-pk={{Auth::guard('admin')->user()->id }}>{{ ($profile_info->mobile) ? $profile_info->mobile : "Set Mobile Number" }}
				</a>

			</div>

			<div class="profile_com profile_address">Address:

				<a href="#" id="address" data-pk={{Auth::guard('admin')->user()->id }}>{{ ($profile_info->address) ? $profile_info->address : "Set Address" }}
				</a>

			</div>

		</div>

		<div class="profile_right">

			<div class="profile_image">

				@if($profile_info->image)

				<img src="{{ asset('images/avatar.jpg') }}" alt="image">

				@else

				<img src="{{ asset('images/avatar.jpg') }}" alt="image">

				@endif

				{!! Form::open(['method' => 'POST']) !!}

				<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
					{!! Form::label('image', 'Select One') !!}
					{!! Form::file('image', ['required' => 'required']) !!}
					<small class="text-danger">{{ $errors->first('image') }}</small>
				</div>
				
				<div class="btn-group pull-right">
				{!! Form::submit("Update", ['class' => 'btn btn-primary']) !!}
				</div>
				
				{!! Form::close() !!}
			</div>
		</div>

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
