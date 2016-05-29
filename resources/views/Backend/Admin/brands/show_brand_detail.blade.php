@extends('Backend.Admin.layouts.master')

@section('title')

<title>Brand Detail | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="brand_detail">

	<div class="single_brand">

		<div class="brand_detail_div">

			<div class="row">

				<div class="col-lg-12">

					<h3 class="page-header">

						Brand Name : {{ $brand_info->brand_name }}

						<small>{{ ($brand_info->status == 0)? "Pending" : "Approved" }}</small>

					</h3>

				</div>

				<!-- /.col-lg-12 -->

			</div>
			<!-- /.row -->

			<div class="row">

				<div class="col-md-6">
					Brand Name: {{ $brand_info->brand_name }}
				</div>

				<div class="col-md-6">
					@define $brand_owner = $brand_info->profile
					<strong>Brand Owner</strong>
					<div class="owner_name">
						Owner Name: 
						{{ $brand_owner->first_name." ".$brand_owner->last_name }}
					</div>
					<div class="owner_mobile">
						Owner Mobile:
						{{ $brand_owner->mobile }}
					</div>
					<div class="owner_address">Owner Address:

						<address>{{ $brand_owner->address }}</address>

					</div>
				</div>
			</div>

			<div class="row brand_option">
				<div class="col-md-12">
					<div class="pull-left brand_edit_delete">

						@if ($brand_info->status == 0)
						
						<!-- checking whether this is your addition or not -->
						@if (is_null($brand_info->profile->admin_id) && ($brand_info->profile->admin_id != auth()->guard('admin')->user()->id))

						<input type="button" class="btn btn-default approve_brand" name="approve_brand" value="Approve Brand" data-toggle="modal" data-target="#approveBrandModal">
						@include ('Backend.modals.approve_brand_modal')

						@endif

						@endif

						<input type="button" class="btn btn-default delete_approved_brand" name="remove_brand" value="Delete Brand" data-toggle="modal" data-target="#removeBrandModal">
						@include ('Backend.modals.remove_brand_modal')

						<input type="button" class="btn btn-default" name="edit_brand" value="Edit Brand" data-toggle="modal" data-target="#editBrandModal">
						@include ('Backend.modals.edit_brand_modal')

					</div>

				</div>
			</div>

		</div>

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
