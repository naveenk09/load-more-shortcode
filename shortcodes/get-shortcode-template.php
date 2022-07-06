<?php

// add_action('custom_shortcode_op', 'output_text', $var);

class OutputData {

    function load_more($query, $terms, $post_type, $pages, $posts_per_page, $taxonomy, $order, $category_filter){
        do_action('container_div', $category_filter);
        // echo $category_filter
        echo "<div class='show-post-inner'>";
        echo "<div class='filter-container'>";
        //Start of Categories filter section
        echo "<div class='filter-section category-filter'>";
        echo "<ul class='filter-list'>";
        echo "<div>Categories</div>";
        if( !empty($terms) ) {
            foreach( $terms as $category ) {
                get_template_part('inc/shortcodes/shortcode-template/category-list', null,array(
                    'category_slug' => $category -> slug,
                    'category_name' => $category -> name,
                ));
            }
        }
        echo "</ul>";//end of filter-list
        echo "</div>";//end of filter section
        //End of Categories Filter Section

        //Start of Layout Filter Section
        echo "<div class='filter-section'>";
        echo "<ul class='filter-list'>";
        echo "<div>Layout</div>";
        ?>
        <li class='layout-item filter-item'>
            <input class='layout-input' name='layout-checkbox' type="checkbox" value='grid-post-layout'>
            <label for='grid'>Two Col Grid</label>
        </li>
        <li class='layout-item filter-item'>
            <input class='layout-input' name='layout-checkbox' type="checkbox" value='masonry-post-layout'>
            <label for='grid'>Masonry</label>
        </li>
        <?php
        echo "</ul>";//end of filter-list
        echo "</div>";//end of filter section
        //End of Layout Filter Section
        echo "</div>";//end of fiter-container
        echo "<div class='content-outer'>";
        do_action('load_more_container', $post_type, $pages, 1, $posts_per_page, $taxonomy, $order);
        if($query -> have_posts()):
            while($query -> have_posts()): $query -> the_post();
            get_template_part('inc/shortcodes/shortcode-template/load-more');
        endwhile;
    endif;
    do_action('closing_load_more');
    get_template_part('inc/shortcodes/shortcode-template/load-more-btn');
    do_action('closing_load_more');//end of content-outer
    do_action('closing_load_more');
    do_action('closing_load_more');
    }
}