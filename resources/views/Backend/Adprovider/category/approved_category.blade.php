@extends('Backend.Admin.layouts.master')

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="approved_category">

	@include ('Backend.modals.remove_category_modal')

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
					<th>Delete</th>
					<th>Owner</th>
				</tr>
			</thead>
			<tbody>

				<?php foreach ($approved_category as $key => $category): ?>

					<tr>
						<td>{{ $key+1 }}</td>
						<td>
							<a href="/admin/category/details/{{$category->id}}" title="click to see the detail page" target="_blank">{{ $category->category_name }}</a>
						</td>
						<td class="remove_category">
							<a href="#" title="click to delete" id="{{$category->id}}">
								<i class="glyphicon glyphicon-remove"></i>
							</a>						
						</td>
						<td>
						<a href="/profile/members/{{ $category->profile->id }}">
								{{ $category->profile->first_name." ".$category->profile->last_name }}
							</a>
						</td>						
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
