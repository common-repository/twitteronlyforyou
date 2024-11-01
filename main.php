<?php

/*
  Plugin Name: Twitter Only For You
  Plugin URI: http://www.ronniewebsolutions.com
  Description: This plugin is use for connect your resource with twitter. *Login with twitter, *Get feeds of twitter, *Get feeds by user and hashtag feeds.
  Author: Rws
  Text Domain: RGJB
  Version: 1.0.0
 */
/* * **************** Intialization Of Plugin ****************** */
define('RGJB__VERSION', '1.0.0');

if (!defined('RGJB_PLUGIN_BASENAME'))
    define('RGJB_PLUGIN_BASENAME', plugin_basename(__FILE__));

if (!defined('RGJB_PLUGIN_NAME'))
    define('RGJB_PLUGIN_NAME', trim(dirname(RGJB_PLUGIN_BASENAME), '/'));

if (!defined('RGJB_PLUGIN_DIR'))
    define('RGJB_PLUGIN_DIR', untrailingslashit(dirname(__FILE__)));

if (!defined('RGJB_PLUGIN_URL'))
    define('RGJB_PLUGIN_URL', untrailingslashit(plugins_url('', __FILE__)));

if (!defined('SITE_URL'))
    $siteurl = get_option('siteurl');
define('SITE_URL', $siteurl);

if (!defined('AJAX_URL'))
    define('AJAX_URL', untrailingslashit(admin_url('admin-ajax.php')));

/* * *********************************** GET REQUIRED FILES ************************************************ */
require_once RGJB_PLUGIN_DIR . '/admin/rgjb-load.php'; /* * * Load All Plugin Code ** */
require_once RGJB_PLUGIN_DIR . '/admin/classes/rgjb-plugin-ajax-call.php'; /* * * ADD Ajax Call For This Plugin [RWSSamplePlugin] ** */
require_once RGJB_PLUGIN_DIR . '/admin/classes/rgjb-plugin-shortcode.php'; /* * * ADD ShortCode For This Plugin [RWSSamplePlugin] ** */
require_once RGJB_PLUGIN_DIR . '/config.php';
//require_once RGJB_PLUGIN_DIR.'/twitter/connect.php';

register_activation_hook(__FILE__, 'rgjb_activate');
//deactivation hook
register_deactivation_hook(__FILE__, 'rgjb_deactivate');

/* * *****************************Include Activation data *********************************************** */

function rgjb_activate() {
    
}

function rgjb_deactivate() {
    
}

function rgjb_render_login_form_social_connect($args = NULL) {
    
    $display_label = false;
    $enable_tw = get_option('enable');
    if (!isset($images_url))
        $images_url = apply_filters('social_connect_images_url', RGJB_PLUGIN_URL . '/images/');
    if ($enable_tw == '1') {
        echo apply_filters('social_connect_login_twitter', '<a href="' . home_url('index.php?social-connect=twitter') . '" title="Twitter" class="social_connect_login_twitter"><img alt="Twitter" src="' . $images_url . 'lighter.png" /></a>');
    }
    if ($_GET['status']=='exist') {
        echo '<p class="message">Restricted area, please login to continue.</p><br/>';
    }
    
?>

<?php

}

add_action('login_form', 'rgjb_render_login_form_social_connect', 10);
add_action('register_form', 'rgjb_render_login_form_social_connect', 10);
add_action('after_signup_form', 'rgjb_render_login_form_social_connect', 10);
add_action('social_connect_form', 'rgjb_render_login_form_social_connect', 10);

function sc_parse_request($wp) {
   if (!session_id()) {
        session_start();
    }

    switch ($_REQUEST['social-connect']) {
        case 'twitter':
            require_once 'twitter/connect.php';
            break;
        case 'twitter_callback':
            require_once 'twitter/callback.php';
            break;
        default:
            break;
    }
    wp_die();
}
add_action('parse_request', 'sc_parse_request');
?>