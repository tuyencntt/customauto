<?php
/*===============================
Shortocde tz-skill-item
===============================*/

function autoshowroom_list($atts, $content=null) {
    $autoshowroom_list_style = $border = $autoshowroom_icon = $autoshowroom_tz_css_animation = $css = '';
    extract(shortcode_atts(array(
        'autoshowroom_icon'                     => 'fa fa-adjust',
        'autoshowroom_tz_css_animation'         => '',
        'autoshowroom_list_style'               => '1',
        'border'                                => '',
        'css'                                   => '',
    ),$atts));
    ob_start();

    $css_class =  vc_shortcode_custom_css_class($css);
    $autoshowroom_class = '';

    if($autoshowroom_tz_css_animation != ''){
        wp_enqueue_script( 'vc_waypoints' );
        $autoshowroom_class .= ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_tz_css_animation;
    }
    $autoshowroom_content = preg_replace('/<li>/','<li><i class="'.$autoshowroom_icon.'"></i>',$content);
    $autoshowroom_content_p = preg_replace('#<p>\s*+(<br\s*/*>)?|s*</p>#i','',$autoshowroom_content);
    ?>
    <div class="autoshowroom-list list_style-<?php echo esc_attr($autoshowroom_list_style);?> <?php echo esc_attr($border); ?> <?php echo esc_attr($autoshowroom_class);?><?php echo esc_attr($css_class)?>">
        <?php
        echo balanceTags($autoshowroom_content_p);
        ?>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('autoshowroom-list','autoshowroom_list');
?>
