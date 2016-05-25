@extends('Backend.Admin.layouts.master')

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@stop

@section('content')

<div id="page-wrapper" class="add_branch">

	@include ('Backend.modals.add_brand_modal')

	<div class="row">

		<div class="col-lg-12">

			<h1 class="page-header">Add a new Branch</h1>

		</div>
		<!-- /.col-lg-12 -->

	</div>
	<!-- /.row -->

	<div class="row add_branch_div">

		<div class="addBranchForm">

			{!! Form::open(['method' => 'POST', 'url' => '/addnewbranch', 'name' => 'addBranchForm','novalidate','data-remote'=>'data-remote', 'data-remote-success' => 'Branch Added Successfully']) !!}

			<div class="col-md-6">

				<div class="form-group {{ $errors->has('branch_name') ? ' has-error' : '' }}">
					{!! Form::label('branch_name', 'Branch Name') !!}
					{!! Form::text('branch_name', null, ['class' => 'form-control', 'required' => 'required','placeholder'=>'Enter Branch name']) !!}
					<small class="text-danger val_error_branch_name">{{ $errors->first('branch_name') }}</small>

				</div>

			</div>

			<div class="col-md-6">

				<div class="form-group{{ $errors->has('brand_id') ? ' has-error' : '' }}">
					{!! Form::label('brand_id', 'Brand Name') !!}
					{!! Form::select('brand_id',$brands, null, ['id' => 'brand_id', 'class' => 'form-control', 'required' => 'required', 'placeholder'=>'Select brand']) !!}
					<small class="text-danger val_error_brand_name">{{ $errors->first('brand_id') }}</small>

				</div>

				{!! Form::button('Set your Brand', ['class' => 'btn btn-info','id' => 'add_brand_button_from_branch_page']) !!}

			</div>

			<div>
				{!! Form::reset("Reset", ['class' => 'btn btn-default']) !!}
				{!! Form::submit("Add Branch", ['class' => 'btn btn-primary']) !!}
			</div>

			{!! Form::close() !!}

		</div>

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@stop
