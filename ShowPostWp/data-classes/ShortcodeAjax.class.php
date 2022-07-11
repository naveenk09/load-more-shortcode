<?php
use \Shortcode\Data\Model\ShortcodeQuery as ShortcodeQuery;
use \Shortcode\View\LayoutView as LayoutView;

function load_more_callback() {

    $jsonObject = $_POST['object'];
    // var_dump($jsonObject);
    // var_dump($jsonObject["post_type"]);
    // var_dump($jsonObject['categoryArray']);
    $queryInstance = new ShortcodeQuery();
    $layoutView = new LayoutView($layout);



    $queryInstance -> setPostType($jsonObject["post_type"]);
    $queryInstance -> setPostPerPage((int)$jsonObject["posts_per_page"]);
    $queryInstance -> setOrder($jsonObject["order"]);
    $queryInstance -> setPageNumber((int)$jsonObject["paged"]);
    

    // var_dump(json_decode($jsonObject));
	//If category value in ajax request is empty string then load the items of custom post type without taxonomy
	if( $jsonObject['categoryArray'] == NULL){
        $queryArray = array(
            "post_type" => $queryInstance -> getPostType(),
            "posts_per_page" => $queryInstance -> getPostPerPage(),
            "order" => $queryInstance -> getOrder(),
            "paged" => $queryInstance -> getPageNumber(),
        );
        $ajaxposts = $queryInstance -> fulfill($queryArray);
	}
	else {
        $queryInstance -> setTaxonomy($jsonObject["taxonomy"]);
        $queryArray = array(
            "post_type" => $queryInstance -> getPostType(),
            "posts_per_page" => $queryInstance -> getPostPerPage(),
            "order" => $queryInstance -> getOrder(),
            "paged" => $queryInstance -> getPageNumber(),
            "tax_query" => array(
                array( 
                  "taxonomy" => $queryInstance -> getTaxonomy(),
                  "field" => "slug",
                  "terms" => $jsonObject['categoryArray'],
                )
              )
        );
        $ajaxposts = $queryInstance -> fulfill($queryArray);
}
  
	$response = '';
  
	if($ajaxposts->have_posts()) {
		ob_start();
	  while($ajaxposts->have_posts()) : $ajaxposts->the_post();
		$response .= $layoutView->getTemplateView();
	  endwhile;
	  $output = ob_get_contents();
	  //get the maximum number of pages for the post type
	  $max_pages = $ajaxposts ->max_num_pages;
	  ob_end_clean();
	} else {
	  $response = '';
	}
  // json_encode($output);
  $result = [
		'max' => $max_pages,
		'html' => $output,
		'paged' => $queryInstance -> getPageNumber(),
	];
  
	echo json_encode($result);
	exit;
  }
  add_action('wp_ajax_load_more', 'load_more_callback');
  add_action('wp_ajax_nopriv_load_more', 'load_more_callback');