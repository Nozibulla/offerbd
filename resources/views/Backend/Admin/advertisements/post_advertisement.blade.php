@extends('Backend.Admin.layouts.master')

@section('title')

<title>Post Advertisement | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

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

		{!! Form::open(['method' => 'POST', 'url' => '/addnewadvertisement', 'name' => 'addAdvertisementForm','novalidate', 'files' => true, 'data-remote'=>'data-remote', 'data-remote-success' => 'Advertisement Posted Successfully']) !!}

		<div class="row">

			<div class="col-md-6">

				<div class="form-group{{ $errors->has('ad_image') ? ' has-error' : '' }}">
					{!! Form::label('ad_image', 'Advertisement Image *') !!}
					{!! Form::file('ad_image', ['required' => 'required']) !!}
					<p class="help-block">Image help block</p>
					<small class="text-danger ad_image">{{ $errors->first('ad_image') }}</small>
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

				<!-- expire date -->
				<div class="form-group{{ $errors->has('expire_date') ? ' has-error' : '' }}">
					{!! Form::label('expire_date', 'Expire Date *') !!}
					{!! Form::date('expire_date', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => Carbon\Carbon::now()]) !!}
					<small class="text-danger expire_date">{{ $errors->first('expire_date') }}</small>
				</div>
				<!-- end of advertisement expire date -->

			</div>

			<div class="col-md-6">

				<!-- discount type -->

				@define $discount_type_array = array("percentage" => "Percentage (%)", "fixed_money" => "Fixed Money", "free" => "X Buy Y Free")

				<div class="form-group{{ $errors->has('discount_type') ? ' has-error' : '' }}">
					{!! Form::label('discount_type', 'Type of Discount *') !!}
					{!! Form::select('discount_type', $discount_type_array, null, ['id' => 'discount_type', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select One']) !!}
					<small class="text-danger">{{ $errors->first('discount_type') }}</small>
				</div>

				<!-- end of discount type -->

				<!-- discount area -->

				<div class="discount_area">

					<!-- percentage (%) discount -->
					<div class="common form-group{{ $errors->has('discount') ? ' has-error' : '' }} hide percentage">
						{!! Form::label('discount', 'Discount (%) *') !!}
						{!! Form::selectRange('discount', 1, 100, null, ['id' => 'discount', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select discount']) !!}
						<small class="text-danger discount">{{ $errors->first('discount') }}</small>
					</div>
					<!-- end of percentage (%) discount -->
					<!-- fixed money discount -->
					<div class="common form-group{{ $errors->has('fixed_money_discount') ? ' has-error' : '' }} hide fixed_money">
						{!! Form::label('fixed_money_discount', 'Discount (BDT) *') !!}
						{!! Form::number('fixed_money_discount', null, ['class' => 'form-control', 'required' => 'required', 'min' => 0, 'step' => 1, 'placeholder' => '100']) !!}
						<small class="text-danger">{{ $errors->first('fixed_money_discount') }}</small>
					</div>
					<!-- end of fixed money discount -->
					<!-- y free with x discount -->
					<div class="common x_buy_y_free hide free">
						<!-- how many product buy -->
						<div class="form-group{{ $errors->has('product_no') ? ' has-error' : '' }}">
							{!! Form::label('product_no', 'Product Number *') !!}
							{!! Form::selectRange('product_no', 1, 100, null, ['id' => 'product_no', 'class' => 'form-control', 'required' => 'required', 'placeholder' => ' How many product to buy?']) !!}
							<small class="text-danger">{{ $errors->first('product_no') }}</small>
						</div>
						<!-- how many product free -->
						<div class="form-group{{ $errors->has('free_product_no') ? ' has-error' : '' }}">
							{!! Form::label('free_product_no', 'Free Product Number *') !!}
							{!! Form::selectRange('free_product_no', 1, 100, null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => ' How many free product?']) !!}
							<small class="text-danger">{{ $errors->first('free_product_no') }}</small>
						</div>
						<!-- free product type -->
						<div class="radio{{ $errors->has('free_product_type') ? ' has-error' : '' }}">
							<!-- free same product -->
							<label for="free_product_type">
								{!! Form::radio('free_product_type', 'free_same',  null, ['id' => 'free_same']) !!} Same Product Free
							</label>
							<!-- free for different product -->
							<label for="free_product_type">
								{!! Form::radio('free_product_type', 'free_different',  null, ['id' => 'free_different']) !!} Different Product Free
							</label>
							<small class="text-danger">{{ $errors->first('free_product_type') }}</small>
						</div>
						<!-- free different product name -->
						<div class="common form-group{{ $errors->has('free_different_product_name') ? ' has-error' : '' }} hide free_different">
							{!! Form::label('free_different_product_name', 'What Free *') !!}
							{!! Form::text('free_different_product_name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Name of free product']) !!}
							<p class="help-block">Ex.: bowel, jug, container...</p>
							<small class="text-danger">{{ $errors->first('free_different_product_name') }}</small>
						</div>
					</div>
					<!-- end of y free with x discount -->

					<div class="form-group{{ $errors->has('actual_price') ? ' has-error' : '' }}">
						{!! Form::label('actual_price', 'Actual price (BDT) *') !!}
						{!! Form::number('actual_price', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => '1250', 'min' => 0, 'step' => 1]) !!}
						<p class="help-block">ex. 500,1190,1250 ... etc</p>
						<small class="text-danger actual_price">{{ $errors->first('actual_price') }}</small>
					</div>

				</div>
				<!-- end of discount area -->

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
