@extends('Backend.Adprovider.layouts.master')

@section('title')

<title>Add Product | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Adprovider.layouts.sidebar')

@stop

@section('content')

<div id="page-wrapper" class="add_product">

	@include ('Backend.modals.add_category_modal')

	<div class="row">

		<div class="col-lg-12">

			<h1 class="page-header">Add a new Product</h1>

		</div>
		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="row add_product_div">

		<div class="addProductForm">

			{!! Form::open(['method' => 'POST', 'url' => '/adprovider/addnewproduct', 'name' => 'addProductForm','novalidate','data-remote'=>'data-remote', 'data-remote-success' => 'Product Added Successfully']) !!}

			<div class="col-md-6">

				<div class="form-group {{ $errors->has('product_name') ? ' has-error' : '' }}">
					{!! Form::label('product_name', 'Product Name') !!}
					{!! Form::text('product_name', null, ['class' => 'form-control', 'required' => 'required','placeholder'=>'Enter product name']) !!}
					<small class="text-danger val_error_product_name">{{ $errors->first('product_name') }}</small>

				</div>

			</div>

			<div class="col-md-6">

				<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
					{!! Form::label('category_id', 'Category Name') !!}
					{!! Form::select('category_id',$categorys, null, ['id' => 'category_id', 'class' => 'form-control', 'required' => 'required', 'placeholder'=>'Select Category']) !!}
					<small class="text-danger val_error_category_name">{{ $errors->first('category_id') }}</small>

				</div>

				{!! Form::button('Set your Category', ['class' => 'btn btn-info','id' => 'add_category_button_from_product_page']) !!}

			</div>

			<div>
				{!! Form::reset("Reset", ['class' => 'btn btn-default']) !!}
				{!! Form::submit("Add product", ['class' => 'btn btn-primary']) !!}
			</div>

			{!! Form::close() !!}

		</div>

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@stop
