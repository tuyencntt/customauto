<?php
    $autoshowroom_logotype   =   ot_get_option('autoshowroom_logotype','text');
    $autoshowroom_text       =   ot_get_option('autoshowroom_logoText','autoshowroom');
    $autoshowroom_text_color =   ot_get_option('autoshowroom_logoTextcolor','');
    $autoshowroom_img_url    =   ot_get_option('autoshowroom_logo','');
    $autoshowroom_header     =   ot_get_option('autoshowroom_header_type','header1');
    $autoshowroom_top_sidebar=   ot_get_option('autoshowroom_header_sidebar');
    $autoshowroom_h2_logo =   ot_get_option('autoshowroom_header2_logo_position');
    $autoshowroom_menu_fixed =   ot_get_option('autoshowroom_menu_fixed');
    $autoshowroom_header6_addcar =   ot_get_option('autoshowroom_header6_addcar');
    $autoshowroom_header6_link_addcar =   ot_get_option('autoshowroom_header6_link_addcar');
    $autoshowroom_header_menu_cart =   ot_get_option('autoshowroom_header_menu_cart','show');

?>

<?php
$header_class = 'tz-header-1';
switch ($autoshowroom_header):
    case 'header1':
    $header_class = 'tz-header-1';
    break;
    case 'header2':
    $header_class = 'tz-header-2';
    break;
    case 'header3':
    $header_class = 'tz-header-3'; // if fix header3-fix
    break;
    case 'header4':
    $header_class = 'tz-header-4';
    break;
    case 'header5':
    $header_class = 'tz-header-5';
    break;
    case 'header6':
    $header_class = 'tz-header-6'; // if fix header3-fix
    break;
    case 'header7':
    $header_class = 'tz-header-7'; // if fix header3-fix
    break;
    case 'header8':
    $header_class = 'tz-header-8';
    break;
    case 'header9':
        $header_class = 'tz-header-9';
        break;

endswitch;
$sticky = '';

