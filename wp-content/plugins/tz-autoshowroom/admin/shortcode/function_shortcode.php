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
function tz_font_awesome_styles($atts){
    extract ( shortcode_atts ( array (
        'color' => '#555',
        'border_color' => '#555',
        'icon' => '',
        'font' => '14px',
        'width' => '12px',
        'padding' => '5px',
    ), $atts, 'font') );

    return '<i style="font-size: '.$font.'; color:'.$color.';border: 1px solid '.$border_color.';padding: '.$padding.';border-radius: 50%;margin: 2px;text-align:center;width:'.$width.';height:'.$width.'"  class="fa '.$icon.'"></i>';

}
add_shortcode('font','tz_font_awesome_styles');

function font_awesome_styles_with_link($atts){
    extract ( shortcode_atts ( array (
        'color' => '#555',
        'border_color' => '#555',
        'icon' => '',
        'font' => '14px',
        'href' => '#',
        'hover_color' => '#fff',
        'hover_bg' => '#555',
        'width' => '12px',
        'padding' => '5px',
    ), $atts, 'font_link') );

    return '<a href="'.$href.'" class="font_awesome_link" style="color:'.$color.';margin: 2px;outline: medium none;text-decoration:none"><i style="text-align:center;width:'.$width.';height:'.$width.';border: 1px solid '.$border_color.';border-radius: 50%;font-size: '.$font.';padding: '.$padding.';"  class="fa '.$icon.'"></i></a><style>a.font_awesome_link:hover{color:'.$hover_color.' !important;}a.font_awesome_link:hover i{border:1px solid '.$hover_bg.' !important;background:'.$hover_bg.' }</style>';

}
add_shortcode('font_link','font_awesome_styles_with_link');
?>