<div class="modal fade" id="removeProductModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Product Removing</h4>
			</div>
			<div class="modal-body">
				Do you really want to Remove this Product?
			</div>
			<input type="hidden" name="product_id" id="product_id" value="{{ (isset($product_info->id)) ? $product_info->id : "" }}">
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Nev'r Mind</button>
				<button type="button" class="btn btn-primary" id="removeProductYes">It's Ok</button>
			</div>
		</div>
	</div>
</div>