if($autoshowroom_menu_fixed == 'yes'){
    $sticky = 'tzmenu_fixed';
}
if($autoshowroom_header_menu_cart =='show'){
    $autoshowroom_header_menu_cart_true ='show_cart';
}else{
    $autoshowroom_header_menu_cart_true ='';
}
if ( is_plugin_active( 'megamenu/megamenu.php' ) ) {
    $maxmegamenu ='true';
    $mobilemenu = '';
}else{
    $maxmegamenu ='';
    $mobilemenu = 'tz-menumobile';
}
if( $header_class == 'tz-header-1' ) {
?>
<!-- Begin Header 1 -->
<header class="tz-header <?php echo $autoshowroom_header_menu_cart_true.' '.$mobilemenu;?>">

    <?php
    if($autoshowroom_top_sidebar == 'show'):
        if ( is_active_sidebar( 'headertop-left' ) || is_active_sidebar( 'headertop-right' )  ) : ?>
            <div class="tz-top-header ">
                <div class="container">
                    <div class="row">
                        <?php
                        if ( is_active_sidebar( 'headertop-left' )  ) : ?>
                            <div class="col-md-6 tz-top-header-left">
                                <?php dynamic_sidebar( 'headertop-left' ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( is_active_sidebar( 'headertop-right' ) ) : ?>
                            <div class="col-md-6 tz-top-header-right">
                                <?php dynamic_sidebar( 'headertop-right' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="tz-menu-header <?php echo $sticky;?>">
        <div class="container tz-megamenu-wrap">
            <div class="row">
                <div class="col-md-3 tz-logo-block">
                    <?php
                    if ( is_front_page() ) {
                        echo ('<h1>');
                    }
                        if($autoshowroom_logotype == 0){
                        ?>
                            <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                        <?php
                            echo ('<span class="tz-logo-text">'.esc_html($autoshowroom_text).'</span>');
                            ?></a>
                            <?php
                        }else{
                            if ( isset($autoshowroom_img_url) && !empty( $autoshowroom_img_url ) ) :
                                $logo_ext= wp_check_filetype($autoshowroom_img_url);
                                $logo_file = $logo_ext['ext'];
                                if($logo_file =='svg'){
                                    ?>
                                    <div class="svg_logo" data-href="<?php echo esc_url(get_home_url('/')); ?>">
                                    <object id="svgObject"  type="image/svg+xml" data="<?php echo esc_url($autoshowroom_img_url);?>" class="svg_logo">
                                        <?php echo esc_html_e('Your browser does not support SVG','tz_autoshowroom');?>
                                    </object>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                    <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                    <?php
                                    echo'<img src="'.esc_url($autoshowroom_img_url).'" alt="'.get_bloginfo('title').'" />';
                                    ?></a>
                                    <?php
                                }

                            else :
                            ?>
                            <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                            <?php
                                echo'<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('title').'" width="189" height="17" />';
                            ?></a>
                                <?php
                            endif;
                        }
                    if ( is_front_page() ) {
                        echo ('</h1>');
                    }
                    ?>
                </div>
                <?php if($maxmegamenu==''){?>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tz-menu-mobile" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php } ?>
                <div class="col-md-9 tz-megamenu " id="tz-menu-mobile">

                    <nav class="nav-collapse tz-menu-mobile">
                        <?php

                        if ( has_nav_menu('primary') ) :
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'menu_class'     => 'nav navbar-nav tz-nav',
                                'container'      => false
                            ) ) ;
                        endif;

                        ?>
                    </nav>
                    <?php
                    if ($autoshowroom_header_menu_cart=='show' && class_exists( 'WooCommerce')):
                        ?>
                        <div class="tz-header-cart pull-right">
                            <span aria-hidden="true" class="icon_cart_alt"><i class="fas fa-cart-arrow-down"></i></span>
                            <?php
                            if ( class_exists( 'autoshowroom_WC_Widget_Cart' ) ) { the_widget( 'autoshowroom_WC_Widget_Cart' ); }
                            ?>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </div><!--end class container-->
    </div>
</header>
<!-- End Header 1 -->
<?php
}
elseif ( $header_class == 'tz-header-2' ) {
    ?>
    <!-- Begin Header 2 -->
    <header class="tz-header tz-header-2 tz-header-2-default <?php echo $autoshowroom_header_menu_cart_true.' '.$mobilemenu;?>">

        <?php
        if($autoshowroom_top_sidebar == 'show'):
            if ( is_active_sidebar( 'headertop-left' ) || is_active_sidebar( 'headertop-right' )  ) : ?>
                <div class="tz-top-header ">
                    <div class="container">
                        <div class="row">
                            <?php
                            if ( is_active_sidebar( 'headertop-left' )  ) : ?>
                                <div class="col-md-6 tz-top-header-left">
                                    <?php dynamic_sidebar( 'headertop-left' ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( is_active_sidebar( 'headertop-right' ) ) : ?>
                                <div class="col-md-6 tz-top-header-right">
                                    <?php dynamic_sidebar( 'headertop-right' ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="tz-menu-header <?php echo $sticky;?>">
            <div class="container">
                <div class="header-2-logo" style="top:<?php echo esc_attr($autoshowroom_h2_logo);?>px ">
                    <?php
                    if ( is_front_page() ) {
                        echo ('<h1>');
                    }
                    if($autoshowroom_logotype == 0){
                        ?>
                        <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                            <?php
                            echo ('<span class="tz-logo-text">'.esc_html($autoshowroom_text).'</span>');
                            ?></a>
                        <?php
                    }else{
                        if ( isset($autoshowroom_img_url) && !empty( $autoshowroom_img_url ) ) :
                            $logo_ext= wp_check_filetype($autoshowroom_img_url);
                            $logo_file = $logo_ext['ext'];
                            if($logo_file =='svg'){
                                ?>
                                <div class="svg_logo" data-href="<?php echo esc_url(get_home_url('/')); ?>">
                                    <object id="svgObject"  type="image/svg+xml" data="<?php echo esc_url($autoshowroom_img_url);?>" class="svg_logo">
                                        <?php echo esc_html_e('Your browser does not support SVG','tz_autoshowroom');?>
                                    </object>
                                </div>
                                <?php
                            }else{
                                ?>
                                <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                    <?php
                                    echo'<img src="'.esc_url($autoshowroom_img_url).'" alt="'.get_bloginfo('title').'" />';
                                    ?></a>
                                <?php
                            }

                        else :
                            ?>
                            <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                <?php
                                echo'<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('title').'" width="189" height="17" />';
                                ?></a>
                            <?php
                        endif;
                    }
                    if ( is_front_page() ) {
                        echo ('</h1>');
                    }
                    ?>
                </div>
                <div class="row">
                    <?php if($maxmegamenu==''){?>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tz-menu-mobile" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    <?php } ?>
                    <div class="col-md-12 tz-megamenu " id="tz-menu-mobile">
                        <nav class="nav-collapse tz-menu-mobile">
                            <?php
                            if ( has_nav_menu('primary') ) {
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'menu_class' => 'nav navbar-nav tz-nav',
                                    'container' => false
                                ));
                            }else{
                                wp_nav_menu(array(
                                    'theme_location' => 'primary-home-2',
                                    'menu_class' => 'nav navbar-nav tz-nav',
                                    'container' => false
                                ));
                            }

                            ?>
                        </nav>
                        <?php
                        if ($autoshowroom_header_menu_cart=='show' && class_exists( 'WooCommerce')):
                            ?>
                            <div class="tz-header-cart pull-right">
                                <span aria-hidden="true" class="icon_cart_alt"><i class="fas fa-cart-arrow-down"></i></span>
                                <?php
                                if ( class_exists( 'autoshowroom_WC_Widget_Cart' ) ) { the_widget( 'autoshowroom_WC_Widget_Cart' ); }
                                ?>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div><!--end class container-->
        </div>
    </header>
    <!-- End Header 2 -->
    <?php
}
elseif ( $header_class == 'tz-header-3' ) {
    ?>
    <!-- Begin Header 1 -->
    <header class="tz-header tz-header-3 <?php echo $autoshowroom_header_menu_cart_true.' '.$mobilemenu;?>">

        <?php
        if($autoshowroom_top_sidebar == 'show'):
            if ( is_active_sidebar( 'headertop-left' ) || is_active_sidebar( 'headertop-right' )  ) : ?>
                <div class="tz-top-header ">
                    <div class="container">
                        <div class="row">
                            <?php
                            if ( is_active_sidebar( 'headertop-left' )  ) : ?>
                                <div class="col-md-6 tz-top-header-left">
                                    <?php dynamic_sidebar( 'headertop-left' ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( is_active_sidebar( 'headertop-right' ) ) : ?>
                                <div class="col-md-6 tz-top-header-right">
                                    <?php dynamic_sidebar( 'headertop-right' ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="tz-menu-header <?php echo $sticky;?>">
            <div class="container tz-megamenu-wrap">

                <div class="row">
                    <div class="col-md-3 tz-logo-block">
                        <?php
                        if ( is_front_page() ) {
                            echo ('<h1>');
                        }
                        if($autoshowroom_logotype == 0){
                            ?>
                            <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                <?php
                                echo ('<span class="tz-logo-text">'.esc_html($autoshowroom_text).'</span>');
                                ?></a>
                            <?php
                        }else{
                            if ( isset($autoshowroom_img_url) && !empty( $autoshowroom_img_url ) ) :
                                $logo_ext= wp_check_filetype($autoshowroom_img_url);
                                $logo_file = $logo_ext['ext'];
                                if($logo_file =='svg'){
                                    ?>
                                    <div class="svg_logo" data-href="<?php echo esc_url(get_home_url('/')); ?>">
                                        <object id="svgObject"  type="image/svg+xml" data="<?php echo esc_url($autoshowroom_img_url);?>" class="svg_logo">
                                            <?php echo esc_html_e('Your browser does not support SVG','tz_autoshowroom');?>
                                        </object>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                    <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                        <?php
                                        echo'<img src="'.esc_url($autoshowroom_img_url).'" alt="'.get_bloginfo('title').'" />';
                                        ?></a>
                                    <?php
                                }

                            else :
                                ?>
                                <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                    <?php
                                    echo'<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('title').'" width="189" height="17" />';
                                    ?></a>
                                <?php
                            endif;
                        }
                        if ( is_front_page() ) {
                            echo ('</h1>');
                        }
                        ?>
                    </div>
                    <?php if($maxmegamenu==''){?>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tz-menu-mobile" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    <?php } ?>
                    <div class="col-md-9 tz-megamenu " id="tz-menu-mobile">
                        <nav class="nav-collapse tz-menu-mobile">
                            <?php
                            if ( has_nav_menu('primary') ) {
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'menu_class' => 'nav navbar-nav tz-nav',
                                    'container' => false
                                ));
                            }else{
                                wp_nav_menu(array(
                                    'theme_location' => 'primary-home-3',
                                    'menu_class' => 'nav navbar-nav tz-nav',
                                    'container' => false
                                ));
                            }

                            ?>
                        </nav>
                        <?php
                        if ($autoshowroom_header_menu_cart=='show' && class_exists( 'WooCommerce')):
                            ?>
                            <div class="tz-header-cart pull-right">
                                <span aria-hidden="true" class="icon_cart_alt"><i class="fas fa-cart-arrow-down"></i></span>
                                <?php
                                if ( class_exists( 'autoshowroom_WC_Widget_Cart' ) ) { the_widget( 'autoshowroom_WC_Widget_Cart' ); }
                                ?>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div><!--end class container-->
        </div>
    </header>
    <!-- End Header 1 -->

    <?php
}
elseif ( $header_class == 'tz-header-4' ) {
    ?>
    <!-- Begin Header 4 -->
    <header class="tz-header tz-header-3 tz-header-4 <?php echo $autoshowroom_header_menu_cart_true.' '.$mobilemenu;?>">

        <?php
        if($autoshowroom_top_sidebar == 'show'):
            if ( is_active_sidebar( 'headertop-left' ) || is_active_sidebar( 'headertop-right' )  ) : ?>
                <div class="tz-top-header">
                    <div class="container">
                        <div class="row">
                            <?php
                            if ( is_active_sidebar( 'headertop-left' )  ) : ?>
                                <div class="col-md-6 tz-top-header-left">
                                    <?php dynamic_sidebar( 'headertop-left' ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( is_active_sidebar( 'headertop-right' ) ) : ?>
                                <div class="col-md-6 tz-top-header-right">
                                    <?php dynamic_sidebar( 'headertop-right' ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="tz-menu-header <?php echo $sticky;?>">
            <div class="container tz-megamenu-wrap">

                <div class="row">
                    <div class="col-md-3 tz-logo-block">
                        <?php
                        if ( is_front_page() ) {
                            echo ('<h1>');
                        }
                        if($autoshowroom_logotype == 0){
                            ?>
                            <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                <?php
                                echo ('<span class="tz-logo-text">'.esc_html($autoshowroom_text).'</span>');
                                ?></a>
                            <?php
                        }else{
                            if ( isset($autoshowroom_img_url) && !empty( $autoshowroom_img_url ) ) :
                                $logo_ext= wp_check_filetype($autoshowroom_img_url);
                                $logo_file = $logo_ext['ext'];
                                if($logo_file =='svg'){
                                    ?>
                                    <div class="svg_logo" data-href="<?php echo esc_url(get_home_url('/')); ?>">
                                        <object id="svgObject"  type="image/svg+xml" data="<?php echo esc_url($autoshowroom_img_url);?>" class="svg_logo">
                                            <?php echo esc_html_e('Your browser does not support SVG','tz_autoshowroom');?>
                                        </object>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                    <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                        <?php
                                        echo'<img src="'.esc_url($autoshowroom_img_url).'" alt="'.get_bloginfo('title').'" />';
                                        ?></a>
                                    <?php
                                }

                            else :
                                ?>
                                <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                    <?php
                                    echo'<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('title').'" width="189" height="17" />';
                                    ?></a>
                                <?php
                            endif;
                        }
                        if ( is_front_page() ) {
                            echo ('</h1>');
                        }
                        ?>
                    </div>
                    <?php if($maxmegamenu==''){?>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tz-menu-mobile" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    <?php } ?>
                    <div class="col-md-9 tz-megamenu " id="tz-menu-mobile">
                        <nav class="nav-collapse tz-menu-mobile">
                            <?php
                            if ( has_nav_menu('primary') ) {
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'menu_class' => 'nav navbar-nav tz-nav',
                                    'container' => false
                                ));
                            }else{
                                wp_nav_menu(array(
                                    'theme_location' => 'primary-home-4',
                                    'menu_class' => 'nav navbar-nav tz-nav',
                                    'container' => false
                                ));
                            }

                            ?>
                        </nav>
                        <?php
                        if ($autoshowroom_header_menu_cart=='show' && class_exists( 'WooCommerce')):
                            ?>
                            <div class="tz-header-cart pull-right">
                                <span aria-hidden="true" class="icon_cart_alt"><i class="fas fa-cart-arrow-down"></i></span>
                                <?php
                                if ( class_exists( 'autoshowroom_WC_Widget_Cart' ) ) { the_widget( 'autoshowroom_WC_Widget_Cart' ); }
                                ?>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div><!--end class container-->
        </div>
    </header>
    <!-- End Header 4 -->

    <?php
}
elseif ( $header_class == 'tz-header-5' ) {
    ?>
    <!-- Begin Header 5 -->
    <header class="tz-header tz-header-3 tz-header-5 <?php echo $autoshowroom_header_menu_cart_true.' '.$mobilemenu;?>">
        <div class="tz-menu-header <?php echo $sticky; ?>">
            <div class="container">
                <div class="tz-megamenu-wrap">
                    <div class="row">
                        <div class="header-5-logo col-md-2">
                            <?php
                            if (is_front_page()) {
                                echo('<h1>');
                            }
                            if($autoshowroom_logotype == 0){
                                ?>
                                <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                    <?php
                                    echo ('<span class="tz-logo-text">'.esc_html($autoshowroom_text).'</span>');
                                    ?></a>
                                <?php
                            }else{
                                if ( isset($autoshowroom_img_url) && !empty( $autoshowroom_img_url ) ) :
                                    $logo_ext= wp_check_filetype($autoshowroom_img_url);
                                    $logo_file = $logo_ext['ext'];
                                    if($logo_file =='svg'){
                                        ?>
                                        <div class="svg_logo" data-href="<?php echo esc_url(get_home_url('/')); ?>">
                                            <object id="svgObject"  type="image/svg+xml" data="<?php echo esc_url($autoshowroom_img_url);?>" class="svg_logo">
                                                <?php echo esc_html_e('Your browser does not support SVG','tz_autoshowroom');?>
                                            </object>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                        <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                            <?php
                                            echo'<img src="'.esc_url($autoshowroom_img_url).'" alt="'.get_bloginfo('title').'" />';
                                            ?></a>
                                        <?php
                                    }

                                else :
                                    ?>
                                    <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                        <?php
                                        echo'<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('title').'" width="189" height="17" />';
                                        ?></a>
                                    <?php
                                endif;
                            }
                            if (is_front_page()) {
                                echo('</h1>');
                            }
                            ?>
                        </div>
                        <?php if($maxmegamenu==''){?>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tz-menu-mobile" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        <?php } ?>
                        <div class="col-md-10 tz-megamenu " id="tz-menu-mobile">
                            <?php
                            if ($autoshowroom_top_sidebar == 'show'):
                                if (is_active_sidebar('headertop-left') || is_active_sidebar('headertop-right')) : ?>
                                    <div class="tz-top-header">
                                        <?php if (is_active_sidebar('headertop-right')) : ?>
                                            <div class="tz-top-header-right">
                                                <?php dynamic_sidebar('headertop-right'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <nav class="nav-collapse tz-menu-mobile">
                                <?php
                                if ( has_nav_menu('primary') ) {
                                    wp_nav_menu(array(
                                        'theme_location' => 'primary',
                                        'menu_class' => 'nav navbar-nav tz-nav',
                                        'container' => false
                                    ));
                                }else{
                                    wp_nav_menu(array(
                                        'theme_location' => 'primary-home-motor',
                                        'menu_class' => 'nav navbar-nav tz-nav',
                                        'container' => false
                                    ));
                                }
                                ?>
                            </nav>
                            <?php
                            if ($autoshowroom_header_menu_cart=='show' && class_exists( 'WooCommerce')):
                                ?>
                                <div class="tz-header-cart pull-right">
                                    <span aria-hidden="true" class="icon_cart_alt"><i class="fas fa-cart-arrow-down"></i></span>
                                    <?php
                                    if ( class_exists( 'autoshowroom_WC_Widget_Cart' ) ) { the_widget( 'autoshowroom_WC_Widget_Cart' ); }
                                    ?>
                                </div>
                                <?php
                            endif;
                            ?>
                        </div>
                    </div>
                </div><!--end class container-->
            </div>
        </div>
    </header>
    <!-- End Header 5 -->
    <?php
}
elseif( $header_class == 'tz-header-6' ) {
    ?>
    <!-- Begin Header 6 -->
    <header class="tz-header tz-header-6 <?php echo $autoshowroom_header_menu_cart_true.' '.$mobilemenu;?>">

        <?php
        if($autoshowroom_top_sidebar == 'show'):
            if ( is_active_sidebar( 'headertop-left' ) || is_active_sidebar( 'headertop-right' )  ) : ?>
                <div class="tz-top-header">
                    <div class="container">
                        <div class="row">
                            <?php
                            if ( is_active_sidebar( 'headertop-left' )  ) : ?>
                                <div class="col-md-6 tz-top-header-left">
                                    <?php dynamic_sidebar( 'headertop-left' ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( is_active_sidebar( 'headertop-right' ) ) : ?>
                                <div class="col-md-6 tz-top-header-right">
                                    <?php dynamic_sidebar( 'headertop-right' ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="tz-menu-header <?php echo $sticky;?>">
            <div class="container tz-megamenu-wrap">
                <div class="row">
                    <div class="col-md-3 tz-logo-block">
                        <?php
                        if ( is_front_page() ) {
                            echo ('<h1>');
                        }
                        if($autoshowroom_logotype == 0){
                            ?>
                            <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                <?php
                                echo ('<span class="tz-logo-text">'.esc_html($autoshowroom_text).'</span>');
                                ?></a>
                            <?php
                        }else{
                            if ( isset($autoshowroom_img_url) && !empty( $autoshowroom_img_url ) ) :
                                $logo_ext= wp_check_filetype($autoshowroom_img_url);
                                $logo_file = $logo_ext['ext'];
                                if($logo_file =='svg'){
                                    ?>
                                    <div class="svg_logo" data-href="<?php echo esc_url(get_home_url('/')); ?>">
                                        <object id="svgObject"  type="image/svg+xml" data="<?php echo esc_url($autoshowroom_img_url);?>" class="svg_logo">
                                            <?php echo esc_html_e('Your browser does not support SVG','tz_autoshowroom');?>
                                        </object>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                    <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                        <?php
                                        echo'<img src="'.esc_url($autoshowroom_img_url).'" alt="'.get_bloginfo('title').'" />';
                                        ?></a>
                                    <?php
                                }

                            else :
                                ?>
                                <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                    <?php
                                    echo'<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('title').'" width="189" height="17" />';
                                    ?></a>
                                <?php
                            endif;
                        }
                        if ( is_front_page() ) {
                            echo ('</h1>');
                        }
                        ?>
                    </div>
                    <?php if($maxmegamenu==''){?>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tz-menu-mobile" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    <?php } ?>
                    <div class="col-md-7 tz-megamenu " id="tz-menu-mobile">
                        <nav class="nav-collapse tz-menu-mobile">
                            <?php
                            if ( has_nav_menu('primary') ) {
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'menu_class' => 'nav navbar-nav tz-nav',
                                    'container' => false
                                ));
                            }else{
                                wp_nav_menu(array(
                                    'theme_location' => 'primary-home-6',
                                    'menu_class' => 'nav navbar-nav tz-nav',
                                    'container' => false
                                ));
                            }
                            ?>
                        </nav>
                        <?php
                        if ($autoshowroom_header_menu_cart=='show' && class_exists( 'WooCommerce')):
                            ?>
                            <div class="tz-header-cart pull-right">
                                <span aria-hidden="true" class="icon_cart_alt"><i class="fas fa-cart-arrow-down"></i></span>
                                <?php
                                if ( class_exists( 'autoshowroom_WC_Widget_Cart' ) ) { the_widget( 'autoshowroom_WC_Widget_Cart' ); }
                                ?>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>
                    <?php if($autoshowroom_header6_addcar == 'show'){ ?>
                    <div class="col-md-2 tz-logo-block tz-add-item">
                        <a href="<?php echo esc_attr($autoshowroom_header6_link_addcar); ?>" class="tz-add-car">
                            <i class="fa fa-plus-circle"></i>
                            <?php esc_html_e('Add your Item','tz-autoshowroom'); ?>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div><!--end class container-->
        </div>
    </header>
    <!-- End Header 6 -->
    <?php
}
elseif( $header_class == 'tz-header-7' ) {
    $autoshowroom_header7_account = ot_get_option('autoshowroom_header7_account','show');
    $autoshowroom_header7_phone = ot_get_option('autoshowroom_header7_phone','+1-888-335-3567');
    $autoshowroom_header7_email = ot_get_option('autoshowroom_header7_email','info@templaza.com');
    $autoshowroom_header7_hour = ot_get_option('autoshowroom_header7_hour','Mon - Fri: 08 am - 10 pm');
    ?>
    <!-- Begin Header 7 -->
    <header class="tz-header tz-header-7 <?php echo $autoshowroom_header_menu_cart_true.' '.$mobilemenu;?>">
        <div class="tz-top-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-3 col-xs-12 tz-logo-block">
                        <?php
                        if ( is_front_page() ) {
                            echo ('<h1>');
                        }
                        if($autoshowroom_logotype == 0){
                            ?>
                            <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                <?php
                                echo ('<span class="tz-logo-text">'.esc_html($autoshowroom_text).'</span>');
                                ?></a>
                            <?php
                        }else{
                            if ( isset($autoshowroom_img_url) && !empty( $autoshowroom_img_url ) ) :
                                $logo_ext= wp_check_filetype($autoshowroom_img_url);
                                $logo_file = $logo_ext['ext'];
                                if($logo_file =='svg'){
                                    ?>
                                    <div class="svg_logo" data-href="<?php echo esc_url(get_home_url('/')); ?>">
                                        <object id="svgObject"  type="image/svg+xml" data="<?php echo esc_url($autoshowroom_img_url);?>" class="svg_logo">
                                            <?php echo esc_html_e('Your browser does not support SVG','tz_autoshowroom');?>
                                        </object>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                    <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                        <?php
                                        echo'<img src="'.esc_url($autoshowroom_img_url).'" alt="'.get_bloginfo('title').'" />';
                                        ?></a>
                                    <?php
                                }

                            else :
                                ?>
                                <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                    <?php
                                    echo'<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('title').'" width="189" height="17" />';
                                    ?></a>
                                <?php
                            endif;
                        }
                        if ( is_front_page() ) {
                            echo ('</h1>');
                        }
                        ?>
                    </div>
                    <div class="col-md-7 col-sm-9 col-xs-12 tz-info">
                        <div class="item phone">
                            <i class="fa fa-phone"></i>
                            <small><?php echo esc_html__('CALL US:','tz-autoshowroom'); ?></small>
                            <span><?php echo esc_html($autoshowroom_header7_phone); ?></span>
                        </div>
                        <div class="item email">
                            <i class="fa fa-envelope"></i>
                            <small><?php echo esc_html__('MAIL US:','tz-autoshowroom'); ?></small>
                            <span><?php echo esc_html($autoshowroom_header7_email); ?></span>
                        </div>
                        <div class="item hour">
                            <i class="fa fa-clock-o"></i>
                            <small><?php echo esc_html__('OPENING HOURS:','tz-autoshowroom'); ?></small>
                            <span><?php echo esc_html($autoshowroom_header7_hour); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tz-menu-header <?php echo $sticky;?> ">
            <div class="container tz-megamenu-wrap">
                <div class="row">
                    <?php if($maxmegamenu==''){?>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tz-menu-mobile" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    <?php } ?>
                    <div class="col-md-9 col-sm-9 col-xs-12 tz-megamenu " id="tz-menu-mobile">
                        <nav class="nav-collapse tz-menu-mobile">
                            <?php
                            if ( has_nav_menu('primary') ) {
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'menu_class' => 'nav navbar-nav tz-nav',
                                    'container' => false
                                ));
                            }else{
                                wp_nav_menu(array(
                                    'theme_location' => 'primary-home-7',
                                    'menu_class' => 'nav navbar-nav tz-nav',
                                    'container' => false
                                ));
                            }
                            ?>
                        </nav>
                        <?php
                        if ($autoshowroom_header_menu_cart=='show' && class_exists( 'WooCommerce')):
                            ?>
                            <div class="tz-header-cart pull-right">
                                <span aria-hidden="true" class="icon_cart_alt"><i class="fas fa-cart-arrow-down"></i></span>
                                <?php
                                if ( class_exists( 'autoshowroom_WC_Widget_Cart' ) ) { the_widget( 'autoshowroom_WC_Widget_Cart' ); }
                                ?>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>
                    <?php if ($autoshowroom_header7_account == 'show'){ ?>
                        <div class="col-md-3 col-sm-3 col-xs-12 tz-account">
                            <?php global $current_user; wp_get_current_user(); ?>
                            <a href="<?php echo get_edit_user_link($current_user->ID);?>" class="tz-add-car">
                                <i class="fa fa-user-circle"></i>
                                <?php if ( is_user_logged_in() ) {
                                    echo $current_user->user_login;
                                } else {
                                    esc_html_e('My Account','tz-autoshowroom'); } ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div><!--end class container-->
        </div>
    </header>
    <!-- End Header 7 -->
    <?php
}
elseif( $header_class == 'tz-header-8' ) {
    $autoshowroom_header8_logo_image = ot_get_option('autoshowroom_header8_logo_image','');
    $autoshowroom_header8_link_register = ot_get_option('autoshowroom_header8_link_register','#');
    $autoshowroom_header8_link_login = ot_get_option('autoshowroom_header8_link_login','#');
    $autoshowroom_header8_phone = ot_get_option('autoshowroom_header8_phone','+1-888-335-3567');
    $autoshowroom_header8_phone_link = ot_get_option('autoshowroom_header8_phone_link','');
    ?>
    <header class="tz-header tz-header-8 <?php echo esc_attr($mobilemenu);?>">
        <div class="tz-menu-header <?php echo $sticky;?>">
            <div class="tz-megamenu-wrap">
                <div class="tz-left tz-logo-block">
                    <?php
                    if ( is_front_page() ) {
                        echo ('<h1>');
                    }
                    if($autoshowroom_header8_logo_image) :
                        if ( isset($autoshowroom_logo_image) && !empty( $autoshowroom_logo_image ) ):
                            $autoshowroom_logo_data = wp_get_attachment_image_src($autoshowroom_logo_image,'full');
                            $autoshowroom_img_url = $autoshowroom_logo_data[0];
                        endif;
                        if ( isset($autoshowroom_img_url) && !empty( $autoshowroom_img_url ) ) :
                            $logo_ext= wp_check_filetype($autoshowroom_img_url);
                            $logo_file = $logo_ext['ext'];
                            if($logo_file =='svg'){
                                ?>
                                <div class="svg_logo" data-href="<?php echo esc_url(get_home_url('/')); ?>">
                                    <object id="svgObject"  type="image/svg+xml" data="<?php echo esc_url($autoshowroom_img_url);?>" class="svg_logo">
                                        <?php echo esc_html_e('Your browser does not support SVG','tz_autoshowroom');?>
                                    </object>
                                </div>
                                <?php
                            }else{
                                ?>
                                <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                    <?php
                                    echo'<img src="'.esc_url($autoshowroom_img_url).'" alt="'.get_bloginfo('title').'" />';
                                    ?></a>
                                <?php
                            }

                        else :
                            ?>
                            <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                <?php
                                echo'<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('title').'" width="189" height="17" />';
                                ?></a>
                        <?php
                        endif;
                    endif;
                    if ( is_front_page() ) {
                        echo ('</h1>');
                    }
                    ?>
                </div>
                <div class="tz-right">
                    <?php if($maxmegamenu==''){?>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tz-menu-mobile" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    <?php } ?>
                    <div class="tz-megamenu " id="tz-menu-mobile">
                        <nav class="nav-collapse tz-menu-mobile">
                            <?php
                            if ( has_nav_menu('primary') ) {
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'menu_class' => 'nav navbar-nav tz-nav',
                                    'container' => false
                                ));
                            }else{
                                wp_nav_menu(array(
                                    'theme_location' => 'primary-home-8',
                                    'menu_class' => 'nav navbar-nav tz-nav',
                                    'container' => false
                                ));
                            }
                            ?>
                        </nav>
                    </div>
                    <div class="tz-header-login">
                        <div class="tz_login">
                            <?php if($autoshowroom_header8_link_login){?>
                                <a href="<?php echo esc_html($autoshowroom_header8_link_login); ?>"><?php echo esc_html_e('Login', 'tz_autoshowroom'); ?></a>
                            <?php }?>
                            <?php if($autoshowroom_header8_link_register){?>
                                <?php if($autoshowroom_header8_link_login && $autoshowroom_header8_link_register){ ?>
                                <span>or</span>
                                    <?php } ?>
                                <a href="<?php echo esc_html($autoshowroom_header8_link_register); ?>"><?php echo esc_html_e('Register', 'tz_autoshowroom'); ?></a>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div><!--end class container-fluid-->
        </div>
    </header>
    <!-- End Header 8 -->
    <?php
}elseif ($header_class == 'tz-header-9') {
?>
<!-- Begin Header 9 -->
<header class="tz-header tz_hservice <?php echo $autoshowroom_header_menu_cart_true.' '.$mobilemenu;?>">
    <?php
    if ($autoshowroom_top_sidebar == 'show'):
        if (is_active_sidebar('headertop-left') || is_active_sidebar('headertop-right')) : ?>
            <div class="tz-top-header">
                <div class="container tz_Fwidth">
                    <div class="row">
                        <?php
                        if ( is_active_sidebar( 'headertop-left' )  ) : ?>
                            <div class="col-md-8 col-sm-12 tz-top-header-left">
                                <?php dynamic_sidebar( 'headertop-left' ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( is_active_sidebar( 'headertop-right' ) ) : ?>
                            <div class="col-md-4 col-sm-12 tz-top-header-right">
                                <?php dynamic_sidebar( 'headertop-right' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="tz-menu-header <?php echo $sticky;?>">
        <div class="container tz_Fwidth tz-megamenu-wrap">
            <div class="row">
                <div class="col-md-3 tz-logo-block">
                    <?php
                    if ( is_front_page() ) {
                        echo ('<h1>');
                    }
                    if($autoshowroom_logotype == 0){
                        ?>
                        <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                            <?php
                            echo ('<span class="tz-logo-text">'.esc_html($autoshowroom_text).'</span>');
                            ?></a>
                        <?php
                    }else{
                        if ( isset($autoshowroom_img_url) && !empty( $autoshowroom_img_url ) ) :
                            $logo_ext= wp_check_filetype($autoshowroom_img_url);
                            $logo_file = $logo_ext['ext'];
                            if($logo_file =='svg'){
                                ?>
                                <div class="svg_logo" data-href="<?php echo esc_url(get_home_url('/')); ?>">
                                    <object id="svgObject"  type="image/svg+xml" data="<?php echo esc_url($autoshowroom_img_url);?>" class="svg_logo">
                                        <?php echo esc_html_e('Your browser does not support SVG','tz_autoshowroom');?>
                                    </object>
                                </div>
                                <?php
                            }else{
                                ?>
                                <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                    <?php
                                    echo'<img src="'.esc_url($autoshowroom_img_url).'" alt="'.get_bloginfo('title').'" />';
                                    ?></a>
                                <?php
                            }

                        else :
                            ?>
                            <a class="pull-left tz_logo" href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                                <?php
                                echo'<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('title').'" width="189" height="17" />';
                                ?></a>
                        <?php
                        endif;
                    }
                    if ( is_front_page() ) {
                        echo ('</h1>');
                    }
                    ?>
                </div>
                <?php if($maxmegamenu==''){?>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tz-menu-mobile" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <?php } ?>
                <div class="col-md-9 tz-megamenu " id="tz-menu-mobile">
                    <nav class="nav-collapse tz-menu-mobile">
                        <?php
                        if ( has_nav_menu('primary') ) {
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_class' => 'nav navbar-nav tz-nav',
                                'container' => false
                            ));
                        }else{
                            wp_nav_menu(array(
                                'theme_location' => 'primary-home-9',
                                'menu_class' => 'nav navbar-nav tz-nav',
                                'container' => false
                            ));
                        }
                        ?>
                    </nav>
                    <?php
                    if ($autoshowroom_header_menu_cart=='show' && class_exists( 'WooCommerce')):
                        ?>
                        <div class="tz-header-cart pull-right">
                            <span aria-hidden="true" class="icon_cart_alt"><i class="fas fa-cart-arrow-down"></i></span>
                            <?php
                            if ( class_exists( 'autoshowroom_WC_Widget_Cart' ) ) { the_widget( 'autoshowroom_WC_Widget_Cart' ); }
                            ?>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div><!--end class container-->
    </div>
</header>
    <!-- End Header 9 -->
<?php }
