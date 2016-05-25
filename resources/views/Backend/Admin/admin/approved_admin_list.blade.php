@extends('Backend.Admin.layouts.master')

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="approved_admin_list">

	@include ('Backend.modals.remove_admin_modal')

	@include ('Backend.modals.change_admin_privilege_modal')

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">
				List of all <strong>Approved</strong> Admins
			</h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive admin_list_table">

		@if (count($approved_admin)>0)

		<table class="table offerbd_table">
			<caption>Available admins of all privilege</caption>
			<thead>
				<tr>
					<th>SL#</th>
					<th>Name</th>
					<th>role</th>
					<th>Status</th>
					<th>Delete</th>
					<th>Change</th>
				</tr>
			</thead>
			<tbody>

				<?php foreach ($approved_admin as $key => $admin): ?>

					<?php $adminInfo = $admin->profile ?>

					<tr>
						<td>{{ $key+1 }}</td>
						<td>
							@if ($admin->id != auth()->guard('admin')->user()->id)
							<a href="/admin/admin-list/details/{{$admin->id}}" title="click to see the detail page" target="_blank">
								<!-- checking whether name is set or not -->
								{{ (!empty($adminInfo->first_name) || !empty($adminInfo->last_name)) ? $adminInfo->first_name." ".$adminInfo->last_name : "See Profile" }}
							</a>

							@else

							<!-- printing my name -->
							{{ $adminInfo->first_name." ".$adminInfo->last_name }} (you)
							@endif
						</td>
						<td>
							@foreach ($admin->role as $roleKey => $role)
							{{ $role->role_name }}
							@if ($roleKey < count($admin->role)-1)
							,
							@endif
							@endforeach
						</td>
						<td>{{ ($admin->status == 1) ? "Active" : "Pending" }}</td>
						<!-- disabling the delete option if admin is an owner -->
						@if (!$admin->hasRole('owner'))
						<td class="remove_admin">		
							<a href="#" title="click to delete" id="{{$admin->id}}">
								<i class="glyphicon glyphicon-remove"></i>
							</a>
						</td>
						<td class="change_privilege">
							<a href="#" title="click to change the privilege" id="{{$admin->id}}">change</a>
						</td>
						@else
						<td>---</td>
						<td>---</td>
						@endif
					</tr>
				<?php endforeach ?>

			</tbody>
		</table>

		@else

		<strong>No approved admin available right now.</strong>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
