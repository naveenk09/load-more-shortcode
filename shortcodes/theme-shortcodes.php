<?php

//add_shortcode('custom', 'custom_shortcode_function');

class CustomShortcode {

    function __construct() {
        add_shortcode('show_post', array($this, 'load_more_shortcode'));
    }

    //Load More Shortcode
    public function load_more_shortcode($atts){
        ob_start();
        $attr = shortcode_atts(array(
            'post_type' => 'post',
            'posts_per_page' => 2,
            'taxonomy' => 'product_cat',
            'order' => 'ASC',
            'category_filter' => 'yes',
        ), $atts);
        $logic = new InitShortcode();
        $logic -> load_more_logic($attr);
        return ob_get_clean();
    }
}


function runShortcode() {
    return new CustomShortcode();
}
runShortcode(); 