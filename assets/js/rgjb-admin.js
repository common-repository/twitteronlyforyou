/********** Used That Function For Make Ajax Call ***************/
function RGJBajaxcallfunction(data, callback) {
    jQuery.ajax({
        type: "POST",
        url: ajax_url,
        data: data,
        beforeSend: function() {
            jQuery('.cls_loader').show();
        },
        success: function(data) {
            callback(data);
        },
        complete: function() {
            jQuery('.cls_loader').hide();
        }
    });
}
// var _do_twitter_connect = function() {
//        var twitter_auth = jQuery('#social_connect_twitter_auth');
//        var redirect_uri = twitter_auth.find('input[type=hidden][name=redirect_uri]').val();
//
//        window.open(redirect_uri, '', 'scrollbars=no,menubar=no,height=400,width=800,resizable=yes,toolbar=no,status=no');
//    };
/**********************************************Used to save the settings **********************************************/
jQuery(document).ready(function() {
    jQuery('#save_setting').click(function() {
        var api_key = jQuery('#tw_apikey').val();
        var secret_key = jQuery('#tw_secretkey').val();
        var call_back = jQuery('#tw_callback').val()
        var enable = '';
        if (jQuery('#tw_enable').prop('checked') == true)
        {
            enable = 1;
        } else {
            enable = 0;
        }
        var data = {
            action: "RGJB_ajax_call", //It's Common For all Ajax Call
            action_name: "save_settings",
            api_key: api_key,
            secret_key: secret_key,
            call_back: call_back,
            tw_enable: enable
        };
        RGJBajaxcallfunction(data, function(result) {
            if (result == 'err') {
                jQuery('.rgjb_succ').css("display", "none");
                jQuery('.rgjb_err').html("<p>There are some problem to save settings.</p>");
                jQuery('.rgjb_err').css("display", "block");
            } else {
                jQuery('.rgjb_succ').css("display", "block");
                jQuery('.rgjb_succ').html("<p>User Data Saved Successfully</p>");
                jQuery('.rgjb_err').css("display", "none");
            }
        });
    });
    
//       jQuery(".social_connect_login_twitter").on("click", function() {
//          _do_twitter_connect();
//    });
});