@extends('Backend.Admin.layouts.master')

@section('title')

<title>Category Detail | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="category_detail">

	<div class="single_category">

		<div class="row">

			<div class="col-lg-12">

				<h3 class="page-header">
					Category Name : {{ $category_info->category_name }}
					<small>{{ ($category_info->status == 0)? "Pending" : "Approved" }}</small>
				</h3>

			</div>

			<!-- /.col-lg-12 -->

		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-md-6">Category Name: {{ $category_info->category_name }}</div>
			<div class="col-md-6">
				@define $brand_owner = $category_info->profile
				<strong>Brand Owner</strong>
				<div class="owner_name">Owner Name: 
					{{ $brand_owner->first_name." ".$brand_owner->last_name }}
				</div>
				<div class="owner_mobile">Owner Mobile:
					{{ $brand_owner->mobile }}
				</div>
				<div class="owner_address">Owner Address:

					<address>
						{{ $brand_owner->address }}
					</address>
				</div>
			</div>
		</div>

		<div class="row category_option">
			<div class="col-md-12">
				<div class="pull-left category_edit_delete">

					@if ($category_info->status == 0)

					<!-- checking whether this is your addition or not -->
					@if (is_null($category_info->profile->admin_id) && ($category_info->profile->admin_id != auth()->guard('admin')->user()->id))

					<input type="button" class="btn btn-default approve_category" name="approve_category" value="Approve Category" data-toggle="modal" data-target="#approveCategoryModal">
					@include ('Backend.modals.approve_category_modal')

					@endif
					
					@endif

					<input type="button" class="btn btn-default delete_approved_category" name="remove_category" value="Delete Category" data-toggle="modal" data-target="#removeCategoryModal">
					@include ('Backend.modals.remove_category_modal')

					<input type="button" class="btn btn-default" name="edit_category" value="Edit Category" data-toggle="modal" data-target="#editCategoryModal">
					@include ('Backend.modals.edit_category_modal')

				</div>

			</div>
		</div>

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
