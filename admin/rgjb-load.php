<?php
add_action('init', 'rgjb_control_init',11);
function rgjb_control_init() {
        if(is_admin()){
            rgjb_control_init_admin();
        }else{
            rgjb_control_init_front();
        }
}

function rgjb_control_init_admin(){
     wp_enqueue_script('js-admin', RGJB_PLUGIN_URL.'/assets/js/rgjb-admin.js', array(), '1.0.0', false);
     wp_enqueue_style('css-admin', RGJB_PLUGIN_URL.'/assets/css/rgjb-admin.css', array(), '1.0.0', false);
}
function rgjb_control_init_front(){
    wp_register_script('my-front',RGJB_PLUGIN_URL. '/assets/js/rgjb-front.js',array( 'jquery' ));
    wp_enqueue_script( 'my-front' );
    wp_enqueue_style('css-front', RGJB_PLUGIN_URL.'/assets/css/rgjb-front.css', array(), '1.0.0', false);
}

/*****************************************ALL ADMIN ACTION ***********************************************/
if(is_admin()){
/******************************* ACTIVATION and DEACTIVATION  Hook *************************************/

/* * *********************************** GET REQUIRED FILES ************************************************ */
require_once RGJB_PLUGIN_DIR . '/admin/admin.php'; /***Call Main Admin File(Contain New Menu and Pages etc...)***/
}
?>