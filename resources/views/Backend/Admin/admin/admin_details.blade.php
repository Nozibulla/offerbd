@extends('Backend.Admin.layouts.master')

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="admin_detail">

	<div class="single_admin">

		<div class="row">

			<div class="col-lg-12">

				<h3 class="page-header">
					Details of <strong>{{ (!empty($profile->first_name) || !empty($profile->last_name)) ? $profile->first_name." ".$profile->last_name : "Mr. X" }}</strong>
				</h3>

			</div>

			<!-- /.col-lg-12 -->

		</div>
		<!-- /.row -->

		<div class="profile">

			<div class="profile_left">

				<div class="profile_com profile_first_name">First Name:

					<strong>{{ (!empty($profile->first_name)) ? $profile->first_name : "Not Set" }}</strong>

				</div>

				<div class="profile_com profile_last_name">Last Name:

					<strong>{{ (!empty($profile->last_name)) ? $profile->last_name : "Not Set" }}</strong>
					
				</div>

				<div class="profile_com profile_mobile">Mobile:

					<strong>{{ (!empty($profile->mobile)) ? $profile->mobile : "Not Set" }}</strong>

				</div>

				<div class="profile_com profile_address">Address:

					<strong>{{ (!empty($profile->address)) ? $profile->address : "Not Set" }}</strong>

				</div>

			</div>

			<div class="profile_right">

				<div class="profile_image">

					@if($profile->image)

					<img src="{{ asset('images/avatar.jpg') }}" alt="image">

					@else

					<img src="{{ asset('images/avatar.jpg') }}" alt="image">

					@endif

				</div>
			</div>

		</div>

		{{-- checking the current user is an owner or not & the viewing profile has the owner privilege or not--}}
		@if ((auth()->guard('admin')->user()->hasRole('owner')) && (!$profile->admin->hasRole('owner')))

		<div class="row">
			<div class="col-md-12">
				<div class="pull-left">
					{!! Form::button('Delete Member', ['class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#removeAdminModal']) !!}
					@include ('Backend.modals.remove_admin_modal')

				</div>
			</div>
		</div>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
