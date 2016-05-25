<div class="modal fade" id="approveBranchModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Branch Approving</h4>
			</div>
			<div class="modal-body">
				Do you really want to Approve this Branch?
			</div>
			<input type="hidden" name="branch_id" id="branch_id" value="{{ (isset($branch_info->id)) ? $branch_info->id : "" }}">
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Nev'r Mind</button>
				<button type="button" class="btn btn-primary" id="approveBranchYes">It's Ok</button>
			</div>
		</div>
	</div>
</div>