@extends('Backend.Admin.layouts.master')

@section('title')

<title>Pending Brand | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="pending_brands">

	@include ('Backend.modals.approve_brand_modal')

	@include ('Backend.modals.remove_brand_modal')

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">
				List of all <strong>Pending</strong> Brands
			</h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive brands_table">

		@if (count($pending_brands)>0)

		<table class="table offerbd_table">
			<caption>Available Pending Brands</caption>
			<thead>
				<tr>
					<th>SL#</th>
					<th>Name</th>
					<th>Approved</th>
					<th>Delete</th>
					<th>Owner</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($pending_brands as $key => $brand)

				<tr>
					<td>{{ $key+1 }}</td>
					<td>
						<a href="/admin/brands/details/{{$brand->id}}" title="click to see the detail page" target="_blank">{{ $brand->brand_name }}</a>
					</td>

					@if(is_null($brand->profile->admin_id))

					<td class="approve_brand">
						<a href="#" title="click to approve" id="{{$brand->id}}">
							<i class="glyphicon glyphicon-ok"></i>
						</a>
					</td>

					@else

					<td>---</td>

					@endif

					<td class="remove_brand">
						<a href="#" title="click to delete" id="{{$brand->id}}">
							<i class="glyphicon glyphicon-remove"></i>
						</a>						
					</td>
					<td>

						<!-- checking whether this is your addition or not -->
						@if (is_null($brand->profile->admin_id) && ($brand->profile->admin_id != auth()->guard('admin')->user()->id))
						<a href="/profile/members/{{ $brand->profile->id }}">
							{{ $brand->profile->first_name." ".$brand->profile->last_name }}
						</a>
						@else

						<!-- printing my name -->
						{{ $brand->profile->first_name." ".$brand->profile->last_name  }} (you)
						@endif
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>

		@else

		<strong>No pending brand available</strong>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
