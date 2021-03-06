@extends('Backend.Admin.layouts.master')

@section('title')

<title>Pending Category | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="pending_category">

	@include ('Backend.modals.approve_category_modal')

	@include ('Backend.modals.remove_category_modal')

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">
				List of all <strong>Pending</strong> Categories
			</h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive category_table">

		@if (count($pending_category)>0)

		<table class="table offerbd_table">
			<caption>Available Pending Categories</caption>
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

				@foreach ($pending_category as $key => $category)

				<tr>
					<td>{{ $key+1 }}</td>
					<td>
						<a href="{{ url('/admin/category/details', $category->id) }}" title="click to see the detail page" target="_blank">{{ $category->category_name }}</a>
					</td>

					@if(is_null($category->profile->admin_id))

					<td class="approve_category">
						<a href="{{ url('#)') }} " title="click to approve" id="{{$category->id}}">
							<i class="glyphicon glyphicon-ok"></i>
						</a>
					</td>

					@else

					<td>---</td>

					@endif
					
					<td class="remove_category">
						<a href="{{ url('#)') }} " title="click to delete" id="{{$category->id}}">
							<i class="glyphicon glyphicon-remove"></i>
						</a>						
					</td>
					<td>
						<!-- checking whether this is your addition or not -->
						@if (is_null($category->profile->admin_id) && ($category->profile->admin_id != auth()->guard('admin')->user()->id))
						<a href="{{ url('/profile/members', $category->profile->id) }}">
							{{ $category->profile->first_name." ".$category->profile->last_name }}
						</a>
						@else

						<!-- printing my name -->
						{{ $category->profile->first_name." ".$category->profile->last_name  }} (you)
						@endif
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>

		{!! $pending_category->links() !!}

		@else

		<strong>No pending category available</strong>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
