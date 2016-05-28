@extends('Backend.Adprovider.layouts.master')

@section('sidebar')

@include ('Backend.Adprovider.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="product_detail">

	<div class="single_product">

		<div class="row">

			<div class="col-lg-12">

				<h3 class="page-header">
					Product Name : {{ $product_info->product_name }}
					<small>{{ ($product_info->status == 0)? "Pending" : "Approved" }}</small>
				</h3>

			</div>

			<!-- /.col-lg-12 -->

		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-md-6">
				Product Name: {{ $product_info->product_name }} <br>
				Upload time: {{ $product_info->created_at }}
			</div>

		</div>

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
