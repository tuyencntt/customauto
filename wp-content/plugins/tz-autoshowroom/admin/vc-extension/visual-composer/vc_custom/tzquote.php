<?php
global $autoshowroom_quote_type;
$args = array(
    "autoshowroom_quote_type"                               => "type1",
    "autoshowroom_center_mode"                              => "true",
    "autoshowroom_number_item_des_center"                   => "3",
    "autoshowroom_number_item_tablet_landscape_center"      => "3",
    "autoshowroom_number_item_tablet_portrait_center"       => "3",
    "autoshowroom_number_item_mobile_center"                => "1",
    "autoshowroom_number_item_des"                          => "5",
    "autoshowroom_number_item_tablet_landscape"             => "5",
    "autoshowroom_number_item_tablet_portrait"              => "3",
    "autoshowroom_number_item_mobile"                       => "1",
    "autoshowroom_css_animation"                            => "",
    "tz_autoshowroom_number_item"                           => "1",
    "tz_autoplay_option"                                    => "",
    "tz_autoplay_time"                                      => "",
    "tz_loop_option"                                        => "",
    "tz_dots_option"                                        => "",

);
$html = "";

extract(shortcode_atts($args, $atts));

wp_enqueue_style( 'autoshowroom-slick' );
wp_enqueue_script( 'autoshowroom-slick' );

$autoshowroom_quote_class = '';
$tz_id = rand(0,1000);

if($autoshowroom_css_animation != ''){
    wp_enqueue_script( 'vc_waypoints' );
    $autoshowroom_quote_class .= ' wpb_animate_when_almost_visible wpb_' . $autoshowroom_css_animation;
} ?>
<?php if($autoshowroom_quote_type == 'type1'){ ?>
    <div class="container">
    <div id="autoshowroom-quote-<?php echo $tz_id;?>" class="autoshowroom-quote <?php echo esc_attr($autoshowroom_quote_type); ?> au_<?php echo esc_attr($autoshowroom_number_item_des); ?> number-item-<?php echo esc_attr($autoshowroom_number_item_des_center); ?> <?php echo esc_attr($autoshowroom_quote_class);?>">
        <?php
        echo do_shortcode($content);
        ?>
    </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            "use strict";
            jQuery("#autoshowroom-quote-<?php echo $tz_id;?>").each(function(){
                jQuery(this).slick({
                    centerMode: <?php echo esc_attr($autoshowroom_center_mode);?>,
                    centerPadding: '0px',
                    slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_des_center);}else{echo esc_attr($autoshowroom_number_item_des);}?>,
                    autoplay:false,
                    autoplaySpeed:3000,
                    arrows:false,
                    dots:true,
                    infinite:true,
                    focusOnSelect: true,
                    adaptiveHeight: true,
                    responsive: [
                        {
                            breakpoint: 1199,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '0px',
                                slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_tablet_landscape_center);}else{echo esc_attr($autoshowroom_number_item_tablet_landscape);}?>
                            }
                        },
                        {
                            breakpoint: 992,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '0px',
                                slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_tablet_portrait_center);}else{echo esc_attr($autoshowroom_number_item_tablet_portrait);}?>
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '0px',
                                slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_mobile_center);}else{echo esc_attr($autoshowroom_number_item_tablet_portrait);}?>
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '0px',
                                slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_mobile_center);}else{echo esc_attr($autoshowroom_number_item_mobile_center);}?>
                            }
                        }
                    ]
                });
            });
        });
    </script><!--end script recent-project -->
