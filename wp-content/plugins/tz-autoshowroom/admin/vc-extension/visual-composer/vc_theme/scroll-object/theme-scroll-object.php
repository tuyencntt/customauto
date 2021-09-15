<?php
/*
 * Element Scroll Object
 * */

function autoshowroom_scroll_object($atts, $content=null) {
    $autoshowroom_scroll_when        =
    $autoshowroom_scroll_easing      =
    $autoshowroom_scroll_opacity     =
    $autoshowroom_scroll_scale       =
    $autoshowroom_scroll_scale_x     =
    $autoshowroom_scroll_scale_y     =
    $autoshowroom_scroll_scale_z     =
    $autoshowroom_scroll_rotate_x    =
    $autoshowroom_scroll_rotate_y    =
    $autoshowroom_scroll_rotate_z    =
    $autoshowroom_scroll_translate_x =
    $autoshowroom_scroll_translate_y =
    $autoshowroom_scroll_translate_z = '';

    extract(shortcode_atts(array(
        'autoshowroom_scroll_when'        => 'enter',
        'autoshowroom_scroll_easing'      => '',
        'autoshowroom_scroll_opacity'     => '0.5',
        'autoshowroom_scroll_scale'       => '',
        'autoshowroom_scroll_scale_x'     => '',
        'autoshowroom_scroll_scale_y'     => '',
        'autoshowroom_scroll_scale_z'     => '',
        'autoshowroom_scroll_rotate_x'    => '',
        'autoshowroom_scroll_rotate_y'    => '',
        'autoshowroom_scroll_rotate_z'    => '',
        'autoshowroom_scroll_translate_x' => '',
        'autoshowroom_scroll_translate_y' => '',
        'autoshowroom_scroll_translate_z' => '',
    ),$atts));
    ob_start();
    wp_enqueue_script('autoshowroom-scroll');
    ?>
    <div class="autoshowroom-scroll">
        <div class="scrollme">
            <div class="animateme"
                 data-from="1"
                 data-to="0"
                <?php
                    if($autoshowroom_scroll_when){ ?>
                        data-when="<?php echo esc_attr($autoshowroom_scroll_when);?>"
                    <?php }
                    if($autoshowroom_scroll_easing){?>
                        data-easing="<?php echo esc_attr($autoshowroom_scroll_easing);?>"
                    <?php }
                    if($autoshowroom_scroll_opacity){?>
                        data-opacity="<?php echo esc_attr($autoshowroom_scroll_opacity);?>"
                    <?php }
                    if($autoshowroom_scroll_scale){?>
                        data-scale="<?php echo esc_attr($autoshowroom_scroll_scale);?>"
                    <?php }
                    if($autoshowroom_scroll_scale_x){?>
                        data-scalex="<?php echo esc_attr($autoshowroom_scroll_scale_x);?>"
                    <?php }
                    if($autoshowroom_scroll_scale_y){?>
                        data-scaley="<?php echo esc_attr($autoshowroom_scroll_scale_y);?>"
                    <?php }
                    if($autoshowroom_scroll_scale_z){?>
                        data-scalez="<?php echo esc_attr($autoshowroom_scroll_scale_z);?>"
                    <?php }
                    if($autoshowroom_scroll_rotate_x){?>
                        data-rotatex="<?php echo esc_attr($autoshowroom_scroll_rotate_x);?>"
                    <?php }
                    if($autoshowroom_scroll_rotate_y){?>
                        data-rotatey="<?php echo esc_attr($autoshowroom_scroll_rotate_y);?>"
                    <?php }
                    if($autoshowroom_scroll_rotate_z){?>
                        data-rotatez="<?php echo esc_attr($autoshowroom_scroll_rotate_z);?>"
                    <?php }
                    if($autoshowroom_scroll_translate_x){?>
                        data-translatex="<?php echo esc_attr($autoshowroom_scroll_translate_x);?>"
                    <?php }
                    if($autoshowroom_scroll_translate_y){?>
                        data-translatey="<?php echo esc_attr($autoshowroom_scroll_translate_x);?>"
                    <?php }
                    if($autoshowroom_scroll_translate_x){?>
                        data-translatez="<?php echo esc_attr($autoshowroom_scroll_translate_z);?>"
                    <?php }
                ?>
            >
                <?php echo balanceTags($content);?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('autoshowroom-scroll-object','autoshowroom_scroll_object');
?>