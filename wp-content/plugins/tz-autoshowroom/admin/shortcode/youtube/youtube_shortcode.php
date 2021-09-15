<?php
/* =========================================================
* shortcode for Youtube embed.
* ========================================================= */
// Youtube.
function shortcode_youtube($attrs, $content) {
    $attrs = shortcode_atts(array(
        'width' => '',
        'height' => '',
    ), $attrs);
    return '<iframe class="youtube-player" type="text/html" width="' . (!empty($attrs['width']) ? $attrs['width'] : '640') . '" height="' . (!empty($attrs['height']) ? $attrs['height'] : '480') . '" src="http://www.youtube.com/embed/' . $content . '" frameborder="0"></iframe>';
}
add_shortcode('youtube', 'shortcode_youtube');

?>