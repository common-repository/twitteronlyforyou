<?php
/**********************************************@@SAMPLE@@  Initialize Menu **********************************************/
add_action('admin_menu', 'rgjb_menu_page');

function rgjb_menu_page() {
    add_menu_page('custom menu title', 'Twitter For You', 'manage_options', 'twitterseting', 'rgjb_menu_page_detail', RGJB_PLUGIN_URL . '/images/sample-icon.ico');
}

function rgjb_menu_page_detail() {
    ?>

    <script>
        var ajax_url = "<?php echo AJAX_URL; ?>"; //Must define ajax url.
    </script>
    <div class="plugin_title_box">
        <img  src="<?php echo RGJB_PLUGIN_URL . '/images/sample-icon.ico'; ?>" class="plugin_titleimg">
        <span class="plugin_title" >Twitter Setting</span>
    </div>
    <div class="rgjb_err error" style="display:none;"></div>
    <div class="rgjb_succ updated fade" style="display:none;"></div>
    <?php
    /**********************************************Get options and display if option are there**********************************************/
    $api_key = get_option('api_key');
    $secret_key = get_option('secret_key');
    //$call_back=get_option('call_back');
    $enable=get_option('enable');
   ?>
    <div class="cls_loader"></div>
    <div class="main_div">
        <div><?php _e('Consumer Key','twitter_only_for_you'); ?></div>
        <div><input type="text" id="tw_apikey" name="tw_apikey" style="width:436px;" value="<?php echo!empty($api_key) ? $api_key : ''; ?>"/></div><br/>
        <div><?php _e('Consumer Secret','twitter_only_for_you'); ?></div>
        <div><input type="text" id="tw_secretkey" name="tw_secretkey" style="width:436px;" value="<?php echo!empty($secret_key) ? $secret_key : ''; ?>"/></div><br/>
<!--        <div><?php //_e('Callback Url','twitter_only_for_you'); ?></div>
        <div><input type="text" id="tw_callback" name="tw_callback" style="width:436px;" value="<?php // echo!empty($call_back) ? $call_back : ''; ?>"/></div><br/>-->
        <div><?php _e('Do you want to enable the login button?','twitter_only_for_you'); ?></div>
        <div><input type="checkbox" id="tw_enable" name="tw_enable" value="1" <?php echo ($enable=='1' && !empty($enable)) ? 'checked=checked' : ""; ?> /></div><br/>
        <div><input type="button" id="save_setting" name="tw_submit" value="Save Setting" /></div>
    </div>
    <?php
}
?>