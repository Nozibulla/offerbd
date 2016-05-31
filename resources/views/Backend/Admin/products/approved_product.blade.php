@extends('Backend.Admin.layouts.master')

@section('title')

<title>Approved Product | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="approved_products">

	@include ('Backend.modals.remove_product_modal')

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">
				List of all <strong>Approved</strong> Products
			</h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive products_table">

		@if (count($approved_products)>0)

		<table class="table offerbd_table">
			<caption>Available Approved Products</caption>
			<thead>
				<tr>
					<th>SL#</th>
					<th>Name</th>
					<th>Delete</th>
					<th>Owner</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($approved_products as $key => $product)

				<tr>
					<td>{{ $key+1 }}</td>
					<td>
						<a href="/admin/products/details/{{ $product->id }}" title="click to see the detail page" target="_blank">{{ $product->product_name }}</a>
					</td>
					<td class="remove_product">
						<a href="#" title="click to delete" id="{{ $product->id }}">
							<i class="glyphicon glyphicon-remove"></i>
						</a>						
					</td>
					<td>
						<!-- checking whether this is your addition or not -->
						@if (is_null($product->profile->admin_id) && ($product->profile->admin_id != auth()->guard('admin')->user()->id))
						<a href="/profile/members/{{ $product->profile->id }}">
							{{ $product->profile->first_name." ".$product->profile->last_name }}
						</a>
						@else

						<!-- printing my name -->
						{{ $product->profile->first_name." ".$product->profile->last_name  }} (you)
						@endif
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>

		{!! $approved_products->links() !!}

		@else

		<strong>No approved product available</strong>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
