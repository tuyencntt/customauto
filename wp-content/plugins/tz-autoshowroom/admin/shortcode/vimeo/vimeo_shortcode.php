<?php
/* =========================================================
* shortcode for video embed.
* ========================================================= */
function shortcode_vimeo ($atts, $content) {
    extract(shortcode_atts(array(
        'width'  => '100%',
        'height' => '450px'
    ),$atts));
    $html = '';
    $html = '<iframe src="http://player.vimeo.com/video/' . $content . '" width="' . $width . '" height="' . $height . '" frameborder="0"></iframe>' ;
    return $html ;
}
add_shortcode('vimeo','shortcode_vimeo') ;