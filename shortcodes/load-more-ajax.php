<?php

//Container div
add_action('container_div', 'add_container_div', 10, 1);
function add_container_div($category_filter) {
	echo "<div class='show-post-container' data-cat_filter='$category_filter'>";
}

//Load More Shortcode Container
add_action('load_more_container', 'add_load_more_container', 10, 6);
function add_load_more_container($post_type, $pages, $page_no, $posts_per_page, $taxonomy, $order) {
	echo "<div class='show-post-content three-post-layout' data-post = '$post_type'  data-max_pages = $pages data-page_no = $page_no data-ppp = $posts_per_page data-taxonomy= $taxonomy data-order=$order> ";
}
add_action('closing_load_more', 'add_closing_load_more');
function add_closing_load_more() {
    echo "</div>";
}

function load_more_callback() {
	//If category value in ajax request is empty string then load the items of custom post type without taxonomy
	if( empty($_POST['category'])){
		$query_obj = new Query();
		$ajaxposts = $query_obj -> query_nocat($_POST['postType'], $_POST['paged'], $_POST['posts_per_page'], $_POST['order']);
	}
	else {
		$query_obj = new Query();
		$ajaxposts = $query_obj -> query_cat($_POST['postType'], $_POST['category'], $_POST['paged'], $_POST['posts_per_page'], $_POST['order']);
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