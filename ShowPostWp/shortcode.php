<?php

use \Shortcode\Controller\ShowPost\ShowPostShortcodeController as ShowPostShortcodeController;

if(!function_exists("init_shortcode")) {
  function init_show_post_shortcode() {
    $gridInstance = new ShowPostShortcodeController();
    return $gridInstance;
  }
}

if(!function_exists("run")) {
  function run() {
    return init_show_post_shortcode();
  }
}

run();