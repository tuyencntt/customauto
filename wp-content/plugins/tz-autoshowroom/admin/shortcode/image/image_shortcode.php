<?php
/*===============================
Shortocde image
*/
function shortcode_image($atts) {
    extract(shortcode_atts(array(
        'src' => ''
    ),$atts));
    return '<img src="'.$src.'" />';
}
add_shortcode('image','shortcode_image');
?>