@extends('Backend.Adprovider.layouts.master')

@section('title')

<title>Pending Product | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Adprovider.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="pending_products">

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">
				List of all <strong>Pending</strong> Products
			</h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive products_table">

		@if (count($pending_products)>0)

		<table class="table offerbd_table">
			<caption>Available Pending Products</caption>
			<thead>
				<tr>
					<th>SL#</th>
					<th>Name</th>
					<th>Status</th>
					<th>Uploaded Time</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($pending_products as $key => $product)

				<tr>
					<td>{{ $key+1 }}</td>
					<td>
						<a href="/adprovider/products/details/{{ $product->id }}" title="click to see the detail page" target="_blank">{{ $product->product_name }}</a>
					</td>
					<td> {{ ($product->status == 0) ? "Pending" : "Approved" }} </td>

					<td> {{ $product->created_at }} </td>
				</tr>
				@endforeach

			</tbody>
		</table>

		@else

		<strong>No pending product available</strong>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
