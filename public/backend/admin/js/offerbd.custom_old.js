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


$( document ).ajaxStart(function(event, jqxhr, ajaxOptions, errorThrown) {


});


$(document).ajaxSuccess(function(event, jqxhr, ajaxOptions, errorThrown){

	var contentType   = jqxhr.getResponseHeader("Content-Type");

	var responseBody  = jqxhr.responseText;

	$('.bb-alert').removeClass('alert-danger').addClass('alert-info');

});

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
	$("#approveBrandModal, #removeBrandModal, #editBrandModal, #addBrandModal, #approveBranchModal, #removeBranchModal, #editBranchModal, #addBranchModal, #approveCategoryModal, #removeCategoryModal, #editCategoryModal, #addCategoryModal").modal({

		show: false,

		backdrop: 'static',

		keyboard: false

	});

});


(function($){

	//  creating brandManager
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

			$(".brand_detail").on('click','#removeBrandModal #removeBrandYes',this.removeApprovedBrand);

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

				//dataType: 'json',

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

				$('.brands_table').load(currentPageUrl+' .brands_table');

			})
			.error(function(jqXHR){

			});		

		},

		// removing a approved brand
		showRemoveApprovedBrandModal : function(event){

			event.preventDefault();

			var brand = $(this);

			var brand_id = (this.id);

			$("#removeBrandModal").modal({

				show : true

			});

			// adding the brand id to the modal hidden input field 
			$("#brand_id").val(brand_id);

		},

		removeApprovedBrand : function(){

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

			$(".approved_branch_detail").on('click','#removeBranchModal #removeBranchYes',this.removeApprovedBranchFromDetail);

			// approving a branch from the branch detail page
			// $(".branch_option").on('click','.branch_edit_delete .approve_brand',this.showApprovedBranchDetailModal);

			$(".approved_branch_detail").on('click','#approveBranchModal #approveBranchYes',this.approveBranchFromDetail);

			// save Brand after editing
			$(".approved_branch_detail").on('submit','#editBranchModal form[data-remote]',this.saveBranchAfterEdit);


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

		// approving a pending brand
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

		// removing a pending brand
		showRemoveBranchModal : function(event){

			event.preventDefault();

			var branch = $(this);

			var branch_id = (this.id);

			$("#removeBranchModal").modal('show');

			// adding the brand id to the modal hidden input field 
			$("#removeBranchModal #branch_id").val(branch_id);

		},

		removeBranch : function(){

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

			alert(category_id);

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
