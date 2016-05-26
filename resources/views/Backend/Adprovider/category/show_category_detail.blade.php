@extends('Backend.Adprovider.layouts.master')

@section('title')

<title>Category Detail | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Adprovider.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="category_detail">

	<div class="single_category">

		<div class="row">

			<div class="col-lg-12">

				<h3 class="page-header">
					Category Name : {{ $category_info->category_name }}
					<small>{{ ($category_info->status == 0)? "Pending" : "Approved" }}</small>
				</h3>

			</div>

			<!-- /.col-lg-12 -->

		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-md-6">
				Category Name: {{ $category_info->category_name }} <br>
				Upload Time: {{ $category_info->created_at }}
			</div>

		</div>

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
