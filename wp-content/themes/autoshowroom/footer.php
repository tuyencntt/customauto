<?php
$autoshowroom_type_footer = ot_get_option('autoshowroom_footer_type', 'type1');
$autoshowroom_footer_col = ot_get_option('autoshowroom_footer_columns', 4);
$autoshowroom_footer_widthl = ot_get_option('autoshowroom_footer_width1', 3);
$autoshowroom_footer_width2 = ot_get_option('autoshowroom_footer_width2', 3);
$autoshowroom_footer_width3 = ot_get_option('autoshowroom_footer_width3', 3);
$autoshowroom_footer_width4 = ot_get_option('autoshowroom_footer_width4', 3);
$autoshowroom_footer_offset_width1 = ot_get_option('autoshowroom_footer_offset_width1', 0);
$autoshowroom_footer_offset_width2 = ot_get_option('autoshowroom_footer_offset_width2', 0);
$autoshowroom_footer_offset_width3 = ot_get_option('autoshowroom_footer_offset_width3', 0);
$autoshowroom_footer_offset_width4 = ot_get_option('autoshowroom_footer_offset_width4', 0);
$autoshowroom_footer_social_number = ot_get_option('autoshowroom_footer_social_number', 5);
$autoshowroom_copyright = ot_get_option('autoshowroom_copyright');
$autoshowroom_btn_backtotop = ot_get_option('autoshowroom_btn_backtotop', 'yes');
$autoshowroom_btn_quote = ot_get_option('autoshowroom_btn_quote', 'yes');
$autoshowroom_btn_quote_title = ot_get_option('autoshowroom_btn_quote_title', 'Get A Quote');
$autoshowroom_btn_quote_link = ot_get_option('autoshowroom_btn_quote_link', 'http://autoshowroom.co/get-a-quote/');
$autoshowroom_logo_footer = ot_get_option('autoshowroom_logo_footer');
$autoshowroom_newsletter = ot_get_option('autoshowroom_newsletter');
$autoshowroom_newsletter_title = ot_get_option('autoshowroom_newsletter_title', 'Subscribe to our newsletter');
$autoshowroom_newsletter_des = ot_get_option('autoshowroom_newsletter_des', 'By entering your email address, you will be kept updated about Auto Showroom.');
$autoshowroom_s_or_m = ot_get_option('autoshowroom_s_or_m', 'Tz_social');
$autoshowroom_TZVehicle_compare_icon = ot_get_option('autoshowroom_TZVehicle_compare_icon', 'fas fa-car');
$autoshowroom_footer_bottom_class = '';
$autoshowroom_page = get_post_meta(get_the_ID(), 'autoshowroom_footer_type', true);
if (isset($autoshowroom_page) && $autoshowroom_page != '') {
    $autoshowroom_type_footer = $autoshowroom_page;
}
$tz_autofooter = '';
switch ($autoshowroom_type_footer) {
    case 'type1':
    case 'type5':
        $autoshowroom_footer_bottom_class = 'col-md-6';
        $tz_autofooter = 'autoshowroom-footer';
        break;
    case 'type2':
    case 'type3':
        $autoshowroom_footer_bottom_class = 'col-md-4';
        $tz_autofooter = 'autoshowroom-footer';
        break;
    case 'type4':
        $autoshowroom_footer_bottom_class = 'col-md-6';
        $tz_autofooter = 'autoshowroom-footer-service';
        break;
}
//if ($autoshowroom_type_footer == 'type1') {
//    $autoshowroom_footer_bottom_class = 'col-md-6';
//    $tz_autofooter = 'autoshowroom-footer';
//} elseif ($autoshowroom_type_footer == 'type2') {
//    $autoshowroom_footer_bottom_class = 'col-md-4';
//    $tz_autofooter = 'autoshowroom-footer';
//} elseif ($autoshowroom_type_footer == 'type3') {
//    $autoshowroom_footer_bottom_class = 'col-md-4';
//    $tz_autofooter = 'autoshowroom-footer';
//} elseif ($autoshowroom_type_footer == 'type4') {
//    $autoshowroom_footer_bottom_class = 'col-md-6';
//    $tz_autofooter = 'autoshowroom-footer-service';
//} elseif ($autoshowroom_type_footer == 'type5') {
//    $autoshowroom_footer_bottom_class = 'col-md-6';
//    $tz_autofooter = 'autoshowroom-footer';
//}
?>

