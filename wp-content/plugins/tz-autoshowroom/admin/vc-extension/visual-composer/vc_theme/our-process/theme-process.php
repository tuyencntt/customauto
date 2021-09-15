<?php
/*===============================
Shortocde tz-skill-item
===============================*/
function autoshowroom_our_process($atts, $content=null) {
     $autoshowroom_tz_number = $autoshowroom_tz_name =  $autoshowroom_tz_readmore_option = $autoshowroom_tz_readmore_text =
     $autoshowroom_tz_readmore_link = $autoshowroom_tz_css_animation = $autoshowroom_color_title =
     $autoshowroom_icon = $autoshowroom_icon_bg = $autoshowroom_tz_icon_align_option = $icon_color = $custom_color_icon = '';
    extract(shortcode_atts(array(
        'autoshowroom_tz_number'                => '',
        'autoshowroom_tz_name'                  => '',
        'autoshowroom_tz_readmore_option'       => 'show',
        'autoshowroom_tz_readmore_text'         => '',
        'autoshowroom_tz_readmore_link'         => '',
        'autoshowroom_tz_css_animation'         => '',
        'autoshowroom_color_title'              => '',
        'autoshowroom_icon_bg'                  => 'yes',
        'autoshowroom_icon'                     => 'fa fa-adjust',
        'icon_color'                            => '1',
        'custom_color_icon'                     => '',
        'autoshowroom_tz_icon_align_option'     => 'left',
    ),$atts));
    ob_start();

    if($autoshowroom_tz_icon_align_option=='center'){
        $autoshowroom_tz_icon_align_option='icon_center';
    }
    if($autoshowroom_tz_icon_align_option=='right'){
        $autoshowroom_tz_icon_align_option='icon_right';
    }

    $autoshowroom_class = '';
    if($autoshowroom_tz_css_animation != ''){
        wp_enqueue_script( 'waypoints' );
        $autoshowroom_class .= ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_tz_css_animation;
    }
    ?>
    <div class="autoshowroom-our-process <?php echo esc_attr($autoshowroom_class); echo esc_attr($autoshowroom_icon_bg); echo esc_attr($autoshowroom_tz_icon_align_option);?>">
        <?php
        if($autoshowroom_icon!='' && $autoshowroom_icon_bg == 'yes'){
            ?>
            <div class="autoshowroom-counter-icon">
                <i class="<?php echo esc_attr($autoshowroom_icon); ?>" <?php if ($custom_color_icon){  echo 'style="color: '.esc_attr($custom_color_icon).';"'; } ?>></i>
            </div>
            <?php
        }
        ?>
        <?php
        if($autoshowroom_tz_number != ''){
            ?>
            <span class="autoshowroom-number-process"><?php echo esc_html($autoshowroom_tz_number).'.';?></span>
            <?php
        }
        ?>

        <?php
        if($autoshowroom_tz_name != ''){
            ?>
            <h3 class="autoshowroom-name-process" <?php if($autoshowroom_color_title){?>style="color:<?php echo esc_attr($autoshowroom_color_title);?>" <?php }?>>
                <?php echo esc_html($autoshowroom_tz_name);?></h3>
            <?php
        }
        ?>
        <?php
        if($content != ''){
            ?>
            <p class="autoshowroom-description-process">
                <?php echo balanceTags($content);?>
            </p>
            <?php
        }
        ?>

        <?php
        if($autoshowroom_tz_readmore_option == 'show' && $autoshowroom_tz_readmore_link != '' && $autoshowroom_tz_readmore_text != ''){
            ?>
            <a class="autoshowroom_readmore" <?php if($autoshowroom_color_title){?>style="color:<?php echo esc_attr($autoshowroom_color_title);?>" <?php }?>
               href="<?php echo esc_url($autoshowroom_tz_readmore_link);?>"><?php echo esc_html($autoshowroom_tz_readmore_text);?> »</a>
            <?php
        }
        ?>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('autoshowroom-our-process','autoshowroom_our_process');
?>
