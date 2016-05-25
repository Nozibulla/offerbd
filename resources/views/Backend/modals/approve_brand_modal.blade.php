<div class="modal fade" id="approveBrandModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Brand Approving</h4>
			</div>
			<div class="modal-body">
				Do you really want to Approve this Brand?
			</div>
			<input type="hidden" name="brand_id" id="brand_id" value="{{ (isset($brand_info->id)) ? $brand_info->id : "" }}">
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Nev'r Mind</button>
				<button type="button" class="btn btn-primary" id="approveBrandYes">It's Ok</button>
			</div>
		</div>
	</div>
</div>