<footer class="<?php echo $tz_autofooter . ' ' . esc_attr($autoshowroom_type_footer); ?>">
    <div class="autoshowroom-footer-top">
        <?php if ($autoshowroom_newsletter == 'show' && ($autoshowroom_type_footer == 'type3' || $autoshowroom_type_footer == 'type5')) { ?>
            <?php get_template_part('template_inc/inc', 'newsletter') ?>
        <?php } ?>
        <div class="container">
            <div class="row">
                <?php
                if (isset($autoshowroom_footer_col) && $autoshowroom_footer_col != ""):
                    for ($autoshowroom_i = 0; $autoshowroom_i < $autoshowroom_footer_col; $autoshowroom_i++):
                        $autoshowroom_j = $autoshowroom_i + 1;
                        if ($autoshowroom_i == 0) {
                            if ($autoshowroom_footer_offset_width1 != 0) {
                                $autoshowroom_offset = $autoshowroom_footer_offset_width1;
                                $autoshowroom_col = $autoshowroom_footer_widthl - $autoshowroom_footer_offset_width1;
                            } else {
                                $autoshowroom_offset = 0;
                                $autoshowroom_col = $autoshowroom_footer_widthl;
                            }
                        } elseif ($autoshowroom_i == 1) {
                            if ($autoshowroom_footer_offset_width2 != 0) {
                                $autoshowroom_offset = $autoshowroom_footer_offset_width2;
                                $autoshowroom_col = $autoshowroom_footer_width2 - $autoshowroom_footer_offset_width2;
                            } else {
                                $autoshowroom_offset = 0;
                                $autoshowroom_col = $autoshowroom_footer_width2;
                            }
                        } elseif ($autoshowroom_i == 2) {
                            if ($autoshowroom_footer_offset_width3 != 0) {
                                $autoshowroom_offset = $autoshowroom_footer_offset_width3;
                                $autoshowroom_col = $autoshowroom_footer_width3 - $autoshowroom_footer_offset_width3;
                            } else {
                                $autoshowroom_offset = 0;
                                $autoshowroom_col = $autoshowroom_footer_width3;
                            }
                        } elseif ($autoshowroom_i == 3) {
                            if ($autoshowroom_footer_offset_width4 != 0) {
                                $autoshowroom_offset = $autoshowroom_footer_offset_width4;
                                $autoshowroom_col = $autoshowroom_footer_width4 - $autoshowroom_footer_offset_width4;
                            } else {
                                $autoshowroom_offset = 0;
                                $autoshowroom_col = $autoshowroom_footer_width4;
                            }
                        }

                        ?>
                        <div class="col-md-<?php echo esc_attr($autoshowroom_col); ?><?php if ($autoshowroom_offset != 0) { ?> col-md-offset-<?php echo esc_attr($autoshowroom_offset); ?><?php } ?> footerattr">
                            <?php
                            if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer-' . $autoshowroom_j . '')):
                            endif;
                            ?>
                        </div><!--end class footermenu-->
                    <?php
                    endfor;
                endif;
                ?>
            </div>
        </div>
        <?php if ($autoshowroom_newsletter == 'show' && $autoshowroom_type_footer == 'type2') { ?>
            <?php get_template_part('template_inc/inc', 'newsletter') ?>
        <?php } ?>
    </div>
    <?php if (is_active_sidebar('footer-bottom-left') || is_active_sidebar('footer-bottom-center') || is_active_sidebar('footer-bottom-right')) { ?>
        <?php if ($autoshowroom_type_footer == 'type4') { ?>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="<?php echo esc_attr($autoshowroom_footer_bottom_class); ?> autoshowroom-footer-bottom-left">
                            <?php
                            if (is_active_sidebar('footer-bottom-left')) :
                                dynamic_sidebar('footer-bottom-left');
                            endif; ?>
                        </div>
                        <div class="<?php echo esc_attr($autoshowroom_footer_bottom_class); ?> autoshowroom-footer-bottom-right">
                            <?php
                            if (is_active_sidebar('footer-bottom-right')) :
                                dynamic_sidebar('footer-bottom-right');
                            endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="autoshowroom-footer-bottom">
            <div class="container">
                <div class="row">
                    <?php if ($autoshowroom_type_footer == 'type1' || $autoshowroom_type_footer == 'type2') { ?>
                        <?php if ($autoshowroom_type_footer == 'type1') { ?>
                            <div class="autoshowroom-footer-bottom-center">
                                <div class="autoshowrooom-footer-bottom-center-box">
                                    <?php
                                    if (isset($autoshowroom_footer_social_number) && $autoshowroom_footer_social_number != '') {
                                        for ($autoshowroom_count = 1; $autoshowroom_count <= $autoshowroom_footer_social_number; $autoshowroom_count++) {
                                            ?>
                                            <div class="autoshowroom-footer-social-item">
                                                <a href="<?php echo esc_url(ot_get_option('autoshowroom_social_url_' . $autoshowroom_count)); ?>"
                                                   target="popup">
                                                    <i class=" <?php echo esc_attr(ot_get_option('autoshowroom_social_icon_' . $autoshowroom_count)) ?>"></i>
                                                </a>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="<?php echo esc_attr($autoshowroom_footer_bottom_class); ?> autoshowroom-footer-bottom-left">
                            <?php
                            if (is_active_sidebar('footer-bottom-left')) :
                                dynamic_sidebar('footer-bottom-left');
                            endif; ?>
                        </div>
                        <?php if ($autoshowroom_type_footer == 'type2') {
                            ?>
                            <div class="autoshowroom-logo-footer col-md-4">
                                <img src="<?php echo esc_url($autoshowroom_logo_footer); ?>" alt="logo-footer">
                            </div>
                            <?php
                        } ?>
                        <?php if ($autoshowroom_type_footer == 'type1') { ?>
                            <div class="<?php echo esc_attr($autoshowroom_footer_bottom_class); ?> autoshowroom-footer-bottom-right">
                                <?php
                                if (is_active_sidebar('footer-bottom-right')) :
                                    dynamic_sidebar('footer-bottom-right');
                                endif; ?>
                            </div>
                        <?php } else { ?>
                            <div class="autoshowroom-footer-social-right col-md-4">
                                <div class="autoshowrooom-footer-bottom-center-box">
                                    <?php
                                    if (isset($autoshowroom_footer_social_number) && $autoshowroom_footer_social_number != '') {
                                        for ($autoshowroom_count = 1; $autoshowroom_count <= $autoshowroom_footer_social_number; $autoshowroom_count++) {
                                            ?>
                                            <div class="autoshowroom-footer-social-item">
                                                <a href="<?php echo esc_url(ot_get_option('autoshowroom_social_url_' . $autoshowroom_count)); ?>"
                                                   target="popup">
                                                    <i class=" <?php echo esc_attr(ot_get_option('autoshowroom_social_icon_' . $autoshowroom_count)) ?>"></i>
                                                </a>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else if ($autoshowroom_type_footer == 'type3') { ?>
                        <div class="<?php echo esc_attr($autoshowroom_footer_bottom_class); ?> autoshowroom-footer-bottom-left">
                            <?php
                            if (is_active_sidebar('footer-bottom-left')) :
                                dynamic_sidebar('footer-bottom-left');
                            endif; ?>
                        </div>
                        <div class="<?php echo esc_attr($autoshowroom_footer_bottom_class); ?> autoshowroom-footer-bottom_center">
                            <?php
                            if (is_active_sidebar('footer-bottom-center')) :
                                dynamic_sidebar('footer-bottom-center');
                            endif; ?>
                        </div>
                        <div class="<?php echo esc_attr($autoshowroom_footer_bottom_class); ?> autoshowroom-footer-bottom-right">
                            <?php
                            if (is_active_sidebar('footer-bottom-right')) :
                                dynamic_sidebar('footer-bottom-right');
                            endif; ?>
                        </div>

                    <?php } else if ($autoshowroom_type_footer == 'type4') { ?>
                        <div class="col-lg-6 col-sm-12 autoshowroom-footer-bottom-left" <?php if ($autoshowroom_s_or_m == 'Tz_none') {
                            echo 'style="width: 100%;;text-align: center;"';
                        } ?>>
                            <?php
                            echo do_shortcode($autoshowroom_copyright);
                            ?>
                        </div>
                        <?php if ($autoshowroom_s_or_m != 'Tz_none') { ?>
                            <div class="col-lg-6 col-sm-12 autoshowroom-footer-bottom-right">
                                <?php
                                if ($autoshowroom_s_or_m == 'Tz_social') {
                                    if (isset($autoshowroom_footer_social_number) && $autoshowroom_footer_social_number != '') {
                                        for ($autoshowroom_count = 1; $autoshowroom_count <= $autoshowroom_footer_social_number; $autoshowroom_count++) {
                                            ?>
                                            <a href="<?php echo esc_url(ot_get_option('autoshowroom_social_url_' . $autoshowroom_count)); ?>"
                                               target="popup">
                                                <i class=" <?php echo esc_attr(ot_get_option('autoshowroom_social_icon_' . $autoshowroom_count)) ?>"></i>
                                            </a>
                                            <?php
                                        }
                                    }
                                } else {
                                    wp_nav_menu(array('theme_location' => 'footer-menu'));
                                }
                                ?>
                            </div>
                        <?php }
                    }  else if ($autoshowroom_type_footer == 'type5') { ?>
                        <div class="col-lg-6 col-sm-12 autoshowroom-footer-bottom-left" <?php if ($autoshowroom_s_or_m == 'Tz_none') {
                            echo 'style="width: 100%;;text-align: center;"';
                        } ?>>
                            <?php
                            if (is_active_sidebar('footer-bottom-left')) :
                                dynamic_sidebar('footer-bottom-left');
                            endif; ?>
                        </div>
                        <?php if ($autoshowroom_s_or_m != 'Tz_none') { ?>
                            <div class="col-lg-6 col-sm-12 autoshowroom-footer-bottom-right">
                                <?php
                                if (is_active_sidebar('footer-bottom-right')) :
                                    dynamic_sidebar('footer-bottom-right');
                                endif; ?>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</footer>
<section class="products_compare"><span class="view-compare">
        <?php if($autoshowroom_TZVehicle_compare_icon !=' '){
         ?>
        <i class="<?php echo $autoshowroom_TZVehicle_compare_icon; ?>"></i>
        <?php
        }
         esc_html_e('Compare List', 'autoshowroom'); ?></span><span
            class="compare-count"></span></section>
<section class="compare-content"></section>
<?php
if ($autoshowroom_btn_backtotop == 'yes') {
    ?>
    <div class="auto-backtotop">
        <i class="fa fa-caret-up"></i>
    </div>
    <?php
}
?>
<?php
if ($autoshowroom_btn_quote == 'yes') {
    ?>
    <div class="auto-get-a-quote">
        <a href="<?php echo esc_html($autoshowroom_btn_quote_link); ?>" target="popup">
            <?php esc_html_e($autoshowroom_btn_quote_title, 'autoshowroom'); ?>
        </a>
    </div>
    <?php
}

?>
<?php wp_footer(); ?>
</body>
</html>