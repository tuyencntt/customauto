<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $link
 * @var $size
 * @var $el_class
 * @var $css
 * @var $tz_type
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Gmaps
 */
$title = $link = $size = $el_class = $css = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script('tz-gmaps');

$zoom = 14; // deprecated 4.0.2. In 4.6 was moved outside from shortcode_atts
$type = 'm'; // deprecated 4.0.2
$bubble = ''; // deprecated 4.0.2

if ( '' === $link ) {
	return null;
}
$link = trim( vc_value_from_safe( $link ) );
$bubble = ( '' !== $bubble && '0' !== $bubble ) ? '&amp;iwloc=near' : '';
$size = str_replace( array( 'px', ' ' ), array( '', '' ), $size );

if ( is_numeric( $size ) ) {
	$link = preg_replace( '/height="[0-9]*"/', 'height="' . $size . '"', $link );
}

$class_to_filter = 'wpb_gmaps_widget wpb_content_element' . ( '' === $size ? ' vc_map_responsive' : '' );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$tzinteriart_class = '';
if($tz_type != ''){
	$tzinteriart_class = 'tzGoogleMap_'.$tz_type;
}
?>
<div class="<?php echo esc_attr( $css_class ).' '.esc_attr($tzinteriart_class); ?>">
	<?php echo wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_map_heading' ) ); ?>
	<div class="wpb_wrapper">
		<div class="wpb_map_wraper">
			<?php
			if ( preg_match( '/^\<iframe/', $link ) ) {
				echo $link;
			} else {
				// TODO: refactor or remove outdated/deprecated attributes that is not mapped in gmaps.
				echo '<iframe width="100%" height="' . $size . '" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . $link . '&amp;t=' . $type . '&amp;z=' . $zoom . '&amp;output=embed' . $bubble . '"></iframe>';
			}
			?>
			<?php
			if($tz_type == 'modern'){
				?>
				<div class="tz_map_overlay">
					<button class="tz_map_button_view"><i class="fa fa-map-o"></i><?php esc_html_e('View Maps','tz-interiart')?></button>
					<button class="tz_map_button_close"><i class="fa fa-map-o"></i><?php esc_html_e('Close Maps','tz-interiart')?></button>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
