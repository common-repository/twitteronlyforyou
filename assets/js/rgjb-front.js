//(function($) { 
//	$(function() {
//		// ready to roll
//		
//		var _do_twitter_connect = function() {
//			var twitter_auth = jQuery('#social_connect_twitter_auth');
//			var redirect_uri = twitter_auth.find('input[type=hidden][name=redirect_uri]').val();
//
//			window.open(redirect_uri,'','scrollbars=no,menubar=no,height=400,width=800,resizable=yes,toolbar=no,status=no');
//		};
//
//		jQuery(".social_connect_login_twitter").on("click", function() {
//                    _do_twitter_connect();
//		});
//
//	});
//})(jQuery);

//window.wp_social_connect = function(config) {
//	jQuery('#loginform').unbind('submit.simplemodal-login');
//
//	var form_id = '#loginform';
//
//	if(!jQuery('#loginform').length) {
//		// if register form exists, just use that
//		if(jQuery('#registerform').length) {
//			form_id = '#registerform';
//		} else {
//			// create the login form
//			var login_uri = jQuery("#social_connect_login_form_uri").val();
//			jQuery('body').append("<form id='loginform' method='post' action='" + login_uri + "'></form>");
//			if (!jQuery('#setupform').length) {
//				jQuery('#loginform').append("<input type='hidden' id='redirect_to' name='redirect_to' value='" + window.location.href + "'>");
//			}
//		}
//	}
//        
//	jQuery.each(config, function(key, value) { 
//		jQuery("#" + key).remove();
//		jQuery(form_id).append("<input type='hidden' id='" + key + "' name='" + key + "' value='" + value + "'>");
//	});  
//
//	if(jQuery("#simplemodal-login-form").length) {
//		var current_url = window.location.href;
//		jQuery("#redirect_to").remove();
//		jQuery(form_id).append("<input type='hidden' id='redirect_to' name='redirect_to' value='" + current_url + "'>");
//	}
//
//	jQuery(form_id).submit();
//}