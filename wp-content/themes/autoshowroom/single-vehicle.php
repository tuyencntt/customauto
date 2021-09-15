<?php get_header(); ?>
<?php get_template_part('template_inc/inc', 'menu'); ?>
<?php get_template_part('template_inc/inc', 'title-breadcrumb');

$symbol = get_option('options_pcd_currency_symbol', '$');
$txttaxes = ot_get_option('autoshowroom_Detail_tax_txt');
$txtrelated = ot_get_option('autoshowroom_Detail_related_txt', 'Related Cars');
$autoshowroom_detail_make = ot_get_option('autoshowroom_Detail_show_make');
$autoshowroom_detail_model = ot_get_option('autoshowroom_Detail_show_model');
$autoshowroom_TZVehicleCalculator_on = ot_get_option('autoshowroom_TZVehicleCalculator_on','on');
$autoshowroom_TZVehicleCalculator_Title = ot_get_option('autoshowroom_TZVehicleCalculator_Title');
$autoshowroom_TZVehicleCalculator_down = ot_get_option('autoshowroom_TZVehicleCalculator_down');
$autoshowroom_TZVehicleCalculator_months = ot_get_option('autoshowroom_TZVehicleCalculator_down_months');
$autoshowroom_portfolio_description_limit = ot_get_option('autoshowroom_TZVehicle_limit');
$autoshowroom_portfolio_specifications_arr = ot_get_option('autoshowroom_TZVehicle_specs');

$autoshowroom_detail_popup = ot_get_option('autoshowroom_Detail_show_popup', 'yes');

$autoshowroom_related_show = ot_get_option('autoshowroom_Detail_show_related');
$autoshowroom_related_number = ot_get_option('autoshowroom_Detail_related_number', '4');

$txtprice = ot_get_option('autoshowroom_TZVehicleCalculator_price_txt');
$txtdownpay = ot_get_option('autoshowroom_TZVehicleCalculator_d_txt');
$txtrate = ot_get_option('autoshowroom_TZVehicleCalculator_rate_txt');
$txtPeriod = ot_get_option('autoshowroom_TZVehicleCalculator_loan_txt');
$txtbtn = ot_get_option('autoshowroom_TZVehicleCalculator_btn_txt');

$txtmonty = ot_get_option('autoshowroom_TZVehicleCalculator_monthy_txt');
$txtannual = ot_get_option('autoshowroom_TZVehicleCalculator_annual_txt');
$txttotal = ot_get_option('autoshowroom_TZVehicleCalculator_total_txt');

$showcompare = ot_get_option('autoshowroom_Detail_show_compare', 'yes');
$showbrochure = ot_get_option('autoshowroom_Detail_show_brochure', 'yes');

$showmsrp = ot_get_option('autoshowroom_Detail_show_msrp', 'yes');
$stock_number = get_field('autoshowroom_stock_number_manually',get_the_ID());

