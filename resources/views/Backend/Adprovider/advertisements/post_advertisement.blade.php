@extends('Backend.Adprovider.layouts.master')

@section('title')

<title>Post Advertisement | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Adprovider.layouts.sidebar')

@stop

@section('content')

<div id="page-wrapper" class="post_advertisement">

	<div class="row">

		<div class="col-lg-12">

			<h1 class="page-header">Post a new Advertisement</h1>

		</div>
		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="row addAdvertisementForm">

		{!! Form::open(['method' => 'POST', 'url' => '/adprovider/addnewadvertisement', 'name' => 'addAdvertisementForm','novalidate', 'files' => true, 'data-remote'=>'data-remote', 'data-remote-success' => 'Advertisement Posted Successfully']) !!}

		<div class="row">

			<div class="col-md-6">

				<div class="form-group{{ $errors->has('ad_image') ? ' has-error' : '' }}">
					{!! Form::label('ad_image', 'Advertisement Image *') !!}
					{!! Form::file('ad_image', ['required' => 'required']) !!}
					<!-- <p class="help-block">Image help block</p> -->
					<small class="text-danger no_image">{{ $errors->first('ad_image') }}</small>
				</div>

				<div class="form-group{{ $errors->has('brand_id') ? ' has-error' : '' }}">
					{!! Form::label('brand_id', 'Brand *') !!}
					{!! Form::select('brand_id', $brands, null, ['id' => 'brand_id', 'class' => 'form-control', 'required' => 'required','placeholder' => (count($brands)>0) ? 'Select Brand' : 'No Brand available']) !!}
					<p class="help-block">
						@if (!count($brands))
						<a href="{{ url('/admin/brands/add-brand') }}" title="add brand first">Add Brand First</a>
						@endif
					</p>
					<small class="text-danger brand_id">{{ $errors->first('brand_id') }}</small>
				</div>

				<div class="form-group{{ $errors->has('branch_id') ? ' has-error' : '' }}">
					{!! Form::label('branch_id', 'Branch *') !!}
					{!! Form::select('branch_id', $branchs, null, ['id' => 'branch_id', 'class' => 'form-control', 'required' => 'required','placeholder' => (count($branchs)>0) ? 'Select Branch' : 'No Branch available']) !!}
					<p class="help-block">
						@if (!count($branchs))
						<a href="{{ url('/admin/branch/add-branch') }}" title="add branch first">Add Branch First</a>
						@endif
					</p>
					<small class="text-danger branch_id">{{ $errors->first('branch_id') }}</small>
				</div>

				<div class="form-group{{ $errors->has('product_id') ? ' has-error' : '' }}">
					{!! Form::label('product_id', 'Product *') !!}
					{!! Form::select('product_id', $products, null, ['id' => 'product_id', 'class' => 'form-control', 'required' => 'required','placeholder' => (count($products)>0) ? 'Select Product' : 'No Product available']) !!}
					<p class="help-block">
						@if (!count($products))
						<a href="{{ url('/admin/products/add-product') }}" title="add product first">Add Product First</a>
						@endif
					</p>
					<small class="text-danger product_id">{{ $errors->first('product_id') }}</small>
				</div>

			</div>

			<div class="col-md-6">

				<div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
					{!! Form::label('discount', 'Discount (%) *') !!}
					{!! Form::selectRange('discount', 1, 100, null, ['id' => 'discount', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select discount']) !!}
					<small class="text-danger discount">{{ $errors->first('discount') }}</small>
				</div>

				<div class="form-group{{ $errors->has('actual_price') ? ' has-error' : '' }}">
					{!! Form::label('actual_price', 'Actual price (BDT) *') !!}
					{!! Form::number('actual_price', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => '1250', 'min' => 0, 'step' => 1]) !!}
					<p class="help-block">ex. 500,1190,1250 ... etc</p>
					<small class="text-danger actual_price">{{ $errors->first('actual_price') }}</small>
				</div>

				<div class="form-group{{ $errors->has('expire_date') ? ' has-error' : '' }}">
					{!! Form::label('expire_date', 'Expire Date *') !!}
					{!! Form::date('expire_date', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => Carbon\Carbon::now()]) !!}
					<small class="text-danger expire_date">{{ $errors->first('expire_date') }}</small>
				</div>

			</div>

		</div>

		<div class="row">
			<div class="col-md-6">
				{!! Form::reset("Reset", ['class' => 'btn btn-default']) !!}
				{!! Form::submit("POST NOW", ['class' => 'btn btn-primary']) !!}
			</div>
		</div>

		{!! Form::close() !!}

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@stop
