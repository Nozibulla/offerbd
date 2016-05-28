@extends('Backend.Adprovider.layouts.master')

@section('title')

<title>Pending Advertisement | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Adprovider.layouts.sidebar')

@stop

@section('content')

<div id="page-wrapper" class="pending_advertisements">

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">
				List of all <strong>Pending</strong> Advertisements
			</h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive advertisements_table">

		@if (count($pending_advertisements)>0)

		<table class="table offerbd_table">
			<caption>Available Pending Advertisements</caption>
			<thead>
				<tr>
					<th>SL#</th>
					<th>Name</th>
					<th>Status</th>
					<th>Upload time</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($pending_advertisements as $key => $advertisement)

					<tr>
						<td>{{ $key+1 }}</td>
						<td>
							<a href="/adprovider/advertisements/details/{{$advertisement->id}}" title="click to see the detail page" target="_blank">
								<img src="{{ asset($advertisement->ad_image) }}" alt="adno{{$advertisement->id}}">
							</a>
						</td>
					
						<td>{{ ($advertisement->status == 0) ? "pending" : "Approved" }}</td>
						<td>{{ $advertisement->created_at }}</td>
					</tr>
				@endforeach

			</tbody>
		</table>

		@else

		<strong>No pending advertisement available</strong>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
