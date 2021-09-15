<?php
/*===============================
Shortocde tz-skill-item
===============================*/

function tzinteriart_buttonaventura($atts, $content = null)
{
    $tz_fsize = $btn_type = $tz_type = $css = $tz_icontxt = $tz_txtlink = $link = $tz_title = $tz_color_title = $tz_text_align = '';
    extract(shortcode_atts(array(
        'tz_title' => '',
        'tz_fsize' => '',
        'tz_color_title' => '',
        'tz_text_align' => 'center',
        'link' => '',
        'tz_txtlink' => '',
        'tz_icontxt' => '',
        'css' => '',
        'tz_type' => '1',
        'btn_type'  => 'left',
    ), $atts));
    ob_start();

    $vc_link = vc_build_link($link);

    $btn_align = " tz_btn_align_".$btn_type;

    ?>
    <div class="tz_button<?php echo $btn_align?> ">
        <a class="tz_buttonrp <?php echo vc_shortcode_custom_css_class($css)?>" href="<?php echo esc_attr($vc_link['url']); ?>" target="<?php echo esc_attr($vc_link['target']);?>"><?php echo esc_attr($vc_link['title']); ?></a>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('tz-button', 'tzinteriart_buttonaventura');
?>
