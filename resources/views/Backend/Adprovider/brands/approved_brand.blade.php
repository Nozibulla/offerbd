@extends('Backend.Adprovider.layouts.master')

@section('title')

<title>Approved Brand | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Adprovider.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="approved_brands">

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
					<th>Status</th>
					<th>Upload time</th>
				</tr>
			</thead>
			<tbody>

				<?php foreach ($approved_brands as $key => $brand): ?>

					<tr>
						<td>{{ $key+1 }}</td>
						<td>
							<a href="{{ url('/adprovider/brands/details', $brand->id) }}" title="click to see the detail page" target="_blank">{{ $brand->brand_name }}</a>
						</td>
						<td>{{ ($brand->status == 0) ? "pending" : "Approved" }}</td>
						<td>{{ $brand->created_at }}</td>						
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
