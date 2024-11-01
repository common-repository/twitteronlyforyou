<?php
add_action("wp_ajax_RGJB_ajax_call", "RGJB_ajax_call");
function RGJB_ajax_call($ajax_action) {
    $ajax_action = $_POST['action_name'];
    switch ($ajax_action) {

        case 'save_settings':
            if (!empty($_POST['api_key']) && !empty($_POST['secret_key']) && (!empty($_POST['tw_enable']) || $_POST['tw_enable']==0)) {
                update_option('api_key', $_POST['api_key']);
                update_option('secret_key', $_POST['secret_key']);
                //update_option('call_back',$_POST['call_back']);
                update_option('enable',$_POST['tw_enable']);
            } else {
                echo 'err';
            }
            break;
        default:
            echo "Function not Found!";
            break;
    }
    die();
}
?>