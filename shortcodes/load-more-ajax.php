<?php

//Load More Shortcode Container
add_action('load_more_container', 'add_load_more_container', 10, 4);
function add_load_more_container($post_type, $cat, $pages, $page_no) {
	echo "<div class='load-more-container' data-post = '$post_type' data-category = '$cat' data-max_pages = $pages data-page_no = $page_no> ";
}
add_action('closing_load_more', 'add_closing_load_more');
function add_closing_load_more() {
    echo "</div>";
}

function load_more_callback() {
	//If category value in ajax request is empty string then load the items of custom post type without taxonomy
	if( $_POST['category'] == '' ){
		$query_obj = new Query();
		$ajaxposts = $query_obj -> query_nocat($_POST['postType'], $_POST['paged']);
		// $ajaxposts = new WP_Query([
		// 	'post_type' => $_POST['postType'],
		// 	'posts_per_page' => 5,
		// 	'order' => 'ASC',
		// 	'paged' => $_POST['paged'],
		//   ]);
	}
	else {
		$query_obj = new Query();
		$ajaxposts = $query_obj -> query_cat($_POST['postType'], $_POST['category'], $_POST['paged']);
	// $ajaxposts = new WP_Query([
	//   'post_type' => $_POST['postType'],
	//   'posts_per_page' => 5,
	//   'order' => 'ASC',
	//   'paged' => $_POST['paged'],
	//   'tax_query' => array(
	// 	array( 
	// 	  'taxonomy' => 'product_cat',
	// 	  'field' => 'slug',
	// 	  'terms' => array($_POST['category']),
	// 	)
	//   )
	// ]);
}
  
	$response = '';
  
	if($ajaxposts->have_posts()) {
		ob_start();
	  while($ajaxposts->have_posts()) : $ajaxposts->the_post();
		$response .= get_template_part('inc/shortcodes/shortcode-template/load-more');
	  endwhile;
	  $output = ob_get_contents();
	  //get the maximum number of pages for the post type
	  $max_pages = $ajaxposts ->max_num_pages;
	  ob_end_clean();
	} else {
	  $response = '';
	}
	$result = [
		'max' => $max_pages,
		'html' => $output,
		'paged' => $_POST['paged'],
	];
  
	echo json_encode($result);
	exit;
  }
  add_action('wp_ajax_load_more', 'load_more_callback');
  add_action('wp_ajax_nopriv_load_more', 'load_more_callback');