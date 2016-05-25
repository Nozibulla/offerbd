<div class="modal fade" id="editBrandModal">
	<div class="modal-dialog">
		{!! Form::open(['method' => 'POST', 'url' => '/saveeditedbrand','name' => 'editBrandForm','data-remote'=>'data-remote','data-remote-success'=>'changes saved successfully']) !!}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Brand Name: <strong>{{ $brand_info->brand_name }}</strong></h4>
			</div>
			<div class="modal-body">
				
				<div class="form-group{{ $errors->has('brand_name') ? ' has-error' : '' }}">
				    {!! Form::label('brand_name', 'Brand Name') !!}
				    {!! Form::text('brand_name', $brand_info->brand_name, ['class' => 'form-control', 'required' => 'required','placeholder'=>'Enter Brand name']) !!}
				    <small class="text-danger val_error">{{ $errors->first('brand_name') }}</small>
				</div>

				<input type="hidden" name="brand_id" id="brand_id" value="{{ $brand_info->id }}">
	
				
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