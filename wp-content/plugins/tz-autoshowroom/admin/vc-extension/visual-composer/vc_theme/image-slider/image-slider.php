<?php
/*
 * Element tz-feature-item
 * */

function autoshowroom_carousel_slide($atts, $content = null)
{
    $tz_image = $tz_image_size = $meta = $auto_play = $timeout = $loop = $item_slider = $tz_click_action = $tz_custom_links = $tz_link_target = $css = '';
    extract(shortcode_atts(array(
        'meta'          => '',
        'tz_image'      => '',
        'tz_image_size' => '',
        'auto_play'     => 'true',
        'timeout'       => '3000',
        'loop'          => 'true',
        'item_slider'   => '1',
        'css'           => '',

    ), $atts));
    ob_start();

    wp_enqueue_script('owl-carousel');
    wp_enqueue_style('owl-carousel');

    if ($auto_play == '') {
        $auto_play = 'false';
    }
    if ($loop == '') {
        $loop = 'false';
    }
    if ($timeout == '') {
        $timeout = 3000;
    }

    $images = explode(',', $tz_image);

    $i = -1;
    ?>

    <div class="tz_Image_slide">
        <div class="image-slider owl-carousel owl-theme <?php echo vc_shortcode_custom_css_class( $css ); ?>">
            <?php
            foreach ( $images  as $attach_id ) {
                $i++;
                $post_thumbnail = wpb_getImageBySize( array(
                    'attach_id' => $attach_id,
                    'thumb_size' => $tz_image_size,
                ) );
                $thumbnail = $post_thumbnail['thumbnail'];
                ?>
                <div class="tzImage_Slide_Item">
                    <?php echo $thumbnail ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <script>
        (function ($) {
            $(document).ready(function () {
                $('.image-slider').owlCarousel({
                    margin: 0,
                    animateIn: 'fadeIn',
                    animateOut: 'fadeOut',
                    smartSpeed: 450,
                    autoplay: <?php echo esc_attr($auto_play);?>,
                    autoplayTimeout: <?php echo esc_attr($timeout);?>,
                    loop: <?php echo esc_attr($loop);?>,
                    dots: false,
                    responsive: {
                        0: {
                            items: 1,
                            margin: 0,
                        },
                        600: {
                            items: 1,
                            margin: 0,
                        },
                        992: {
                            items: <?php echo esc_attr($item_slider);?>
                        },
                        1200: {
                            items: <?php echo esc_attr($item_slider);?>
                        }
                    },
                })
            });
        }(jQuery));
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode('autoshowroom-image-slider', 'autoshowroom_carousel_slide');
?>