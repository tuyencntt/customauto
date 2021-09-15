<?php
/*===============================
Shortocde tz-skill-item
===============================*/

function autoshowroom_sign_up_mp($atts, $content=null) {
     $autoshowroom_title = $autoshowroom_sub_title = $autoshowroom_image = $autoshowroom_position_x = $autoshowroom_position_y = $autoshowroom_image_animation = $autoshowroom_tz_css_animation = '';
    extract(shortcode_atts(array(
        'autoshowroom_title'                => '',
        'autoshowroom_sub_title'            => '',
        'autoshowroom_image'                => '',
        'autoshowroom_position_x'           => '-115',
        'autoshowroom_position_y'           => '-36',
        'autoshowroom_image_animation'      => '',
        'autoshowroom_tz_css_animation'     => '',
    ),$atts));
    ob_start();

    $autoshowroom_class = '';

    if($autoshowroom_tz_css_animation != ''){
        wp_enqueue_script( 'waypoints' );
        $autoshowroom_class .= ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_tz_css_animation;
    }

    $autoshowroom_class_image = '';
    if($autoshowroom_image_animation != ''){
        wp_enqueue_script( 'waypoints' );
        $autoshowroom_class_image .= ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_image_animation;
    }
    ?>
    <div class="autoshowroom-sign-up <?php echo esc_attr($autoshowroom_class);?>">
        <div class="autoshowroom-sign-up-box">
            <h3 class="autoshowroom-sign-up-title"><?php echo esc_html($autoshowroom_title);?></h3>
            <p class="autoshowroom-sign-up-subtitle"><?php echo esc_html($autoshowroom_sub_title);?></p>
            <div class="autoshowroom-sign-up-triangle"></div>
        </div>
        <?php
        echo apply_filters( 'the_content', $content );?>


            <?php
            $autoshowroom_image_url = wp_get_attachment_url($autoshowroom_image);
            $autoshowroom_width_img ='';
            $autoshowroom_height_img ='';
            $autoshowroom_images_info = wp_get_attachment_image_src($autoshowroom_image, $size='full');
            if(isset($autoshowroom_images_info) && !empty($autoshowroom_images_info)){
                $autoshowroom_width_img = $autoshowroom_images_info[1];
                $autoshowroom_height_img = $autoshowroom_images_info[2];
            }
            if($autoshowroom_image_url !=""){
            ?>
            <img class="logo_lager <?php echo esc_attr($autoshowroom_class_image);?>" width ="<?php echo esc_attr($autoshowroom_width_img);?>" height ="<?php echo esc_attr($autoshowroom_height_img);?>" src="<?php echo esc_url($autoshowroom_image_url);?>" alt="image signup" <?php
            if($autoshowroom_position_x != '' || $autoshowroom_position_y != ''){
                echo 'style="';
                if($autoshowroom_position_x != ''){
                    echo 'right:'.$autoshowroom_position_x.'px;';
                }
                if($autoshowroom_position_y != ''){
                    echo 'top:'.$autoshowroom_position_y.'px;';
                }
                echo '"';
            }
            ?>/>
        <?php } ?>

    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('autoshowroom-sign-up-mp','autoshowroom_sign_up_mp');
?>
