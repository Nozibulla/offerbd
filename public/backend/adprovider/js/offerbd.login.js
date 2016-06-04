// global ajaxStart function
$( document ).ajaxStart(function(event, jqxhr, ajaxOptions, errorThrown) {

	$(".overlay").show();
});

// global ajaxStop function
$( document ).ajaxStop(function(event, jqxhr, ajaxOptions, errorThrown) {

	$(".overlay").hide();
});

// global ajaxSuccess function
$(document).ajaxSuccess(function(event, jqxhr, ajaxOptions, errorThrown){

	var contentType   = jqxhr.getResponseHeader("Content-Type");

	var responseBody  = jqxhr.responseText;

	$('.bb-alert').removeClass('alert-danger').addClass('alert-info');

});

// global ajaxError function
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




// login manager
(function($){

	var authManager = {

		init: function(){

			var form,url,method,data,message,currentPageUrl,formData,errors;

			// adprovider login
			$('.adprovider_login').on('submit','.loginForm form[data-remote]',this.adproviderLogin);

			// adprovider registration
			$('.adprovider_registration').on('submit','.registrationForm form[data-remote]',this.adproviderRegistration);

			// password resetting
			// sending email
			$('.password_reset_email').on('submit','.sendEmailForm form[data-remote]',this.sendPasswordResetEmail);
			// resetting new password
			$('.adprovider_password_reset').on('submit','.passwordResetForm form[data-remote]',this.setNewPassword);
			

		},

		// logging of an adprovider
		adproviderLogin: function(event){

			event.preventDefault();

			// clearing the error
			$('.match_error').html("");

			$('.ls_div').hide();

			$('.error_div').hide();

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

					// login successful
					$('.login_successful').html(message);

					$('.ls_div').show();

					document.location.href = "/adprovider/dashboard"; 

				}
				else if (msg == 2) {

					// email isn't verified yet
					$('.match_error').html("Please confirm your email first.");

					$('.error_div').show();

				}
				 else {

				 	// email and password doesn't match
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

		// registering an adprovider
		adproviderRegistration: function(event){

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