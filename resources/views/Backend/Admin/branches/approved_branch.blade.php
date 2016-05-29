@extends('Backend.Admin.layouts.master')

@section('title')

<title>Approved Branch | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="approved_branch">

	@include ('Backend.modals.remove_branch_modal')

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">
				List of all <strong>Approved</strong> Branches
			</h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive branch_table">

		@if (count($approved_branchs)>0)

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

				@foreach ($approved_branchs as $key => $branch)

				<tr>
					<td>{{ $key+1 }}</td>
					<td>
						<a href="/admin/branch/details/{{$branch->id}}" title="click to see the detail page" target="_blank">{{ $branch->branch_name }}</a>
					</td>
					<td class="remove_branch">
						<a href="#" title="click to delete" id="{{$branch->id}}">
							<i class="glyphicon glyphicon-remove"></i>
						</a>						
					</td>
					<td>
						<!-- checking whether this is your addition or not -->
						@if (is_null($branch->profile->admin_id) && ($branch->profile->admin_id != auth()->guard('admin')->user()->id))
						<a href="/profile/members/{{ $branch->profile->id }}">
							{{ $branch->profile->first_name." ". $branch->profile->last_name}}
						</a>

						@else

						<!-- printing my name -->
						{{ $branch->profile->first_name." ".$branch->profile->last_name  }} (you)
						@endif
					</td>						
				</tr>

				@endforeach

			</tbody>
		</table>
		@else

		<strong>No approved Branch is available yet</strong>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
