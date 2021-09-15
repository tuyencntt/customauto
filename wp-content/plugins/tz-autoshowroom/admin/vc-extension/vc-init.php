<?php
/*=====================================
 * Visual Composer
 =====================================*/
if ( class_exists('WPBakeryVisualComposerAbstract') ):
    function tz_autoshowroom_includevisual(){
        $dir_vc = dirname( __FILE__ );

        require_once $dir_vc . '/visual-composer/vc_custom/custom_vc.php';
        require_once $dir_vc . '/visual-composer/vc_custom/vc_extend.php';

        // VC Templates
        $vc_templates_dir = $dir_vc . '/visual-composer/vc_custom/';
        vc_set_shortcodes_templates_dir($vc_templates_dir);

       // $vc_templates_dir = $dir_vc . '/visual-composer/vc_custom1/';
      //  vc_set_shortcodes_templates_dir($vc_templates_dir);

        // Templates for theme of Templaza

        $tz_templates_dir = $dir_vc . '/visual-composer/vc_theme/';

        require_once $tz_templates_dir . 'header/theme-header.php';
        require_once $tz_templates_dir . 'header/vc-theme-header.php';

        require_once $tz_templates_dir . 'title/theme-title.php';
        require_once $tz_templates_dir . 'title/vc-theme-title.php';

        require_once $tz_templates_dir . 'service/theme-service.php';
        require_once $tz_templates_dir . 'service/vc-theme-service.php';

        require_once $tz_templates_dir . 'vehicle-feature/theme-feature-vehicle.php';
        require_once $tz_templates_dir . 'vehicle-feature/vc-theme-feature-vehicle.php';

        require_once $tz_templates_dir . 'motorbike-feature/theme-feature-motorbike.php';
        require_once $tz_templates_dir . 'motorbike-feature/vc-theme-feature-motorbike.php';

        require_once $tz_templates_dir . 'our-process/theme-process.php';
        require_once $tz_templates_dir . 'our-process/vc-theme-process.php';

        require_once $tz_templates_dir . 'our-team/our_team_item.php';
        require_once $tz_templates_dir . 'our-team/vc-our-team.php';

        require_once $tz_templates_dir . 'counter/theme-counter.php';
        require_once $tz_templates_dir . 'counter/vc-theme-counter.php';

        require_once $tz_templates_dir . 'post-slider/theme-post-slider.php';
        require_once $tz_templates_dir . 'post-slider/vc-theme-post-slider.php';

        require_once $tz_templates_dir . 'vehicle-portfolio/theme-vehicle-portfolio.php';
        require_once $tz_templates_dir . 'vehicle-portfolio/vc-theme-vehicle-portfolio.php';

        require_once $tz_templates_dir . 'vehicle-portfolio-sold/theme-vehicle-portfolio-sold.php';
        require_once $tz_templates_dir . 'vehicle-portfolio-sold/vc-theme-vehicle-portfolio-sold.php';

        require_once $tz_templates_dir . 'list/theme-list.php';
        require_once $tz_templates_dir . 'list/vc-theme-list.php';

        require_once $tz_templates_dir . 'auto-button/tz_btn_aventura.php';
        require_once $tz_templates_dir . 'auto-button/tz_btn_aventura_extend.php';


        if  ( class_exists('EsuAdmin') ):
            require_once $tz_templates_dir . 'sign-up/theme-sign-up.php';
            require_once $tz_templates_dir . 'sign-up/vc-theme-sign-up.php';
        endif;
        if  ( class_exists('MC4WP_Container') ):
            require_once $tz_templates_dir . 'sign-up-mp/theme-sign-up-mp.php';
            require_once $tz_templates_dir . 'sign-up-mp/vc-theme-sign-up-mp.php';
        endif;

        require_once $tz_templates_dir . 'vehicle-search/theme-vehicle-search.php';
        require_once $tz_templates_dir . 'vehicle-search/vc-theme-vehicle-search.php';

        require_once $tz_templates_dir . 'advertise/theme-ads.php';
        require_once $tz_templates_dir . 'advertise/vc-theme-ads.php';

        require_once $tz_templates_dir . 'scroll-object/theme-scroll-object.php';
        require_once $tz_templates_dir . 'scroll-object/vc-theme-scroll-object.php';

        require_once $tz_templates_dir . 'light-gallery/theme-light-gallery.php';
        require_once $tz_templates_dir . 'light-gallery/vc-theme-light-gallery.php';

        require_once $tz_templates_dir . 'vehicle-slider/theme-vehicle-slider.php';
        require_once $tz_templates_dir . 'vehicle-slider/vc-theme-vehicle-slider.php';

        require_once $tz_templates_dir . 'text-box/theme-text.php';
        require_once $tz_templates_dir . 'text-box/vc-theme-text.php';

        require_once $tz_templates_dir . 'vehicle-taxonomy/theme-taxonomy-vehicle.php';
        require_once $tz_templates_dir . 'vehicle-taxonomy/vc-theme-taxonomy-vehicle.php';

        require_once $tz_templates_dir . 'vehicle-quote/theme-vehicle-quote.php';
        require_once $tz_templates_dir . 'vehicle-quote/vc-theme-vehicle-quote.php';

        require_once $tz_templates_dir . 'vehicle-dealer-feature/theme-dealer-feature.php';
        require_once $tz_templates_dir . 'vehicle-dealer-feature/vc-theme-dealer-feature.php';

        require_once $tz_templates_dir . 'vehicle-top-dealer/theme-top-dealer.php';
        require_once $tz_templates_dir . 'vehicle-top-dealer/vc-theme-top-dealer.php';

        require_once $tz_templates_dir . 'blog/theme-blog.php';
        require_once $tz_templates_dir . 'blog/vc-theme-blog.php';

        require_once $tz_templates_dir . 'newletter/theme-newletter.php';
        require_once $tz_templates_dir . 'newletter/vc-theme-letter.php';

        require_once $tz_templates_dir . 'vehicles-condition/theme-condition-vehicle.php';
        require_once $tz_templates_dir . 'vehicles-condition/vc-theme-condition-vehicle.php';

        require_once $tz_templates_dir . 'image-slider/image-slider.php';
        require_once $tz_templates_dir . 'image-slider/vc-image-slider.php';

        require_once $tz_templates_dir . 'pricing/theme-pricing.php';
        require_once $tz_templates_dir . 'pricing/vc-theme-pricing.php';

        require_once $tz_templates_dir . 'call-us/theme-call-us.php';
        require_once $tz_templates_dir . 'call-us/vc-theme-call-us.php';

        require_once $tz_templates_dir . 'countdown/theme-countdown.php';
        require_once $tz_templates_dir . 'countdown/vc-theme-countdown.php';

        require_once $tz_templates_dir . 'our-demos/our-demos.php';
        require_once $tz_templates_dir . 'our-demos/vc-our-demos.php';

        require_once $tz_templates_dir . 'our-themes/our-themes.php';
        require_once $tz_templates_dir . 'our-themes/vc-our-themes.php';

        require_once $tz_templates_dir . 'customers-say/customers-say.php';
        require_once $tz_templates_dir . 'customers-say/vc-customers-say.php';

        require_once $tz_templates_dir . 'banner/banner.php';
        require_once $tz_templates_dir . 'banner/vc-banner.php';

        require_once $tz_templates_dir . 'vehicle-types/theme-vehicle-types.php';
        require_once $tz_templates_dir . 'vehicle-types/vc-theme-vehicle-types.php';

    }

    add_action('init', 'tz_autoshowroom_includevisual', 20);
