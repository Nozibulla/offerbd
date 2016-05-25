<div class="modal fade" id="editProductModal">
	<div class="modal-dialog">
		{!! Form::open(['method' => 'POST', 'url' => '/saveeditedproduct','name' => 'editProductForm','data-remote'=>'data-remote','data-remote-success'=>'changes saved successfully']) !!}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Product Name: <strong>{{ $product_info->product_name }}</strong></h4>
			</div>
			<div class="modal-body">
				
				<div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
					{!! Form::label('product_name', 'Product Name') !!}
					{!! Form::text('product_name', $product_info->product_name, ['class' => 'form-control', 'required' => 'required','placeholder'=>'Enter Product name']) !!}
					<small class="text-danger val_error_product_name">{{ $errors->first('product_name') }}</small>
				</div>

				<input type="hidden" name="product_id" id="product_id" value="{{ $product_info->id }}">
				<input type="hidden" name="category_id" id="category_id" value="{{ $product_info->category_id }}">
				
				
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