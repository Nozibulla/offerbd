@extends('Backend.Admin.layouts.master')

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="approved_brands">

	@include ('Backend.modals.remove_brand_modal')

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">
				List of all <strong>Approved</strong> Brands
			</h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive brands_table">

		@if (count($approved_brands)>0)

		<table class="table offerbd_table">
			<caption>Available Brands</caption>
			<thead>
				<tr>
					<th>SL#</th>
					<th>Name</th>
					<th>Delete</th>
					<th>Owner</th>
				</tr>
			</thead>
			<tbody>

				<?php foreach ($approved_brands as $key => $brand): ?>

					<tr>
						<td>{{ $key+1 }}</td>
						<td>
							<a href="/admin/brands/details/{{$brand->id}}" title="click to see the detail page" target="_blank">{{ $brand->brand_name }}</a>
						</td>
						<td class="remove_brand">
							<a href="#" title="click to delete" id="{{$brand->id}}">
								<i class="glyphicon glyphicon-remove"></i>
							</a>						
						</td>
						<td>
						<a href="/profile/members/{{ $brand->profile->id }}">
								{{ $brand->profile->first_name." ".$brand->profile->last_name }}
							</a>
						</td>						
					</tr>
				<?php endforeach ?>

			</tbody>
		</table>
		@else

		<strong>No approved Brand is available yet</strong>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
