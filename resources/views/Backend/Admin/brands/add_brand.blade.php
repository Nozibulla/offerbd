@extends('Backend.Admin.layouts.master')

@section('title')

<title>Add Brand | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@stop

@section('content')

<div id="page-wrapper" class="add_brand">

	<div class="row">

		<div class="col-lg-12">

			<h1 class="page-header">Add a new Brand</h1>

		</div>
		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="row addBrandForm">
		
		<div class="col-md-12">
			
			{!! Form::open(['method' => 'POST', 'url' => '/addnewbrand', 'name' => 'addBrandForm','novalidate','data-remote'=>'data-remote', 'data-remote-success' => 'Brand Added Successfully']) !!}

			<div class="form-group {{ $errors->has('brand_name') ? ' has-error' : '' }}">
				{!! Form::label('brand_name', 'Brand Name') !!}
				{!! Form::text('brand_name', null, ['class' => 'form-control', 'required' => 'required','placeholder'=>'Enter Brand name']) !!}
				<small class="text-danger val_error">{{ $errors->first('brand_name') }}</small>

			</div>

			<div>
				{!! Form::reset("Reset", ['class' => 'btn btn-default']) !!}
				{!! Form::submit("Add Brand", ['class' => 'btn btn-primary']) !!}
			</div>

			{!! Form::close() !!}

		</div>

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@stop
