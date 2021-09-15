<?php
/*===============================
Shortocde tz-skill-item
===============================*/
function autoshowroom_pricing($atts, $content=null) {
      $autoshowroom_tz_title = $autoshowroom_tz_price = $autoshowroom_tz_per_month = $autoshowroom_tz_field = $autoshowroom_tz_readmore_option = $autoshowroom_tz_readmore_text =
     $autoshowroom_tz_readmore_link = $autoshowroom_tz_css_animation = $list_items = $el_class = $css = '';
    extract(shortcode_atts(array(
        'autoshowroom_tz_title'                 => '',
        'autoshowroom_tz_price'                 => '',
        'autoshowroom_tz_per_month'             => '',
        'autoshowroom_tz_field'                 => '',
        'list_items'                            =>  '',
        'el_class'                              => '',
        'css'                                   =>  '',
        'autoshowroom_tz_readmore_option'       => 'show',
        'autoshowroom_tz_readmore_text'         => '',
        'autoshowroom_tz_readmore_link'         => '',
        'autoshowroom_tz_css_animation'         => '',
    ),$atts));
    ob_start();
    $list_items = vc_param_group_parse_atts( $list_items );


    $autoshowroom_class = '';
    if($autoshowroom_tz_css_animation != ''){
        wp_enqueue_script( 'waypoints' );
        $autoshowroom_class .= ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_tz_css_animation;
    }
    ?>
    <div class="autoshowroom-pricing <?php echo esc_attr($autoshowroom_class);?> <?php echo esc_attr($el_class); ?> <?php echo vc_shortcode_custom_css_class( $css ); ?>">


        <?php
        if($autoshowroom_tz_title != ''){
            ?>
            <h3 class="autoshowroom-title-pricing">
                <?php echo esc_html($autoshowroom_tz_title);?></h3>
            <?php
        }
        ?>

        <?php
        if($content != ''){
            ?>
            <p class="autoshowroom-description-pricing">
                <?php echo balanceTags($content);?>
            </p>
            <?php
        }
        ?>

        <?php
        if($autoshowroom_tz_price != ''){
            ?>
            <span class="autoshowroom-price-pricing">
                <?php echo esc_html($autoshowroom_tz_price);?></span>
            <?php
        }
        ?>

        <?php
        if($autoshowroom_tz_per_month != ''){
            ?>
            <span class="autoshowroom-per-month-pricing">
                <?php echo esc_html($autoshowroom_tz_per_month);?></span>
            <?php
        }
        ?>

        <?php

        if($list_items != ''){
            ?>
            <div class="autoshowroom-field-pricing">
                <?php

                if(isset($list_items)){
                    ?>
                    <div class="tz-vc-list">
                        <ul>
                            <?php
                            foreach( $list_items as $item ): ?>
                                <li>
                                    <i class="<?php echo esc_attr($item['icon']); ?>" <?php if(isset($item['icon_color'])){echo 'style="color: '.esc_attr($item['icon_color']).';"';} ?>></i> <?php echo esc_html($item['description']); ?>
                                </li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </div>
                    <?php
                }

                ?></div>
            <?php
        }
        ?>



        <?php
        if($autoshowroom_tz_readmore_option == 'show' && $autoshowroom_tz_readmore_link != '' && $autoshowroom_tz_readmore_text != ''){
            ?>
            <a class="autoshowroom_readmore" href="<?php echo esc_url($autoshowroom_tz_readmore_link);?>"><?php echo esc_html($autoshowroom_tz_readmore_text);?></a>
            <?php
        }
        ?>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('autoshowroom-pricing','autoshowroom_pricing');
?>
