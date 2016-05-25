<div class="modal fade" id="removeAdvertisementModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Advertisement Removing</h4>
			</div>
			<div class="modal-body">
				Do you really want to Delete this Advertisement?
			</div>
			<input type="hidden" name="advertisement_id" id="advertisement_id" value="{{ (isset($advertisement_info->id)) ? $advertisement_info->id : "" }}">
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Nev'r Mind</button>
				<button type="button" class="btn btn-primary" id="removeAdvertisementYes">It's Ok</button>
			</div>
		</div>
	</div>
</div>