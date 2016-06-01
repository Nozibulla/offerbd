$( document ).ajaxStart(function(event, jqxhr, ajaxOptions, errorThrown) {

	$(".overlay").show();
});

$( document ).ajaxStop(function(event, jqxhr, ajaxOptions, errorThrown) {

	$(".overlay").hide();
});



// login manager
(function($){

	var authManager = {

		init: function(){

			var form,url,method,data,message,currentPageUrl,formData,errors;

			// admin login
			$('.admin_login').on('submit','.loginForm form[data-remote]',this.adminLogin);

			// admin registration
			$('.admin_registration').on('submit','.registrationForm form[data-remote]',this.adminRegistration);

			// password resetting
			// sending email
			$('.password_reset_email').on('submit','.sendEmailForm form[data-remote]',this.sendPasswordResetEmail);
			// resetting new password
			$('.admin_password_reset').on('submit','.passwordResetForm form[data-remote]',this.setNewPassword);

		},

		// logging of an admin (both owner/administrator)
		adminLogin: function(event){

			event.preventDefault();

			form = $(this);

			formData = authManager.getFormData(form);

			$.ajax({

				method : formData.method,

				url : formData.url,

				data : formData.data,

			})
			.success(function(msg){

				message = form.data('remote-success');

				if (msg == 1) {

					$('.login_successful').html(message);

					$('.ls_div').show();

					document.location.href = "/admin/dashboard"; 

				} else {

					$('.match_error').html("Credentials don't match.");

					$('.error_div').show();
				}  
				
			})
			.error(function(jqXHR){

				errors = jqXHR.responseJSON;

				if(jqXHR.status == 422){

					if(errors.email){

						$(".req_email").html(errors.email).parent("div").addClass('has-error');
					}
					if(errors.password){

						$(".req_password").html(errors.password).parent("div").addClass('has-error');
					}
				}

			});
		},

		// registering an admin
		adminRegistration: function(event){

			event.preventDefault();

			form = $(this);

			formData = authManager.getFormData(form);

			$.ajax({

				method : formData.method,

				url : formData.url,

				data : formData.data,

			})
			.success(function(msg){

				form.trigger('reset');

				message = form.data('remote-success');

				$('.reg_successful').html(message);

				$('.rs_div').show();

				document.location.href = "/admin/login";
				
			})
			.error(function(jqXHR){

				errors = jqXHR.responseJSON;

				if(jqXHR.status == 422){

					if(errors.email){

						$(".req_email").html(errors.email).parent("div").addClass('has-error');
					}
					if(errors.password){

						$(".req_password").html(errors.password).parent("div").addClass('has-error');
					}
					if(errors.confirm_password){

						$(".req_confirm_password").html(errors.confirm_password).parent("div").addClass('has-error');
					}
				}

			});

		},

		// sending password reset email
		sendPasswordResetEmail: function(event){

			event.preventDefault();

			form = $(this);

			formData = authManager.getFormData(form);

			$.ajax({

				method : formData.method,

				url : formData.url,

				data : formData.data,

			})
			.success(function(msg){

				message = form.data('remote-success');

				// showing the successful div with message

				$('.se_successful').html(message);

				$('.send_email_div').show();
				
			})
			.error(function(jqXHR){

				errors = jqXHR.responseJSON;

				if(jqXHR.status == 422){

					if(errors.email){

						$(".req_email").html(errors.email).parent("div").addClass('has-error');
					}
				}

			});
		},

		// setting new password
		setNewPassword: function(event){

			event.preventDefault();

			// clearing all the error

			form = $(this);

			formData = authManager.getFormData(form);

			$.ajax({

				method : formData.method,

				url : formData.url,

				data : formData.data,

			})
			.success(function(msg){

				message = form.data('remote-success');

				// showing the successful div with message

				$('.pr_successful').html(message);

				$('.password_reset_successful_div').show();
				
			})
			.error(function(jqXHR){

				errors = jqXHR.responseJSON;

				if(jqXHR.status == 422){

					if(errors.email){

						$(".req_email").html(errors.email).parent("div").addClass('has-error');
					}
					if(errors.password){

						$(".req_password").html(errors.password).parent("div").addClass('has-error');
					}
					if(errors.confirm_password){

						$(".req_confirm_password").html(errors.confirm_password).parent("div").addClass('has-error');
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

		authManager.init();

	});

})(jQuery);