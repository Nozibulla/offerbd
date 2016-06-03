@extends('Backend.Admin.layouts.master')

@section('title')

<title>Approved Advertisement | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="approved_advertisements">

	@include ('Backend.modals.remove_advertisement_modal')

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">
				List of all <strong>Approved</strong> Advertisements
			</h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive advertisements_table">

		@if (count($approved_advertisements)>0)

		<table class="table offerbd_table">
			<caption>Available Approved Advertisements</caption>
			<thead>
				<tr>
					<th>SL#</th>
					<th>Ad. Image</th>
					<th>Delete</th>
					<th>Owner</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($approved_advertisements as $key => $advertisement)

				<tr>
					<td>{{ $key+1 }}</td>
					<td>
						<a href="{{ url('/admin/advertisements/details/$advertisement->id') }}" title="click to see the detail page" target="_blank">
							<img src="{{ asset($advertisement->ad_image) }}" alt="adno{{$advertisement->id}}">
						</a>
					</td>
					<td class="remove_advertisement">
						<a href="#" title="click to delete" id="{{$advertisement->id}}">
							<i class="glyphicon glyphicon-remove"></i>
						</a>						
					</td>
					<td>
						<!-- checking whether this is your addition or not -->
						@if (is_null($advertisement->profile->admin_id) && ($advertisement->profile->admin_id != auth()->guard('admin')->user()->id))
						<a href="/profile/members/{{ $advertisement->profile->id }}">
							{{ $advertisement->profile->first_name." ".$advertisement->profile->last_name }}
						</a>
						@else

						<!-- printing my name -->
						{{ $advertisement->profile->first_name." ".$advertisement->profile->last_name  }} (you)
						@endif
					</td>						
				</tr>
				@endforeach

			</tbody>
		</table>
		@else

		<strong>No approved Advertisement is available yet</strong>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
