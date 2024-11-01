<?php
class RGJBShortcode {

    public function __construct() {
        add_shortcode('twitter', array($this, 'shortcode'));
    }

    public function shortcode($atts) {
        extract(shortcode_atts(array(
            'name' => "rgjb twitter",
            'author' => "RGJB",
                        ), $atts));
        return '<a href="#"><img src='.RGJB_PLUGIN_URL.'/images/lighter.png /></a>';
    }
}
$RGJBShortcode = new RGJBShortcode();
?>