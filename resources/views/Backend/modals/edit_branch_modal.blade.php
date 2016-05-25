<div class="modal fade" id="editBranchModal">
	<div class="modal-dialog">
		{!! Form::open(['method' => 'POST', 'url' => '/saveeditedbranch','name' => 'editBranchForm','data-remote'=>'data-remote','data-remote-success'=>'changes saved successfully']) !!}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Branch Name: <strong>{{ $branch_info->branch_name }}</strong></h4>
			</div>
			<div class="modal-body">
				
				<div class="form-group{{ $errors->has('branch_name') ? ' has-error' : '' }}">
				    {!! Form::label('branch_name', 'Branch Name') !!}
				    {!! Form::text('branch_name', $branch_info->branch_name, ['class' => 'form-control', 'required' => 'required','placeholder'=>'Enter Branch name']) !!}
				    <small class="text-danger val_error">{{ $errors->first('branch_name') }}</small>
				</div>

				<input type="hidden" name="branch_id" id="branch_id" value="{{ $branch_info->id }}">
				<input type="hidden" name="brand_id" id="brand_id" value="{{ $branch_info->brand_id }}">
	
				
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