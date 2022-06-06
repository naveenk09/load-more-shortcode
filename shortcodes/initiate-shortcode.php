<?php


class InitShortcode {


    function load_more_logic($attributes){
        $post_type = esc_attr($attributes['post-type']);
        $cat = esc_attr($attributes['category']);   
        if( $cat == ''){
            // $args = array(
            //     'post_type' => $post_type, 
            //     'order' => 'ASC', 
            //     'posts_per_page' => 5, 
            //     'paged' => 1,
            // );
            $query_obj = new Query();
            $query = $query_obj -> query_nocat($post_type, 1);
        }
        else{
            // $args = array(
            //     'post_type' => $post_type, 
            //     'order' => 'ASC', 
            //     'posts_per_page' => 5, 
            //     'paged' => 1, 
            //     'tax_query' => array(
            //         array( 
            //           'taxonomy' => 'product_cat',
            //           'field' => 'slug',
            //           'terms' => array($cat),
            //         )
            //       )
            // );
            $query_obj = new Query();
            $query = $query_obj -> query_cat($post_type, $cat, 1);

        }
        $pages = $query -> max_num_pages;
        do_action('load_more_container', $post_type, $cat, $pages, 1);

        $pass_query = new OutputData();
        $pass_query -> load_more($query);
    }

    
}