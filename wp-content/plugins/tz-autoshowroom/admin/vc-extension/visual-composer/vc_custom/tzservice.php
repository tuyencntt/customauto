<?php
$tz_svtype = '';
$args = array(
    "tz_svtype" => "1",
    "tz_number_item_desk" => "3",
    "tz_number_item_tablet_landscape" => "3",
    "tz_number_item_tablet_portrait" => "1",
    "tz_number_item_mobile" => "1",
    "tz_auto_option" => "",
    "tz_loop_option" => "",
    "tz_nav_option" => "",
    "tz_css_animation" => "",
);

$html = "";

extract(shortcode_atts($args, $atts));

wp_enqueue_style('autoshowroom-owl-carousel-style');
wp_enqueue_script('autoshowroom-owl-carousel-script');
$tzautoshowromm_class = '';
if ($tz_css_animation != '') {
    wp_enqueue_script('vc_waypoints');
    $tzautoshowromm_class .= ' wpb_animate_when_almost_visible wpb_' . $tz_css_animation;
}

$autoshowroom_slideid = rand(0, 10000);
$tz_idpost = uniqid();
if ($tz_svtype == 1) {
    $tz_svtypes = 'tzView_Service_Slide';
} else {
    $tz_svtypes = 'tzView_Service_Grid' . ' ' . $tz_number_item_desk . '-colum';
}
?>
<div class="tzElement-<?php echo $tz_idpost ?> tzElement_viewService tz_type-<?php echo $tz_svtype; ?> <?php echo esc_attr($tzautoshowromm_class); ?>">
    <div id="tzView_Service_Slide__<?php echo $autoshowroom_slideid ?>"
         class="<?php echo $tz_svtypes . ' id-' . $tz_idpost; ?>" data-desktop="<?php echo $tz_number_item_desk ?>"
         data-landscape="<?php echo $tz_number_item_tablet_landscape ?>"
         data-portrait="<?php echo $tz_number_item_tablet_portrait ?>"
         data-mobile="<?php echo $tz_number_item_mobile ?>">
        <?php
        echo do_shortcode($content);
        ?>
    </div>
</div>

<script type="text/javascript" defer>
    jQuery(document).ready(function () {
        <?php if ($tz_svtype == 1){ ?>
        jQuery('#tzView_Service_Slide__<?php echo $autoshowroom_slideid ?>').each(function () {
            jQuery(this).autoshowroom_owlCarousel({
                loop:<?php if ($tz_loop_option == 'true') {
                    echo 'true';
                } else {
                    echo 'false';
                }?>,
                margin: 10,
                navText: ["<i class=\"fas fa-caret-left\"></i>", "<i class=\"fas fa-caret-right\"></i>"],
                rewindNav: true,
                responsiveClass: true,
                autoplay:<?php if ($tz_auto_option == 'true') {
                    echo 'true';
                } else {
                    echo 'false';
                }?>,
                ltl: true,
                responsive: {
                    0: {
                        items:<?php if ($tz_number_item_mobile != '') {
                            echo esc_attr($tz_number_item_mobile);
                        } else {
                            echo '1';
                        }?>,
                        nav: false,
                        center: false
                    },
                    600: {
                        items:<?php if ($tz_number_item_tablet_portrait != '') {
                            echo esc_attr($tz_number_item_tablet_portrait);
                        } else {
                            echo '1';
                        }?>,
                        nav: false,
                        center: false
                    },
                    1024: {
                        items:<?php if ($tz_number_item_tablet_landscape != '') {
                            echo esc_attr($tz_number_item_tablet_landscape);
                        } else {
                            echo '3';
                        }?>,
                        nav:<?php if ($tz_nav_option == 'true') {
                            echo 'true';
                        } else echo 'false' ?>,
                        center: false
                    },
                    1200: {
                        items:<?php if ($tz_number_item_desk != '') {
                            echo esc_attr($tz_number_item_desk);
                        } else {
                            echo '3';
                        }?>,
                        nav:<?php if ($tz_nav_option == 'true') {
                            echo 'true';
                        } else echo 'false' ?>,
                        center: false
                    }
                }
            })
        })
        <?php }elseif ($tz_svtype == 2){?>
        if (jQuery('.tzElement-<?php echo $tz_idpost;?>').length) {
            var viewService = jQuery('.tzElement-<?php echo $tz_idpost;?> .tzView_Service_Grid');
            var tz_item = jQuery('.tzElement-<?php echo $tz_idpost;?> .tzView_Service_Slide_Item');
            viewService.css('opacity', '1');
            if (jQuery(tz_item).length) {
                var desktop = jQuery(viewService).data('desktop');
                var landscape = jQuery(viewService).data('landscape');
                var portrait = jQuery(viewService).data('portrait');
                var mobile = jQuery(viewService).data('mobile');
                var tz_class = 'col-lg-' + (12 / desktop) + ' col-md-' + (12 / landscape) + ' col-sm-' + (12 / portrait) + ' col-xs-' + (12 / mobile);
                jQuery(tz_item).addClass(tz_class);
            }
        }
        <?php } ?>
    })
</script>