<?php } elseif( $autoshowroom_quote_type == 'type2'){ ?>
    <div class="container">
        <div id="autoshowroom-quote-<?php echo $tz_id;?>" class="autoshowroom-quote <?php echo esc_attr($autoshowroom_quote_type); ?> au_<?php echo esc_attr($autoshowroom_number_item_des); ?> number-item-<?php echo esc_attr($autoshowroom_number_item_des_center); ?> <?php echo esc_attr($autoshowroom_quote_class);?>">
            <?php
            echo do_shortcode($content);
            ?>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(window).on('load', function(){
            "use strict";
            jQuery("#autoshowroom-quote-<?php echo $tz_id;?>").each(function(){
                jQuery(this).slick({
                    centerMode: <?php echo esc_attr($autoshowroom_center_mode);?>,
                    centerPadding: '0px',
                    slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_des_center);}else{echo esc_attr($autoshowroom_number_item_des);}?>,
                    autoplay:false,
                    autoplaySpeed:3000,
                    variableWidth: true,
                    arrows:false,
                    dots:true,
                    infinite:true,
                    focusOnSelect: true,
                    adaptiveHeight: true,
                    responsive: [
                        {
                            breakpoint: 1199,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '0px',
                                slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_tablet_landscape_center);}else{echo esc_attr($autoshowroom_number_item_tablet_landscape);}?>
                            }
                        },
                        {
                            breakpoint: 992,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '0px',
                                slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_tablet_portrait_center);}else{echo esc_attr($autoshowroom_number_item_tablet_portrait);}?>
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '0px',
                                slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_tablet_portrait_center);}else{echo esc_attr($autoshowroom_number_item_tablet_portrait);}?>
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '0px',
                                slidesToShow: <?php if($autoshowroom_center_mode == 'true'){ echo esc_attr($autoshowroom_number_item_mobile_center);}else{echo esc_attr($autoshowroom_number_item_mobile_center);}?>
                            }
                        }
                    ]
                });
            });
        });
    </script><!--end script recent-project -->
<?php } elseif( $autoshowroom_quote_type == 'type3' || $autoshowroom_quote_type == 'type5' ){?>
    <?php
    $type_class = '';
    if ($autoshowroom_quote_type == 'type3')  {
        $type_class = 'autoshowroom-quote-type3';
    } else {
        $type_class = 'autoshowroom-quote-type5';
    }?>
    <div id="autoshowroom-quote-<?php echo $tz_id;?>" class="<?php echo esc_attr($type_class)?> <?php echo esc_attr($autoshowroom_quote_type); ?> ">
        <?php
        echo do_shortcode($content);
        ?>
    </div>
    <script type="text/javascript" defer="true">
        jQuery(document).ready(function(){
            jQuery('#autoshowroom-quote-<?php echo $tz_id;?>').each(function(){
                jQuery(this).autoshowroom_owlCarousel({
                    loop: <?php if($tz_loop_option == true){ echo 'true';}else{ echo 'false';}?>,
                    autoplay: <?php if($tz_autoplay_option == true){ echo 'true';}else{ echo 'false';}?>,
                    autoplayTimeout: <?php if($tz_autoplay_time){ echo $tz_autoplay_time; }else{ echo '500';}?>,
                    dots: <?php if($tz_dots_option == true){ echo 'true';}else{ echo 'false';}?>,
                    margin: 25,
                    responsive:{
                        0:{
                            items:1,
                            center: false,
                        },
                        600:{
                            items:2,
                            center: false,
                        },
                        1024:{
                            items:2,
                            center: false,
                        },
                        1200:{
                            items: <?php if($tz_autoshowroom_number_item !='1'){ echo esc_attr($tz_autoshowroom_number_item) ;}else{ echo '1';}?>,
                            center: false,
                        }
                    }
                })
            })
        })
    </script>
<?php } elseif( $autoshowroom_quote_type == 'type4'){?>
    <div id="autoshowroom-quote-<?php echo $tz_id;?>" class="autoshowroom-quote-<?php echo esc_attr($autoshowroom_quote_type); ?> ">
        <?php
        echo do_shortcode($content);
        ?>
    </div>
    <script type="text/javascript" defer="true">
        jQuery(document).ready(function(){
            jQuery('#autoshowroom-quote-<?php echo $tz_id;?>').each(function(){
                jQuery(this).autoshowroom_owlCarousel({
                    loop: <?php if($tz_loop_option == true){ echo 'true';}else{ echo 'false';}?>,
                    autoplay: <?php if($tz_autoplay_option == true){ echo 'true';}else{ echo 'false';}?>,
                    autoplayTimeout: <?php if($tz_autoplay_time){ echo $tz_autoplay_time; }else{ echo '500';}?>,
                    dots: <?php if($tz_dots_option == true){ echo 'true';}else{ echo 'false';}?>,
                    margin: 0,
                    autoplaySpeed:1000,
                    dotsSpeed:800,
                    items:1,
                })
            })
        })
    </script>
    <?php
}
?>
