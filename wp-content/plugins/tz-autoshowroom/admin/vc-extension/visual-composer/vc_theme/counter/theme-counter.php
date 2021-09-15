<?php
/*
 * Element tz-counter
 * */

function autoshowroom_counter($atts) {
    $counter_class = $css = $icon_color = $autoshowroom_counter_style = $autoshowroom_icon = $autoshowroom_count_number = $count_color = $autoshowroom_count = $autoshowroom_title = $title_color = $autoshowroom_css_animation = $autoshowroom_fontsize_option = '';
    extract(shortcode_atts(array(
        'autoshowroom_counter_style'    => 'style1',
        'autoshowroom_icon'             => 'fa fa-adjust',
        'autoshowroom_count'            => '',
        'counter_class'                 => '',
        'autoshowroom_count_number'     => '1',
        'autoshowroom_title'            => '',
        'autoshowroom_css_animation'    => '',
        'icon_color'                    => '',
        'count_color'                   => '',
        'title_color'                   => '',
        'autoshowroom_fontsize_option'  => 'medium',
        'css'                           => '',
    ),$atts));
    ob_start();

    wp_enqueue_script('autoshowroom-counter');

    $autoshowroom_counter_class = '';

    if($autoshowroom_css_animation != ''){
        wp_enqueue_script( 'vc_waypoints' );
        $autoshowroom_counter_class .= ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_css_animation;
    }
    ?>
    <?php if($autoshowroom_counter_style == 'style1'){ ?>
        <div data-number ="<?php echo $autoshowroom_count_number;?>" class="autoshowroom-counter <?php if ($autoshowroom_counter_class) { echo 'autoshowroom-counter-'. esc_attr($autoshowroom_counter_class);}?> <?php echo esc_html($counter_class);?> <?php echo vc_shortcode_custom_css_class( $css ); ?>">
            <div class="autoshowroom-counter-box">
                <?php
                if($autoshowroom_icon != ''){
                    ?>
                    <div class="autoshowroom-counter-icon">
                        <i class="fa <?php echo esc_attr($autoshowroom_icon);?> fa-fw" <?php if ($icon_color) { echo 'style="color: '.esc_attr($icon_color).';"';}?>></i>
                    </div>
                    <?php
                }
                ?>

                <span class="autoshowroom-counter-number stat-count" <?php if ($count_color) { echo 'style="color: '.esc_attr($count_color).';"';}?>><?php echo esc_html($autoshowroom_count);?></span>

            </div>
            <h3 class="autoshowroom-counter-title" <?php if ($title_color) { echo 'style="color: '.esc_attr($title_color).';"';}?>><?php echo esc_html($autoshowroom_title);?></h3>
        </div>
    <?php }elseif ($autoshowroom_counter_style == 'style2') { ?>
        <div  data-number ="<?php echo $autoshowroom_count_number;?>"  class="autoshowroom-counter autoshowroom-counter-<?php echo esc_html($autoshowroom_counter_style); echo esc_attr($autoshowroom_counter_class);?> <?php echo esc_html($counter_class);?> <?php echo vc_shortcode_custom_css_class( $css ); ?>">
            <?php
            if($autoshowroom_icon != ''){
                ?>
                <div class="autoshowroom-counter-icon">
                    <i class="fa <?php echo esc_attr($autoshowroom_icon);?> fa-fw" <?php if ($icon_color) { echo 'style="color: '.esc_attr($icon_color).';"';}?>></i>
                </div>
                <?php
            }
            ?>
            <div class="autoshowroom-counter-content">
                <span class="autoshowroom-counter-number stat-count" <?php if ($count_color) { echo 'style="color: '.esc_attr($count_color).';"';}?>><?php echo esc_html($autoshowroom_count);?></span>
                <h3 class="autoshowroom-counter-title" <?php if ($title_color) { echo 'style="color: '.esc_attr($title_color).';"';}?>><?php echo esc_html($autoshowroom_title);?></h3>
            </div>
        </div>
        <?php
    } elseif ($autoshowroom_counter_style == 'style3') { ?>
        <div  data-number ="<?php echo $autoshowroom_count_number;?>"  class="autoshowroom-counter autoshowroom-counter-<?php echo esc_html($autoshowroom_counter_style); echo esc_attr($autoshowroom_counter_class);?> <?php echo esc_html($counter_class);?> <?php echo vc_shortcode_custom_css_class( $css ); ?> <?php echo 'font-size-' .esc_attr($autoshowroom_fontsize_option); ?>">
            <?php
            if($autoshowroom_icon != ''){
                ?>
                <div class="autoshowroom-counter-icon">
                    <i class="fa <?php echo esc_attr($autoshowroom_icon);?> fa-fw" <?php if ($icon_color) { echo 'style="color: '.esc_attr($icon_color).';"';}?>></i>
                </div>
                <?php
            }
            ?>

            <div class="autoshowroom-counter-content">
                <span class="autoshowroom-counter-number stat-count" <?php if ($count_color) { echo 'style="color: '.esc_attr($count_color).';"';}?>><?php echo esc_html($autoshowroom_count);?></span>
                <h3 class="autoshowroom-counter-title" <?php if ($title_color) { echo 'style="color: '.esc_attr($title_color).';"';}?>><?php echo esc_html($autoshowroom_title);?></h3>
            </div>
        </div>
        <?php
    }
    ?>

<?php
    return ob_get_clean();
}
add_shortcode('autoshowroom-counter','autoshowroom_counter');
?>