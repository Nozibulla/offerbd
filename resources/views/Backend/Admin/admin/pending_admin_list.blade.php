@extends('Backend.Admin.layouts.master')

@section('title')

<title>Pending Admin | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="pending_admin_list">

	@include ('Backend.modals.approve_admin_modal')

	@include ('Backend.modals.remove_admin_modal')

	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">
				List of all <strong>Pending</strong> Admins
			</h3>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="table-responsive admin_list_table">

		@if (count($pending_admin)>0)
		
		<table class="table offerbd_table">
			<caption>Available admins of all privilege</caption>
			<thead>
				<tr>
					<th>SL#</th>
					<th>Name</th>
					<th>role</th>
					<th>Approve</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($pending_admin as $key => $admin)

				@define $adminInfo = $admin->profile

				<tr>
					<td>{{ $key+1 }}</td>
					<td>
						<a href="{{ url('/admin/admin-list/details',$admin->id) }}" title="click to see the detail page" target="_blank">
							<!-- checking whether name is set or not -->
							{{ (!empty($adminInfo->first_name) || !empty($adminInfo->last_name)) ? $adminInfo->first_name." ".$adminInfo->last_name : "See Profile" }}
						</a>
					</td>
					<td>
						@foreach ($admin->role as $roleKey => $role)
						{{ $role->role_name }}
						@if ($roleKey < count($admin->role)-1)
						,
						@endif
						@endforeach
					</td>
					<td class="approve_admin">
						<a href="{{ url('#') }}" title="click to approve" id="{{$admin->id}}">
							<i class="glyphicon glyphicon-ok"></i>
						</a>
					</td>
					<td class="remove_admin">
						<!-- disabling the delete option if admin is an owner -->
						@if (!$admin->hasRole('owner'))
						<a href="{{ url('#') }}" title="click to delete" id="{{$admin->id}}">
							<i class="glyphicon glyphicon-remove"></i>
						</a>
						@endif

					</td>

				</tr>

				@endforeach

			</tbody>

		</table>

		@else

		<strong>No pending admin request available right now.</strong>

		@endif
		
	</div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
@endsection
