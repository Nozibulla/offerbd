@extends('Backend.Adprovider.layouts.master')

@section('title')

<title>Pending Category | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Adprovider.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="pending_category">

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">
				List of all <strong>Pending</strong> Categories
			</h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive category_table">

		@if (count($pending_category)>0)

		<table class="table offerbd_table">
			<caption>Available Pending Categories</caption>
			<thead>
				<tr>
					<th>SL#</th>
					<th>Name</th>
					<th>Status</th>
					<th>Upload Time</th>
				</tr>
			</thead>
			<tbody>

				<?php foreach ($pending_category as $key => $category): ?>

					<tr>
						<td>{{ $key+1 }}</td>
						<td>
							<a href="/adprovider/category/details/{{$category->id}}" title="click to see the detail page" target="_blank">{{ $category->category_name }}</a>
						</td>
						
						<td> {{($category->status == 0) ? "Pending" : "Approved" }} </td>
						<td> {{ $category->created_at }} </td>
					</tr>
				<?php endforeach ?>

			</tbody>
		</table>

		{!! $pending_category->links() !!}

		@else

		<strong>No pending category available</strong>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
