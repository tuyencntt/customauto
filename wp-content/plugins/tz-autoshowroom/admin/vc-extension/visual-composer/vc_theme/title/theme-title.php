<?php
/*===============================
Shortocde tz-skill-item
===============================*/

function autoshowroom_title($atts, $content = null)
{
    $autoshowroom_tz_title = $autoshowroom_tz_line = $autoshowroom_tz_title1 = $autoshowroom_color_title = $autoshowroom_tz_description = $autoshowroom_tz_align = $autoshowroom_tz_css_animation = '';
    extract(shortcode_atts(array(
        'autoshowroom_tz_title' => '',
        'autoshowroom_tz_title1' => '',
        'autoshowroom_color_title' => '',
        'autoshowroom_tz_align' => 'center',
        'autoshowroom_tz_css_animation' => '',
        'autoshowroom_tz_line' => '',
    ), $atts));
    ob_start();
    $autoshowroom_class = '';
    if ($autoshowroom_tz_align != '') {
        $autoshowroom_class .= 'autoshowroom-title-' . $autoshowroom_tz_align;
    }


    if ($autoshowroom_tz_css_animation != '') {
        wp_enqueue_script('waypoints');
        $autoshowroom_class .= ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_tz_css_animation;
    }
    ?>
    <div class="autoshowroom-title <?php if ($autoshowroom_tz_line == true): echo esc_attr('disable-line'); endif; ?> <?php echo esc_attr($autoshowroom_class); ?>">
        <?php
        if ($autoshowroom_tz_title != '') {
            ?>
            <h2 class="AutoshowroomTitle"<?php
            if ($autoshowroom_color_title != '') {
                echo ' style="color:' . $autoshowroom_color_title . '"';
            } ?>
            >
                <?php
                echo balanceTags($autoshowroom_tz_title);
                ?>
            </h2>
            <?php
        }
         if ($content != ''){?>
        <p>
        <?php
             echo balanceTags($content);
             ?>
        </p>
             <?php

         }

         ?>
    </div>
    <?php

    return ob_get_clean();
}

add_shortcode('autoshowroom-title', 'autoshowroom_title');
?>
