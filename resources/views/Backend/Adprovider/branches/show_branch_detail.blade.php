@extends('Backend.Adprovider.layouts.master')

@section('title')

<title>Branch Detail | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Adprovider.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="branch_detail">

	<div class="branch_detail_div">

		<div class="row">

			<div class="col-lg-12">

				<h1 class="page-header">
					Branch Name : {{ $branch_info->branch_name }}
					<small>{{ ($branch_info->status == 0)? "Pending" : "Approved" }}</small>
				</h1>

			</div>

			<!-- /.col-lg-12 -->

		</div>
		<!-- /.row -->

		<div class="row">
				<div class="col-md-6">
					Branch Name: {{ $branch_info->branch_name }} <br>
					Upload time: {{ $branch_info->created_at }}
				</div>
				
			</div>
	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection
