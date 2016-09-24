$(document).ready(function(){

	$.fn.editable.defaults.mode = 'inline';//inline editing activate

	$("#first_name").editable({

		type: 'text',

		url: '/saveprofileinfo',

		ajaxOptions:{

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

		},
		success: function(msg){

		}

	});

	$("#last_name").editable({

		type: 'text',

		url: '/saveprofileinfo',

		ajaxOptions:{

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

		},
		success: function(msg){}  

	});

	$("#mobile").editable({

		type: 'text',

		url: '/saveprofileinfo',

		ajaxOptions:{

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

		},
		success: function(msg){}  

	});

	$("#address").editable({

		type: 'text',

		url: '/saveprofileinfo',

		ajaxOptions:{

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

		},
		success: function(msg){}

	});

});

// starting the ajax request
$( document ).ajaxStart(function(event, jqxhr, ajaxOptions, errorThrown) {

	$(".overlay").show();
});

// end of ajax request
$( document ).ajaxStop(function(event, jqxhr, ajaxOptions, errorThrown) {

	$(".overlay").hide();
});

// global ajax success function
$(document).ajaxSuccess(function(event, jqxhr, ajaxOptions, errorThrown){

	var contentType   = jqxhr.getResponseHeader("Content-Type");

	var responseBody  = jqxhr.responseText;

	$('.bb-alert').removeClass('alert-danger').addClass('alert-info');

});

// global ajax error function
$(document).ajaxError(function(event, jqxhr, ajaxOptions, errorThrown) {

	var contentType   = jqxhr.getResponseHeader("Content-Type");

	var responseBody  = jqxhr.responseText;

	if(jqxhr.status == 404) {

		$('.bb-alert').removeClass('alert-info').addClass('alert-danger').find('span').html("oppss! not found");
		$('.bb-alert').show().delay(3000).fadeOut();
	}
	else if(jqxhr.status == 500) {

		$('.bb-alert').removeClass('alert-info').addClass('alert-danger').find('span').html("Internal Error occured.");
		$('.bb-alert').show().delay(3000).fadeOut();
	}
	else if(jqxhr.status == 403) {

		$('.bb-alert').removeClass('alert-info').addClass('alert-danger').find('span').html("You are not authorized.");
		$('.bb-alert').show().delay(3000).fadeOut();
	}
	else if(jqxhr.status == 405) {

		$('.bb-alert').removeClass('alert-info').addClass('alert-danger').find('span').html("opss!Method not allowed");
		$('.bb-alert').show().delay(3000).fadeOut();
	}

});


$(document).ready(function(){

	// hiding all the modals at a time
	$("#approveBrandModal, #removeBrandModal, #editBrandModal, #addBrandModal, #approveBranchModal, #removeBranchModal, #editBranchModal, #addBranchModal, #approveCategoryModal, #removeCategoryModal, #editCategoryModal, #addCategoryModal, #approveAdminModal, #removeAdminModal, #changePrivilegeModal, #approveProductModal, #removeProductModal, #editProductModal, #approveAdvertisementModal, #removeAdvertisementModal, #editAdvertisementModal, #addAdvertisementModal").modal({

		show: false,

		backdrop: 'static',

		keyboard: false

	});

	// showing the set profile warning modal
	$("#setProfile").modal({

		show: true,

		backdrop: 'static',

		keyboard: false

	});

});

// creating brand manager
(function($){

	var brandManager = {

		init: function(){

			var form,url,method,data,message,currentPageUrl,formData;

			// adding new brand
			$(".add_brand").on('submit','.addBrandForm form[data-remote]',this.addNewBrand);

			// approve pending brand
			$(".pending_brands").on('click','.brands_table .approve_brand a',this.showApproveBrandModal);

			$(".pending_brands").on('click','#approveBrandModal #approveBrandYes',this.approveBrand);

			// delete pending brand
			$(".pending_brands").on('click','.brands_table .remove_brand a',this.showRemoveBrandModal);

			$(".pending_brands").on('click','#removeBrandModal #removeBrandYes',this.removeBrand);


			// deleting the approved brand
			$(".approved_brands").on('click','.brands_table .remove_brand a',this.showRemoveApprovedBrandModal);

			$(".approved_brands").on('click','#removeBrandModal #removeBrandYes',this.removeBrand);

			// deleting approved brand from the brand detail page
			// $(".brand_option").on('click','.brand_edit_delete .delete_approved_brand',this.showRemoveApprovedBrandModal);

			$(".brand_detail").on('click','#removeBrandModal #removeBrandYes',this.removeApprovedBrandFromDetail);

			// approving a brand from the brand detail page
			// $(".brand_option").on('click','.brand_edit_delete .approve_brand',this.showApprovedBrandDetailModal);

			$(".brand_detail").on('click','#approveBrandModal #approveBrandYes',this.approveBrandFromDetail);

			// save Brand after editing
			$(".brand_detail").on('submit','#editBrandModal form[data-remote]',this.saveBrandAfterEdit);

			// adding new brand from the add branch page
			$(".add_branch").on('click','.addBranchForm #add_brand_button_from_branch_page',this.showAddBrandModal);

			$(".add_branch").on('submit','#addBrandModal form[data-remote]',this.addNewBrandFromBranchPage);

		},

		addNewBrand : function(event){

			event.preventDefault();

			form = $(this);

			formData =  brandManager.getFormData(form);

			$.ajax({

				method: formData.method,

				url : formData.url,

				data: formData.data,

			})
			.success(function(msg){

				message = form.data('remote-success');

				$(".val_error").html("").parent("div").removeClass('has-error');

				form.trigger('reset');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();

			})
			.error(function(jqXHR){

				if (jqXHR.status == 422) {

					var errors = jqXHR.responseJSON;

					$(".val_error").html(errors.brand_name).parent("div").addClass('has-error');

				}
				else{

					$('.bb-alert').show().delay(3000).fadeOut();

				}

			});

		},

		// approving a pending brand
		showApproveBrandModal : function(event){

			event.preventDefault();

			var brand = $(this);

			var brand_id = (this.id);

			$("#approveBrandModal").modal('show');

			// adding the brand id to the modal hidden input field 
			$("#approveBrandModal #brand_id").val(brand_id);

		},

		approveBrand : function(){

			var brand_id = $("#brand_id").val();

			$("#approveBrandModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/approvebrand",

				data : {brand_id:brand_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Brand Approved Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.brands_table').load(currentPageUrl+' .brands_table');

			})
			.error(function(jqXHR){

			});		

		},

		// removing a pending brand
		showRemoveBrandModal : function(event){

			event.preventDefault();

			var brand = $(this);

			var brand_id = (this.id);

			$("#removeBrandModal").modal('show');

			// adding the brand id to the modal hidden input field 
			$("#removeBrandModal #brand_id").val(brand_id);

		},

		removeBrand : function(){

			var brand_id = $("#removeBrandModal #brand_id").val();

			$("#removeBrandModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/removebrand",

				data : {brand_id:brand_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Brand Removed Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.brands_table').load(currentPageUrl+' .brands_table');

			})
			.error(function(jqXHR){

			});		

		},

		// removing a approved brand from the brand detail page
		showRemoveApprovedBrandModal : function(event){

			event.preventDefault();

			var brand = $(this);

			var brand_id = (this.id);

			$("#removeBrandModal").modal('show');

			// adding the brand id to the modal hidden input field 
			$("#brand_id").val(brand_id);

		},

		removeApprovedBrandFromDetail : function(){

			var brand_id = $("#brand_id").val();

			$("#removeBrandModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/removebrand",

				data : {brand_id:brand_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Brand Removed Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				document.location.href = "/admin/brands/approved-brand"

			})
			.error(function(jqXHR){

			});		

		},

		// approve a brand from brand detail page
		showApprovedBrandDetailModal : function(event){

			event.preventDefault();

			var brand = $(this);

			var brand_id = (this.id);

			$("#approveBrandModal").modal('show');

			// adding the brand id to the modal hidden input field 
			$("#brand_id").val(brand_id);

		},

		approveBrandFromDetail : function(){

			var brand_id = $("#brand_id").val();

			$("#approveBrandModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/approvebrand",

				data : {brand_id:brand_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Brand Approved Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.brand_detail').load(currentPageUrl+' .single_brand');

			})
			.error(function(jqXHR){

			});		

		},

		// saving brand after editing
		saveBrandAfterEdit : function(event){

			event.preventDefault();

			form = $(this);

			formData =  brandManager.getFormData(form);

			$.ajax({

				method: formData.method,

				url : formData.url,

				data: formData.data,

			})
			.success(function(msg){

				message = form.data('remote-success');

				$("#editBrandModal").modal('hide');

				$(".val_error").html("").parent("div").removeClass('has-error');

				form.trigger('reset');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.brand_detail').load(currentPageUrl+' .single_brand');

			})
			.error(function(jqXHR){

				if (jqXHR.status == 422) {

					var errors = jqXHR.responseJSON;

					$(".val_error").html(errors.brand_name).parent("div").addClass('has-error');

				}
				else{

					$('.bb-alert').show().delay(3000).fadeOut();

				}

			});

		},

		// adding brand from the add branch page
		showAddBrandModal : function(event){

			$("#addBrandModal").modal('show');

		},

		addNewBrandFromBranchPage : function(event){

			event.preventDefault();

			form = $(this);

			formData =  brandManager.getFormData(form);

			$.ajax({

				method: formData.method,

				url : formData.url,

				data: formData.data,

			})
			.success(function(msg){

				message = form.data('remote-success');

				$("#addBrandModal").modal('hide');

				$(".branch_val_error").html("").parent("div").removeClass('has-error');

				form.trigger('reset');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$(".addBranchForm").load(currentPageUrl+' .addBranchForm');

			})
			.error(function(jqXHR){

				if (jqXHR.status == 422) {

					var errors = jqXHR.responseJSON;

					$(".val_error").html(errors.brand_name).parent("div").addClass('has-error');

				}
				else{

					$('.bb-alert').show().delay(3000).fadeOut();

				}

			});

		},

		// getting the form detail to be submitted
		getFormData: function(form){

			url = form.prop('action');

			method = form.find('input[name="_method"]').val() || 'POST';

			data = form.serialize();

			return {'form':form,'method':method,'url':url,'data':data};

		},

	};

	$(function(){

		brandManager.init();

	});

})(jQuery);

// creating branch manager
(function($){

	var branchManager = {

		init : function(){

			var method,url,form,currentPageUrl,data,message,formData;

			// adding a new branch
			$(".add_branch").on('submit','.addBranchForm form[data-remote]',this.addNewBranch);

			// approve pending branch
			$(".pending_branch").on('click','.branch_table .approve_branch a',this.showApproveBranchModal);

			$(".pending_branch").on('click','#approveBranchModal #approveBranchYes',this.approveBranch);

			// delete pending branch
			$(".pending_branch").on('click','.branch_table .remove_branch a',this.showRemoveBranchModal);

			$(".pending_branch").on('click','#removeBranchModal #removeBranchYes',this.removeBranch);

			// deleting the approved branch
			$(".approved_branch").on('click','.branch_table .remove_branch a',this.showRemoveApprovedBranchModal);

			$(".approved_branch").on('click','#removeBranchModal #removeBranchYes',this.removeBranch);

			// deleting approved branch from Branch detail page
			// $(".branch_option").on('click','.branch_edit_delete .delete_approved_branch',this.showRemoveApprovedBranchModal);

			$(".branch_detail").on('click','#removeBranchModal #removeBranchYes',this.removeApprovedBranchFromDetail);

			// approving a branch from the branch detail page
			// $(".branch_option").on('click','.branch_edit_delete .approve_brand',this.showApprovedBranchDetailModal);

			$(".branch_detail").on('click','#approveBranchModal #approveBranchYes',this.approveBranchFromDetail);

			// save Brand after editing
			$(".branch_detail").on('submit','#editBranchModal form[data-remote]',this.saveBranchAfterEdit);


		},

		// adding new branch
		addNewBranch : function(event){

			event.preventDefault();

			form = $(this);

			// clearing all the errors
			$(".val_error_branch_name").html("").parent("div").removeClass('has-error');

			$(".val_error_brand_name").html("").parent("div").removeClass('has-error');

			formData =  branchManager.getFormData(form);

			$.ajax({

				method: formData.method,

				url : formData.url,

				data: formData.data,

			})
			.success(function(msg){

				message = form.data('remote-success');

				$(".val_error_branch_name").html("").parent("div").removeClass('has-error');

				$(".val_error_brand_name").html("").parent("div").removeClass('has-error');

				form.trigger('reset');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();

			})
			.error(function(jqXHR){

				if (jqXHR.status == 422) {

					var errors = jqXHR.responseJSON;

					// console.log(errors.branch_name+errors.brand_id);

					if (errors.branch_name) {
						$(".val_error_branch_name").html(errors.branch_name).parent("div").addClass('has-error');
					}
					if (errors.brand_id) {
						$(".val_error_brand_name").html(errors.brand_id).parent("div").addClass('has-error');
					}

				}
				else{

					$('.bb-alert').show().delay(3000).fadeOut();

				}

			});

		},

		// approving a pending branch
		showApproveBranchModal : function(event){

			event.preventDefault();

			var branch = $(this);

			var branch_id = (this.id);

			$("#approveBranchModal").modal('show');

			// adding the brand id to the modal hidden input field 
			$("#approveBranchModal #branch_id").val(branch_id);

		},

		approveBranch : function(){

			var branch_id = $("#branch_id").val();

			$("#approveBranchModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/approvebranch",

				data : {branch_id:branch_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Branch Approved Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.branch_table').load(currentPageUrl+' .branch_table');

			})
			.error(function(jqXHR){

			});		

		},

		// removing a pending branch
		showRemoveBranchModal : function(event){

			event.preventDefault();

			var branch = $(this);

			var branch_id = (this.id);

			$("#removeBranchModal").modal('show');

			// adding the branch id to the modal hidden input field 
			$("#removeBranchModal #branch_id").val(branch_id);

		},

		removeBranch : function(){

			var branch_id = $("#removeBranchModal #branch_id").val();

			$("#removeBranchModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/removebranch",

				data : {branch_id:branch_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Branch Removed Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.branch_table').load(currentPageUrl+' .branch_table');

			})
			.error(function(jqXHR){

			});		

		},

		// removing a approved branch
		showRemoveApprovedBranchModal : function(event){

			event.preventDefault();

			var branch = $(this);

			var branch_id = (this.id);

			$("#removeBranchModal").modal('show');

			// adding the branch id to the modal hidden input field 
			$("#branch_id").val(branch_id);

		},

		removeApprovedBranchFromDetail : function(){

			var branch_id = $("#branch_id").val();

			$("#removeBranchModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/removebranch",

				data : {branch_id:branch_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Branch Removed Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				document.location.href = "/admin/branch/approved-branch";

			})
			.error(function(jqXHR){

			});		

		},

		// approve a branch from branch detail page
		showApprovedBranchDetailModal : function(event){

			event.preventDefault();

			var branch = $(this);

			var branch_id = (this.id);

			$("#approveBranchModal").modal('show');

			// adding the branch id to the modal hidden input field 
			$("#branch_id").val(branch_id);

		},

		approveBranchFromDetail : function(){

			var branch_id = $("#branch_id").val();

			$("#approveBranchModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/approvebranch",

				data : {branch_id:branch_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Branch Approved Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.approved_branch_detail').load(currentPageUrl+' .branch_detail_div');

			})
			.error(function(jqXHR){

			});		

		},

		// saving brand after editing
		saveBranchAfterEdit : function(event){

			event.preventDefault();

			form = $(this);

			formData =  branchManager.getFormData(form);

			$.ajax({

				method: formData.method,

				url : formData.url,

				data: formData.data,

			})
			.success(function(msg){

				message = form.data('remote-success');

				$("#editBranchModal").modal('hide');

				$(".val_error").html("").parent("div").removeClass('has-error');

				form.trigger('reset');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.approved_branch_detail').load(currentPageUrl+' .branch_detail_div');

			})
			.error(function(jqXHR){

				if (jqXHR.status == 422) {

					var errors = jqXHR.responseJSON;

					$(".val_error").html(errors.branch_name).parent("div").addClass('has-error');

				}
				else{

					$('.bb-alert').show().delay(3000).fadeOut();

				}

			});

		},


		// getting the form detail to be submitted
		getFormData: function(form){

			url = form.prop('action');

			method = form.find('input[name="_method"]').val() || 'POST';

			data = form.serialize();

			return {'form':form,'method':method,'url':url,'data':data};

		},
	};

	$(function(){

		branchManager.init();
	});

})(jQuery);

// creating category manager
(function($){

	var categoryManager = {

		init: function(){

			var method,url,from,formData,message,currentPageUrl;

			//  adding a new category
			$(".add_category").on("submit",".addCategoryForm form[data-remote]",this.addNewCategory);

			// approve pending brand
			$(".pending_category").on('click','.category_table .approve_category a',this.showApproveCategoryModal);

			$(".pending_category").on('click','#approveCategoryModal #approveCategoryYes',this.approveCategory);

			// delete pending category
			$(".pending_category").on('click','.category_table .remove_category a',this.showRemoveCategoryModal);

			$(".pending_category").on('click','#removeCategoryModal #removeCategoryYes',this.removeCategory);

			// delete approved category
			$(".approved_category").on('click','.category_table .remove_category a',this.showRemoveCategoryModal);

			$(".approved_category").on('click','#removeCategoryModal #removeCategoryYes',this.removeCategory);

			// deleting approved category from the category detail page
			$(".category_detail").on('click','#removeCategoryModal #removeCategoryYes',this.removeApprovedCategoryFromDetail);

			// approving a category from the category detail page
			$(".category_detail").on('click','#approveCategoryModal #approveCategoryYes',this.approveCategoryFromDetail);

			// save Category after editing
			$(".category_detail").on('submit','#editCategoryModal form[data-remote]',this.saveCategoryAfterEdit);



		},

		//adding new category
		addNewCategory: function(event){

			event.preventDefault();

			form = $(this);

			// clearing all the errors
			$(".val_error_category_name").html("").parent("div").removeClass('has-error');

			formData =  categoryManager.getFormData(form);

			$.ajax({

				method: formData.method,

				url : formData.url,

				data: formData.data,

			})
			.success(function(msg){

				message = form.data('remote-success');

				$(".val_error_category_name").html("").parent("div").removeClass('has-error');

				form.trigger('reset');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.show_category').load(currentPageUrl+' .all_category');

			})
			.error(function(jqXHR){

				if (jqXHR.status == 422) {

					var errors = jqXHR.responseJSON;

					if (errors.category_name) {
						$(".val_error_category_name").html(errors.category_name).parent("div").addClass('has-error');
					}

				}

			});

		},

		// approving a pending category
		showApproveCategoryModal: function(event){

			event.preventDefault();

			var category = $(this);

			var category_id = (this.id);

			$("#approveCategoryModal").modal('show');

			// adding the category id to the modal hidden input field 
			$("#approveCategoryModal #category_id").val(category_id);

		},

		approveCategory : function(){

			var category_id = $("#category_id").val();

			$("#approveCategoryModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/approvecategory",

				data : {category_id:category_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Category Approved Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.category_table').load(currentPageUrl+' .category_table');

			})
			.error(function(jqXHR){

			});		

		},

		// removing a pending category
		showRemoveCategoryModal : function(event){

			event.preventDefault();

			var category = $(this);

			var category_id = (this.id);

			$("#removeCategoryModal").modal('show');

			// adding the category id to the modal hidden input field 
			$("#removeCategoryModal #category_id").val(category_id);

		},

		removeCategory : function(){

			var category_id = $("#removeCategoryModal #category_id").val();

			$("#removeCategoryModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/removecategory",

				data : {category_id:category_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Category Removed Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.category_table').load(currentPageUrl+' .category_table');

			})
			.error(function(jqXHR){

			});		

		},

		// removing a approved category
		showRemoveApprovedCategoryModal : function(event){

			event.preventDefault();

			var category = $(this);

			var category_id = (this.id);

			$("#removeCategoryModal").modal('show');

			// adding the category id to the modal hidden input field 
			$("#category_id").val(category_id);

		},

		removeApprovedCategoryFromDetail : function(){

			var category_id = $("#category_id").val();

			$("#removeCategoryModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/removecategory",

				data : {category_id:category_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Branch Removed Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				document.location.href = "/admin/category/approved-category";

			})
			.error(function(jqXHR){

			});		

		},

		// approve a category from category detail page
		showApprovedCategoryDetailModal : function(event){

			event.preventDefault();

			var category = $(this);

			var category_id = (this.id);

			$("#approveCategoryModal").modal('show');

			// adding the category id to the modal hidden input field 
			$("#category_id").val(category_id);

		},

		approveCategoryFromDetail : function(){

			var category_id = $("#category_id").val();

			$("#approveCategoryModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/approvecategory",

				data : {category_id:category_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Category Approved Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.category_detail').load(currentPageUrl+' .single_category');

			})
			.error(function(jqXHR){

			});		

		},

		// saving category after editing
		saveCategoryAfterEdit : function(event){

			event.preventDefault();

			form = $(this);

			formData =  categoryManager.getFormData(form);

			$.ajax({

				method: formData.method,

				url : formData.url,

				data: formData.data,

			})
			.success(function(msg){

				message = form.data('remote-success');

				$("#editCategoryModal").modal('hide');

				$(".category_val_error").html("").parent("div").removeClass('has-error');

				form.trigger('reset');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.category_detail').load(currentPageUrl+' .single_category');

			})
			.error(function(jqXHR){

				if (jqXHR.status == 422) {

					var errors = jqXHR.responseJSON;

					$(".category_val_error").html(errors.category_name).parent("div").addClass('has-error');

				}
				else{

					$('.bb-alert').show().delay(3000).fadeOut();

				}

			});

		},

		// getting the form detail to be submitted
		getFormData: function(form){

			url = form.prop('action');

			method = form.find('input[name="_method"]').val() || 'POST';

			data = form.serialize();

			return {'form':form,'method':method,'url':url,'data':data};

		},

	};

	$(function(){

		categoryManager.init();
	});

})(jQuery);

// creating admin manager
(function($){

	var adminManager = {

		init: function(){

			var method,url,from,formData,message,currentPageUrl,admin,admin_id;

			// showing the modal for approving an admin
			$(".pending_admin_list").on('click','.admin_list_table .approve_admin a',this.showApproveAdminModal);
			// approving an admin
			$(".pending_admin_list").on('click','#approveAdminModal #approveAdminYes',this.approveAdmin);
			// showing the modal for deleting an admin
			$(".pending_admin_list").on('click','.admin_list_table .remove_admin a',this.showRemoveAdminModal);
			// deleting an admin
			$(".pending_admin_list").on('click','#removeAdminModal #removeAdminYes',this.removeAdmin);
			// deleting an admin from the approved admin list page
			$(".approved_admin_list").on('click','.admin_list_table .remove_admin a',this.showRemoveAdminModal);
			$(".approved_admin_list").on('click','#removeAdminModal #removeAdminYes',this.removeAdmin);
			// deleting an admin from the admin detail page
			$(".admin_detail").on('click','#removeAdminModal #removeAdminYes',this.removeAdminFromAdminDetail);			
			// changing the privilege of a admin
			$(".approved_admin_list").on('click','.admin_list_table .change_privilege a',this.showChangePrivilegeModal);
			// changing the privilege
			$(".approved_admin_list").on('click','#changePrivilegeModal #changeAdminPrivilegeYes',this.changeAdminPrivilege);

		},

		// showing the modal for approving an admin
		showApproveAdminModal: function(event){

			event.preventDefault();

			admin = $(this);

			admin_id = (this.id);

			$("#approveAdminModal #admin_id").val(admin_id);

			$("#approveAdminModal").modal('show');

		},

		// approving an admin
		approveAdmin: function(){

			admin_id = $("#approveAdminModal #admin_id").val();

			$("#approveAdminModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/approveadmin",

				data : {admin_id:admin_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Admin Approved Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.admin_list_table').load(currentPageUrl+' .admin_list_table');

			})
			.error(function(jqXHR){

			});		

		},

		// showing the modal for deleting an admin
		showRemoveAdminModal: function(event){

			event.preventDefault();

			admin = $(this);

			admin_id = (this.id);

			// alert(admin_id);

			$("#removeAdminModal #admin_id").val(admin_id);

			$("#removeAdminModal").modal('show');

		},

		// deleting an admin
		removeAdmin: function(){

			admin_id = $("#removeAdminModal #admin_id").val();

			$("#removeAdminModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/removeadmin",

				data : {admin_id:admin_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Admin Removed Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.admin_list_table').load(currentPageUrl+' .admin_list_table');

			})
			.error(function(jqXHR){

			});		

		},

		// deleting an admin from the admin detail page
		removeAdminFromAdminDetail: function(){

			admin_id = $("#removeAdminModal #admin_id").val();

			$("#removeAdminModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/removeadmin",

				data : {admin_id:admin_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Admin Removed Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				document.location.href = "/admin/approved-admin";

			})
			.error(function(jqXHR){

			});		


		},

		// showing the modal for changing the admin privilege
		showChangePrivilegeModal: function(event){

			event.preventDefault();

			admin = $(this);

			admin_id = (this.id);

			// alert(admin_id);

			$("#changePrivilegeModal #admin_id").val(admin_id);

			$("#changePrivilegeModal").modal('show');

		},

		// change admin privilege
		changeAdminPrivilege: function(){

			admin_id = $("#changePrivilegeModal #admin_id").val();

			$("#changePrivilegeModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/changeprivilege",

				data : {admin_id:admin_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Privilege changed Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.admin_list_table').load(currentPageUrl+' .admin_list_table');

			})
			.error(function(jqXHR){

			});		


		},

		// getting the form detail to be submitted
		getFormData: function(form){

			url = form.prop('action');

			method = form.find('input[name="_method"]').val() || 'POST';

			data = form.serialize();

			return {'form':form,'method':method,'url':url,'data':data};

		},

	};

	$(function(){

		adminManager.init();

	});

})(jQuery);

