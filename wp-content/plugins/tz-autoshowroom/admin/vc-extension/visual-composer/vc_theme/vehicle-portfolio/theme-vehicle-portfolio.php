<?php
/*
 * Element tz Portfolio Grid
 * */

function autoshowroom_portfolio_vehicle($atts) {
    $autoshowroom_make = $autoshowroom_orderby = $autoshowroom_order = $autoshowroom_col_desktop = $autoshowroom_col_tabletportrait
        = $autoshowroom_col_mobilelandscape = $autoshowroom_col_mobile = $autoshowroom_limit = $autoshowroom_filter_option = $autoshowroom_filter_type = $tz_size
        = $autoshowroom_button_option = $autoshowroom_height_option = $autoshowroom_height_item = $autoshowroom_type_hover = $autoshowroom_css_animation
        = $autoshowroom_portfolio_description_limit = $autoshowroom_portfolio_specifications_values = $autoshowroom_sold= $autoshowroom_layout =
    $autoshowroom_shownav ='';
    extract(shortcode_atts(array(
        'autoshowroom_make'                   =>  '',
        'autoshowroom_sold'                   =>  'show',
        'autoshowroom_filter_option'          =>  'show',
        'autoshowroom_limit'                  =>  10,
        'tz_size'                             =>  '',
        'autoshowroom_shownav'                =>  'hide',
        'autoshowroom_orderby'                =>  'date',
        'autoshowroom_order'                  =>  'desc',
        'autoshowroom_col_desktop'            =>  3,
        'autoshowroom_col_tabletportrait'     =>  3,
        'autoshowroom_col_mobilelandscape'    =>  2,
        'autoshowroom_col_mobile'             =>  1,
        'autoshowroom_css_animation'          => '',
        'autoshowroom_portfolio_specifications_values'          => '',
        'autoshowroom_portfolio_description_limit'          => 80,
        'autoshowroom_layout'          => 'grid',
    ),$atts));
    ob_start();
    if($autoshowroom_layout=='grid') {
        wp_enqueue_script('autoshowroom-masonry-pkgd');
        wp_enqueue_script('autoshowroom-imagesloaded');
        wp_enqueue_script('autoshowroom-masonry');
        wp_enqueue_script('autoshowroom-portfolio');
        wp_enqueue_script('autoshowroom-portfolio-ajax');
        $layout_class = '';
    }else{
        $layout_class = 'vehicle-layout-list';
        wp_enqueue_script('autoshowroom-custom-plugin');
    }
    $showmsrp       = ot_get_option('autoshowroom_Detail_show_msrp','yes');
    $autoshowroom_class = '';
    if($autoshowroom_css_animation != ''){
        wp_enqueue_script( 'vc_waypoints' );
        $autoshowroom_class = ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_css_animation;
    }
    $taxonomies = 'make';
    $vehicle_portfolio = get_terms( $taxonomies );
    $autoshowroom_make_term = explode(",", $autoshowroom_make);
    if ($autoshowroom_make == '') {
        foreach ($vehicle_portfolio as $cat){
            $autoshowroom_make_arr[] = $cat;
        }
    } else {
        foreach ($autoshowroom_make_term as $cat) {
            $autoshowroom_make_arr[] = get_term_by('id',$cat,'make');
        }
    }
    foreach ($autoshowroom_make_arr as $make_term) {
        if($make_term){
            $make_term_id[] = $make_term->term_id;
        }

    }
    $autoshowroom_make_id = implode(',',$make_term_id);
    $autoshowroom_portfolio_specifications_arr = explode(",",$autoshowroom_portfolio_specifications_values);

    ?>
    <div class="TZ-ElementPortfolio container-content <?php echo esc_attr($autoshowroom_class);?>">

        <?php
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
        ?>
        <div class="TZ-Portfolio-Grid <?php echo esc_attr($autoshowroom_column_class);?> ">
            <?php
            if($autoshowroom_layout=='grid') {
                if ($autoshowroom_filter_option == 'show') {
                    ?>
                    <div class="tzfilter" data-option-key="filter">
                        <div class="tzFillter_box">
                            <a href="javascript: "
                               data-option-limit="<?php echo esc_attr($autoshowroom_limit); ?>"
                               data-option-orderby="<?php echo esc_attr($autoshowroom_orderby); ?>"
                               data-option-order="<?php echo esc_attr($autoshowroom_order); ?>"
                               data-option-id="<?php echo esc_attr($autoshowroom_make_id); ?>"
                               data-option-value="*" class="selected autoshowroom-make"
                               data-option-sold="<?php echo esc_attr($autoshowroom_sold); ?>"
                               data-option-specs="<?php echo esc_attr($autoshowroom_portfolio_specifications_values); ?>"
                               data-option-nav="<?php echo esc_attr($autoshowroom_shownav); ?>">
                                <?php esc_html_e('All', 'tz-autoshowroom'); ?>
                            </a>
                            <?php
                            $cat_makes = explode(',',$autoshowroom_make_id);
                            $terms = get_terms( 'make', array(
                                'include' => $cat_makes,
                            ) );
                            if (isset ($terms) && $terms != false && $terms != ''):
                                foreach ($terms as $term): ?>
                                    <a class="TZHide autoshowroom-make"
                                       data-option-limit="<?php echo esc_attr($autoshowroom_limit); ?>"
                                       data-option-orderby="<?php echo esc_attr($autoshowroom_orderby); ?>"
                                       data-option-order="<?php echo esc_attr($autoshowroom_order); ?>"
                                       data-option-id="<?php echo esc_attr($term->term_id); ?>"
                                       data-option-specs="<?php echo esc_attr($autoshowroom_portfolio_specifications_values); ?>"
                                       id="<?php echo 'autoshowroom-' . esc_attr($term->slug); ?>"
                                       href="javascript: "
                                       data-option-value=".<?php echo 'autoshowroom-' . esc_attr($term->slug); ?>"
                                       data-option-sold="<?php echo esc_attr($autoshowroom_sold); ?>">
                                        <?php echo esc_html($term->name); ?>
                                    </a>
                                <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div><!--tzfilter-->
                    <?php
                }
            }
            ?>
            <div class="TZ-Vehicle-content <?php echo esc_attr($layout_class);?>">
                <?php
                if( get_query_var('paged') ) {
                    $paged = get_query_var('paged');
                }elseif ( get_query_var('page' ) ){
                    $paged = get_query_var('page') ;
                }else{
                    $paged = 1;
                }
                if($autoshowroom_sold=='show') {
                    if ($autoshowroom_make_id != '') {
                        $cat_id = explode(",", $autoshowroom_make_id);
                        $tzcat = array();

                        if (is_array($cat_id)) {
                            sort($cat_id);
                            $count_cat = count($cat_id);

                            for ($i = 0; $i < $count_cat; $i++) {
                                $tzcat[] = (int)$cat_id[$i];
                            }
                        } else {
                            $tzcat[] = (int)$cat_id;
                        }
                        $args = array(
                            'post_type' => 'vehicle',
                            'paged' => $paged,
                            'posts_per_page' => $autoshowroom_limit,
                            'orderby' => $autoshowroom_orderby,
                            'order' => $autoshowroom_order,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'make',
                                    'filed' => 'id',
                                    'terms' => $tzcat,
                                )
                            )
                        );
                    } else {
                        $args = array(
                            'post_type' => 'vehicle',
                            'paged' => $paged,
                            'posts_per_page' => $autoshowroom_limit,
                            'orderby' => $autoshowroom_orderby,
                            'order' => $autoshowroom_order,
                        );
                    }
                }else{
                    if ($autoshowroom_make_id != '') {
                        $cat_id = explode(",", $autoshowroom_make_id);
                        $tzcat = array();

                        if (is_array($cat_id)) {
                            sort($cat_id);
                            $count_cat = count($cat_id);

                            for ($i = 0; $i < $count_cat; $i++) {
                                $tzcat[] = (int)$cat_id[$i];
                            }
                        } else {
                            $tzcat[] = (int)$cat_id;
                        }
                        $args = array(
                            'post_type' => 'vehicle',
                            'paged' => $paged,
                            'posts_per_page' => $autoshowroom_limit,
                            'orderby' => $autoshowroom_orderby,
                            'order' => $autoshowroom_order,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'make',
                                    'filed' => 'id',
                                    'terms' => $tzcat,
                                )
                            ),
                            'meta_query' => array(
                                'relation' => 'OR',
                                array(
                                    'key'     => 'autoshowroom_vehicle_sold',
                                    'value'   => 'sold',
                                    'compare' => '!=',
                                ),
                                array(
                                    'key'     => 'autoshowroom_vehicle_sold',
                                    'compare' => 'NOT EXISTS',
                                ),
                            ),
                        );
                    } else {
                        $args = array(
                            'post_type' => 'vehicle',
                            'paged' => $paged,
                            'posts_per_page' => $autoshowroom_limit,
                            'orderby' => $autoshowroom_orderby,
                            'order' => $autoshowroom_order,
                            'meta_query' => array(
                                array(
                                    'key'     => 'autoshowroom_vehicle_sold',
                                    'value'   => 'sold',
                                    'compare' => '!=',
                                ),
                            ),
                        );
                    }
                }

                $fp_query = new WP_Query( $args );

                if ( $fp_query -> have_posts()): while($fp_query -> have_posts()): $fp_query -> the_post();
                    $terms_post = get_the_terms( $fp_query->post->ID, 'make' );
                    $class_filter  = '';
                    if ( isset ( $terms_post ) && $terms_post != false && $terms_post != '' ):
                        foreach ( $terms_post as $term_item ):
                            $class_filter .= 'autoshowroom-'.$term_item -> slug .' ';
                        endforeach;
                    endif;

                    $post_thumbnail_id = get_post_thumbnail_id( $fp_query->post->ID );
                    $image_src = wp_get_attachment_image_src( $post_thumbnail_id, 'feature-image' ); // get info image

                    if ( $autoshowroom_height_option == 'depends' && has_post_thumbnail() ):
                        $imageWidth   =     $image_src[1];
                        $imageHeight  =     $image_src[2];
                    endif;
                    $car_sold = get_field('autoshowroom_vehicle_sold',get_the_ID());
                    if($autoshowroom_layout=='list'){
                        ?>

                        <div class="vehicle-grid vehicle-list">
                            <div class="TZ-Vehicle-Grid">
                                <div class="item">
                                    <div class="Vehicle-Feature-Image">
                                        <a href="<?php echo get_permalink(); ?>">
                                            <?php the_post_thumbnail($tz_size); ?>
                                        </a>
                                    </div>
                                    <h4 class="Vehicle-Title">
                                        <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    <?php if ($autoshowroom_portfolio_description_limit) { ?>
                                        <div class="vehicle-feature-des">
                                            <p><?php echo substr(strip_tags(get_the_excerpt()), 0, $autoshowroom_portfolio_description_limit); ?></p>
                                        </div>
                                    <?php } else {
                                        echo get_the_excerpt();
                                    }
                                    echo tz_autoshowroom_get_vehicle_specs(get_the_ID(), $autoshowroom_portfolio_specifications_arr);

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
                                            <span class="pcd-price"><?php echo esc_attr('$'.$daily);?><em> <?php esc_html_e('/  per', 'tz-autoshowroom'); ?> <?php echo esc_attr($time_rental);?></em></span>
                                        </p>
                                        <?php
                                    } elseif($pricetext !='') {?>
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
                                    <div class="vehicle-btn">
                                            <span class="btn-function btn_detail_compare" data-text="<?php esc_html_e('In Compare List','tz-autoshowroom');?>"
                                                  data-id="<?php echo esc_attr(get_the_ID());?>">
                                                <i class="fa fa-car"></i>
                                                <?php esc_html_e('Add to Compare','tz-autoshowroom');?>
                                            </span>
                                        <a href="<?php the_permalink(); ?>">
                                            <i class="fa fa-arrow-circle-right"></i>
                                            <?php esc_html_e('View More','tz-autoshowroom'); ?>
                                        </a>
                                    </div>
                                    <div class="clr"></div>
                                </div>
                            </div>
                        </div>
                    <?php }else { ?>

                        <div id="post-<?php the_ID(); ?>" <?php post_class("TZ-PortfolioGrid-Item $class_filter "); ?>>
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
                                                    <span class="pcd-price"><?php echo esc_attr('$'.$daily);?> <em> <?php esc_html_e('/  per', 'tz-autoshowroom'); ?> <?php echo esc_attr($time_rental);?></em></span>

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
                                        <?php if ($autoshowroom_portfolio_description_limit) { ?>
                                            <div class="vehicle-feature-des">
                                                <p><?php echo substr(strip_tags(get_the_excerpt()), 0, $autoshowroom_portfolio_description_limit); ?></p>
                                            </div>
                                        <?php } else {
                                            echo get_the_excerpt();
                                        } ?>
                                        <?php echo tz_autoshowroom_get_vehicle_specs(get_the_ID(), $autoshowroom_portfolio_specifications_arr); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                endwhile;
                    wp_reset_postdata();
                endif;

                ?>
            </div><!--end class tzPortfolio-->
            <?php
            if($autoshowroom_shownav=='show'){
                if ( function_exists('wp_pagenavi') ):
                    wp_pagenavi( array( 'query'    =>  $fp_query ));
                endif;
            }
            ?>
            <div class="auto-loading"></div>

            <?php
            if($autoshowroom_button_option == 'show'){
                ?>
                <div id="autoshowroom_append">
                    <a href="#autoshowroom_append"><i class="fa fa-plus"></i></a>
                </div><!--end id autoshowroom_append-->
                <?php
            }
            ?>
        </div><!--end class tzPortfolio_Grid-->
        <script type="text/javascript">
            // set column
            var tzDesktop               =   <?php echo esc_attr($autoshowroom_col_desktop);?>,
                tztabletportrait        =   <?php echo esc_attr($autoshowroom_col_tabletportrait);?>,
                tzmobilelandscape       =   <?php echo esc_attr($autoshowroom_col_mobilelandscape);?>,
                tzmobileportrait        =   <?php echo esc_attr($autoshowroom_col_mobile);?>,
                tzpg_resizeTimer        =  null;
        </script><!--end script recent-work-->

    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('autoshowroom-portfolio-vehicle','autoshowroom_portfolio_vehicle');
?>