<?php
class Query {
    function query_nocat($post_type, $page_no, $posts_per_page, $order) {
        //method when don't have category
        $args = array(
            'post_type' => $post_type, 
            'order' => 'ASC', 
            'posts_per_page' => $posts_per_page, 
            'paged' => $page_no,
        );
        return new WP_Query( $args );
    }
    function query_cat($post_type, $cat, $page_no, $posts_per_page, $order) {
        $args = array(
            'post_type' => $post_type, 
            'order' => 'ASC', 
            'posts_per_page' => $posts_per_page, 
            'paged' => $page_no, 
            'tax_query' => array(
                array( 
                  'taxonomy' => 'product_cat',
                  'field' => 'slug',
                  'terms' => $cat,
                )
              )
        );

        return new WP_Query( $args );
    }
}