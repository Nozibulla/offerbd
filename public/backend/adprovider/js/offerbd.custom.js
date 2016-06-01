$(document).ready(function(){


	$.fn.editable.defaults.mode = 'inline';//inline editing activate

	$("#first_name").editable({

		type: 'text',

		url: '/SAdPI',//save adprovider profile info

		ajaxOptions:{

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

		},
		success: function(msg){

		}

	});

	$("#last_name").editable({

		type: 'text',

		url: '/SAdPI',

		ajaxOptions:{

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

		},
		success: function(msg){}  

	});

	$("#mobile").editable({

		type: 'text',

		url: '/SAdPI',

		ajaxOptions:{

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

		},
		success: function(msg){}  

	});

	$("#address").editable({

		type: 'text',

		url: '/SAdPI',

		ajaxOptions:{

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

		},
		success: function(msg){}

	});

});

$( document ).ajaxStart(function(event, jqxhr, ajaxOptions, errorThrown) {

	$('.overlay').show();
});


$( document ).ajaxStop(function(event, jqxhr, ajaxOptions, errorThrown) {

	$('.overlay').hide();
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

	// showing the set profile warning modal
	$("#setProfile").modal({

		show: true,

		backdrop: 'static',

		keyboard: false

	});

});

// creating brand manager for adprovider
(function($){

	var brandManager = {

		init: function(){

			var form,url,method,data,message,currentPageUrl,formData;

			// adding new brand
			$(".add_brand").on('submit','.addBrandForm form[data-remote]',this.addNewBrand);
		},

		// adding new brand for adprovider
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

				$(".val_error_brand_name").html("").parent("div").removeClass('has-error');

				form.trigger('reset');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();

			})
			.error(function(jqXHR){

				if (jqXHR.status == 422) {

					var errors = jqXHR.responseJSON;

					$(".val_error_brand_name").html(errors.brand_name).parent("div").addClass('has-error');

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

// creating category manager for adprovider
(function($){

	var categoryManager = {

		init: function(){

			var form,url,method,data,message,currentPageUrl,formData;

			//  adding a new category for adprovider
			$(".add_category").on("submit",".addCategoryForm form[data-remote]",this.addNewCategory);
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

// creating product manager for adprovider
(function($){

	var productManager = {

		init: function(){

			var form,url,method,data,message,currentPageUrl,formData;

			// adding a new product
			$(".add_product").on('submit','.addProductForm form[data-remote]',this.addNewProduct);

			// adding category from the add_product page
			$(".add_product").on('click','.addProductForm #add_category_button_from_product_page',this.showAddCategoryModal);
			$(".add_product").on('submit','#addCategoryModal form[data-remote]',this.addNewCategoryFromProductPage);

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

				url : "/adprovider/addnewcategory",

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

// creating a branch manager
(function($){

	var branchManager = {

		init : function(){

			var method,url,form,currentPageUrl,data,message,formData;

			// adding a new branch
			$(".add_branch").on('submit','.addBranchForm form[data-remote]',this.addNewBranch);

			// adding new brand from the add branch page
			$(".add_branch").on('click','.addBranchForm #add_brand_button_from_branch_page',this.showAddBrandModal);

			$(".add_branch").on('submit','#addBrandModal form[data-remote]',this.addNewBrandFromBranchPage);
		},

		// adding new branch
		addNewBranch : function(event){

			event.preventDefault();

			form = $(this);

			// clearing all the errors
			$(".val_error_branch_name, .val_error_brand_name").html("").parent("div").removeClass('has-error');

			// $(".val_error_brand_name").html("").parent("div").removeClass('has-error');

			formData =  branchManager.getFormData(form);

			$.ajax({

				method: formData.method,

				url : formData.url,

				data: formData.data,

			})
			.success(function(msg){

				message = form.data('remote-success');

				$(".val_error_branch_name, .val_error_brand_name").html("").parent("div").removeClass('has-error');

				// $(".val_error_brand_name").html("").parent("div").removeClass('has-error');

				form.trigger('reset');

				$('.bb-alert').find('span').html(message);

				$('.bb-alert').show().delay(3000).fadeOut();

			})
			.error(function(jqXHR){

				if (jqXHR.status == 422) {

					var errors = jqXHR.responseJSON;

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

		// adding brand from the add branch page
		showAddBrandModal : function(event){

			$("#addBrandModal").modal('show');

		},

		addNewBrandFromBranchPage : function(event){

			event.preventDefault();

			form = $(this);

			formData =  branchManager.getFormData(form);

			$.ajax({

				method: formData.method,

				url : "/adprovider/addnewbrand",

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

		branchManager.init();
	});
})(jQuery);

// creating advertisement manager
(function($){

	var advertisementManager = {

		init: function(){

			var form,url,method,data,message,currentPageUrl,formData,errors,advertisement,advertisement_id;

			// posting new advertisement
			$(".post_advertisement").on('submit','.addAdvertisementForm form[data-remote]',this.postAdvertisement);
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

					// alert(errors.ad_image);

					if (errors.ad_image) {
						$(".no_image").html(errors.ad_image).parent("div").addClass('has-error');
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

		advertisementManager.init();

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