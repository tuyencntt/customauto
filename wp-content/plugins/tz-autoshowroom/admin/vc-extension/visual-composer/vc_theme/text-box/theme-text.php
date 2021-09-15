<?php
/*===============================
Shortocde tz-skill-item
===============================*/

function autoshowroom_text_box($atts, $content=null) {
     $autoshowroom_text_title =  $autoshowroom_tz_css_animation =
         $autoshowroom_textbox_css ='';
    extract(shortcode_atts(array(
        'autoshowroom_text_title'         => '',
        'autoshowroom_tz_align'           => 'center',
        'autoshowroom_textbox_css'        => '',
        'autoshowroom_tz_css_animation'   => '',
    ),$atts));
    ob_start();
    $autoshowroom_textbox_style = vc_shortcode_custom_css_class( $autoshowroom_textbox_css );
    $autoshowroom_class = '';
    if($autoshowroom_tz_css_animation != ''){
        wp_enqueue_script( 'waypoints' );
        $autoshowroom_class .= ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_tz_css_animation;
    }
    ?>
    <div class="autoshowroom-text-box <?php echo esc_attr($autoshowroom_class); echo esc_attr($autoshowroom_textbox_style); ?>">
        <?php
        if($autoshowroom_text_title != ''){
            ?>
            <h3 class="AutoshowroomTitle">
                <span>
                    <?php
                    echo balanceTags($autoshowroom_text_title);
                    ?>
                </span>
            </h3>
            <?php
        }
        ?>
        <div class="text-box-desc">
            <?php echo wpb_js_remove_wpautop( $content, true );?>
        </div>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('autoshowroom-text-box','autoshowroom_text_box');
?>
