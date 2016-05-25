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