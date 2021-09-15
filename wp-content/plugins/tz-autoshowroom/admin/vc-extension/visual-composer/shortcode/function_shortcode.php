<?php
/*
 * Add Shortcode buttons in TinyMCE
 */

global $tz_elements;
$tz_elements = array(
    'youtube',
    'vimeo',
    'image'
);

foreach ( $tz_elements as $element ):
    include ( $element. '/'. $element .'_shortcode.php' );
endforeach;


add_action('init','plazart_add_buttons_to_tinymce');
function plazart_add_buttons_to_tinymce() {
    // check action user
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) :
        return;
    endif;

    if ( get_user_option('rich_editing') == true ):
        add_filter('mce_external_plugins','plazart_add_js_shortcode');
        add_filter('mce_buttons_3','plazart_register_button');
    endif;
} // end function register shortcode for tinymce

// function register js
function plazart_add_js_shortcode($plugin_array) {
    global $tz_elements ;
    foreach ( $tz_elements as $element ):
        $plugin_array['plazart' . $element] = PLUGIN_PATH .'/admin/shortcode/' . $element . '/'. $element .'_jquery.js';
    endforeach;
    return $plugin_array ;
}
// function register button
function plazart_register_button($buttons) {
    global $tz_elements ;
    foreach ( $tz_elements as $element ) :
        $button[] = 'plazart'.$element ;
    endforeach;
    return $button;
}
?>