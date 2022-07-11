<?php

define( 'FILE_DIR', dirname(__FILE__) );
define( 'FILE_TEMPLATE_DIR', FILE_DIR . '/template-parts/' );

if(file_exists( dirname(__FILE__) . '/interfaces/index.php')) {
    require_once(dirname(__FILE__) . '/interfaces/index.php');
}

if(file_exists( dirname(__FILE__) . '/data-classes/ShortcodeQuery.class.php')) {
    require_once(dirname(__FILE__) . '/data-classes/ShortcodeQuery.class.php');
}

if(file_exists( dirname(__FILE__) . '/data-classes/GenerateShortcodeQuery.class.php')) {
    require_once(dirname(__FILE__) . '/data-classes/GenerateShortcodeQuery.class.php');
}

if(file_exists( dirname(__FILE__) . '/view-classes/LayoutView.class.php')) {
    require_once(dirname(__FILE__) . '/view-classes/LayoutView.class.php');
}

if(file_exists( dirname(__FILE__) . '/controller-classes/ShowPostShortcodeController.class.php')) {
    require_once(dirname(__FILE__) . '/controller-classes/ShowPostShortcodeController.class.php');
}

if(file_exists( dirname(__FILE__) . '/shortcode.php')) {
    require_once(dirname(__FILE__) . '/shortcode.php');
}

if(file_exists( dirname(__FILE__) . '/data-classes/ShortcodeAjax.class.php')) {
    require_once(dirname(__FILE__) . '/data-classes/ShortcodeAjax.class.php');
}

if(file_exists( dirname(__FILE__) . '/js/enqueue-scripts.php')) {
    require_once(dirname(__FILE__) . '/js/enqueue-scripts.php');
}
