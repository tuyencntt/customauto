<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $interval
 * @var $el_class
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Tabs
 */
$title = $interval = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'jquery-ui-tabs' );

$el_class = $this->getExtraClass( $el_class );

$element = 'wpb_tabs';
if ( 'vc_tour' === $this->shortcode ) {
	$element = 'wpb_tour';
}

// Extract tab titles
preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/**
 * vc_tabs
 *
 */
if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}
$tabs_nav = '';
$tabs_nav .= '<ul class="wpb_tabs_nav ui-tabs-nav vc_clearfix dddddddddddddddddddddddddd">';
foreach ( $tab_titles as $tab ) {
	$tab_atts = shortcode_parse_atts( $tab[0] );
	$tz_font_icon = 'furniture';
	if(isset( $tab_atts['tz_font_icon'] )){
		$tz_font_icon = $tab_atts['tz_font_icon'];
	}

	$tz_icon_position = 'above';
	if(isset( $tab_atts['tz_icon_position'] )){
		$tz_icon_position = $tab_atts['tz_icon_position'];
	}

	$tz_icon_class = '';
	if($tz_icon_position == 'under'){
		$tz_icon_class = 'tz_icon_under_title';
	}elseif($tz_icon_position == 'before'){
		$tz_icon_class = 'tz_icon_before_title';
	}elseif($tz_icon_position == 'after'){
		$tz_icon_class = 'tz_icon_after_title';
	}elseif($tz_icon_position == 'above'){
		$tz_icon_class = 'tz_icon_above_title';
	}

	$html_icon = '';
	if(isset( $tab_atts['tz_add_icon'] ) && $tab_atts['tz_add_icon'] == '1'){
		if(($tz_font_icon == 'et-line' || $tz_font_icon == 'elegant')  && $tab_atts['tz_icon'] != ''){
			$html_icon .='<span aria-hidden="true" class="'.esc_attr($tab_atts['tz_icon']).'"';
			$html_icon .='></span>';

		}elseif($tz_font_icon == 'awesome' && $tab_atts['tz_icon'] != ''){
			$html_icon .='<i class="fa '.esc_attr($tab_atts['tz_icon']).'"';
			$html_icon .='></i>';
		}elseif($tz_font_icon == 'furniture' && $tab_atts['tz_icon'] != ''){
			$html_icon .='<span data-icon="'.esc_attr($tab_atts['tz_icon']).'" class="icon"';
			$html_icon .='></span>';
		}
	}

	if ( isset( $tab_atts['title'] ) ) {
		$tabs_nav .= '<li class="'. esc_attr($tz_icon_class) .'" ';
		if(isset($tab_atts['tz_image']) || isset($tab_atts['tz_width'])){
			$tabs_nav .= 'style="';
			if(isset($tab_atts['tz_image'])){
				$tabs_nav .= 'background-image:url('. esc_url(wp_get_attachment_url($tab_atts['tz_image'])) .');';
			}
			if(isset($tab_atts['tz_width'])){
				$tabs_nav .= 'width:'. esc_attr($tab_atts['tz_width']) .';';
			}
			$tabs_nav .= '" ';
		}
		$tabs_nav .= '>';
		$tabs_nav .= '<span class="tz-background-overlay"></span>';
		if( $tz_icon_position == 'before' || $tz_icon_position == 'above' ){
			$tabs_nav .= $html_icon;
		}
		$tabs_nav .= '<a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '">';
		$tabs_nav .= $tab_atts['title'];
		$tabs_nav .= '</a>';
		if( $tz_icon_position == 'after' || $tz_icon_position == 'under' ){
			$tabs_nav .= $html_icon;
		}
		$tabs_nav .= '</li>';
	}
}
$tabs_nav .= '</ul>';

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), $this->settings['base'], $atts );

if ( 'vc_tour' === $this->shortcode ) {
	$next_prev_nav = '<div class="wpb_tour_next_prev_nav vc_clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="' . __( 'Previous tab', 'js_composer' ) . '">' . __( 'Previous tab', 'js_composer' ) . '</a></span> <span class="wpb_next_slide"><a href="#next" title="' . __( 'Next tab', 'js_composer' ) . '">' . __( 'Next tab', 'js_composer' ) . '</a></span></div>';
} else {
	$next_prev_nav = '';
}

$output = '
	<div class="' . $css_class . ' type-1" data-interval="' . $interval . '">
		<div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix">
			' . wpb_widget_title( array( 'title' => $title, 'extraclass' => $element . '_heading' ) )
	. $tabs_nav
	. wpb_js_remove_wpautop( $content )
	. $next_prev_nav . '
		</div>
	</div>
';

echo $output;
