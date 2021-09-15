<?php
/*
 * Element tz-feature-item
 * */

/**
 * @param $atts
 * @param null $content
 * @return string
 */
function autoshowroom_theme_blog($atts, $content = null)
{
    $blog_style = $get_posts = $cate_post = $get_title_post = $limit = $order = $order_by = $autoshowroom_special_blog_title = $blog_column = '';
    extract(shortcode_atts(array(
        'blog_style' => '1',
        'get_posts' => '',
        'cate_post' => '',
        'get_title_post' => '',
        'limit' => '2',
        'order' => '',
        'order_by' => '',
        'autoshowroom_special_blog_title' => '',
        'blog_column' => '2',
    ), $atts));
    ob_start();
    $col_value = '';
    if ($blog_column == 2) {
        $col_value = '6';
    } elseif ($blog_column == 3) {
        $col_value = '4';
    } else {
        $col_value = '3';
    }
    $tz_class = '';
    if ($blog_style == '1' || $blog_style == '2') {
        $tz_class = "homev6_blog";
    } elseif ($blog_style == '3') {
        $tz_class = "tz_blogservice";
    }
    ?>

    <div class="<?php echo $tz_class; ?>">
        <div class="blog_content">
            <div class="row">
                <?php
                if ($get_posts == 1 && $cate_post != '') :
                    $tz_autoshowroom_our_blog_args = array(

                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'cat' => $cate_post,
                        'posts_per_page' => $limit,
                        'ignore_sticky_posts' => $limit,
                        'orderby' => $order_by,
                        'order' => $order,

                    );

                elseif ($get_posts == 2 && $get_title_post != '') :

                    $get_title_post_ids = array_filter(str_replace(" ", '', explode(',', $get_title_post)));

                    $tz_autoshowroom_our_blog_args = array(

                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'orderby' => $order_by,
                        'order' => $order,
                        'post__in' => $get_title_post_ids,

                    );

                else:
                    $tz_autoshowroom_our_blog_args = array(

                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => $limit,
                        'ignore_sticky_posts' => $limit,
                        'orderby' => $order_by,
                        'order' => $order,

                    );

                endif;
                $tz_autoshowroom_our_blog_post = new WP_Query($tz_autoshowroom_our_blog_args);
                $i = 0;
                if ($tz_autoshowroom_our_blog_post->have_posts()) :
                    while ($tz_autoshowroom_our_blog_post->have_posts()) :
                        $tz_autoshowroom_our_blog_post->the_post();
                        $autoshowroom_comment_count = wp_count_comments(get_the_ID());
                        $i++;
                        if ($limit % 2 == '0' ){
                            $tz_class = ' col-sm-6';
                        }else{
                            if ($i == $limit){
                                $tz_class = ' tz_height';
                            }
                            else{
                                $tz_class = ' col-sm-6';
                            }
                        }
                        ?>

                        <div class="blog_content__item col-md-<?php echo esc_attr($col_value); ?> col-lg-<?php echo esc_attr($col_value); ?><?php echo $tz_class;?> col-xs-12 blog-style-<?php echo esc_attr($blog_style); ?>">
                            <div class="blog_content__media">
                                <?php if ($blog_style == '2') { ?>
                                    <div class="autoshowroom-post-image">
                                        <?php the_post_thumbnail('large'); ?>
                                        <div class="autoshowroom-post-date">
                                            <i class="fa fa-clock-o"></i>
                                            <span><?php echo get_the_time('M j, Y', get_the_ID()); ?></span>
                                        </div>
                                    </div>
                                <?php } elseif ($blog_style == '3') { ?>
                                    <div class="autoshowroom_post__images">
                                        <?php the_post_thumbnail('large'); ?>
                                    </div>
                                <?php } else { ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php
                                        the_post_thumbnail(array(570, 320));
                                        ?>
                                    </a>
                                    <?php
                                } ?>
                                <div class="blog_content__detail">
                                    <div class="blog_detail__wrapper">
                                        <?php if ($blog_style != '4') { ?>
                                            <h3><a href="<?php the_permalink(); ?>"
                                                   title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                        <?php }; ?>
                                        <?php if ($blog_style == '1') { ?>
                                            <div class="blog_content__information">
                                            <span class="blog_content__date">
                                                <?php echo get_the_date(); ?>
                                            </span>
                                                <span class="blog_content__separator">|</span>
                                                <span class="blog-content__author">
                                                <?php echo esc_html__('Posted by', 'tz-autoshowroom') ?>
                                                    <strong>
                                                    <?php echo get_the_author_meta('display_name', false) ?>
                                                </strong>
                                            </span>
                                            </div>
                                        <?php } elseif ($blog_style == '2') { ?>
                                            <div class="blog_content__information">
                                            <span class="blog-content__author">
                                                <?php echo esc_html__('Posted by', 'tz-autoshowroom') ?>
                                                <strong>
                                                    <?php echo get_the_author_meta('display_name', false) ?>
                                                </strong>
                                            </span>
                                                <span class="blog_content__separator">|</span>
                                                <span class="autoshowroom-post-back-comment">
                                                <?php echo esc_html($autoshowroom_comment_count->total_comments); ?>
                                                <?php echo esc_html__('Comments', 'tz-autoshowroom'); ?>
                                            </span>
                                                <?php the_excerpt(); ?>
                                            </div>
                                        <?php } elseif ($blog_style == '3') { ?>
                                            <div class="blog_content__info">
                                                <div class="blog_content__author">
                                                    <span><?php echo get_the_time('M j, Y', get_the_ID()); ?></span>
                                                    <span class="blog_content__separator">|</span>
                                                    <?php echo esc_html__('Posted by', 'tz-autoshowroom') ?>
                                                    <?php echo get_the_author_meta('display_name', false) ?>
                                                </div>
                                                <p>
                                                    <?php echo wp_trim_words(get_the_excerpt(), 19, '...'); ?>
                                                </p>
                                            </div>
                                        <?php } else { ?>
                                            <div class="blog_content__info">
                                                <div class="blog_content__author">
                                                    <span><?php echo get_the_time('M j, Y', get_the_ID()); ?></span>
                                                    <span class="blog_content__separator">|</span>
                                                    <?php echo esc_html__('Posted by', 'tz-autoshowroom') ?>
                                                    <?php echo get_the_author_meta('display_name', false) ?>
                                                </div>
                                            </div>
                                            <h3><a href="<?php the_permalink(); ?>"
                                                   title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                        <?php }; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode('autoshowroom-blog', 'autoshowroom_theme_blog');
?>