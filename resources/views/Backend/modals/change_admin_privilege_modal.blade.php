<div class="modal fade" id="changePrivilegeModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Changing Admin's Privilege</h4>
			</div>
			<div class="modal-body">
				Current Status:<strong id="cur_status">Administrator</strong>
				<p>Do you really want to make this as an owner?</p>
			</div>
			<input type="hidden" name="admin_id" id="admin_id" value="{{ (isset($admin->id)) ? $admin->id : "" }}">
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Not Now</button>
				<button type="button" class="btn btn-primary" id="changeAdminPrivilegeYes">It's Ok</button>
			</div>
		</div>
	</div>
</div>