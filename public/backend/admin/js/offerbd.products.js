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