<?php
/*
 * Element tz Portfolio Grid
 * */

function autoshowroom_portfolio_vehicle_sold($atts)
{
    $autoshowroom_make = $autoshowroom_orderby = $autoshowroom_order = $autoshowroom_col_desktop = $autoshowroom_col_tabletportrait
        = $autoshowroom_col_mobilelandscape = $autoshowroom_col_mobile = $autoshowroom_limit = $autoshowroom_filter_option = $autoshowroom_filter_type
        = $autoshowroom_button_option = $autoshowroom_height_option = $autoshowroom_height_item = $autoshowroom_type_hover = $autoshowroom_css_animation
        = $autoshowroom_portfolio_description_limit = $autoshowroom_portfolio_specifications_values = $autoshowroom_vehicle_sold = '';
    extract(shortcode_atts(array(
        'autoshowroom_make' => '',
        'autoshowroom_filter_option' => 'show',
        'autoshowroom_limit' => 10,
        'autoshowroom_orderby' => 'date',
        'autoshowroom_order' => 'desc',
        'autoshowroom_col_desktop' => 3,
        'autoshowroom_col_tabletportrait' => 3,
        'autoshowroom_col_mobilelandscape' => 2,
        'autoshowroom_col_mobile' => 1,
        'autoshowroom_css_animation' => '',
        'autoshowroom_portfolio_specifications_values' => '',
        'autoshowroom_portfolio_description_limit' => 80,
        'autoshowroom_vehicle_sold' => 'yes',
    ), $atts));
    ob_start();
    wp_enqueue_script('autoshowroom-masonry-pkgd');
    wp_enqueue_script('autoshowroom-imagesloaded');
    wp_enqueue_script('autoshowroom-masonry');
    wp_enqueue_script('autoshowroom-portfolio');
    wp_enqueue_script('autoshowroom-portfolio-ajax-sold');
    $autoshowroom_class = '';
    if ($autoshowroom_css_animation != '') {
        wp_enqueue_script('vc_waypoints');
        $autoshowroom_class = ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_css_animation;
    }
    $autoshowroom_portfolio_specifications_arr = explode(",", $autoshowroom_portfolio_specifications_values);

    ?>
    <div class="TZ-ElementPortfolio <?php echo esc_attr($autoshowroom_class); ?>">
        <?php
        $autoshowroom_column_class = '';
        if ($autoshowroom_col_desktop != '') {
            $autoshowroom_column_class = ' desk_' . $autoshowroom_col_desktop . '_column';
        }

        if ($autoshowroom_col_tabletportrait != '') {
            $autoshowroom_column_class .= ' tabletportrait_' . $autoshowroom_col_tabletportrait . '_column';
        }

        if ($autoshowroom_col_mobilelandscape != '') {
            $autoshowroom_column_class .= ' mobilelandscape_' . $autoshowroom_col_mobilelandscape . '_column';
        }

        if ($autoshowroom_col_mobile != '') {
            $autoshowroom_column_class .= ' mobileportrait_' . $autoshowroom_col_mobile . '_column';
        }
        ?>
        <div class="TZ-Portfolio-Grid <?php echo esc_attr($autoshowroom_column_class); ?> ">
            <?php
            if ($autoshowroom_filter_option == 'show') {
                ?>
                <div class="tzfilter" data-option-key="filter">
                    <div class="tzFillter_box">
                        <a href="javascript: "
                           data-option-limit="<?php echo esc_attr($autoshowroom_limit); ?>"
                           data-option-orderby="<?php echo esc_attr($autoshowroom_orderby); ?>"
                           data-option-order="<?php echo esc_attr($autoshowroom_order); ?>"
                           data-option-id="<?php echo esc_attr($autoshowroom_make); ?>"
                           data-option-value="*" class="selected autoshowroom-make">
                            <?php esc_html_e('All', 'tz-autoshowroom'); ?>
                        </a>
                        <?php
                        $terms = get_terms('make');
                        if (isset ($terms) && $terms != false && $terms != ''):
                            foreach ($terms as $term): ?>
                                <a class="TZHide autoshowroom-make"
                                   data-option-limit="<?php echo esc_attr($autoshowroom_limit); ?>"
                                   data-option-orderby="<?php echo esc_attr($autoshowroom_orderby); ?>"
                                   data-option-order="<?php echo esc_attr($autoshowroom_order); ?>"
                                   data-option-id="<?php echo esc_attr($term->term_id); ?>"
                                   id="<?php echo 'autoshowroom-' . esc_attr($term->slug); ?>" href="javascript: "
                                   data-option-value=".<?php echo 'autoshowroom-' . esc_attr($term->slug); ?>">
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
            ?>
            <div class="TZ-Vehicle-content">
                <?php
                if (get_query_var('paged')) {
                    $paged = get_query_var('paged');
                } elseif (get_query_var('page')) {
                    $paged = get_query_var('page');
                } else {
                    $paged = 1;
                }

                if ($autoshowroom_make != '') {
                    $cat_id = explode(",", $autoshowroom_make);
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
                    if ($autoshowroom_vehicle_sold == 'yes') {
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
                                array(
                                    'key' => 'autoshowroom_vehicle_sold',
                                    'value' => 'sold',
                                    'compare' => '=',
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
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'make',
                                    'filed' => 'id',
                                    'terms' => $tzcat,
                                )
                            )
                        );
                    }

                } else {
                    $args = array(
                        'post_type' => 'vehicle',
                        'paged' => $paged,
                        'posts_per_page' => $autoshowroom_limit,
                        'orderby' => $autoshowroom_orderby,
                        'order' => $autoshowroom_order,
                    );
                }

                $fp_query = new WP_Query($args);
                if ($fp_query->have_posts()): while ($fp_query->have_posts()): $fp_query->the_post();
                    $terms_post = get_the_terms($fp_query->post->ID, 'make');
                    $class_filter = '';
                    if (isset ($terms_post) && $terms_post != false && $terms_post != ''):
                        foreach ($terms_post as $term_item):
                            $class_filter .= 'autoshowroom-' . $term_item->slug . ' ';
                        endforeach;
                    endif;

                    $post_thumbnail_id = get_post_thumbnail_id($fp_query->post->ID);
                    $image_src = wp_get_attachment_image_src($post_thumbnail_id, 'feature-image'); // get info image

                    if ($autoshowroom_height_option == 'depends' && has_post_thumbnail()):
                        $imageWidth = $image_src[1];
                        $imageHeight = $image_src[2];
                    endif;

                    ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class("TZ-PortfolioGrid-Item $class_filter "); ?>>
                        <div class="tz-inner">
                            <div class="TZ-Vehicle-Grid">
                                <div class="item">
                                    <div class="Vehicle-Feature-Image">
                                        <a href="<?php echo get_permalink(); ?>">
                                            <?php the_post_thumbnail('large'); ?>
                                        </a>
                                        <p class="pcd-pricing">
                                            <span class="pcd-price"><?php echo esc_html__('SOLD', 'tz-autoshowroom'); ?></span>
                                        </p>
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
                endwhile;
                    wp_reset_postdata();
                endif;

                ?>
            </div><!--end class tzPortfolio-->
            <div class="auto-loading"></div>

            <?php
            if ($autoshowroom_button_option == 'show') {
                ?>
                <div id="autoshowroom_append">
                    <a href="#autoshowroom_append"><i class="fa fa-plus"></i></a>
                </div><!--end id autoshowroom_append-->
                <?php
            }
            ?>
            <div id="loadajax" style="display: none;">
                <?php
                if (function_exists('wp_pagenavi')):
                    wp_pagenavi(array('query' => $fp_query));
                endif;
                ?>
            </div>

        </div><!--end class tzPortfolio_Grid-->
        <script type="text/javascript">
            // set column
            var tzDesktop =   <?php echo esc_attr($autoshowroom_col_desktop);?>,
                tztabletportrait =   <?php echo esc_attr($autoshowroom_col_tabletportrait);?>,
                tzmobilelandscape =   <?php echo esc_attr($autoshowroom_col_mobilelandscape);?>,
                tzmobileportrait =   <?php echo esc_attr($autoshowroom_col_mobile);?>,
                tzpg_resizeTimer = null;
        </script><!--end script recent-work-->

    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('autoshowroom-portfolio-vehicle-sold', 'autoshowroom_portfolio_vehicle_sold');
?>