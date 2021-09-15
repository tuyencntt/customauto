<?php
/*
 * Element tz-feature-item
 * */

/**
 * @param $atts
 * @param null $content
 * @return string
 */
function autoshowroom_banner($atts, $content = null)
{
    $image = $title = $link = $background = $auto_box_css = '';
    extract(shortcode_atts(array(
        'image' => '',
        'title' => '',
        'link' => '',
        'background' => '',
        'auto_box_css' => '',
    ), $atts));
    ob_start();
    $autoshowroom_box_style = vc_shortcode_custom_css_class($auto_box_css);
    ?>

    <div class="autoshowroom-banner <?php echo esc_attr($autoshowroom_box_style); ?> "
         style="background: url('<?php if ($background != '') :

             echo esc_url(wp_get_attachment_image_src($background, 'full')[0]);

         endif; ?>') no-repeat center center; background-size: cover">
        <div class="content">
            <?php
            if ($image != ''):
                echo wp_get_attachment_image($image, 'full', "", array("class" => "img-responsive img-logo"));
            endif; ?>
            <?php
            if ($title != ''):
                echo '<h3>' . esc_html__($title) . '</h3>';
            endif; ?>
            <?php if (!empty(vc_build_link($link))):
                $href = vc_build_link($link);
                ?>
                <a class="auto_btn" target="<?php echo esc_attr($href['target']); ?>"
                   href="<?php echo esc_url($href['url']); ?>"
                   title="<?php echo esc_attr($href['title']); ?>">
                    <?php
                    echo esc_html__('Purchase for only $59', 'tz-autoshowroom');
                    ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode('autoshowroom-banner', 'autoshowroom_banner');
?>