endif;
/* Get Category Select */
function tz_autoshowroom_drop_down_get_cat( $tz_autoshowroom_drop_down_type_taxonomy ) {

    $tz_autoshowroom_cat          =   array( 'Select Category Menu'       =>  'select_cat' );
    $tz_autoshowroom_category     =   get_categories( array( 'taxonomy'   =>  $tz_autoshowroom_drop_down_type_taxonomy ) );

    if ( isset( $tz_autoshowroom_category ) && !empty( $tz_autoshowroom_category ) ):

        foreach( $tz_autoshowroom_category as $tz_autoshowroom_cate ) {

            $tz_autoshowroom_cat[$tz_autoshowroom_cate->name]   =   $tz_autoshowroom_cate->term_id;

        }

    endif;

    return $tz_autoshowroom_cat;

}

/* Get Category check box */
function tz_autoshowroom_check_get_cat( $tz_autoshowroom_check_type_taxonomy ) {

    $tz_autoshowroom_cat_check    =   array();
    $tz_autoshowroom_category     =   get_categories( array( 'taxonomy'   =>  $tz_autoshowroom_check_type_taxonomy ) );

    if ( isset( $tz_autoshowroom_category ) && !empty( $tz_autoshowroom_category ) ):

        foreach( $tz_autoshowroom_category as $tz_autoshowroom_cate ) {

            $tz_autoshowroom_cat_check[$tz_autoshowroom_cate->name] =   $tz_autoshowroom_cate->term_id;

        }

    endif;

    return $tz_autoshowroom_cat_check;

}

/* Get title post type */
function tz_autoshowroom_get_title_data( $post_type ) {

    $posts = get_posts( array(
        'posts_per_page' 	=> -1,
        'post_type'			=> $post_type,
    ));

    $result = array();

    foreach ( $posts as $post )	{
        $result[] = array(
            'value' => $post->ID,
            'label' => $post->post_title,
        );
    }

    return $result;

}
?>
