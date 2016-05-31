@extends('Backend.Admin.layouts.master')

@section('title')

<title>Add Category | offerbd</title>

@stop

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@stop

@section('content')

<div id="page-wrapper" class="add_category">

	<div class="row">

		<div class="col-lg-12">

			<h1 class="page-header">Add a new Category</h1>

		</div>
		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="row addCategoryForm">
		
		<div class="col-md-6">
			
			{!! Form::open(['method' => 'POST', 'url' => '/addnewcategory', 'name' => 'addCategoryForm','novalidate','data-remote'=>'data-remote', 'data-remote-success' => 'Category Added Successfully']) !!}

			<div class="form-group {{ $errors->has('category_name') ? ' has-error' : '' }}">
				{!! Form::label('category_name', 'Category Name') !!}
				{!! Form::text('category_name', null, ['class' => 'form-control', 'required' => 'required','placeholder'=>'Enter Category name']) !!}
				<small class="text-danger val_error_category_name">{{ $errors->first('category_name') }}</small>

			</div>

			<div>
				{!! Form::reset("Reset", ['class' => 'btn btn-default']) !!}
				{!! Form::submit("Add Category", ['class' => 'btn btn-primary']) !!}
			</div>

			{!! Form::close() !!}

		</div>

		<div class="col-md-6 show_category">

			<div class="all_category">

				@if (count($categorys)>0)

				<h3>Available categories are:</h3>

				<ul>

				@foreach ($categorys as $category)

				<li>{{ $category->category_name }}</li>

				@endforeach

				</ul>

				{!! $categorys->links() !!}

				@else

				<h3>No Category available yet</h3>

				@endif

			</div>

		</div>

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@stop
