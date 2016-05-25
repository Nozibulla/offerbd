@extends('Backend.Admin.layouts.master')

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="product_detail">

	<div class="single_product">

		<div class="row">

			<div class="col-lg-12">

				<h3 class="page-header">
					Product Name : {{ $product_info->product_name }}
					<small>{{ ($product_info->status == 0)? "Pending" : "Approved" }}</small>
				</h3>

			</div>

			<!-- /.col-lg-12 -->

		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-md-6">Product Name: {{ $product_info->product_name }}</div>
			<div class="col-md-6">
				<?php $product_owner = $product_info->profile ?>
				<strong>Product Owner</strong>
				<div class="owner_name">Owner Name: 
					{{ $product_owner->first_name." ".$product_owner->last_name }}
				</div>
				<div class="owner_mobile">Owner Mobile:
					{{ $product_owner->mobile }}
				</div>
				<div class="owner_address">Owner Address:

					<address>
						{{ $product_owner->address }}
					</address>
				</div>
			</div>
		</div>

		<div class="row product_option">
			<div class="col-md-12">
				<div class="pull-left product_edit_delete">

					@if ($product_info->status == 0)

					<input type="button" class="btn btn-primary approve_product" name="approve_product" value="Approve Product" data-toggle="modal" data-target="#approveProductModal">
					@include ('Backend.modals.approve_product_modal')

					@endif

					<input type="button" class="btn btn-primary delete_approved_product" name="remove_product" value="Delete Product" data-toggle="modal" data-target="#removeProductModal">
					@include ('Backend.modals.remove_product_modal')

					<input type="button" class="btn btn-primary" name="edit_product" value="Edit Product" data-toggle="modal" data-target="#editProductModal">
					@include ('Backend.modals.edit_product_modal')

				</div>

			</div>
		</div>

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
