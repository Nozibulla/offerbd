<div class="modal fade" id="editAdvertisementModal">
	<div class="modal-dialog">
		{!! Form::open(['method' => 'POST', 'url' => '/saveeditedadvertisement','name' => 'editAdvertisementForm','data-remote'=>'data-remote','data-remote-success'=>'Changes saved successfully']) !!}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">
					Advertisement ID: <strong>{{ $advertisement_info->id }}</strong>
				</h4>
			</div>
			<div class="modal-body">
				
				<div class="row">

					<div class="col-md-6">

						<img src="{{ asset($advertisement_info->ad_image) }}" alt="adno{{$advertisement_info->id}}" height="300px" width="280px">

						<div class="form-group{{ $errors->has('ad_image') ? ' has-error' : '' }}">
							{!! Form::label('ad_image', 'Advertisement Image *') !!}
							{!! Form::file('ad_image', ['class' => 'form-control']) !!}
							<p class="help-block">Image help block</p>
							<small class="text-danger ad_image">{{ $errors->first('ad_image') }}</small>
						</div>

						<div class="form-group{{ $errors->has('brand_id') ? ' has-error' : '' }}">
							{!! Form::label('brand_id', 'Brand *') !!}
							{!! Form::select('brand_id', $brands, $advertisement_info->brand_id, ['id' => 'brand_id', 'class' => 'form-control', 'required' => 'required']) !!}
							<small class="text-danger brand_id">{{ $errors->first('brand_id') }}</small>
						</div>

						<div class="form-group{{ $errors->has('branch_id') ? ' has-error' : '' }}">
							{!! Form::label('branch_id', 'Branch *') !!}
							{!! Form::select('branch_id', $branchs, $advertisement_info->branch_id, ['id' => 'branch_id', 'class' => 'form-control', 'required' => 'required']) !!}
							
							<small class="text-danger branch_id">{{ $errors->first('branch_id') }}</small>
						</div>

						<div class="form-group{{ $errors->has('product_id') ? ' has-error' : '' }}">
							{!! Form::label('product_id', 'Product *') !!}
							{!! Form::select('product_id', $products, $advertisement_info->product_id, ['id' => 'product_id', 'class' => 'form-control', 'required' => 'required']) !!}
							
							<small class="text-danger product_id">{{ $errors->first('product_id') }}</small>
						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
							{!! Form::label('discount', 'Discount (%) *') !!}
							{!! Form::selectRange('discount', 1, 100, $advertisement_info->discount, ['id' => 'discount', 'class' => 'form-control', 'required' => 'required']) !!}
							<small class="text-danger discount">{{ $errors->first('discount') }}</small>
						</div>

						<div class="form-group{{ $errors->has('actual_price') ? ' has-error' : '' }}">
							{!! Form::label('actual_price', 'Actual price (BDT) *') !!}
							{!! Form::number('actual_price', $advertisement_info->actual_price, ['class' => 'form-control', 'required' => 'required', 'min' => 0, 'step' => 1]) !!}
							<p class="help-block">ex. 500,1000,1250 ... etc</p>
							<small class="text-danger actual_price">{{ $errors->first('actual_price') }}</small>
						</div>
						<div class="form-group{{ $errors->has('expire_date') ? ' has-error' : '' }}">
							{!! Form::label('expire_date', 'Expire Date *') !!}
							{!! Form::date('expire_date', $advertisement_info->expire_date, ['class' => 'form-control', 'required' => 'required']) !!}
							<small class="text-danger expire_date">{{ $errors->first('expire_date') }}</small>
						</div>

					</div>

				</div>

				<input type="hidden" name="advertisement_id" id="advertisement_id" value="{{ $advertisement_info->id }}">
	
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