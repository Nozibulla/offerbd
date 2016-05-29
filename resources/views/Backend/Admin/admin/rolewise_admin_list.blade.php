@extends('Backend.Admin.layouts.master')

@section('title')

<title>Admin Role | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper">

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">
				List of all Admins
			</h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive">

		<table class="table offerbd_table">
			<caption>Available admins of all privilege</caption>
			<thead>
				<tr>
					<th>SL#</th>
					<th>Name</th>
					<th>Owner</th>
					<th>Administrator</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($adminList as $key => $admin)

				@define $adminInfo = $admin->profile

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

							@if ($admin->hasRole('owner'))
							<i class="glyphicon glyphicon-ok"></i>
							@else
							<i class="glyphicon glyphicon-remove"></i>
							@endif
							
						</td>	
						<td>
							@if ($admin->hasRole('administrator'))
							<i class="glyphicon glyphicon-ok"></i>
							@else
							<i class="glyphicon glyphicon-remove"></i>
							@endif
						</td>					
					</tr>

				@endforeach

			</tbody>
		</table>

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection