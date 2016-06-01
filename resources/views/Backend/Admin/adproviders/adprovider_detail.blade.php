@extends('Backend.Admin.layouts.master')

@section('title')

<title>{{ $profile_info->first_name }}'s profile | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper">

	<div class="row">

		<div class="col-lg-12">

			<h1 class="page-header">
				Profile of <strong>{{ $profile_info->first_name." ".$profile_info->last_name }}</strong>
			</h1>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	@define $membership_info = $profile_info->membership;

	<div class="row profile">

		<div class="col-md-8 profile_left">

			<div class="membership_info">
				<div class="plan_name">
					Membership plan: {{ $membership_info->plan_name }}
				</div>
				<div class="adv_range">
					Advertisement range: {{ $membership_info->adv_range }} adv./month
				</div>
				<div class="amount">
					Amount: {{ $membership_info->amount }} BDT/month
				</div>	
			</div>
			<hr>
			<div class="profile_com profile_first_name">First Name:

				{{ $profile_info->first_name }}

			</div>

			<div class="profile_com profile_last_name">Last Name:

				{{ $profile_info->last_name }}
				
			</div>

			<div class="profile_com profile_mobile">Mobile:

				{{ $profile_info->mobile }}

			</div>

			<div class="profile_com profile_address">Address:

				{{ $profile_info->address }}

			</div>

		</div>

		<div class="col-md-4 profile_right">

			<div class="profile_image">

				@if($profile_info->image)

				<img src="{{ asset($profile_info->image) }}" alt="{{ $profile_info->first_name }}" height="150px" width="150px">

				@else

				<img src="{{ asset('images/avatar.jpg') }}" alt="image" height="150px" width="150px">

				@endif

			</div>
		</div>

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
