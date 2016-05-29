(function($){

	var adviertisementManager = {

		init: function(){

			var form,url,method,data,message,currentPageUrl,formData,errors,advertisement,advertisement_id;

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