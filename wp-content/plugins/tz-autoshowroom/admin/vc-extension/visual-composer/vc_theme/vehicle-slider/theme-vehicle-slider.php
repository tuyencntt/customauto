<?php

function autoshowroom_vehicle_slider($atts)
{
    $autoshowroom_features_vehicles
        = $autoshowroom_vehicle_title
        = $autoshowroom_vehicle_description
        = $autoshowroom_vehicle_carousel_height
        = $autoshowroom_vehicle_carousel_height_options
        = $autoshowroom_vehicle_carousel_title_top
        = $autoshowroom_vehicle_description_limit
        = $autoshowroom_vehicle_specifications = $autoshowroom_specifications_values
        = $autoshowroom_vehicle_carousel_button
        = $autoshowroom_vehicle_carousel_loop = $autoshowroom_vehicle_carousel_margin
        = $autoshowroom_vehicle_carousel_autoplay = '';
    extract(shortcode_atts(array(
        'autoshowroom_features_vehicles' => '',
        'autoshowroom_vehicle_title' => 'show',
        'autoshowroom_vehicle_description' => 'show',
        'autoshowroom_vehicle_description_limit' => '',
        'autoshowroom_vehicle_carousel_title_top' => 310,
        'autoshowroom_vehicle_carousel_height' => '',
        'autoshowroom_vehicle_carousel_height_options' => 'auto',
        'autoshowroom_vehicle_specifications' => 'show',
        'autoshowroom_specifications_values' => '',
        'autoshowroom_vehicle_carousel_button' => 'true',
        'autoshowroom_vehicle_carousel_loop' => 'true',
        'autoshowroom_vehicle_carousel_margin' => 30,
        'autoshowroom_vehicle_carousel_autoplay' => 'true',
    ), $atts));
    ob_start();
    wp_enqueue_style('autoshowroom-owl-animate');
    wp_enqueue_style('autoshowroom-owl-carousel-style');
    wp_enqueue_script('autoshowroom-owl-carousel-script');
    $ids = array_filter(str_replace(" ", '', explode(',', $autoshowroom_features_vehicles)));

    $height_values = $autoshowroom_vehicle_carousel_height_options;
    $height_val = '';
    $height_screen = '';
    if ($height_values == 'auto') {
        $height_val = '';
    } elseif ($height_values == 'screen') {
        $height_val = '';
        $height_screen = 'height-screen';
    } else {
        $height_val = $autoshowroom_vehicle_carousel_height;
    }
    $query_args = array(
        'post_type' => 'vehicle',
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page' => -1,
        'post__in' => $ids,
        'orderby' => 'post__in'
    );
    $vehicles = new WP_Query($query_args);
    $autoshowroom_vehicle_specifications_arr = explode(",", $autoshowroom_specifications_values);
    $showmsrp = ot_get_option('autoshowroom_Detail_show_msrp', 'yes');

    $autoshowroom_condition_arr = explode(",", 'condition');
    $autoshowroom_color_arr = explode(",", 'color');
    $autoshowroom_interior_arr = explode(",", 'interior');
    if ($vehicles->have_posts()) : ?>
        <div class="owl-carousel TZ-Vehicle-Slider TZ-Vehicle-Feature">

            <?php while ($vehicles->have_posts()) : $vehicles->the_post();
                $src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail_size');
                $url = $src[0];
                ?>
                <div class="item">
                    <div class="Vehicle-Feature-Image <?php echo esc_attr($height_screen); ?>"
                         style="height:<?php echo esc_attr($autoshowroom_vehicle_carousel_height); ?>px; background:url(<?php echo esc_attr($url); ?>) center no-repeat;background-size:cover;">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                    <?php if ($autoshowroom_vehicle_title == 'show') { ?>
                        <h4 class="Vehicle-Title container"
                            style="top:<?php echo esc_attr($autoshowroom_vehicle_carousel_title_top); ?>px;">
                            <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                            <span>
                            <label><?php esc_html_e('MSRP FROM', 'tz-autoshowroom'); ?></label>
                                <?php echo tz_autoshowroom_filter_vehicle_msrp_price(get_the_ID(), $showmsrp); ?>
                            </span>
                        </h4>
                    <?php } ?>
                    <?php
                    if ($autoshowroom_vehicle_description == 'show') { ?>
                        <div class="container">
                            <div class="vehicle-slider-des container">
                                <div class="slider-info">
                                    <h5><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
                                    <label><?php esc_html_e('Condition:', 'tz-autoshowroom'); ?></label>
                                    <?php echo tz_autoshowroom_get_vehicle_specs(get_the_ID(), $autoshowroom_condition_arr); ?>
                                    <label><?php esc_html_e('Exterior Color:', 'tz-autoshowroom'); ?></label>
                                    <?php echo tz_autoshowroom_get_vehicle_specs(get_the_ID(), $autoshowroom_color_arr); ?>
                                    <label><?php esc_html_e('Interior Color:', 'tz-autoshowroom'); ?></label>
                                    <?php echo tz_autoshowroom_get_vehicle_specs(get_the_ID(), $autoshowroom_interior_arr); ?>
                                    <?php if ($autoshowroom_vehicle_description_limit) { ?>
                                        <p><?php echo substr(strip_tags(get_the_excerpt()), 0, $autoshowroom_vehicle_description_limit); ?></p>
                                    <?php } else {
                                        echo get_the_excerpt();
                                    } ?>
                                </div>
                                <div class="vehicle-specs">
                                    <?php echo tz_autoshowroom_get_vehicle_specs(get_the_ID(), $autoshowroom_vehicle_specifications_arr); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    } ?>

                </div>
            <?php endwhile; ?>
        </div>

    <?php endif;
    wp_reset_postdata();
    ?>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            if (jQuery('.height-screen').length) {
                var win_height = jQuery(window).height();
                jQuery('.height-screen').height(win_height);
            }
            jQuery('.TZ-Vehicle-Slider').each(function () {
                jQuery(this).parents('.vc_row').addClass('over-hidden');
                jQuery(this).autoshowroom_owlCarousel({
                    loop:<?php echo esc_attr($autoshowroom_vehicle_carousel_loop); ?>,
                    center: true,
                    margin:<?php echo esc_attr($autoshowroom_vehicle_carousel_margin); ?>,
                    responsiveClass: true,
                    autoplay:<?php echo esc_attr($autoshowroom_vehicle_carousel_autoplay);?>,
                    animateOut: 'fadeOut',
                    animateIn: 'fadeIn',
                    smartSpeed: 900,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 1,
                            nav: false
                        },
                        1200: {
                            items: 1,
                            nav:<?php echo esc_attr($autoshowroom_vehicle_carousel_button);?>
                        }
                    }
                })
            })
        })

    </script>
    <?php
    $autoshowroom_vehicle_slider = ob_get_contents();
    ob_end_clean();
    return $autoshowroom_vehicle_slider;
}

add_shortcode('autoshowroom-vehicle-slider', 'autoshowroom_vehicle_slider');

?>