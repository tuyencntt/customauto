<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * @var $tztextalign
 * @var $tz_css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */
$output = $rellax_effect = $rellax_effect_speed = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$tzinteriart_textAlign = '';
if($tztextalign != ''){
    $tzinteriart_textAlign = ' tzTextAlign_'.$tztextalign;
}

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
);
$tz_rellax_column = '';
$tz_rellax_item= '';
$tz_speed_rellax= '';
if ($rellax_effect != '') {
    $tz_rellax_column = ' rellax_wrapper';
    $tz_rellax_item = 'rellax ';
    $tz_speed_rellax = 'data-rellax-speed="'.$rellax_effect_speed.'" data-rellax-min="-200" data-rellax-max="200"';
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

if($tz_css_animation != ''){
    wp_enqueue_script( 'vc_waypoints' );
    $css_class .= ' wpb_animate_when_almost_visible wpb_' . $tz_css_animation;
}

$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . ''.$tz_rellax_column.'"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$innerColumnClass = 'vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) );
$output .= '<div class="' . trim( $innerColumnClass ) . '">';
$output .= '<div class="wpb_wrapper '.$tz_rellax_item.' '.$tzinteriart_textAlign.'" '.$tz_speed_rellax.'>';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>' . $this->endBlockComment( '.wpb_wrapper' );
$output .= '</div>';
$output .= '</div>' . $this->endBlockComment( $this->getShortcode() );


echo balanceTags($output);