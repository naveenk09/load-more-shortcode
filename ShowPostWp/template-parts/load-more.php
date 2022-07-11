<?php

if( empty(get_the_ID())) {
    return null;
}

$image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
$excerpt = get_the_excerpt(); 
// echo implode(' ',array_slice(str_word_count($text,1),0,$length));
// $excerpt = implode(' ',array_slice(str_word_count($text,1),0,$length));
$post_title = get_the_title();
?>
<div class="content">
    <div class='post-container post-col-layout'>
        <div class='show-post-img-container'>
            <img src="<? echo $image_url;?>">
        </div>
        <div class='post-content-container'>
            <p class="post-title"><? echo $post_title; ?></p>
            <p class="post-excerpt"><? echo substr($excerpt, 0, 200); ?></p>
            <div class="post-link">
                <a href="<?php the_permalink();?>">Read more</a>
            </div>
        </div>
    </div>
</div>