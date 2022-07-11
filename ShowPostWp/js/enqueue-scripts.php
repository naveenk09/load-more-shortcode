<?php
function load_more_scripts() {
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/inc/ShowPostWp/js/load_more.js', array('jquery', 'masnory-grid'), time(), true );
	wp_enqueue_script( 'images-loaded', get_stylesheet_directory_uri() . '/inc/ShowPostWp/js/imagesloaded.pkgd.min.js', array(), time(), true);
	wp_enqueue_script( 'masnory-grid', get_stylesheet_directory_uri() . '/inc/ShowPostWp/js/masonry.pkgd.min.js', array('images-loaded'), time(), true);
	$script_data_array = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'security' => wp_create_nonce( 'load_more_posts' ),
	  );

	wp_localize_script( 'custom-script', 'products', $script_data_array );

	wp_enqueue_style( 'load_more_style', get_stylesheet_directory_uri() . '/inc/ShowPostWp/css/show-post.css', false, rand(111, 9999));
}
add_action( 'wp_enqueue_scripts', 'load_more_scripts');