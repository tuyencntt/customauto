<?php
function autoshowroom_feature_vehicle( $atts )
{
    $autoshowroom_features_vehicles
        = $autoshowroom_vehicle_type
        = $autoshowroom_vehicle_title
        = $autoshowroom_vehicle_description
        = $item_color
        = $autoshowroom_vehicle_description_limit
        = $autoshowroom_vehicle_specifications = $autoshowroom_specifications_values = $tz_size
        = $autoshowroom_vehicle_carousel_number = $autoshowroom_vehicle_carousel_button
        = $autoshowroom_vehicle_carousel_loop = $autoshowroom_vehicle_carousel_margin
        = $autoshowroom_vehicle_carousel_autoplay = $autoshowroom_vehicle_carousel_layout = $autoshowroom_vehicle_carousel_dots
        = $el_class = $autoshowroom_col_desktop = $autoshowroom_col_tabletportrait = $autoshowroom_col_mobilelandscape = $autoshowroom_col_mobile = '';
    extract(shortcode_atts(array(
        'autoshowroom_features_vehicles' => '',
        'autoshowroom_vehicle_type' => 'type1',
        'autoshowroom_vehicle_title' => 'show',
        'autoshowroom_vehicle_description' => 'show',
        'autoshowroom_vehicle_description_limit' => '',
        'autoshowroom_vehicle_specifications' => 'show',
        'autoshowroom_specifications_values' => '',
        'autoshowroom_vehicle_carousel_layout' => 'grid',
        'tz_size' => 'large',
        'item_color' => '',
        'autoshowroom_vehicle_carousel_number' => 5,
        'autoshowroom_vehicle_carousel_button' => 'true',
        'autoshowroom_vehicle_carousel_dots' => 'false',
        'autoshowroom_vehicle_carousel_loop' => 'true',
        'autoshowroom_vehicle_carousel_margin' => 30,
        'autoshowroom_vehicle_carousel_autoplay' => 'true',
        'autoshowroom_col_desktop' => 4,
        'autoshowroom_col_tabletportrait' => 3,
        'autoshowroom_col_mobilelandscape' => 2,
        'autoshowroom_col_mobile' => 1,
        'el_class' => ''
    ), $atts));
    ob_start();
    wp_enqueue_style('autoshowroom-owl-carousel-style');
    wp_enqueue_script('autoshowroom-owl-carousel-script');
    $showmsrp       = ot_get_option('autoshowroom_Detail_show_msrp','yes');
    $ids = array_filter( str_replace(" ",'',explode(',', $autoshowroom_features_vehicles) ));
    $content_class = '';
    if($autoshowroom_vehicle_carousel_layout == 'grid'){
        $content_class = 'container';
    } else{
        $content_class = '';
    }
    if ($autoshowroom_col_desktop == 3) {
        $col_des = 'col-lg-4';
    } else {
        $col_des = 'col-lg-3';
    }
    if ($autoshowroom_col_tabletportrait == 3) {
        $col_tablet = 'col-md-4';
    } else {
        $col_tablet = 'col-md-3';
    }
    if ($autoshowroom_col_mobilelandscape == 1) {
        $col_mobilelandscape = 'col-sm-12';
    } else {
        $col_mobilelandscape = 'col-sm-6';
    }
    if ($autoshowroom_col_mobile == 1) {
        $col_mobile = 'col-xs-12';
    } else {
        $col_mobile = 'col-xs-6';
    }


    $query_args = array(
        'post_type'           	=> 'vehicle',
        'post_status'         	=> 'publish',
        'ignore_sticky_posts' 	=> 1,
        'posts_per_page'        => -1,
        'post__in'            	=> $ids,
        'orderby' 				=> 'post__in'
    );

    $vehicles = new WP_Query($query_args);
    $autoshowroom_specifications_arr = explode(",", $autoshowroom_specifications_values);
    $has_location = '';
    if (in_array('location', $autoshowroom_specifications_arr)) {
        $has_location = ' has-location';
    }
    $autoshowroom_speci_total = count($autoshowroom_specifications_arr);
    if ($vehicles->have_posts()) : ?>
        <?php if ($autoshowroom_vehicle_type != 'type4') : ?>
            <div class="owl-carousel features TZ-Vehicle-Feature <?php echo esc_attr($autoshowroom_vehicle_type); ?> <?php echo esc_attr($content_class); ?> <?php if ($el_class != '') echo esc_attr($el_class); ?>">

                <?php while ($vehicles->have_posts()) : $vehicles->the_post();
                    ?>
                    <div class="item" <?php
                    if ($item_color != '') {
                        echo 'style="background:' . $item_color . ';"';
                    }
                    ?>>
                        <div class="Vehicle-Feature-Image">
                            <a href="<?php echo get_permalink(); ?>">
                                <?php the_post_thumbnail($tz_size); ?>
                            </a>
                            <?php
                            $pricesold = get_field('autoshowroom_vehicle_sold', get_the_ID());
                            $pricetext = get_field('pricetext', get_the_ID());
                            $pricelink = get_field('pricelink', get_the_ID());
                            if ($pricesold == 'sold') { ?>
                                <p class="pcd-pricing">
                                    <span class="pcd-price"><?php echo esc_html__('SOLD', 'tz-autoshowroom'); ?></span>
                                </p>
                                <?php
                            } elseif ($pricesold == 'upcoming') { ?>
                                <p class="pcd-pricing">
                                    <span class="pcd-price"><?php echo esc_html__('Upcoming', 'tz-autoshowroom'); ?></span>
                                </p>
                                <?php
                            } elseif ($pricetext != '') { ?>
                                <p class="pcd-pricing">
                                    <?php
                                    if ($pricelink != ''){ ?>
                                    <a class="priceurl" href="<?php echo esc_url($pricelink); ?>">
                                        <?php }
                                        ?>

                                        <span class="pcd-price"><?php echo esc_attr($pricetext); ?></span>
                                        <?php
                                        if ($pricelink != ''){ ?>
                                    </a>
                                <?php }
                                ?>
                                </p>
                                <?php
                            } else {
                                echo balanceTags(tz_autoshowroom_filter_vehicle_price(get_the_ID(), $showmsrp));
                            }
                            ?>
                        </div>
                        <?php if ($autoshowroom_vehicle_title == 'show') { ?>
                            <h4 class="Vehicle-Title">
                                <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                        <?php } ?>
                        <?php
                        if ($autoshowroom_vehicle_description == 'show') {
                            if ($autoshowroom_vehicle_description_limit) { ?>
                                <div class="vehicle-feature-des">
                                    <p><?php echo substr(strip_tags(get_the_excerpt()), 0, $autoshowroom_vehicle_description_limit); ?></p>
                                </div>
                            <?php } else {
                                echo '<p class="vehicle-feature-excerpt">' . get_the_excerpt() . '</p>';
                            }
                        } ?>
                        <div class="vehicle-specs-<?php echo esc_attr__($autoshowroom_speci_total); ?> <?php echo esc_attr($has_location); ?>">
                            <?php echo tz_autoshowroom_get_vehicle_specs(get_the_ID(), $autoshowroom_specifications_arr); ?>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="TZ-Vehicle-Feature row <?php echo esc_attr($autoshowroom_vehicle_type); ?> <?php if ($el_class != '') echo esc_attr($el_class); ?>">

                <?php while ($vehicles->have_posts()) : $vehicles->the_post();
                    ?>
                    <div class="<?php echo $col_mobile . ' ' . $col_mobilelandscape . ' ' . $col_tablet . ' ' . $col_des; ?>">
                        <div class="item" <?php
                        if ($item_color != '') {
                            echo 'style="background:' . $item_color . ';"';
                        }
                        ?>>
                            <div class="Vehicle-Feature-Image">
                                <a href="<?php echo get_permalink(); ?>">
                                    <?php the_post_thumbnail($tz_size); ?>
                                </a>
                                <div class="Vehicle-Feature-content">
                                    <?php
                                    $pricesold = get_field('autoshowroom_vehicle_sold', get_the_ID());
                                    $pricetext = get_field('pricetext', get_the_ID());
                                    $pricelink = get_field('pricelink', get_the_ID());
                                    ?>
                                    <?php if ($autoshowroom_vehicle_title == 'show') { ?>
                                        <h4 class="Vehicle-Title">
                                            <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                                        </h4>
                                    <?php } ?>
                                    <div class="vehicle-specs-<?php echo esc_attr__($autoshowroom_speci_total); ?>">
                                        <?php echo tz_autoshowroom_get_vehicle_specs(get_the_ID(), $autoshowroom_specifications_arr); ?>
                                        <div class="clearfix"></div>
                                    </div>
                                    <?php
                                    if ($pricesold == 'sold') { ?>
                                        <div class="pcd-pricing-read">
                                            <p class="pcd-pricing">
                                                <span class="pcd-price"><?php echo esc_html__('SOLD', 'tz-autoshowroom'); ?></span>
                                            </p>
                                            <a href="<?php the_permalink(); ?>" class="read-more"><i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                        <?php
                                    } elseif ($pricesold == 'upcoming') { ?>
                                        <div class="pcd-pricing-read">
                                            <p class="pcd-pricing">
                                                <span class="pcd-price"><?php echo esc_html__('Upcoming', 'tz-autoshowroom'); ?></span>
                                            </p>
                                            <a href="<?php the_permalink(); ?>" class="read-more"><i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                        <?php
                                    } elseif ($pricetext != '') { ?>
                                        <div class="pcd-pricing-read">
                                            <p class="pcd-pricing">
                                                <?php
                                                if ($pricelink != ''){ ?>
                                                <a class="priceurl" href="<?php echo esc_url($pricelink); ?>">
                                                    <?php }
                                                    ?>

                                                    <span class="pcd-price"><?php echo esc_attr($pricetext); ?></span>
                                                    <?php
                                                    if ($pricelink != ''){ ?>
                                                </a>
                                            <?php }
                                            ?>
                                            </p>
                                            <a href="<?php the_permalink(); ?>" class="read-more"><i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                        <?php
                                    } else { ?>
                                        <div class="pcd-pricing-read <?php if (tz_autoshowroom_filter_vehicle_price(get_the_ID(), $showmsrp) == '') : echo 'just-end'; endif; ?>">
                                            <?php echo balanceTags(tz_autoshowroom_filter_vehicle_price(get_the_ID(), $showmsrp)); ?>
                                            <a href="<?php the_permalink(); ?>" class="read-more"><i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                        <?php

                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

        <?php endif; ?>
    <?php endif;
    wp_reset_postdata();
    ?>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('.features.TZ-Vehicle-Feature').each(function () {
                jQuery(this).parents('.vc_row').addClass('over-hidden');
                jQuery(this).autoshowroom_owlCarousel({
                    loop:<?php echo esc_attr($autoshowroom_vehicle_carousel_loop); ?>,
                    margin:<?php echo esc_attr($autoshowroom_vehicle_carousel_margin); ?>,
                    responsiveClass: true,
                    autoplay:<?php echo esc_attr($autoshowroom_vehicle_carousel_autoplay);?>,
                    dots: <?php echo esc_attr($autoshowroom_vehicle_carousel_dots); ?>,
                    <?php if(is_rtl() == true){ ?>
                    rtl: true,
                    <?php } ?>
                    responsive: {
                        0: {
                            items: 1,
                            nav: true,
                            center: false
                        },
                        600: {
                            items: 1,
                            nav: true,
                            center: false
                        },
                        1024: {
                            items: 2,
                            nav: true,
                            center: false
                        },
                        1200: {
                            items:<?php echo esc_attr($autoshowroom_vehicle_carousel_number);?>,
                            nav:<?php echo esc_attr($autoshowroom_vehicle_carousel_button);?>,
                            center: false
                        }
                    }
                })
            })
        })

    </script>
<?php
    $autoshowroom_feature_vehicle = ob_get_contents();
    ob_end_clean();
    return $autoshowroom_feature_vehicle;
}
add_shortcode('autoshowroom-feature-vehicle', 'autoshowroom_feature_vehicle');

?>