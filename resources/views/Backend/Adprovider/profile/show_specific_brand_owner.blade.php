@extends('Backend.Admin.layouts.master')

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper">

	<div class="row">

		<div class="col-lg-12">

			<h1 class="page-header">
				Profile of {{ $member_profile->first_name." ".$member_profile->last_name }}
			</h1>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="profile">

		<div class="profile_left">

			<div class="profile_com profile_first_name">First Name:

				{{ $member_profile->first_name }}

			</div>

			<div class="profile_com profile_last_name">Last Name:

				{{ $member_profile->last_name }}
				
			</div>

			<div class="profile_com profile_mobile">Mobile:

				{{ $member_profile->mobile }}

			</div>

			<div class="profile_com profile_address">Address:

				{{ $member_profile->address }}

			</div>

		</div>

		<div class="profile_right">

			<div class="profile_image">

				@if($member_profile->image)

				<img src="{{ asset('images/avatar.jpg') }}" alt="image">

				@else

				<img src="{{ asset('images/avatar.jpg') }}" alt="image">

				@endif

			</div>
		</div>

	</div>

	{{-- checking the current user is an owner or not --}}
	@if (auth()->guard('admin')->user()->hasRole('owner'))

	<div class="row">
		<div class="col-md-12">
			<div class="pull-left">
				{!! Form::button('Delete Member', ['class' => 'btn btn-primary']) !!}
			</div>
		</div>
	</div>

	@endif

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
