@extends('Backend.Adprovider.layouts.master')

@section('title')

<title>Advertisement Detail | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Adprovider.layouts.sidebar')

@stop

@section('content')

<div id="page-wrapper" class="advertisement_detail">

	<div class="single_advertisement">

		<div class="advertisement_detail_div">

			<div class="row">

				<div class="col-lg-12">

					<h3 class="page-header">
						Advertisement ID : {{ $advertisement_info->id }}
						<small>{{ ($advertisement_info->status ==0)? "Pending" : "Approved" }}</small>
					</h3>

				</div>

				<!-- /.col-lg-12 -->

			</div>
			<!-- /.row -->

			<div class="row">
				<div class="col-md-6">
					Advertisement: <br> 
					<img src="{{ asset($advertisement_info->ad_image) }}" alt="adno{{$advertisement_info->id}}" height="300px" width="280px">
					<br><br>
					<div class="ad_brand_name">
						Brand Name: <strong>{{ $advertisement_info->brand->brand_name}}</strong>
					</div>
					<div class="ad_branch_name">
						Branch Name: <strong>{{ $advertisement_info->branch->branch_name}}</strong>
					</div>
					<div class="ad_product_name">
						Product Name: <strong>{{ $advertisement_info->product->product_name}}</strong>
					</div>
					<div class="ad_category_name">
						Category Name: <strong>{{ $advertisement_info->product->category->category_name}}</strong>
					</div>
					
				</div>
				<div class="col-md-6">
					@define $advertisement_owner = $advertisement_info->profile
					<strong>Advertisement Owner</strong>
					<div class="owner_name">
						Owner Name: 
						{{ $advertisement_owner->first_name." ".$advertisement_owner->last_name }}
					</div>
					<div class="owner_mobile">
						Owner Mobile:
						{{ ($advertisement_owner->mobile) ? $advertisement_owner->mobile : "Not Set" }}
					</div>
					<address>
						<div class="owner_address">Owner Address:

							{{ ($advertisement_owner->address) ? $advertisement_owner->address : "Not Set" }}

						</div>
					</address>
				</div>
			</div>
			<br>
			<div class="row advertisement_option">
				<div class="col-md-12">
					<div class="pull-left advertisement_edit_delete">

						@if ($advertisement_info->status == 0)

						<input type="button" class="btn btn-default approve_advertisement" name="approve_advertisement" value="Approve Advertisement" data-toggle="modal" data-target="#approveAdvertisementModal">
						@include ('Backend.modals.approve_advertisement_modal')

						@endif

						<input type="button" class="btn btn-default delete_approved_advertisement" name="remove_advertisement" value="Delete Advertisement" data-toggle="modal" data-target="#removeAdvertisementModal">
						@include ('Backend.modals.remove_advertisement_modal')

						<input type="button" class="btn btn-default" name="edit_advertisement" value="Edit Advertisement" data-toggle="modal" data-target="#editAdvertisementModal">
						@include ('Backend.modals.edit_advertisement_modal')

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
