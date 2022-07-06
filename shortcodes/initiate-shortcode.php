<?php


class InitShortcode {


    function load_more_logic($attributes){
        $post_type = esc_attr($attributes['post_type']);
        $posts_per_page = esc_attr($attributes['posts_per_page']);
        $taxonomy = esc_attr( $attributes['taxonomy']);
        $order = esc_attr( $attributes['order']);
        $category_filter = esc_attr( $attributes['category_filter']);//Specifies whether to include category filter or not
        $terms = get_terms( array( 
            'taxonomy' => $taxonomy,
            'parent'   => 0
        ));

        $query_obj = new Query();
        $query = $query_obj -> query_nocat($post_type, 1, $posts_per_page, $order);

        $pages = $query -> max_num_pages;
        $pass_query = new OutputData();
        $pass_query -> load_more($query, $terms, $post_type, $pages, $posts_per_page, $taxonomy, $order, $category_filter);
    }
    
}