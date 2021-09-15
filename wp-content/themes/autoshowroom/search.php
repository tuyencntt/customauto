<?php get_header();
//  Blog options show hide
$autoshowroom_blog_sidebar        =   ot_get_option('autoshowroom_blog_sidebar',1);
$autoshowroom_blog_title          =   ot_get_option('autoshowroom_blog_title',1);
$autoshowroom_blog_date           =   ot_get_option('autoshowroom_blog_date',1);
$autoshowroom_blog_comment        =   ot_get_option('autoshowroom_blog_comment',1);
$autoshowroom_blog_view           =   ot_get_option('autoshowroom_blog_view',1);
$autoshowroom_blog_category       =   ot_get_option('autoshowroom_blog_category',1);
$autoshowroom_blog_media          =   ot_get_option('autoshowroom_blog_media',1);
$autoshowroom_blog_excerpt        =   ot_get_option('autoshowroom_blog_excerpt',1);
$autoshowroom_blog_share          =   ot_get_option('autoshowroom_blog_share',1);
$autoshowroom_blog_readmore       =   ot_get_option('autoshowroom_blog_readmore',1);
$autoshowroom_blog_readmore_text  =   ot_get_option('autoshowroom_blog_readmore_text','Readmore');

$autoshowroom_blog_class = 'autoshowroom-blog-body';
if($autoshowroom_blog_sidebar == '1' || $autoshowroom_blog_sidebar == '0'){
    $autoshowroom_blog_class .= ' col-md-9';
}else{
    $autoshowroom_blog_class .= ' col-md-12';
}
?>
<?php get_template_part('template_inc/inc','menu'); ?>
<?php get_template_part('template_inc/inc','title-breadcrumb'); ?>
<div class="autoshowroom-blog">
    <div class="container">
        <div class="row">
            <?php
            if($autoshowroom_blog_sidebar == '0'){
                get_sidebar();
            }
            ?>
            <div class="<?php echo esc_attr($autoshowroom_blog_class);?>">
                <?php
                if ( have_posts() ) : while (have_posts()) : the_post() ;
                    $autoshowroom_type              = get_post_type( $post -> ID );
                    $autoshowroom_comment_count     = wp_count_comments(get_the_ID());

                    $autoshowroom_class_icon = '';
                    if($autoshowroom_type == 'page'){
                        $autoshowroom_class_icon = 'fa-file';
                    }else{
                        if(has_post_format('gallery')){
                            $autoshowroom_class_icon = 'fa-picture-o';
                        }elseif(has_post_format('video')){
                            $autoshowroom_class_icon = 'fa-play';
                        }elseif(has_post_format('audio')){
                            $autoshowroom_class_icon = 'fa-soundcloud';
                        }elseif(has_post_format('link')){
                            $autoshowroom_class_icon = 'fa-link';
                        }elseif(has_post_format('quote')){
                            $autoshowroom_class_icon = 'fa-commenting-o';
                        }else{
                            $autoshowroom_class_icon = 'fa-camera-retro';
                        }
                    }
                    ?>
                    <div id='post-<?php the_ID(); ?>' class="autoshowroom-blog-item">
                        <div class="autoshowroom-blog-item-wrap">
                            <div class="autoshowroom-blog-item-icon">
                                <i class="fa <?php echo esc_attr($autoshowroom_class_icon);?>"></i>
                            </div>
                            <div class="autoshowroom-blog-item-content">
                                <?php if($autoshowroom_blog_title == 1):?>
                                    <?php if(has_post_format('quote')):
                                        $autoshowroom_quote_name = get_post_meta( $post->ID, '_format_quote_source_name', true );
                                        $autoshowroom_quote_url = get_post_meta( $post->ID, '_format_quote_source_url', true );
                                        ?>
                                        <h3 class="autoshowroom-blog-item-title"><a href="<?php echo esc_url($autoshowroom_quote_url);?>"><?php echo esc_html($autoshowroom_quote_name);?></a></h3>
                                    <?php else: ?>
                                        <h3 class="autoshowroom-blog-item-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                                    <?php endif; ?>
                                <?php endif;?>
                                <div class="autoshowroom-blog-item-Info">

                                    <?php if($autoshowroom_blog_date == 1):?>
                                        <span><i class="fas fa-calendar"></i><?php echo balanceTags(get_the_date());?></span>
                                        <small>/</small>
                                    <?php endif;?>

                                    <?php if($autoshowroom_blog_comment == 1):?>
                                        <span><i class="fas fa-comment"></i><?php echo esc_html($autoshowroom_comment_count ->total_comments).' Comments';?></span>
                                        <small>/</small>
                                    <?php endif;?>
                                    <?php if($autoshowroom_blog_view == 1):?>
                                        <span><i class="fas fa-heart"></i><?php echo balanceTags(tz_autoshowroom_getPostViews(get_the_ID()));?></span>
                                        <small>/</small>
                                    <?php endif; ?>
                                    <?php
                                    if(get_the_category() !=false && $autoshowroom_blog_category == 1){
                                        ?>
                                        <span class="tzcategory">
                                            <i class="fas fa-folder"></i>
                                            <?php
                                            the_category(', ');
                                            ?>
                                        </span>
                                    <?php } ?>
                                </div>
                                <?php if( $autoshowroom_type != 'page' ) : ?>
                                    <?php if(has_post_format('gallery')) : ?>
                                        <?php if($autoshowroom_blog_media == 1):?>
                                            <?php $autoshowroom_gallery = get_post_meta( $post->ID, '_format_gallery_images', true ); ?>

                                            <?php if($autoshowroom_gallery) : ?>
                                                <div class="autoshowroom-gallery-flexslider">
                                                    <ul class="slides">
                                                        <?php foreach($autoshowroom_gallery as $autoshowroom_image) : ?>

                                                            <?php $autoshowroom_image_src = wp_get_attachment_image_src( $autoshowroom_image, 'large' ); ?>
                                                            <?php $autoshowroom_caption = get_post_field('post_excerpt', $autoshowroom_image); ?>
                                                            <li><img src="<?php echo esc_url($autoshowroom_image_src[0]); ?>" <?php if($autoshowroom_caption) : ?>title="<?php echo esc_attr($autoshowroom_caption); ?>"<?php endif; ?> /></li>

                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif;?>
                                    <?php elseif(has_post_format('video')) : ?>
                                        <?php if($autoshowroom_blog_media == 1):?>
                                            <?php $autoshowroom_video = get_post_meta( $post->ID, '_format_video_embed', true ); ?>
                                            <?php
                                            if($autoshowroom_video != ''):
                                                ?>
                                                <div class="autoshowroom-blog-item-video">
                                                    <?php if(wp_oembed_get( $autoshowroom_video )) : ?>
                                                        <?php echo wp_oembed_get($autoshowroom_video); ?>
                                                    <?php else : ?>
                                                        <?php echo balanceTags($autoshowroom_video); ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif;?>
                                        <?php endif;?>
                                    <?php elseif(has_post_format('audio')) : ?>
                                        <?php if($autoshowroom_blog_media == 1):?>
                                            <?php $autoshowroom_audio = get_post_meta( $post->ID, '_format_audio_embed', true ); ?>
                                            <?php if($autoshowroom_audio != ''): ?>
                                                <div class="autoshowroom-blog-item-audio">
                                                    <?php if(wp_oembed_get( $autoshowroom_audio )) : ?>
                                                        <?php echo wp_oembed_get($autoshowroom_audio); ?>
                                                    <?php else : ?>
                                                        <?php echo balanceTags($autoshowroom_audio); ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php elseif(has_post_format('link')) : ?>
                                        <?php if($autoshowroom_blog_excerpt == 1):?>
                                            <div class="autoshowroom-blog-item-link">
                                                <?php $autoshowroom_link = get_post_meta( $post->ID, '_format_link_url', true ); ?>
                                                <a target="_blank" title="<?php the_title();?>" href="<?php echo esc_url($autoshowroom_link);?>">
                                                    <?php echo esc_html($autoshowroom_link);?>
                                                </a>
                                            </div>
                                        <?php endif;?>
                                    <?php elseif(has_post_format('quote')):?>
                                        <?php if($autoshowroom_blog_excerpt == 1):?>
                                            <div class="autoshowroom-blog-item-quote">
                                                <?php
                                                the_content();
                                                wp_link_pages();
                                                ?>
                                            </div>
                                        <?php endif;?>
                                    <?php else: ?>
                                        <?php if($autoshowroom_blog_media == 1):?>
                                            <div class="autoshowroom-blog-item-img">
                                                <?php the_post_thumbnail(); ?>
                                            </div>
                                        <?php endif;?>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php
                                if(!has_post_format('link') && !has_post_format('quote') && $autoshowroom_type != 'page'):
                                    if($autoshowroom_blog_excerpt == 1):
                                        if ( ! has_excerpt() ) {
                                            the_content();
                                            wp_link_pages();
                                        } else {
                                            the_excerpt();
                                            ?>
                                            <a href="<?php the_permalink();?>" class="more-link"><i class="fa fa-arrow-circle-right"></i> <?php esc_html_e('Read more', 'autoshowroom');?></a>
                                            <?php
                                        }
                                    endif;
                                    ?>
                                    <?php if($autoshowroom_blog_share == 1):?>
                                    <div class="autoshowroom-blog-item-share">
                                        <i class="fas fa-share-alt"></i><?php esc_html_e(' Share It','autoshowroom')?>
                                        <div class="autoshowroom-blog-share-icon">
                                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php urlencode(the_permalink()); ?>"><i class="fab fa-facebook"></i></a>
                                            <a target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php print tz_autoshowroom_social_title( get_the_title() ); ?>%20-%20<?php echo urlencode(the_permalink()); ?>"><i class="fab fa-twitter"></i></a>
                                            <?php $autoshowroom_pin_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())); ?>
                                            <a data-pin-do="skipLink" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_attr($autoshowroom_pin_image); ?>&description=<?php echo urlencode(the_title()); ?>"><i class="fab fa-pinterest"></i></a>
                                            <a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink(); ?>"><i class="fab fa-linkedin-square" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                <?php endif;?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile; // end while ( have_posts )
                else: ?>
                    <div class="autoshowroom-serach-notdata">
                        <h3><?php  esc_html_e('No Data', 'autoshowroom');?></h3>

                        <div class="page-content">

                            <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

                                <p><?php printf(  esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'autoshowroom' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

                            <?php elseif ( is_search() ) : ?>

                                <p><?php  esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'autoshowroom' ); ?></p>
                                <?php get_search_form(); ?>

                            <?php else : ?>

                                <p><?php  esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'autoshowroom' ); ?></p>
                                <?php get_search_form(); ?>

                            <?php endif; ?>

                        </div><!-- .page-content -->
                    </div>
                <?php
                endif; // end if ( have_posts )
                ?>

                <div class="autoshowroom-blog-pagenavi">
                    <?php if ( have_posts() ): ?>
                        <div class="autoshowroom-blog-back">
                            <i class="fa fa-chevron-up"></i>
                        </div>
                    <?php endif; ?>
                    <?php
                    if ( function_exists('wp_pagenavi') ):
                        wp_pagenavi();
                    else:
                        tz_autoshowroom_paging_nav('bottom-nav');
                    endif;
                    ?>
                </div>
            </div>
            <?php
            if($autoshowroom_blog_sidebar == '1'){
                get_sidebar();
            }
            ?>
        </div>
    </div>
</div>
<?php get_template_part('template_inc/inc','contact'); ?>
<?php
get_footer();
?>