<?php

function autoshowroom_condition_vehicle( $atts )
{
    $autoshowroom_vehicle_condition
    = $autoshowroom_vehicle_title
    = $autoshowroom_vehicle_style
    = $autoshowroom_vehicle_description
    = $autoshowroom_vehicle_description_limit
    = $autoshowroom_col_desktop
    = $autoshowroom_col_tabletportrait
    = $autoshowroom_col_mobilelandscape
    = $autoshowroom_col_mobile
    = $autoshowroom_limit
    = $autoshowroom_vehicle_specifications = $autoshowroom_specifications_values = $tz_size
    = $autoshowroom_vehicle_carousel_number = $autoshowroom_vehicle_carousel_button
    = $autoshowroom_vehicle_carousel_loop = $autoshowroom_vehicle_carousel_margin
    = $autoshowroom_vehicle_carousel_autoplay= $autoshowroom_vehicle_carousel_layout = $autoshowroom_vehicle_carousel_center = $autoshowroom_vehicle_carousel_dots
    = $el_class = '';
    extract(shortcode_atts(array(
        'autoshowroom_vehicle_condition'            =>  'new',
        'autoshowroom_vehicle_title'                =>  'show',
        'autoshowroom_vehicle_style'                =>  'slider',
        'autoshowroom_vehicle_description'          =>  'show',
        'autoshowroom_vehicle_description_limit'    =>  '',
        'autoshowroom_vehicle_specifications'       =>  'show',
        'autoshowroom_specifications_values'        =>  '',
        'autoshowroom_vehicle_carousel_layout'      =>  'grid',
        'autoshowroom_vehicle_carousel_center'      =>  'true',
        'tz_size'                                   =>  'large',
        'autoshowroom_vehicle_carousel_number'      =>  5,
        'autoshowroom_vehicle_carousel_button'      =>  'true',
        'autoshowroom_vehicle_carousel_dots'        =>  'false',
        'autoshowroom_vehicle_carousel_loop'        =>  'true',
        'autoshowroom_vehicle_carousel_margin'      =>  30,
        'autoshowroom_vehicle_carousel_autoplay'    =>  'true',
        'autoshowroom_limit'                        =>  9,
        'autoshowroom_col_desktop'                  =>  '',
        'autoshowroom_col_tabletportrait'           =>  '',
        'autoshowroom_col_mobilelandscape'          =>  '',
        'autoshowroom_col_mobile'                   =>  '',
        'el_class'                                  =>  ''
    ), $atts));
    ob_start();
    wp_enqueue_style('autoshowroom-owl-carousel-style');
    wp_enqueue_script('autoshowroom-owl-carousel-script');
    $showmsrp       = ot_get_option('autoshowroom_Detail_show_msrp','yes');
    $content_class = '';
    if($autoshowroom_vehicle_carousel_layout == 'grid'){
        $content_class = 'container';
    } else{
        $content_class = '';
    }

    $query_args = array(
        'post_type'=>'vehicle',
        'post_status'=>'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page'      => -1,
        'meta_query' => array(
            array(
                'key' => 'condition',
                'value' => $autoshowroom_vehicle_condition,
            ),
        ),
    );
    $vehicles = new WP_Query( $query_args );
    $autoshowroom_specifications_arr = explode(",",$autoshowroom_specifications_values);
    $autoshowroom_speci_total = count($autoshowroom_specifications_arr);
    $autoshowroom_column_class = '';
    if($autoshowroom_col_desktop != ''){
        $autoshowroom_column_class = ' desk_'.$autoshowroom_col_desktop.'_column';
    }

    if($autoshowroom_col_tabletportrait != ''){
        $autoshowroom_column_class .= ' tabletportrait_'.$autoshowroom_col_tabletportrait.'_column';
    }

    if($autoshowroom_col_mobilelandscape != ''){
        $autoshowroom_column_class .= ' mobilelandscape_'.$autoshowroom_col_mobilelandscape.'_column';
    }

    if($autoshowroom_col_mobile != ''){
        $autoshowroom_column_class .= ' mobileportrait_'.$autoshowroom_col_mobile.'_column';
    }
    if($autoshowroom_vehicle_style == 'grid'){
        if( get_query_var('paged') ) {
            $paged = get_query_var('paged');
        }elseif ( get_query_var('page' ) ){
            $paged = get_query_var('page') ;
        }else{
            $paged = 1;
        }
        $query_args = array(
            'post_type'=>'vehicle',
            'post_status'=>'publish',
            'ignore_sticky_posts' => 1,
            'paged' => $paged,
            'posts_per_page' => $autoshowroom_limit,
            'meta_query' => array(
                array(
                    'key' => 'condition',
                    'value' => $autoshowroom_vehicle_condition,
                ),
            ),
        );
        $vehicles = new WP_Query( $query_args );
        wp_enqueue_script('autoshowroom-masonry-pkgd');
        wp_enqueue_script('autoshowroom-imagesloaded');
        wp_enqueue_script('autoshowroom-masonry');
        wp_enqueue_script('autoshowroom-portfolio');
        wp_enqueue_script('autoshowroom-portfolio-ajax');
        ?>
        <div class="TZ-ElementPortfolio container-content">
        <div class="TZ-Portfolio-Grid <?php echo esc_attr($autoshowroom_column_class);?> ">
            <div class="TZ-Vehicle-content">
        <?php
        while ($vehicles->have_posts()) : $vehicles->the_post();
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class("TZ-PortfolioGrid-Item "); ?>>
            <div class="tz-inner">
                <div class="TZ-Vehicle-Grid">
                    <div class="item">
                        <div class="Vehicle-Feature-Image">
                            <a href="<?php echo get_permalink(); ?>">
                                <?php the_post_thumbnail($tz_size); ?>
                            </a>

                            <?php
                            $pricesold = get_field('autoshowroom_vehicle_sold',get_the_ID());
                            $pricetext = get_field( 'pricetext',get_the_ID());
                            $daily = get_field( 'pricerental',get_the_ID());
                            $time_rental = get_field('time_rental', get_the_ID());
                            $pricelink = get_field( 'pricelink',get_the_ID());

                            if($pricesold=='sold'){ ?>
                                <p class="pcd-pricing">
                                    <span class="pcd-price"><?php echo esc_html__('SOLD','tz-autoshowroom');?></span>
                                </p>
                                <?php
                            }elseif($pricesold == 'upcoming'){ ?>
                                <p class="pcd-pricing">
                                    <span class="pcd-price"><?php echo esc_html__('Upcoming','tz-autoshowroom');?></span>
                                </p>
                                <?php
                            }elseif($daily != ''){ ?>
                                <p class="pcd-pricing pcd-perday">
                                    <span class="pcd-price"><?php echo esc_attr('$'.$daily);?> <em><?php esc_html_e('/  per', 'tz-autoshowroom'); ?> <?php echo esc_attr($time_rental);?></em></span>
                                </p>
                                <?php
                            } elseif($pricetext !='') { ?>
                                <p class="pcd-pricing">
                                    <?php
                                    if($pricelink !=''){ ?>
                                    <a class="priceurl" href="<?php echo esc_url($pricelink);?>">
                                        <?php }                                               ?>

                                        <span class="pcd-price"><?php echo esc_attr($pricetext);?></span>
                                        <?php
                                        if($pricelink !=''){ ?>
                                    </a>
                                <?php }
                                ?>
                                </p>
                                <?php
                            }else
                            {
                                echo balanceTags(tz_autoshowroom_filter_vehicle_price(get_the_ID(),$showmsrp));
                            }
                            ?>

                        </div>
                        <h4 class="Vehicle-Title">
                            <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                        <?php if ($autoshowroom_vehicle_description_limit) { ?>
                            <div class="vehicle-feature-des">
                                <p><?php echo substr(strip_tags(get_the_excerpt()), 0, $autoshowroom_vehicle_description_limit); ?></p>
                            </div>
                        <?php } else {
                            echo get_the_excerpt();
                        } ?>
                        <?php echo tz_autoshowroom_get_vehicle_specs(get_the_ID(), $autoshowroom_specifications_arr); ?>
                    </div>
                </div>
            </div>
        </div>
            <?php
        endwhile;
        ?>
        </div>
            <?php
            if ( function_exists('wp_pagenavi') ):
                wp_pagenavi( array( 'query'    =>  $vehicles ));
            endif;
            wp_reset_postdata();
            ?>
        </div>
        </div>
        <script type="text/javascript">
            // set column
            var tzDesktop               =   <?php echo esc_attr($autoshowroom_col_desktop);?>,
                tztabletportrait        =   <?php echo esc_attr($autoshowroom_col_tabletportrait);?>,
                tzmobilelandscape       =   <?php echo esc_attr($autoshowroom_col_mobilelandscape);?>,
                tzmobileportrait        =   <?php echo esc_attr($autoshowroom_col_mobile);?>,
                tzpg_resizeTimer        =  null;
        </script><!--end script recent-work-->
        <?php
    }else {
        if ($vehicles->have_posts()) : ?>
            <div class="owl-carousel features TZ-Vehicle-Feature TZ-Condition-vehicle <?php echo esc_attr($content_class); ?> <?php if ($el_class != '') echo esc_attr($el_class); ?>">

                <?php while ($vehicles->have_posts()) : $vehicles->the_post();
                    ?>
                    <div class="item">
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
                                    <p><?php echo substr(strip_tags(get_the_excerpt()), 1, $autoshowroom_vehicle_description_limit); ?></p>
                                </div>
                            <?php } else {
                                echo '<p class="vehicle-feature-excerpt">' . get_the_excerpt() . '</p>';
                            }
                        } ?>
                        <div class="vehicle-specs-<?php echo esc_attr__($autoshowroom_speci_total); ?>">
                            <?php echo tz_autoshowroom_get_vehicle_specs(get_the_ID(), $autoshowroom_specifications_arr); ?>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                <?php endwhile; ?>
            </div>

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
                                center: <?php echo esc_attr($autoshowroom_vehicle_carousel_center); ?>
                            }
                        }
                    })
                })
            })

        </script>
        <?php
    }
    $autoshowroom_condition_vehicle = ob_get_contents();
    ob_end_clean();
    return $autoshowroom_condition_vehicle;
}
add_shortcode('autoshowroom-condition-vehicle', 'autoshowroom_condition_vehicle');

?>