if ($autoshowroom_detail_popup == 'yes') {
    wp_enqueue_style('autoshowroom-lightgallery-css');
    wp_enqueue_script('autoshowroom-lightgallery');
    wp_enqueue_script('autoshowroom-mousewheel');
}
wp_enqueue_style('autoshowroom-ekko-css');
wp_enqueue_script('autoshowroom-ekko');
?>
    <section class="container-content default-page vehicle-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="vehicle-title"><?php the_title(); ?></h1>
                    <div class="vehicle_url" style="display: none"><?php the_permalink(); ?></div>
                    <div class="vehicle-btn-function">
                        <?php if ($stock_number != '') { ?>
                            <span class="btn-stock">
                                                        <?php esc_html_e('Stock# ', 'autoshowroom'); ?>
                                                        <strong>
                        <?php esc_html_e($stock_number, 'autoshowroom'); ?></strong>
                                                    </span>
                        <?php } ?>
                        <?php if ($showcompare == 'yes') { ?>
                            <span class="btn-function btn_detail_compare"
                                  data-images="<?php the_post_thumbnail_url('medium'); ?>"
                                  data-id="<?php echo esc_attr(get_the_ID()); ?>"
                                  data-text="<?php esc_html_e('In Compare List', 'autoshowroom'); ?>">
                                <i class="fa fa-car"></i>
                                <?php esc_html_e('Add to Compare', 'autoshowroom'); ?>
                            </span>
                        <?php } ?>
                        <?php if ($showbrochure == 'yes' && get_post_meta(get_the_ID(), 'autoshowroom_vehicle_brochure',true)) { ?>
                            <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'autoshowroom_vehicle_brochure', true)); ?>">
                                <span class="btn-function"><i
                                            class="fa fa-file-pdf-o"></i> <?php esc_html_e('Car Brochure', 'autoshowroom'); ?></span>
                            </a>
                        <?php } ?>
                    </div>
                    <?php
                    $autoshowroom_video = get_post_meta(get_the_ID(), 'video');
                    $autoshowroom_gallery = get_post_meta(get_the_ID(), 'images');
                    if (isset($autoshowroom_video[0]) && isset($autoshowroom_video[0]) != '') {
                        preg_match("/iframe/", $autoshowroom_video[0], $output_array);
                        if (isset($output_array[0]) != '') {
                            preg_match("/src=\"([^\"]+)\"/", $autoshowroom_video[0], $output_array);
                            $autoshowroom_video = $output_array[1];
                        } else {
                            $autoshowroom_video = $autoshowroom_video[0];
                        }
                    }
                    if (!empty($autoshowroom_video) && !empty($autoshowroom_gallery[0])) {
                        ?>
                        <div id="slider" class="flexslider">
                            <div class="video_vehicle_button">
                                <a href="<?php echo esc_url($autoshowroom_video); ?>" id="open-youtube"
                                   data-max-width="800">
                                    <i class="fa fa-video-camera"></i>
                                </a></div>
                            <ul class="slides cardeal_slide">
                                <?php
                                if ($autoshowroom_images = get_post_meta(get_the_ID(), 'images')) {
                                    foreach ($autoshowroom_images[0] as $image) { ?>
                                        <li data-src="<?php echo esc_url(wp_get_attachment_url($image)); ?>">
                                            <a><img src="<?php echo esc_url(wp_get_attachment_url($image)); ?>"
                                                    alt="<?php echo esc_attr(get_the_title()); ?>"/></a>
                                        </li>
                                    <?php }
                                }
                                ?>
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                <?php
                                if ($autoshowroom_images = get_post_meta(get_the_ID(), 'images')) {
                                    foreach ($autoshowroom_images[0] as $image) { ?>
                                        <li>
                                            <?php echo wp_get_attachment_image($image, 'medium'); ?>
                                        </li>
                                    <?php }
                                } ?>
                            </ul>
                        </div>

                        <?php
                    } elseif (!empty($autoshowroom_video) && empty($autoshowroom_gallery[0])) {
                        ?>
                        <div class="vehicle_video">
                            <?php
                            if (wp_oembed_get($autoshowroom_video)) :
                                echo wp_oembed_get($autoshowroom_video);
                            else :
                                echo balanceTags($autoshowroom_video);
                            endif;
                            ?> </div>
                        <?php

                    } elseif (empty($autoshowroom_video) && !empty($autoshowroom_gallery[0])) {
                        ?>

                        <div id="slider" class="flexslider">

                            <ul class="slides cardeal_slide">
                                <?php
                                if ($autoshowroom_images = get_post_meta(get_the_ID(), 'images')) {
                                    foreach ($autoshowroom_images[0] as $image) { ?>
                                        <li data-src="<?php echo esc_url(wp_get_attachment_url($image)); ?>">
                                            <a><img src="<?php echo esc_url(wp_get_attachment_url($image)); ?>"
                                                    alt="<?php echo esc_attr(get_the_title()); ?>"/></a>
                                        </li>
                                    <?php }
                                }
                                ?>
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                <?php
                                if ($autoshowroom_images = get_post_meta(get_the_ID(), 'images')) {
                                    foreach ($autoshowroom_images[0] as $image) { ?>
                                        <li>
                                            <?php echo wp_get_attachment_image($image, 'medium'); ?>
                                        </li>
                                    <?php }
                                } ?>
                            </ul>
                        </div>
                    <?php } else {
                        ?>
                        <div class="single_auto_image">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="vehicle-content">
                        <?php
                        echo apply_filters('the_content', get_field('content'));
                        ?>
                        <div class="vehicle-content-tab">
                            <ul class="vehicle_tab" id="vehicle-tab" role="tablist">
                                <?php if (get_field('vehicle_overview', get_the_ID())) { ?>
                                    <li class="nav-item active">
                                        <a class="nav-link" id="vehicle_overview-tab" data-toggle="tab"
                                           href="#vehicle_overview" role="tab" aria-controls="vehicle_overview"
                                           aria-selected="true">
                                            <?php echo get_field('vehicle_overview_title'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (get_field('vehicle_options', get_the_ID())) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="vehicle_info-tab" data-toggle="tab" href="#vehicle_info"
                                           role="tab" aria-controls="vehicle_info" aria-selected="false">
                                            <?php echo get_field('vehicle_options_title'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (get_field('vehicle_information', get_the_ID())) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="vehicle_contact-tab" data-toggle="tab"
                                           href="#vehicle_contact" role="tab" aria-controls="vehicle_contact"
                                           aria-selected="false">
                                            <?php echo get_field('vehicle_information_title'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (get_field('vehicle_tab4', get_the_ID())) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="vehicle_tab4-tab" data-toggle="tab" href="#vehicle_tab4"
                                           role="tab" aria-controls="vehicle_tab4" aria-selected="false">
                                            <?php echo get_field('vehicle_tab4_title'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (get_field('vehicle_tab5', get_the_ID())) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="vehicle_tab5-tab" data-toggle="tab" href="#vehicle_tab5"
                                           role="tab" aria-controls="vehicle_tab5" aria-selected="false">
                                            <?php echo get_field('vehicle_tab5_title'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content" id="vehicle-tabContent">
                                <?php if (get_field('vehicle_overview', get_the_ID())) { ?>
                                    <div class="tab-pane active" id="vehicle_overview" role="tabpanel"
                                         aria-labelledby="vehicle_overview-tab">
                                        <?php
                                        echo apply_filters('the_content', get_field('vehicle_overview'));
                                        ?>
                                    </div>
                                <?php } ?>
                                <?php if (get_field('vehicle_options', get_the_ID())) { ?>
                                    <div class="tab-pane fade" id="vehicle_info" role="tabpanel"
                                         aria-labelledby="vehicle_info-tab">
                                        <?php
                                        echo apply_filters('the_content', get_field('vehicle_options'));
                                        ?>
                                    </div>
                                <?php } ?>
                                <?php if (get_field('vehicle_information', get_the_ID())) { ?>
                                    <div class="tab-pane fade" id="vehicle_contact" role="tabpanel"
                                         aria-labelledby="vehicle_contact-tab">
                                        <?php
                                        echo apply_filters('the_content', get_field('vehicle_information'));
                                        ?>
                                    </div>
                                <?php } ?>
                                <?php if (get_field('vehicle_tab4', get_the_ID())) { ?>
                                    <div class="tab-pane fade" id="vehicle_tab4" role="tabpanel"
                                         aria-labelledby="vehicle_tab4-tab">
                                        <?php
                                        echo apply_filters('the_content', get_field('vehicle_tab4'));
                                        ?>
                                    </div>
                                <?php } ?>
                                <?php if (get_field('vehicle_tab5', get_the_ID())) { ?>
                                    <div class="tab-pane fade" id="vehicle_tab5" role="tabpanel"
                                         aria-labelledby="vehicle_tab5-tab">
                                        <?php
                                        echo apply_filters('the_content', get_field('vehicle_tab5'));
                                        ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="autoshowroom-comment-content">
                            <?php comments_template('', true); ?>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 autoshowroom-sidebar">
                    <?php
                    $pricesold = get_field('autoshowroom_vehicle_sold', get_the_ID());
                    $pricetext = get_field('pricetext', get_the_ID());
                    $daily = get_field('pricerental', get_the_ID());
                    $time_rental = get_field('time_rental', get_the_ID());
                    $pricelink = get_field('pricelink', get_the_ID());
                    if ($pricesold == 'sold') { ?>
                        <p class="pcd-pricing">
                            <span class="pcd-price"><?php echo esc_html__('SOLD', 'autoshowroom'); ?></span>
                        </p>
                        <?php
                    } elseif ($pricesold == 'upcoming') { ?>
                        <p class="pcd-pricing">
                            <span class="pcd-price"><?php echo esc_html__('Upcoming', 'autoshowroom'); ?></span>
                        </p>
                        <?php
                    } elseif ($daily != '') { ?>
                        <p class="pcd-pricing price-center">
                            <span class="pcd-price"><?php echo esc_attr('$' . $daily); ?><em> <?php esc_html_e('/  per', 'autoshowroom'); ?> <?php echo esc_attr($time_rental);?></em></span>
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
                    <p class="center"><?php echo esc_html($txttaxes); ?></p>
                    <div class="vehicle-box">
                        <h3 class="widget-title"><span><?php esc_html_e('Specifications', 'autoshowroom'); ?></span>
                        </h3>
                        <?php if ($autoshowroom_detail_model || $autoshowroom_detail_make == 'yes') : ?>
                            <div class="pcd-specs">
                                <?php if ($autoshowroom_detail_make == 'yes') { ?>
                                    <div>
                                        <label><?php esc_html_e('Make', 'autoshowroom'); ?></label>
                                        <span>
                                    <?php $autoshowroom_vehicle_make = wp_get_post_terms(get_the_ID(), 'make');
                                    foreach ($autoshowroom_vehicle_make as $make) {
                                        $ve_make = $make->slug;
                                        echo esc_attr($make->name);
                                    }
                                    ?>
                                </span>
                                    </div>
                                <?php } ?>
                                <?php if ($autoshowroom_detail_model == 'yes') { ?>
                                    <div>
                                        <label><?php esc_html_e('Model', 'autoshowroom'); ?></label>
                                        <span>
                                    <?php $autoshowroom_vehicle_make = wp_get_post_terms(get_the_ID(), 'model');
                                    foreach ($autoshowroom_vehicle_make as $make) {
                                        echo esc_attr($make->name);
                                    }
                                    ?>
                                </span>
                                    </div>
                                <?php } ?>
                                <div class="clr"></div>
                            </div>
                        <?php endif; ?>
                        <?php echo balanceTags(tz_autoshowroom_get_vehicle_specs(get_the_ID(), 'all')); ?>
                        <?php
                        if (class_exists('Comment_Rating_Output')):
                            $average_rating = get_post_meta(get_the_ID(), 'tz-average-rating', true);
                            if (empty($average_rating)) {
                                $average_rating = 0;
                            }
                            echo '<div class="tz-average-rating"><div class="tz-rating tz-rating-' . esc_attr($average_rating) . '"></div></div>';
                        endif;
                        ?>
                    </div>
                    <?php if (is_active_sidebar("vehicle-bottom-right")) : ?>
                        <?php dynamic_sidebar("vehicle-bottom-right"); ?>
                    <?php endif; ?>
                    <?php
                    if ($autoshowroom_TZVehicleCalculator_on == 'on') {
                        ?>
                        <div class="vehicle-box">
                            <h3 class="widget-title">
                                <span><?php echo esc_html($autoshowroom_TZVehicleCalculator_Title); ?></span></h3>
                            <div class="payment-calculator">
                                <label><?php echo balanceTags($txtprice); ?></label>
                                <input class="payment-price" type="text" value="" readonly/>
                                <label><?php echo balanceTags($txtdownpay); ?></label>
                                <input type="text" name="down payment" value="" class="down-pay-percent"/>
                                <label><?php echo balanceTags($txtrate); ?></label>
                                <select class="pay_rate">
                                    <?php
                                    foreach ($autoshowroom_TZVehicleCalculator_down as $autoshowroom_downpay) {
                                        ?>
                                        <option value="<?php echo esc_attr($autoshowroom_downpay["autoshowroom_TZVehicleCalculator_Annual"]); ?>"
                                        ><?php echo esc_attr($autoshowroom_downpay["autoshowroom_TZVehicleCalculator_Annual"]); ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <label><?php echo balanceTags($txtPeriod); ?></label>
                                <select class="down-pay-years">
                                    <?php
                                    foreach ($autoshowroom_TZVehicleCalculator_months as $autoshowroom_down) {
                                        ?>
                                        <option value="<?php echo esc_attr($autoshowroom_down["autoshowroom_TZVehicleCalculator_down_payment_month"]); ?>"><?php echo esc_attr($autoshowroom_down["autoshowroom_TZVehicleCalculator_down_payment_month"]); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>

                                <button class="payment_cal_btn" value=""><?php echo esc_attr($txtbtn); ?></button>

                            </div>
                            <div class="payment_result">
                                <span><?php echo esc_html($txtmonty); ?></span>
                                <span class="strong"><?php echo esc_attr($symbol); ?><strong
                                            class="monthy"></strong></span>
                                <span><?php echo esc_html($txtannual); ?></span>
                                <span class="strong"><?php echo esc_attr($symbol); ?><strong
                                            class="free-amount"></strong></span>
                                <span><?php echo esc_html($txttotal); ?></span>
                                <span class="strong"><?php echo esc_attr($symbol); ?><strong class="total-pay"></strong></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php if ($autoshowroom_related_show == 'yes') {
                ?>
                <div class="related-container">
                    <h3> <?php echo $txtrelated; ?></h3>
                    <div class="row">
                        <?php
                        global $post;
                        $number = 12 / $autoshowroom_related_number;
                        $related = get_posts(array('post_type' => 'vehicle',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'make',
                                    'field' => 'slug',
                                    'terms' => $ve_make,
                                )
                            ),
                            'numberposts' => $autoshowroom_related_number,
                            'post__not_in' => array($post->ID)));

                        if ($related) foreach ($related as $post) {
                            setup_postdata($post); ?>

                            <div class="vehicle-grid col-md-<?php echo $number; ?>">
                                <div class="TZ-Vehicle-Grid">
                                    <div class="item">
                                        <div class="Vehicle-Feature-Image">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('large'); ?>
                                            </a>
                                        </div>
                                        <h4 class="Vehicle-Title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h4>
                                        <?php if ($autoshowroom_portfolio_description_limit) {
                                            $desc = substr(strip_tags(get_the_excerpt()), 0, $autoshowroom_portfolio_description_limit);
                                            ?>
                                            <div class="vehicle-feature-des">
                                                <p><?php echo esc_attr($desc); ?></p>
                                            </div>
                                        <?php } else {
                                            echo get_the_excerpt();
                                        } ?>

                                        <?php echo balanceTags(tz_autoshowroom_get_vehicle_specs(get_the_ID(), $autoshowroom_portfolio_specifications_arr)); ?>
                                        <?php
                                        $pricesold = get_field('autoshowroom_vehicle_sold', get_the_ID());
                                        $pricetext = get_field('pricetext', get_the_ID());
                                        $daily = get_field('pricerental', get_the_ID());
                                        $time_rental = get_field('time_rental', get_the_ID());
                                        $pricelink = get_field('pricelink', get_the_ID());
                                        if ($pricesold == 'sold') { ?>
                                            <p class="pcd-pricing">
                                                <span class="pcd-price"><?php echo esc_html__('SOLD', 'autoshowroom'); ?></span>
                                            </p>
                                            <?php
                                        } elseif ($pricesold == 'upcoming') { ?>
                                            <p class="pcd-pricing">
                                                <span class="pcd-price"><?php echo esc_html__('Upcoming', 'autoshowroom'); ?></span>
                                            </p>
                                            <?php
                                        } elseif ($daily != '') { ?>
                                            <p class="pcd-pricing price-center">
                                                <span class="pcd-price"><?php echo esc_attr('$' . $daily); ?><em> <?php esc_html_e('/  per', 'autoshowroom'); ?> <?php echo esc_attr($time_rental);?></em></span>
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
                                        <div class="vehicle-btn">
                                    <span class="btn-function btn_detail_compare"
                                          data-text="<?php esc_html_e('In Compare List', 'autoshowroom'); ?>"
                                          data-id="<?php echo esc_attr(get_the_ID()); ?>">
                                        <i class="fa fa-car"></i>
                                        <?php esc_html_e('Add to Compare', 'autoshowroom'); ?>
                                    </span>
                                            <a href="<?php the_permalink(); ?>">
                                                <i class="fa fa-arrow-circle-right"></i>
                                                <?php esc_html_e('View More', 'autoshowroom'); ?>
                                            </a>
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        wp_reset_postdata(); ?>
                        <div class="clr"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <script type="text/javascript">
        jQuery(window).load(function () {

            jQuery('#open-youtube').on('click', function (e) {
                e.preventDefault();
                jQuery(this).ekkoLightbox();
            });
            <?php if($autoshowroom_detail_popup == 'yes'){
            ?>
            jQuery('.cardeal_slide').lightGallery();
            <?php } ?>
            var slider_width = jQuery('#slider').width() - 40;
            jQuery('#tab-description').addClass('in_active');
            var item_width = (slider_width / 5);

            jQuery('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: item_width,
                itemMargin: 10,
                move: 5,
                asNavFor: '#slider'
            });

            jQuery('#slider').flexslider({
                animation: "fade",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                smoothHeight: true,
                sync: "#carousel",
                directionNav: false,
                start: function (slider) {
                    jQuery('body').removeClass('loading');
                }
            });

            var price_payment = jQuery('.autoshowroom-sidebar .pcd-pricing .pcd-price').text();

            jQuery('.payment-calculator .payment-price').attr('value', jQuery.trim(price_payment));

            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            }

            jQuery('.payment_cal_btn').on('click', function () {

                var price_item = jQuery('.payment-price').val();
                var down_percent = jQuery('.down-pay-percent').val();
                var interest_rate = jQuery('.pay_rate').val();
                var period_time = jQuery('.down-pay-years').val();

                var price_number = price_item.replace(/[^0-9]/g, '');

                if (price_number === down_percent) {
                    jQuery('.monthy').html(0);
                    jQuery('.free-amount').html(0);
                    jQuery('.total-pay').html(price_number);
                    jQuery('.payment_result').addClass('active');
                } else if (down_percent < 0) {
                    alert('Value must be greater than zero !');
                } else {
                    var price = price_number - down_percent;
                    var balance = parseFloat(price);

                    var monthly_payment = ((interest_rate / (100 * 12)) * price) / (1 - Math.pow(1 + interest_rate / 1200, (-period_time)));
                    var loan_payment = monthly_payment * period_time;
                    console.log(loan_payment);
                    var total_interest = monthly_payment * period_time - balance;

                    jQuery('.monthy').html(formatNumber(monthly_payment.toLocaleString('en', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })));
                    jQuery('.free-amount').html(formatNumber(total_interest.toLocaleString('en', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })));
                    jQuery('.total-pay').html(formatNumber(loan_payment.toLocaleString('en', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })));
                    jQuery('.payment_result').addClass('active');
                }
            })
        });
    </script>

<?php get_template_part('template_inc/inc', 'contact'); ?>
<?php
get_footer();
