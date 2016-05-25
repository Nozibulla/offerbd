<div class="modal fade" id="editCategoryModal">
	<div class="modal-dialog">
		{!! Form::open(['method' => 'POST', 'url' => '/saveeditedcategory','name' => 'editCategoryForm','data-remote'=>'data-remote','data-remote-success'=>'changes saved successfully']) !!}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Category Name: <strong>{{ $category_info->category_name }}</strong></h4>
			</div>
			<div class="modal-body">
				
				<div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
				    {!! Form::label('category_name', 'Category Name') !!}
				    {!! Form::text('category_name', $category_info->category_name, ['class' => 'form-control', 'required' => 'required','placeholder'=>'Enter Brand name']) !!}
				    <small class="text-danger category_val_error">{{ $errors->first('category_name') }}</small>
				</div>

				<input type="hidden" name="category_id" id="category_id" value="{{ $category_info->id }}">
	
				
			</div>
			<div class="modal-footer">
				<div class="pull-right">
					{!! Form::button("Nev'r Mind", ['class' => 'btn btn-default','data-dismiss'=>'modal']) !!}
					{!! Form::submit("Save Changes", ['class' => 'btn btn-primary']) !!}
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>