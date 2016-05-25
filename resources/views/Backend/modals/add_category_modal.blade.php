<div class="modal fade" id="addCategoryModal">
	<div class="modal-dialog">
		{!! Form::open(['method' => 'POST', 'url' => '/addnewcategory', 'name' => 'addCategoryForm','novalidate','data-remote'=>'data-remote', 'data-remote-success' => 'Category Added Successfully']) !!}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add new brand</h4>
			</div>
			<div class="modal-body">
				
				<div class="form-group {{ $errors->has('category_name') ? ' has-error' : '' }}">
					{!! Form::label('category_name', 'Category Name') !!}
					{!! Form::text('category_name', null, ['class' => 'form-control', 'required' => 'required','placeholder'=>'Enter Category name']) !!}
					<small class="text-danger val_error_category_name">{{ $errors->first('category_name') }}</small>

				</div>
				
			</div>

			<div class="modal-footer">
				<div class="pull-right">
					{!! Form::reset("Reset", ['class' => 'btn btn-default']) !!}
					{!! Form::submit("Add Category", ['class' => 'btn btn-primary']) !!}
				</div>
			</div>
			
		</div>
		{!! Form::close() !!}
	</div>
</div>