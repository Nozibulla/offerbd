@extends('Backend.Admin.layouts.master')

@section('title')

<title>Subscribers | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="subscriptions_list">

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">
				List of all <strong>Subscribers</strong>
			</h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive subscription_table_list">

		@if (count($subscription_list)>0)

		<table class="table offerbd_table">
			<caption>Available Subscribers</caption>
			<thead>
				<tr>
					<th>SL#</th>
					<th>Mobile</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($subscription_list as $key => $subscriber)
					
					<tr>
						<td>{{ $key+1 }}</td>
						<td> {{ $subscriber->mobile_no }} </td>
						<td> <a href="{{ url('#') }}" title="click to edit" id=" {{ $subscriber->id }} ">Edit</a> </td>
						<td> <a href="{{ url('#') }}" title="click to delete" id=" {{ $subscriber->id }} ">Delete</a> </td>
					</tr>

				@endforeach

			</tbody>
		</table>

		@else

		<strong>Subscriber not available yet.</strong>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
