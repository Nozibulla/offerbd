<div class="modal fade" id="removeAdminModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Admin Removing</h4>
			</div>
			<div class="modal-body">
				Do you really want to Delete this Admin?
			</div>
			<input type="hidden" name="admin_id" id="admin_id" value="{{ (isset($profile->id)) ? $profile->id : "" }}">
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Not Now</button>
				<button type="button" class="btn btn-primary" id="removeAdminYes">It's Ok</button>
			</div>
		</div>
	</div>
</div>