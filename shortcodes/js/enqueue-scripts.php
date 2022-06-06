<?php
function load_more_scripts() {
    wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/inc/shortcodes/js/load_more.js', array('jquery'), time(), true );
	$script_data_array = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'security' => wp_create_nonce( 'load_more_posts' ),
	  );

	wp_localize_script( 'custom-script', 'products', $script_data_array );
}
add_action( 'wp_enqueue_scripts', 'load_more_scripts');