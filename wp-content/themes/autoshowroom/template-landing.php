<?php
    /*
     * Template Name: Template Landing page
     */
?>
<?php  get_header();
//require get_template_directory() . '/fonts/font-google.php';
$autoshowroom_btn_backtotop       =   ot_get_option('autoshowroom_btn_backtotop','yes');
?>
<div class="landing_page">
    <div class="landing_menu">
        <div class="container">
            <div class="landing_header">
                <a href="" class="logo_landing">
                    <img src="<?php echo get_template_directory_uri() . '/images/Templaza-logo.png'?>" alt="Autoshowroom"/>
                </a>
                <div class="header-right">
                    <div class="nav-menu">
                        <a href="#demo"><?php echo esc_attr('Demos')?></a>
                        <a href="#tools"><?php echo esc_attr('Tools')?></a>
                        <a href="#features"><?php echo esc_attr('Features')?></a>
                        <a href="#customers_say"><?php echo esc_attr('Customers Say')?></a>
                        <a href="#support"><?php echo esc_attr('Support')?></a>
                    </div>
                    <div class="auto_btn">
                        <a href="https://themeforest.net/item/auto-showroom-car-dealership-wordpress-theme/15995336" target="_blank">Purchase now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner_content">
        <div class="about_theme">
            <h1><span>Auto <strong>Showroom</strong></span> Pro Car Dealership WordPress Theme</h1>
            <p>Get 7+ Home layouts in 1 Package. Everything for a Great Automotive website is in your hands. </p>
            <div class="about_control">
                <a class="auto_btn" href="#demo"> <?php echo esc_attr('SHOW ME')?> <span class="icon-arrow-right"></span>
                </a>
            </div>
        </div>
        <div class="landing_image">

        </div>
    </div>
    <?php
    if(have_posts()):
        while(have_posts()):the_post();
            the_content();
            wp_link_pages();
        endwhile;
    endif;
    ?>
</div>
<?php
if($autoshowroom_btn_backtotop=='yes'){?>
    <div class="auto-backtotop">
        <i class="fa fa-caret-up"></i>
    </div>
    <?php
}
?>
<?php
//get_template_part('template_inc/inc','footer');
wp_footer();
?>