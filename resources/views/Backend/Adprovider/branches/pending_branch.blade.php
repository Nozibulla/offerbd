@extends('Backend.Adprovider.layouts.master')

@section('title')

<title>Pending Branch | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Adprovider.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="pending_branch">

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">
				List of all <strong>Pending</strong> Branches
			</h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive branch_table">

		@if (count($pending_branchs)>0)

		<table class="table offerbd_table">
			<caption>Available Pending Branchs</caption>
			<thead>
				<tr>
					<th>SL#</th>
					<th>Name</th>
					<th>Status</th>
					<th>Upload time</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($pending_branchs as $key => $branch)

					<tr>
						<td>{{ $key+1 }}</td>
						<td>
							<a href="/adprovider/branch/details/{{$branch->id}}" title="click to see the detail page" target="_blank">{{ $branch->branch_name }}</a>
						</td>
					
						<td>{{ ($branch->status == 0) ? "pending" : "Approved" }}</td>
						<td>{{ $branch->created_at }}</td>
					</tr>
				@endforeach

			</tbody>
		</table>

		@else

		<strong>No pending branch available</strong>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