// creating product Manager
(function($){

	var productManager = {

		init: function(){

			var form,url,method,data,message,currentPageUrl,formData,product,product_id;

			// adding a new product
			$(".add_product").on('submit','.addProductForm form[data-remote]',this.addNewProduct);

			// adding category from the add_product page
			$(".add_product").on('click','.addProductForm #add_category_button_from_product_page',this.showAddCategoryModal);
			$(".add_product").on('submit','#addCategoryModal form[data-remote]',this.addNewCategoryFromProductPage);

			// approve pending product
			$(".pending_products").on('click','.products_table .approve_product a',this.showApproveProductModal);

			$(".pending_products").on('click','#approveProductModal #approveProductYes',this.approveProduct);

			// delete pending product
			$(".pending_products").on('click','.products_table .remove_product a',this.showRemoveProductModal);

			$(".pending_products").on('click','#removeProductModal #removeProductYes',this.removeProduct);

			// deleting the approved product
			$(".approved_products").on('click','.products_table .remove_product a',this.showRemoveApprovedProductModal);

			$(".approved_products").on('click','#removeProductModal #removeProductYes',this.removeProduct);

			// deleting approved product from the product detail page
			$(".product_detail").on('click','#removeProductModal #removeProductYes',this.removeApprovedProductFromDetail);

			// approving a product from the product detail page
			$(".product_detail").on('click','#approveProductModal #approveProductYes',this.approveProductFromDetail);

			// save Product after editing
			$(".product_detail").on('submit','#editProductModal form[data-remote]',this.saveProductAfterEdit);

		},

		// adding a new product
		addNewProduct: function(event){

			event.preventDefault();

			form = $(this);

			// clearing all the errors
			$(".val_error_product_name").html("").parent("div").removeClass('has-error');

			$(".val_error_category_name").html("").parent("div").removeClass('has-error');

			formData =  productManager.getFormData(form);

			$.ajax({

				method: formData.method,

				url : formData.url,

				data: formData.data,

			})
			.success(function(msg){

				message = form.data('remote-success');

				$(".val_error_product_name").html("").parent("div").removeClass('has-error');

				$(".val_error_category_name").html("").parent("div").removeClass('has-error');

				form.trigger('reset');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();

			})
			.error(function(jqXHR){

				if (jqXHR.status == 422) {

					var errors = jqXHR.responseJSON;

					// console.log(errors.product_name+errors.category_id);

					if (errors.product_name) {
						$(".val_error_product_name").html(errors.product_name).parent("div").addClass('has-error');
					}
					if (errors.category_id) {
						$(".val_error_category_name").html(errors.category_id).parent("div").addClass('has-error');
					}

				}
				else{

					$('.bb-alert').show().delay(3000).fadeOut();

				}

			});


		},

		// adding new category modal showing
		showAddCategoryModal: function(){

			$("#addCategoryModal").modal('show');

		},

		// adding new category from add_product page
		addNewCategoryFromProductPage : function(event){

			event.preventDefault();

			form = $(this);

			formData =  productManager.getFormData(form);

			$.ajax({

				method: formData.method,

				url : formData.url,

				data: formData.data,

			})
			.success(function(msg){

				message = form.data('remote-success');

				$("#addCategoryModal").modal('hide');

				$(".val_error_category_name").html("").parent("div").removeClass('has-error');

				form.trigger('reset');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$(".addProductForm").load(currentPageUrl+' .addProductForm');

			})
			.error(function(jqXHR){

				if (jqXHR.status == 422) {

					var errors = jqXHR.responseJSON;

					$(".val_error_category_name").html(errors.category_name).parent("div").addClass('has-error');

				}
				else{

					$('.bb-alert').show().delay(3000).fadeOut();

				}

			});

		},

		// approving a pending product
		showApproveProductModal : function(event){

			event.preventDefault();

			product = $(this);

			product_id = (this.id);

			$("#approveProductModal").modal('show');

			// adding the product id to the modal hidden input field 
			$("#approveProductModal #product_id").val(product_id);

		},

		approveProduct : function(){

			product_id = $("#product_id").val();

			$("#approveProductModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/approveproduct",

				data : {product_id:product_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Product Approved Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.products_table').load(currentPageUrl+' .products_table');

			})
			.error(function(jqXHR){

			});		

		},

		// removing a pending product modal
		showRemoveProductModal : function(event){

			event.preventDefault();

			product = $(this);

			product_id = (this.id);

			$("#removeProductModal").modal('show');

			// adding the product id to the modal hidden input field 
			$("#removeProductModal #product_id").val(product_id);

		},

		// removing a pending product
		removeProduct : function(){

			product_id = $("#removeProductModal #product_id").val();

			$("#removeProductModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/removeproduct",

				data : {product_id:product_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Product Removed Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.products_table').load(currentPageUrl+' .products_table');

			})
			.error(function(jqXHR){

			});		

		},

		// removing a approved product modal
		showRemoveApprovedProductModal : function(event){

			event.preventDefault();

			product = $(this);

			product_id = (this.id);

			$("#removeProductModal").modal('show');

			// adding the brand id to the modal hidden input field 
			$("#product_id").val(product_id);

		},

		// approving a product from the product detail page
		approveProductFromDetail : function(){

			product_id = $("#product_id").val();

			$("#approveProductModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/approveproduct",

				data : {product_id:product_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Product Approved Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.product_detail').load(currentPageUrl+' .single_product');

			})
			.error(function(jqXHR){

			});		

		},

		// deleting a product from the product detail page
		removeApprovedProductFromDetail : function(){

			product_id = $("#product_id").val();

			$("#removeProductModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/removeproduct",

				data : {product_id:product_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Product Removed Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				document.location.href = "/admin/products/approved-product";

			})
			.error(function(jqXHR){

			});		

		},

		// saving product after editing
		saveProductAfterEdit : function(event){

			event.preventDefault();

			form = $(this);

			formData =  productManager.getFormData(form);

			$.ajax({

				method: formData.method,

				url : formData.url,

				data: formData.data,

			})
			.success(function(msg){

				message = form.data('remote-success');

				$("#editProductModal").modal('hide');

				$(".val_error_product_name").html("").parent("div").removeClass('has-error');

				form.trigger('reset');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.product_detail').load(currentPageUrl+' .single_product');

			})
			.error(function(jqXHR){

				if (jqXHR.status == 422) {

					var errors = jqXHR.responseJSON;

					$(".val_error_product_name").html(errors.product_name).parent("div").addClass('has-error');

				}
				else{

					$('.bb-alert').show().delay(3000).fadeOut();

				}

			});

		},


		// getting the form detail to be submitted
		getFormData: function(form){

			url = form.prop('action');

			method = form.find('input[name="_method"]').val() || 'POST';

			data = form.serialize();

			return {'form':form,'method':method,'url':url,'data':data};

		},

	};

	$(function(){

		productManager.init();

	});

})(jQuery);

