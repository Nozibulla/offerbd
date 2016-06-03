@extends('Backend.Admin.layouts.master')

@section('title')

<title>Adproviders List | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="adprovider_list">

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">List of all <strong>Advertisement Providers</strong></h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive adprovider_list_table">

		@if (count($adproviders)>0)

		<table class="table offerbd_table">
			<caption>List of all Advertisement Providers</caption>
			<thead>
				<tr>
					<th>SL#</th>
					<th>Name</th>
					<th>Status</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($adproviders as $key => $adprovider)

				@define $adprovider_info = $adprovider->profile

				<tr>
					<td>{{ $key+1 }}</td>
					<td>
						<a href="{{ url('/admin/adprovider-list/details', $adprovider->id) }}" title="click to see the detail page" target="_blank">
							<!-- checking whether name is set or not -->
							{{ (!empty($adprovider_info->first_name) || !empty($adprovider_info->last_name)) ? $adprovider_info->first_name." ".$adprovider_info->last_name : "Mr. X" }}
						</a>
					</td>
					<td>status</td>
					<td class="remove_adprovider">				
						<a href="{{ url('#') }}" title="click to delete" id="{{$adprovider->id}}">
							<i class="glyphicon glyphicon-remove"></i>
						</a>
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>

		@else

		<strong>No adprovider available yet</strong>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
