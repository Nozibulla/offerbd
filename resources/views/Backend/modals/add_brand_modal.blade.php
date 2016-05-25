<div class="modal fade" id="addBrandModal">
	<div class="modal-dialog">
		{!! Form::open(['method' => 'POST', 'url' => '/addnewbrand','name' => 'addBrandForm','data-remote'=>'data-remote','data-remote-success'=>'Brand added successfully']) !!}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add new brand</h4>
			</div>
			<div class="modal-body">
				
				<div class="form-group {{ $errors->has('brand_name') ? ' has-error' : '' }}">
					{!! Form::label('brand_name', 'Brand Name') !!}
					{!! Form::text('brand_name', null, ['class' => 'form-control', 'required' => 'required','placeholder'=>'Enter Brand name']) !!}
					<small class="text-danger val_error">{{ $errors->first('brand_name') }}</small>

				</div>
				
			</div>

			<div class="modal-footer">
				<div class="pull-right">
					{!! Form::button("Not Now", ['class' => 'btn btn-default','data-dismiss'=>'modal']) !!}
					{!! Form::submit("Add Now", ['class' => 'btn btn-primary']) !!}
				</div>
			</div>
			
		</div>
		{!! Form::close() !!}
	</div>
</div>