// creating advertisement manager
(function($){

	var adviertisementManager = {

		init: function(){

			var form,url,method,data,message,currentPageUrl,formData,errors,advertisement,advertisement_id;

			// showing the discount type
			$(".post_advertisement").on('change','.addAdvertisementForm #discount_type',this.showSpecificDiscount);

			// showing the div for different free things
			$(".post_advertisement").on('change','.addAdvertisementForm .x_buy_y_free input[type=radio]',this.showDifferentFreeProductArea);

			// posting new advertisement
			$(".post_advertisement").on('submit','.addAdvertisementForm form[data-remote]',this.postAdvertisement);

			// approve pending advertisement
			$(".pending_advertisements").on('click','.advertisements_table .approve_advertisement a',this.showApproveAdvertisementModal);
			$(".pending_advertisements").on('click','#approveAdvertisementModal #approveAdvertisementYes',this.approveAdvertisement);

			// delete pending advertisement
			$(".pending_advertisements").on('click','.advertisements_table .remove_advertisement a',this.showRemoveAdvertisementModal);
			$(".pending_advertisements").on('click','#removeAdvertisementModal #removeAdvertisementYes',this.removeAdvertisement);

			// deleting the approved product
			$(".approved_advertisements").on('click','.advertisements_table .remove_advertisement a',this.showRemoveApprovedAdvertisementModal);
			$(".approved_advertisements").on('click','#removeAdvertisementModal #removeAdvertisementYes',this.removeAdvertisement);
			// deleting approved product from the product detail page
			$(".advertisement_detail").on('click','#removeAdvertisementModal #removeAdvertisementYes',this.removeApprovedAdvertisementFromDetail);

			// approving a product from the product detail page
			$(".advertisement_detail").on('click','#approveAdvertisementModal #approveAdvertisementYes',this.approveAdvertisementFromDetail);
			// save Advertisement after editing
			$(".advertisement_detail").on('submit','#editAdvertisementModal form[data-remote]',this.saveAdvertisementAfterEdit);


		},

		// showing specific discount
		showSpecificDiscount: function(){

			var selected_discount_type = $(this).val();



			if (selected_discount_type) {

				// finding all the div having class 'common' in the discount_area div & adding the 'hide' class to all div
				var all_div_in_discount_area = $(".discount_area").find(".common");

				all_div_in_discount_area.each(function(index, element){

					$(element).addClass('hide');

				});
			// end of 'hide' class addition

			// removing the 'hide' class for the selected category
			$("." + selected_discount_type).removeClass('hide');
		}
		else{

			// finding all the div having class 'common' in the discount_area div & adding the 'hide' class to all div
			var all_div_in_discount_area = $(".discount_area").find(".common").not(".free_different");

			all_div_in_discount_area.each(function(index, element){

				$(element).addClass('hide');

			});
			// end of 'hide' class addition

		}

	},

		// showing the div for different free things
		showDifferentFreeProductArea: function(){

			var selected_free_product_type = $("input[name='free_product_type']:checked").val();

			// alert(selected_free_product_type);
			// checking the radio button selection
			if (selected_free_product_type == "free_different") {

				$('.free_different').removeClass('hide');

			} else {

				$('.free_different').addClass('hide');
			}

		},

		// posting new advertisement
		postAdvertisement: function(event){

			event.preventDefault();

			$('small').html("");

			$('.addAdvertisementForm div').removeClass('has-error');

			$('.addAdvertisementForm').nextAll('small').removeClass('has-error');

			form = $(this);

			method = form.find('input[name="_method"]').val() || 'POST';

			url = form.prop('action');

			formData = new FormData(this);
			
			$.ajax({

				type : method,

				url  : url,

				contentType: false,

				processData: false,

				data : formData,

			})
			.success(function(){

				form.trigger('reset');

				message = form.data('remote-success');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();


			})
			.error(function(jqXHR){

				if (jqXHR.status == 422) {

					errors = jqXHR.responseJSON;

					if (errors.ad_image) {
						$(".ad_image").html(errors.ad_image).parent("div").addClass('has-error');
					}
					if (errors.brand_id) {
						$(".brand_id").html(errors.brand_id).parent("div").addClass('has-error');
					}
					if (errors.branch_id) {
						$(".branch_id").html(errors.branch_id).parent("div").addClass('has-error');
					}
					if (errors.product_id) {
						$(".product_id").html(errors.product_id).parent("div").addClass('has-error');
					}
					if (errors.discount_type) {
						$(".discount_type").html(errors.discount_type).parent("div").addClass('has-error');
					}
					if (errors.actual_price) {
						$(".actual_price").html(errors.actual_price).parent("div").addClass('has-error');
					}
					if (errors.expire_date) {
						$(".expire_date").html(errors.expire_date).parent("div").addClass('has-error');
					}

				}
				else{

					$('.bb-alert').show().delay(3000).fadeOut();

				}

			});

		},

		// approving a pending advertisement
		showApproveAdvertisementModal : function(event){

			event.preventDefault();

			advertisement = $(this);

			advertisement_id = (this.id);

			$("#approveAdvertisementModal").modal('show');

			// adding the advertisement id to the modal hidden input field 
			$("#approveAdvertisementModal #advertisement_id").val(advertisement_id);

		},

		approveAdvertisement : function(){

			advertisement_id = $("#advertisement_id").val();

			$("#approveAdvertisementModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/approveadvertisement",

				data : {advertisement_id:advertisement_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Advertisement Approved Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.advertisements_table').load(currentPageUrl+' .advertisements_table');

			})
			.error(function(jqXHR){

			});		

		},

		// removing a pending product modal
		showRemoveAdvertisementModal : function(event){

			event.preventDefault();

			advertisement = $(this);

			advertisement_id = (this.id);

			$("#removeAdvertisementModal").modal('show');

			// adding the advertisement id to the modal hidden input field 
			$("#removeAdvertisementModal #advertisement_id").val(advertisement_id);

		},

		// removing a pending advertisement
		removeAdvertisement : function(){

			advertisement_id = $("#removeAdvertisementModal #advertisement_id").val();

			$("#removeAdvertisementModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/removeadvertisement",

				data : {advertisement_id:advertisement_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Advertisement Removed Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.advertisements_table').load(currentPageUrl+' .advertisements_table');

			})
			.error(function(jqXHR){

			});		

		},

		// removing a advertisement modal
		showRemoveApprovedAdvertisementModal : function(event){

			event.preventDefault();

			advertisement = $(this);

			advertisement_id = (this.id);

			$("#removeAdvertisementModal").modal('show');

			// adding the advertisement id to the modal hidden input field 
			$("#advertisement_id").val(advertisement_id);

		},

		// approving a advertisement from the advertisement detail page
		approveAdvertisementFromDetail : function(){

			advertisement_id = $("#advertisement_id").val();

			$("#approveAdvertisementModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/approveadvertisement",

				data : {advertisement_id:advertisement_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Advertisement Approved Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.advertisement_detail').load(currentPageUrl+' .single_advertisement');

			})
			.error(function(jqXHR){

			});		

		},

		// deleting a advertisement from the advertisement detail page
		removeApprovedAdvertisementFromDetail : function(){

			advertisement_id = $("#advertisement_id").val();

			$("#removeProductModal").modal('hide');

			$.ajax({

				type : "POST",

				url : "/removeadvertisement",

				data : {advertisement_id:advertisement_id},

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			})
			.success(function(jqXHR){

				$('.bb-alert').find('span').html("Advertisement Removed Successfully");

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				document.location.href = "/admin/advertisements/approved-ad";

			})
			.error(function(jqXHR){

			});		

		},

		// saving Advertisement after editing
		saveAdvertisementAfterEdit : function(event){

			event.preventDefault();

			$('small').html("");

			$('#editAdvertisementModal div').removeClass('has-error');

			$('#editAdvertisementModal').nextAll('small').removeClass('has-error');

			form = $(this);

			method = form.find('input[name="_method"]').val() || 'POST';

			url = form.prop('action');

			formData = new FormData(this);
			
			$.ajax({

				type : method,

				url  : url,

				contentType: false,

				processData: false,

				data : formData,

			})
			.success(function(){

				form.trigger('reset');

				$("#editAdvertisementModal").modal('hide');				

				message = form.data('remote-success');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.advertisement_detail').load(currentPageUrl+' .single_advertisement');
			})
			.error(function(jqXHR){

				if (jqXHR.status == 422) {

					errors = jqXHR.responseJSON;

					if (errors.ad_image) {
						$(".ad_image").html(errors.ad_image).parent("div").addClass('has-error');
					}
					if (errors.brand_id) {
						$(".brand_id").html(errors.brand_id).parent("div").addClass('has-error');
					}
					if (errors.branch_id) {
						$(".branch_id").html(errors.branch_id).parent("div").addClass('has-error');
					}
					if (errors.product_id) {
						$(".product_id").html(errors.product_id).parent("div").addClass('has-error');
					}
					if (errors.discount) {
						$(".discount").html(errors.discount).parent("div").addClass('has-error');
					}
					if (errors.actual_price) {
						$(".actual_price").html(errors.actual_price).parent("div").addClass('has-error');
					}
					if (errors.expire_date) {
						$(".expire_date").html(errors.expire_date).parent("div").addClass('has-error');
					}

				}
				else{

					$('.bb-alert').show().delay(3000).fadeOut();

				}

			});

		},

	};

	$(function(){

		adviertisementManager.init();
	});

})(jQuery);

// profile manager
(function($){

	var profileManager = {

		init: function(){

			var form,url,method,data,message,currentPageUrl,formData,errors;

			// saving the profile picture of admin/owner
			$(".profile").on('submit','.profile_right form[data-remote]',this.saveProfilePicture);

		},

		// saving the profile picture
		saveProfilePicture: function(event){

			event.preventDefault();

			form = $(this);

			method = form.find('input[name="_method"]').val() || 'POST';

			url = form.prop('action');

			formData = new FormData(this);
			
			$.ajax({

				type : method,

				url  : url,

				contentType: false,

				processData: false,

				data : formData,

			})
			.success(function(){

				form.trigger('reset');

				message = form.data('remote-success');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();

				currentPageUrl = window.location.href;

				$('.profile_right').load(currentPageUrl+' .profile_image');


			})
			.error(function(jqXHR){

				alert("error");

			});

		},

	};

	$(function(){

		profileManager.init();

	});

})(jQuery);