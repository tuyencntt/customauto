<?php
/*
 * Element tz-feature-item
 * */

function autoshowroom_service_item($atts, $content = null)
{
    $autoshowroom_service_type = $autoshowroom_icon = $autoshowroom_services_image = $autoshowroom_services_image_style =
    $autoshowroom_services_image_icon = $autoshowroom_title = $autoshowroom_bg_icon = $autoshowroom_color_title = $autoshowroom_style = $autoshowroom_readmore_option
        = $autoshowroom_readmore_text = $autoshowroom_readmore_link = $autoshowroom_padding_top =
    $autoshowroom_padding_bottom = $autoshowroom_css_animation = $css = '';
    extract(shortcode_atts(array(
        'autoshowroom_service_type' => '1',
        'autoshowroom_icon' => 'fa fa-adjust',
        'autoshowroom_services_image' => '',
        'autoshowroom_services_image_style' => '',
        'autoshowroom_services_image_icon' => '',
        'autoshowroom_bg_icon' => '#ff5400',
        'autoshowroom_title' => '',
        'autoshowroom_color_title' => '#222222',
        'autoshowroom_readmore_option' => 'hide',
        'autoshowroom_readmore_text' => '',
        'autoshowroom_readmore_link' => '',
        'autoshowroom_padding_top' => '',
        'autoshowroom_padding_bottom' => '',
        'autoshowroom_style' => 'style1',
        'autoshowroom_css_animation' => '',
        'css' => '',
    ), $atts));
    ob_start();
    $autoshowroom_signature_img_id = preg_replace('/[^\d]/', '', $autoshowroom_services_image);
    $autoshowroom_img_style_id = preg_replace('/[^\d]/', '', $autoshowroom_services_image_style);
    $autoshowroom_signature_img_icon_id = preg_replace('/[^\d]/', '', $autoshowroom_services_image_icon);
    $autoshowroom_img_url = '';

    $autoshowroom_signature_info = wp_get_attachment_image_src($autoshowroom_signature_img_id, $size = 'full');
    $autoshowroom_img_info = wp_get_attachment_image_src($autoshowroom_img_style_id, $size = 'full');
    $autoshowroom_icon_info = wp_get_attachment_image_src($autoshowroom_signature_img_icon_id, $size = 'full');
    
    if (isset($autoshowroom_signature_info) && !empty($autoshowroom_signature_info)) {
        $autoshowroom_signature_url = $autoshowroom_signature_info[0];
    }
    if (isset($autoshowroom_icon_info) && !empty($autoshowroom_icon_info)) {
        $autoshowroom_icon_url = $autoshowroom_icon_info[0];
    }
    if (isset($autoshowroom_img_info) && !empty($autoshowroom_img_info)) {
        $autoshowroom_img_url = $autoshowroom_img_info[0];
    }

    $autoshowroom_class = '';

    if ($autoshowroom_css_animation != '') {
        wp_enqueue_script('waypoints');
        $autoshowroom_class .= ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_css_animation;
    }

    ?>
    <div class="autoshowroom-service <?php echo esc_attr($autoshowroom_class); ?> <?php echo esc_attr($autoshowroom_style); ?> <?php echo vc_shortcode_custom_css_class($css)?>" <?php
    if ($autoshowroom_padding_top != '' || $autoshowroom_padding_bottom != '') {
        echo 'style="';
        if ($autoshowroom_padding_top != '') {
            echo 'padding-top:' . esc_attr($autoshowroom_padding_top) . 'px;';
        }
        if ($autoshowroom_padding_bottom != '') {
            echo 'padding-bottom:' . esc_attr($autoshowroom_padding_bottom) . 'px;';
        }
        echo '"';
    }
    ?>>
        <?php if ($autoshowroom_style != 'style5') { ?>
            <?php if ($autoshowroom_service_type == '1') { ?>
                <div class="autoshowroom-service-icon"<?php
                if ($autoshowroom_bg_icon != '') {
                    echo ' style="background-color:' . $autoshowroom_bg_icon . '"';
                } ?>>
                    <i class="<?php echo esc_attr($autoshowroom_icon); ?>"></i>
                </div>
            <?php } else {
                ?>
                <div class="autoshowroom-service-icon">
                    <img src="<?php echo esc_html($autoshowroom_signature_url); ?>" alt="image-services">
                </div>
                <?php
            } ?>
        <?php } else { ?>
            <div class="autoshowroom-service-icon">
                <img src="<?php echo esc_html($autoshowroom_img_url); ?>" alt="image-services">
            </div>
        <?php } ?>
        <?php if ($autoshowroom_style == 'style5') :?>
        <div class="autoshowroom-service-image-icon">
            <img src="<?php echo esc_html($autoshowroom_icon_url); ?>" alt="image-icon" class="image-icon">
        </div>
        <?php endif;?>
        <h3 class="autoshowroom-service-title" <?php
        if ($autoshowroom_color_title != '') {
            echo ' style="color:' . $autoshowroom_color_title . '"';
        } ?>>
            <?php echo esc_html($autoshowroom_title); ?>
        </h3>

        <p class="autoshowroom-service-description">
            <?php echo balanceTags($content); ?>
        </p>
        <?php
        if ($autoshowroom_readmore_option == 'show' && $autoshowroom_readmore_link != '' && $autoshowroom_readmore_text != '') {
            ?>
            <a class="autoshowroom-service-readmore"
               href="<?php echo esc_url($autoshowroom_readmore_link); ?>"><?php echo esc_html($autoshowroom_readmore_text); ?></a>
            <?php
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('autoshowroom-service-item', 'autoshowroom_service_item');
?>