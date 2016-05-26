@extends('Backend.Adprovider.layouts.master')

@section('title')

<title>Approved Category | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Adprovider.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="approved_category">

	<div class="row">

		<div class="col-lg-12">

			<h3 class="page-header">
				List of all <strong>Approved</strong> categories
			</h3>

		</div>

		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="table-responsive category_table">

		@if (count($approved_category)>0)

		<table class="table offerbd_table">
			<caption>Available categories</caption>
			<thead>
				<tr>
					<th>SL#</th>
					<th>Name</th>
					<th>Status</th>
					<th>Upload Time</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($approved_category as $key => $category)

					<tr>
						<td>{{ $key+1 }}</td>
						<td>
							<a href="/adprovider/category/details/{{$category->id}}" title="click to see the detail page" target="_blank">{{ $category->category_name }}</a>
						</td>
						<td> {{ ($category->status == 0) ? "Pending" : "Approved" }} </td>
						<td> {{ $category->created_at }} </td>						
					</tr>
				<?php endforeach ?>

			</tbody>
		</table>

		{!! $approved_category->links() !!}

		@else

		<strong>No approved Category is available yet</strong>

		@endif

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
