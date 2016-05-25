<div class="modal fade" id="removeCategoryModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Category Removing</h4>
			</div>
			<div class="modal-body">
				Do you really want to Delete this Category?
			</div>
			<input type="hidden" name="category_id" id="category_id" value="{{ (isset($category_info->id)) ? $category_info->id : "" }}">
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Nev'r Mind</button>
				<button type="button" class="btn btn-primary" id="removeCategoryYes">It's Ok</button>
			</div>
		</div>
	</div>
</div>