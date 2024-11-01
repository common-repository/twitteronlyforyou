<?php

if (!class_exists('TwitterOAuth')) {
    require_once 'twitteroauth/twitteroauth.php';
}
/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
/* Request access tokens from twitter */
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
/* Save the access tokens. Normally these would be saved in a database for future use. */
$_SESSION['access_token'] = $access_token;
/* Remove no longer needed request tokens */
unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);
/* If HTTP response is 200 continue otherwise send to connect page to retry */
if (200 == $connection->http_code) {
    /* The user has been verified and the access tokens can be saved for future use */
    $_SESSION['status'] = 'verified';
    $user = $connection->get('account/verify_credentials');
    // print_r($user);
    $name = $user->name;
    $screen_name = $user->screen_name;
    $twitter_id = $user->id;
    $avatar = $user->profile_image_url;
    //$signature = social_connect_generate_signature($twitter_id);
    //$sc_name = $_REQUEST['social_connect_name'];
    $names = explode(' ', $name, 2);
    $sc_first_name = $names[0];
    $sc_last_name = $names[1];
    $sc_screen_name = $screen_name;
    $sc_avatar = isset($_REQUEST['social_connect_avatar']) ? str_replace('http:', '', $_REQUEST['social_connect_avatar']) : '';
    $sc_profile_url = '';
    // Get host name from URL
    $site_url = parse_url(site_url());
    $sc_email = '';
    $user_login = $sc_screen_name;
    //$user_login = sc_get_unique_username($user_login);
    $random_password = wp_generate_password($length = 12, $include_standard_special_chars = false);
    $userdata = array('user_login' => $user_login, 'user_email' => $sc_email, 'first_name' => $sc_first_name, 'last_name' => $sc_last_name, 'user_url' => $sc_profile_url, 'user_pass' => $random_password);
    // Create a new user
    global $wpdb;
    $users = $wpdb->get_col("SELECT meta_value FROM $wpdb->prefix" . "usermeta WHERE meta_key='twitter_key'");
    if (username_exists($user_login) || in_array($twitter_id, $users)) {
        
        wp_redirect(home_url('wp-login.php?status=exist'));
        
    } else {
        $user_id = wp_insert_user(apply_filters('social_connect_insert_user', $userdata));
        if ($user_id && is_integer($user_id)) {
            update_user_meta($user_id, 'twitter_key', $twitter_id);
        }
        do_action('social_connect_inserted_user', $user_id, 'twitter');
        wp_set_auth_cookie($user_id, false, is_ssl());
        wp_redirect(admin_url('profile.php'));
    }
    exit;
?>
<?php
} else {
    /* Save HTTP status for error dialog on connnect page. */
    echo 'Login error';
}
?>