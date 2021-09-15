<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $tz_gradient
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * @var $tz_row_type
 * @var $tz_overlay_parallax
 * @var $tz_pattern
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$tz_gradient = $el_class = $full_height = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $tz_row_type = $tz_overlay_parallax = $tz_pattern = '';
$output = $after_output = '';
$tz_gradient = array();
$attributes = array();
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
wp_enqueue_script( 'wpb_composer_front_js' );
$el_class = $this->getExtraClass( $el_class );
$uid = uniqid();
$css_classes = array(
    'vc_row',
    'wpb_row', //deprecated
    'vc_row-fluid',
    'vc_row-gradient-' . $tz_gradient . $uid,
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') ) || $video_bg || $parallax) {
    $css_classes[]='vc_row-has-fill';
}

if (!empty($atts['gap'])) {
    $css_classes[] = 'vc_column-gap-'.$atts['gap'];
}
$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
    $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
    $wrapper_attributes[] = 'data-vc-full-width="true"';
    $wrapper_attributes[] = 'data-vc-full-width-init="false"';
    if ( 'stretch_row_content' === $full_width ) {
        $wrapper_attributes[] = 'data-vc-stretch-content="true"';
    } elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
        $wrapper_attributes[] = 'data-vc-stretch-content="true"';
        $css_classes[] = 'vc_row-no-padding';
    }
    $after_output .= '<div class="vc_row-full-width"></div>';
}

if ( 'yes' === $disable_element ) {
    if ( vc_is_page_editable() ) {
        $css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
    } else {
        return '';
    }
}
if ( ! empty( $full_height ) ) {
    $css_classes[] = ' vc_row-o-full-height';
    if ( ! empty( $columns_placement ) ) {
        $flex_row = true;
        $css_classes[] = ' vc_row-o-columns-' . $columns_placement;
    }
}

if ( ! empty( $equal_height ) ) {
    $flex_row = true;
    $css_classes[] = ' vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
    $flex_row = true;
    $css_classes[] = ' vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
    $css_classes[] = ' vc_row-flex';
}

// use default video if user checked video, but didn't chose url
if ( ! empty( $video_bg ) && empty( $video_bg_url ) ) {
    $video_bg_url = 'https://www.youtube.com/watch?v=lMJXxhRFO1k';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

if ( $has_video_bg ) {
    $parallax = $video_bg_parallax;
    $parallax_image = $video_bg_url;
    $css_classes[] = ' vc_video-bg-container';
    wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
    wp_enqueue_script( 'vc_jquery_skrollr_js' );
    $wrapper_attributes[] = 'data-vc-parallax="1.5"'; // parallax speed
    $css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
    if ( strpos( $parallax, 'fade' ) !== false ) {
        $css_classes[] = 'js-vc_parallax-o-fade';
        $wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
    } elseif ( strpos( $parallax, 'fixed' ) !== false ) {
        $css_classes[] = 'js-vc_parallax-o-fixed';
    }
}

if ( ! empty ( $parallax_image ) ) {
    if ( $has_video_bg ) {
        $parallax_image_src = $parallax_image;
    } else {
        $parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
        $parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
        if ( ! empty( $parallax_image_src[0] ) ) {
            $parallax_image_src = $parallax_image_src[0];
        }
    }
    $wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
    $wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
if ( 'gradient' === $tz_gradient || 'gradient-custom' === $tz_gradient ) {
    $output .= '<div class="tz-gradient"></div>';
}
if( $tz_row_type == 'grid') {
    $output .= '<div class="container">';
    $output .= '<div class="row tz-row">';
    $output .= wpb_js_remove_wpautop($content);
    $output .= '</div>';
    $output .= '</div>';
}else{
    $output .= '<div class="no_container">';
    $output .= wpb_js_remove_wpautop($content);
    $output .= '</div>';
}

if ( 'gradient' === $tz_gradient || 'gradient-custom' === $tz_gradient ) {


    $gradient_color_1 = vc_convert_vc_color( $gradient_color_1 );
    $gradient_color_2 = vc_convert_vc_color( $gradient_color_2 );

    if ( 'gradient-custom' === $tz_gradient ) {
        $gradient_color_1 = $gradient_custom_color_1;
        $gradient_color_2 = $gradient_custom_color_2;
    }


    $gradient_css = array();
    $gradient_css[] = 'content: ""';
    $gradient_css[] = 'position: absolute';
    $gradient_css[] = 'top: 0';
    $gradient_css[] = 'left: 0';
    $gradient_css[] = 'width: 100%';
    $gradient_css[] = 'height: 100%';
    $gradient_css[] = 'opacity: 0.3';
    $gradient_css[] = 'border: none';
    $gradient_css[] = 'background-color: ' . $gradient_color_1;
    $gradient_css[] = 'background-image: -webkit-linear-gradient(left, ' . $gradient_color_1 . ' 0%, ' . $gradient_color_2 . ' 50%,' . $gradient_color_1 . ' 100%)';
    $gradient_css[] = 'background-image: linear-gradient(to right, ' . $gradient_color_1 . ' 0%, ' . $gradient_color_2 . ' 50%,' . $gradient_color_1 . ' 100%)';
    $gradient_css[] = '-webkit-transition: all .2s ease-in-out';
    $gradient_css[] = 'transition: all .2s ease-in-out';
    $gradient_css[] = 'background-size: 200% 100%';


    echo '<style type="text/css">.vc_row-gradient-' . $tz_gradient . $uid . '{position: relative;} .vc_row-gradient-' . $tz_gradient . $uid . ' .tz-gradient::before{' . implode( ';', $gradient_css ) . ';' . '}</style>';
    $css_classes[] = 'vc_row-gradient-css-' . $uid;
    $attributes[] = 'data-vc-gradient-1="' . $gradient_color_1 . '"';
    $attributes[] = 'data-vc-gradient-2="' . $gradient_color_2 . '"';
}

if ( ! empty( $parallax ) && $tz_overlay_parallax != '' ):
    $output .= '<div class="overlay_parallax" style="background-color:'.$tz_overlay_parallax.'"></div>';
endif;

if( !empty ($tz_pattern) && $tz_pattern == '1'){
    $output .= '<div class="tzPattern"></div>';
}
$output .= '</div>';
$output .= $after_output;
$output .= $this->endBlockComment( $this->getShortcode() );

echo balanceTags($output);