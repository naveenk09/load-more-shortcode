<?php

// add_action('custom_shortcode_op', 'output_text', $var);

class OutputData {


    function load_more($query){
        
        if($query -> have_posts()):
            while($query -> have_posts()): $query -> the_post();
            // $post_id = get_the_ID();
            // $image_url = get_the_post_thumbnail_url($post_id, 'full');
            // $title = get_the_title($post_id);
            // $content = get_the_content($post_id);

            get_template_part('inc/shortcodes/shortcode-template/load-more');
        endwhile;
    endif;
    do_action('closing_load_more');
    get_template_part('inc/shortcodes/shortcode-template/load-more-btn');
    }

}