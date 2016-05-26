@extends('Backend.Adprovider.layouts.master')

@section('title')

<title>Brand Detail | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Adprovider.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="brand_detail">

	<div class="single_brand">

		<div class="brand_detail_div">

			<div class="row">

				<div class="col-lg-12">

					<h3 class="page-header">
						Brand Name : {{ $brand_info->brand_name }}
						<small>{{ ($brand_info->status == 0)? "Pending" : "Approved" }}</small>
					</h3>

				</div>

				<!-- /.col-lg-12 -->

			</div>
			<!-- /.row -->

			<div class="row">
				<div class="col-md-6">
					Brand Name: {{ $brand_info->brand_name }} <br>
					Upload time: {{ $brand_info->created_at }}
				</div>
				
			</div>

		</div>

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
