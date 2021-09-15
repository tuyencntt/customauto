<?php
/*
 * Element Tz View Post
 * */
function autoshowroom_post_slider($atts) {
    $autoshowroom_type_get_post = $autoshowroom_category = $autoshowroom_post = $autoshowroom_post_style = $autoshowroom_limit = $autoshowroom_post_description_limit = $tz_size = $autoshowroom_orderby = $autoshowroom_order = $autoshowroom_carousel_button = $autoshowroom_carousel_dot = $autoshowroom_carousel_autoplay = $autoshowroom_carousel_loop = $autoshowroom_css_animation = '';
    extract(shortcode_atts(array(
        'autoshowroom_type_get_post'          => 'category',
        'autoshowroom_category'               => '',
        'autoshowroom_post'                   => '',
        'autoshowroom_post_style'             => 'style1',
        'autoshowroom_limit'                  => '',
        'autoshowroom_post_description_limit' => 80,
        'tz_size'                             => '',
        'autoshowroom_orderby'                => '',
        'autoshowroom_order'                  => '',
        'autoshowroom_carousel_button'        => 'true',
        'autoshowroom_carousel_dot'           => 'true',
        'autoshowroom_carousel_autoplay'      => 'true',
        'autoshowroom_carousel_loop'          => 'true',
        'autoshowroom_css_animation'          => '',
    ),$atts));
    ob_start();

    wp_enqueue_style( 'autoshowroom-owl-carousel-style' );
    wp_enqueue_script('autoshowroom-owl-carousel-script');
    if($autoshowroom_post_style == 'style2') {
        wp_enqueue_script('resize');
        wp_enqueue_script('autoshowroom-post-slider');
    }
    $autoshowroom_post_slider_class = '';
    $tz_id = mt_rand();
    if($autoshowroom_css_animation != ''){
        wp_enqueue_script( 'waypoints' );
        $autoshowroom_post_slider_class .= ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_css_animation;
    }
    if($autoshowroom_type_get_post == 'category'){
        $autoshowroom_cat_id =  get_cat_ID( $autoshowroom_category );

        if ( isset ( $autoshowroom_cat_id ) && $autoshowroom_cat_id != '' ):
            $autoshowroom_args = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $autoshowroom_limit,
                'orderby'           =>  $autoshowroom_orderby,
                'order'             =>  $autoshowroom_order,
                'cat'               =>  $autoshowroom_cat_id,
            );
        else:
            $autoshowroom_args = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $autoshowroom_limit,
                'orderby'           =>  $autoshowroom_orderby,
                'order'             =>  $autoshowroom_order,
            );
        endif;
    }else{
        $autoshowroom_post_ids = array_filter( explode(',', $autoshowroom_post) );
        $autoshowroom_args = array(
            'post_type'           	=> 'post',
            'posts_per_page'        => -1,
            'post_status'         	=> 'publish',
            'ignore_sticky_posts' 	=> 1,
            'post__in'            	=> $autoshowroom_post_ids,
            'orderby' 				=> 'post__in'
        );
    }
    $autoshowroom_news_query = '';
    $autoshowroom_news_query = new WP_Query( $autoshowroom_args );
    if ( $autoshowroom_news_query -> have_posts() ):
        if($autoshowroom_post_style == 'style1') {
            ?>
            <div class="autoshowroom-post-slider <?php echo esc_attr($autoshowroom_post_slider_class); ?>">
                <div class="autoshowroom-post-slider-box">
                    <?php
                    while ($autoshowroom_news_query->have_posts()): $autoshowroom_news_query->the_post();
                        $autoshowroom_comment_count = wp_count_comments(get_the_ID());
                        ?>
                        <div class="autoshowroom-post-slider-item">
                            <div class="autoshowroom-post-image">
                                <?php the_post_thumbnail($tz_size); ?>
                                <div class="autoshowroom-post-date">
                                    <i class="far fa-clock"></i>
                                    <span><?php echo get_the_time('M j, Y', get_the_ID()); ?></span>
                                </div>
                            </div>
                            <div class="autoshowroom-post-back">
                                <div class="autoshowroom-post-back-box">
                                    <span class="autoshowroom-post-back-comment">
                                        <i class="far fa-comments"></i>
                                        <?php echo esc_html($autoshowroom_comment_count->total_comments); ?>
                                    </span>
                                </div>
                                <div class="autoshowroom-post-back-box">
                                    <span class="autoshowroom-post-back-like">
                                        <i class="fas fa-heart"></i>
                                        <?php echo tz_autoshowroom_getPostViews(get_the_ID()); ?>
                                    </span>
                                </div>
                                <div class="autoshowroom-post-back-box">
                                    <div class="autoshowroom-post-back-share">
                                        ...
                                        <div class="autoshowroom-post-back-share-box">
                                            <a target="_blank"
                                               href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fab fa-facebook-f"></i></a>
                                            <a target="_blank"
                                               href="https://twitter.com/home?status=Checkoutthisarticle:<?php print tz_autoshowroom_social_title(get_the_title()); ?>-<?php echo urlencode(the_permalink()); ?>"><i class="fab fa-twitter"></i>
                                            </a>
                                            <?php $autoshowroom_pin_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>
                                            <a data-pin-do="skipLink" target="_blank"
                                               href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo esc_attr($autoshowroom_pin_image); ?>&amp;description="><i class="fab fa-pinterest"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="autoshowroom-post-front">
                                    <div class="autoshowroom-post-front-box">
                                        <div class="autoshowroom-post-front-avata">
                                            <?php echo get_avatar(get_the_author_meta('ID')); ?>
                                        </div>
                                        <div class="autoshowroom-post-front-info">
                                        <span class="autoshowroom-post-front-info-author">
                                            <?php esc_html_e('Post by ', 'tz-autoshowroom'); ?><a
                                                    href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
                                        </span>
                                            <span class="autoshowroom-divider">|</span>
                                            <?php
                                            if (get_the_category() != false) {
                                                ?>
                                                <span class="autoshowroom-post-front-info-category">
                                        <?php
                                        the_category(', ');
                                        ?>
                                    </span>
                                            <?php } ?>
                                        </div>
                                        <h3 class="autoshowroom-post-front-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <?php
                                        if ($autoshowroom_post_description_limit) { ?>
                                            <p><?php echo substr(strip_tags(get_the_excerpt()), 0, $autoshowroom_post_description_limit);?></p>
                                        <?php } else {
                                            echo get_the_excerpt();
                                        } ?>
                                        <a href="<?php the_permalink(); ?>"
                                           class="autoshowroom-readmore"><?php esc_html_e('Read More &raquo;', 'tz-autoshowroom'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function () {
                        "use strict";
                        jQuery('.autoshowroom-post-slider-box').autoshowroom_owlCarousel({
                            loop: <?php echo esc_attr($autoshowroom_carousel_loop); ?>,
                            center: false,
                            margin: 30,
                            responsiveClass: true,
                            autoplay:<?php echo esc_attr($autoshowroom_carousel_autoplay); ?>,
                            dots: <?php echo esc_attr($autoshowroom_carousel_dot); ?>,
                            <?php if(is_rtl() == true){ ?>
                            rtl:true,
                            <?php } ?>
                            responsive: {
                                0: {
                                    items: 1
                                },
                                600: {
                                    items: 2,
                                    nav: false
                                },
                                1200: {
                                    items: 3,
                                    nav: <?php echo esc_attr($autoshowroom_carousel_button);?>
                                }
                            }
                        })
                    });
                </script>
            </div>
            <?php
        }elseif ($autoshowroom_post_style == 'style2'){ ?>
            <?php
            $autoshowroom_args1 = array(
                'numberposts' => -1,
                'offset' => 0,
                'category' => 0,
                'orderby' => 'post_date',
                'order' => 'DESC',
                'post_type' => 'post',
                'post_status' => 'publish',
                'suppress_filters' => true
            );
            $autoshowroom_post_slider_2 = wp_get_recent_posts($autoshowroom_args1);
            ?>
            <div class="autoshowroom_post_slider_style2">
                <?php
                $autoshowroom_count = 1;
                $autoshowroom_i = 1;
                $aventura_total = count($autoshowroom_post_slider_2);

                foreach( $autoshowroom_post_slider_2 as $post_style2 ){
                    $aventura_date_format = get_option( 'date_format' );

                    $tz_post_thumbnail_id = get_post_thumbnail_id($post_style2["ID"]);
                    $tz_post_thumbnail = wpb_getImageBySize( array(
                        'attach_id' => $tz_post_thumbnail_id,
                        'thumb_size' => $tz_size,
                    ) );
                    $tz_image_thumbnail = $tz_post_thumbnail['thumbnail'];
                    ?>
                    <?php if($autoshowroom_count%4==1):?>
                        <div class="autoshowroom_post_item">
                    <?php endif;?>

                    <div class="autoshowroom_post_item_child autoshowroom_post_item_<?php echo esc_attr($autoshowroom_i)?>">
                        <div class="autoshowroom_post_item_box">
                            <?php if(isset($tz_image_thumbnail)): ?>
                            <div class="tz_post_image">
                                <?php echo $tz_image_thumbnail; ?>
                            </div>
                            <?php endif; ?>
                            <div class="tz_post_info">
                                <span class="autoshowroom_post_date">
                                    <?php echo get_the_date( $aventura_date_format, $post_style2["ID"] );?>
                                </span>
                                <span class="autoshowroom-post-author">
                                    <?php esc_html_e('By ', 'tz-autoshowroom'); ?><a
                                    href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
                                </span>
                                <h3 class="autoshowroom_post_title"><a href="<?php echo get_permalink($post_style2["ID"]); ?>"><?php echo $post_style2["post_title"]; ?></a></h3>
                                <?php if($autoshowroom_i != '1'): ?>
                                <p class="autoshowroom_excerpt"><?php echo get_the_excerpt($post_style2["ID"]); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php if($autoshowroom_count%4==0 || $autoshowroom_count == $aventura_total):?>
                        </div>
                        <?php $autoshowroom_i=0;endif;?>
                    <?php
                    $autoshowroom_count++;
                    $autoshowroom_i++;
                }
                ?>
            </div>
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    "use strict";
                    jQuery('.autoshowroom_post_slider_style2').autoshowroom_owlCarousel({
                        loop: <?php echo esc_attr($autoshowroom_carousel_loop); ?>,
                        center: false,
                        margin: 30,
                        <?php if(is_rtl() == true){ ?>
                        rtl:true,
                        <?php } ?>
                        responsiveClass: true,
                        dots: <?php echo esc_attr($autoshowroom_carousel_dot); ?>,
                        items: 1
                    })
                });
            </script>
        <?php
        }
        endif; // endif have_post
    return ob_get_clean();
}
add_shortcode('autoshowroom-post-slider','autoshowroom_post_slider');
?>