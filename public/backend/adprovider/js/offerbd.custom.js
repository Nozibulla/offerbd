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