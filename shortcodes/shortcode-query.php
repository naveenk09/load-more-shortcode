<?php
class Query {
    function query_nocat($post_type, $page_no) {
        //method when don't have category
        $args = array(
            'post_type' => $post_type, 
            'order' => 'ASC', 
            'posts_per_page' => 5, 
            'paged' => $page_no,
        );
        return new WP_Query( $args );
    }
    function query_cat($post_type, $cat, $page_no) {
        $args = array(
            'post_type' => $post_type, 
            'order' => 'ASC', 
            'posts_per_page' => 5, 
            'paged' => $page_no, 
            'tax_query' => array(
                array( 
                  'taxonomy' => 'product_cat',
                  'field' => 'slug',
                  'terms' => array($cat),
                )
              )
        );

        return new WP_Query( $args );
    }
}