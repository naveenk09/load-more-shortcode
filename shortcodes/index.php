<?php

if(file_exists( dirname(__FILE__) . '/shortcode-query.php')) {
    require_once(dirname(__FILE__) . '/shortcode-query.php');
}

if(file_exists( dirname(__FILE__) . '/js/enqueue-scripts.php')) {
    require_once(dirname(__FILE__) . '/js/enqueue-scripts.php');
}

if(file_exists( dirname(__FILE__) . '/load-more-ajax.php')) {
    require_once(dirname(__FILE__) . '/load-more-ajax.php');
}

if (file_exists( dirname( __FILE__ ) . '/theme-shortcodes.php' ) ) {
    require_once(dirname( __FILE__ ) .'/theme-shortcodes.php');
}

if (file_exists( dirname( __FILE__ ) . '/initiate-shortcode.php' ) ) {
    require_once(dirname( __FILE__ ) .'/initiate-shortcode.php');
}

if (file_exists( dirname( __FILE__ ) . '/get-shortcode-template.php' ) ) {
    require_once(dirname( __FILE__ ) .'/get-shortcode-template.php');
}