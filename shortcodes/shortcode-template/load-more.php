<?php

if( empty(get_the_ID())) {
    return null;
}

$image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
$content = get_the_content();
$post_title = get_the_title();
?>
<div class='product-container'>
    <div>
        <img src="<? echo $image_url;?>">
    </div>
    <p><? echo $post_title; ?></p>
    <p><? echo $content; ?></p>
</div>