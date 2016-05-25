@extends('Backend.Admin.layouts.master')

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="pending_branch">

	@include ('Backend.modals.approve_branch_modal')

	@include ('Backend.modals.remove_branch_modal')

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
					<th>Approved</th>
					<th>Delete</th>
					<th>Owner</th>
				</tr>
			</thead>
			<tbody>

				<?php foreach ($pending_branchs as $key => $branch): ?>

					<tr>
						<td>{{ $key+1 }}</td>
						<td>
							<a href="/admin/branch/details/{{$branch->id}}" title="click to see the detail page" target="_blank">{{ $branch->branch_name }}</a>
						</td>
						<td class="approve_branch">
							<a href="#" title="click to approve" id="{{$branch->id}}">
								<i class="glyphicon glyphicon-ok"></i>
							</a>
						</td>
						<td class="remove_branch">
							<a href="#" title="click to delete" id="{{$branch->id}}">
								<i class="glyphicon glyphicon-remove"></i>
							</a>						
						</td>
						<td>
							<a href="/profile/members/{{ $branch->profile->id }}">
								{{ $branch->profile->first_name." ". $branch->profile->last_name}}
							</a>
						</td>
					</tr>
				<?php endforeach ?>

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