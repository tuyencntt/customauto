<?php
/*
 * Method process option
 * # option 1: config font
 * # option 2: process config theme
*/
if (!is_admin()):


    add_action('wp_head', 'autoshowroom_config_theme');

    function autoshowroom_config_theme()
    {
        $autoshowroom_styles = '<style type="text/css">';
        $autoshowroom_styles .= '';

        // Color options
        $autoshowroom__menu_color_type = ot_get_option('autoshowroom_menu_color_type', 'max_megamenu');

        $autoshowroom_general_color = ot_get_option('autoshowroom_general_color', '#ff5400');
        $autoshowroom_menu_color = ot_get_option('autoshowroom_menu_color', '#222');
        $autoshowroom_menu_hover = ot_get_option('autoshowroom_menu_hover', '#ff5400');
        $autoshowroom_submenu_color = ot_get_option('autoshowroom_submenu_color', '#222');
        $autoshowroom_submenu_hover = ot_get_option('autoshowroom_submenu_hover', '#ff5400');
        $autoshowroom_submenu_border = ot_get_option('autoshowroom_submenu_border', '#ff5400');
        if ($autoshowroom__menu_color_type == 'custom') {
            $autoshowroom_styles .= '
                body header nav ul.navbar-nav li > a,
            #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item > a.mega-menu-link,
            #mega-menu-wrap-primary-home-8 #mega-menu-primary-home-8 > li.mega-menu-item > a.mega-menu-link,
            #mega-menu-wrap-primary-home-8 #mega-menu-primary-home-8 > li.mega-menu-item.mega-current-menu-item > a.mega-menu-link, 
            #mega-menu-wrap-primary-home-8 #mega-menu-primary-home-8 > li.mega-menu-item.mega-current-menu-ancestor > a.mega-menu-link, 
            #mega-menu-wrap-primary-home-8 #mega-menu-primary-home-8 > li.mega-menu-item.mega-current-page-ancestor > a.mega-menu-link,
            #mega-menu-wrap-primary-home-7 #mega-menu-primary-home-7 > li.mega-menu-item > a.mega-menu-link,
            #mega-menu-wrap-primary-home-6 #mega-menu-primary-home-6 > li.mega-menu-item > a.mega-menu-link,
            #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-3 > li.mega-menu-item > a.mega-menu-link,
            #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-2 > li.mega-menu-item > a.mega-menu-link,
            #mega-menu-wrap-primary-home-9 #mega-menu-primary-home-9 > li.mega-menu-item > a.mega-menu-link,
            #mega-menu-wrap-primary-home-10 #mega-menu-primary-home-10 > li.mega-menu-item > a.mega-menu-link
            {
            color:' . $autoshowroom_menu_color . ';
            }
            body header nav ul.navbar-nav li > a:hover,
            body #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item.mega-current-menu-item > a.mega-menu-link,
            body #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item.mega-current-menu-ancestor > a.mega-menu-link,
            body #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item.mega-toggle-on > a.mega-menu-link,
            body #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item > a.mega-menu-link:hover,
            body #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item > a.mega-menu-link:focus,
            #mega-menu-wrap-primary-home-8 #mega-menu-primary-home-8 > li.mega-menu-item > a.mega-menu-link:hover,
            #mega-menu-wrap-primary-home-8 #mega-menu-primary-home-8 > li.mega-menu-item.mega-current-menu-item > a.mega-menu-link, 
            #mega-menu-wrap-primary-home-8 #mega-menu-primary-home-8 > li.mega-menu-item.mega-current-menu-ancestor > a.mega-menu-link, 
            #mega-menu-wrap-primary-home-8 #mega-menu-primary-home-8 > li.mega-menu-item.mega-current-page-ancestor > a.mega-menu-link,
            #mega-menu-wrap-primary-home-6 #mega-menu-primary-home-6 > li.mega-menu-item.mega-current-menu-item > a.mega-menu-link,
            #mega-menu-wrap-primary-home-6 #mega-menu-primary-home-6 > li.mega-menu-item.mega-current-menu-ancestor > a.mega-menu-link,
            #mega-menu-wrap-primary-home-6 #mega-menu-primary-home-6 > li.mega-menu-item.mega-current-page-ancestor > a.mega-menu-link,
            #mega-menu-wrap-primary-home-6 #mega-menu-primary-home-6 > li.mega-menu-item > a.mega-menu-link:hover,
            #mega-menu-wrap-primary-home-6 #mega-menu-primary-home-9 > li.mega-menu-item.mega-toggle-on > a.mega-menu-link,
            #mega-menu-wrap-primary-home-7 #mega-menu-primary-home-7 > li.mega-menu-item.mega-current-menu-item > a.mega-menu-link,
            #mega-menu-wrap-primary-home-7 #mega-menu-primary-home-7 > li.mega-menu-item.mega-current-menu-ancestor > a.mega-menu-link,
            #mega-menu-wrap-primary-home-7 #mega-menu-primary-home-7 > li.mega-menu-item.mega-current-page-ancestor > a.mega-menu-link,
            #mega-menu-wrap-primary-home-7 #mega-menu-primary-home-7 > li.mega-menu-item > a.mega-menu-link:hover,
            #mega-menu-wrap-primary-home-7 #mega-menu-primary-home-9 > li.mega-menu-item.mega-toggle-on > a.mega-menu-link,
            #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-3 > li.mega-menu-item.mega-current-menu-item > a.mega-menu-link,
            #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-3 > li.mega-menu-item.mega-current-menu-ancestor > a.mega-menu-link,
            #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-3 > li.mega-menu-item.mega-current-page-ancestor > a.mega-menu-link,
            #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-3 > li.mega-menu-item > a.mega-menu-link:hover,
            #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-9 > li.mega-menu-item.mega-toggle-on > a.mega-menu-link,
            #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-2 > li.mega-menu-item.mega-current-menu-item > a.mega-menu-link,
            #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-2 > li.mega-menu-item.mega-current-menu-ancestor > a.mega-menu-link,
            #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-2 > li.mega-menu-item.mega-current-page-ancestor > a.mega-menu-link,
            #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-2 > li.mega-menu-item > a.mega-menu-link:hover,
            #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-9 > li.mega-menu-item.mega-toggle-on > a.mega-menu-link,
            #mega-menu-wrap-primary-home-9 #mega-menu-primary-home-9 > li.mega-menu-item > a.mega-menu-link:hover,
            #mega-menu-wrap-primary-home-9 #mega-menu-primary-home-9 > li.mega-menu-item.mega-toggle-on > a.mega-menu-link,
            #mega-menu-wrap-primary-home-10 #mega-menu-primary-home-10 > li.mega-menu-item.mega-toggle-on > a.mega-menu-link
            
            {
            color:' . $autoshowroom_menu_hover . ';
            }
            body header nav ul.navbar-nav ul.sub-menu li a,
            #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link,
            #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-megamenu > ul.mega-sub-menu > li.mega-menu-item h4.mega-block-title, 
            #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-megamenu > ul.mega-sub-menu li.mega-menu-column > ul.mega-sub-menu > li.mega-menu-item h4.mega-block-title,
            #mega-menu-wrap-primary-home-8 #mega-menu-primary-home-8 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link,
            header #mega-menu-wrap-primary #mega-menu-primary .mega-menu-item-type-widget ul li a, 
            header #mega-menu-wrap-primary-home-2 #mega-menu-primary .mega-menu-item-type-widget ul li a, 
            header #mega-menu-wrap-primary-home-3 #mega-menu-primary .mega-menu-item-type-widget ul li a, 
            header #mega-menu-wrap-primary #mega-menu-primary-home-2 .mega-menu-item-type-widget ul li a, 
            header #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-2 .mega-menu-item-type-widget ul li a, 
            header #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-2 .mega-menu-item-type-widget ul li a, 
            header #mega-menu-wrap-primary #mega-menu-primary-home-3 .mega-menu-item-type-widget ul li a, 
            header #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-3 .mega-menu-item-type-widget ul li a, 
            header #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-3 .mega-menu-item-type-widget ul li a,
            header #mega-menu-wrap-primary #mega-menu-primary .menu li i, 
            header #mega-menu-wrap-primary-home-2 #mega-menu-primary .menu li i, 
            header #mega-menu-wrap-primary-home-3 #mega-menu-primary .menu li i, 
            header #mega-menu-wrap-primary #mega-menu-primary-home-2 .menu li i, 
            header #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-2 .menu li i, 
            header #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-2 .menu li i, 
            header #mega-menu-wrap-primary #mega-menu-primary-home-3 .menu li i, 
            header #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-3 .menu li i, 
            header #mega-menu-wrap-primary-home-6 #mega-menu-primary-home-6 .menu li i, 
            header #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-3 .menu li i,
            #mega-menu-wrap-primary-home-7 #mega-menu-primary-home-7 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link,
            #mega-menu-wrap-primary-home-6 #mega-menu-primary-home-6 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link,
            #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-3 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link,
            #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-2 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link,
            #mega-menu-wrap-primary-home-9 #mega-menu-primary-home-9 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link,
            #mega-menu-wrap-primary-home-10 #mega-menu-primary-home-10 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link
            {
            color:' . $autoshowroom_submenu_color . ';
            }
            body header nav ul.navbar-nav ul.sub-menu li a:hover,
            body #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:hover,
            body #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:focus,
            #mega-menu-wrap-primary-home-8 #mega-menu-primary-home-8 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:hover, 
            #mega-menu-wrap-primary-home-8 #mega-menu-primary-home-8 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:focus,
            header #mega-menu-wrap-primary #mega-menu-primary .menu li a:hover, 
            header #mega-menu-wrap-primary-home-2 #mega-menu-primary .menu li a:hover, 
            header #mega-menu-wrap-primary-home-3 #mega-menu-primary .menu li a:hover, 
            header #mega-menu-wrap-primary #mega-menu-primary-home-2 .menu li a:hover, 
            header #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-2 .menu li a:hover, 
            header #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-2 .menu li a:hover, 
            header #mega-menu-wrap-primary #mega-menu-primary-home-3 .menu li a:hover, 
            header #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-3 .menu li a:hover, 
            header #mega-menu-wrap-primary-home-6 #mega-menu-primary-home-6 .menu li a:hover, 
            header #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-3 .menu li a:hover,
            header #mega-menu-wrap-primary #mega-menu-primary .menu li:hover i, 
            header #mega-menu-wrap-primary-home-2 #mega-menu-primary .menu li:hover i, 
            header #mega-menu-wrap-primary-home-3 #mega-menu-primary .menu li:hover i, 
            header #mega-menu-wrap-primary #mega-menu-primary-home-2 .menu li:hover i, 
            header #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-2 .menu li:hover i, 
            header #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-2 .menu li:hover i, 
            header #mega-menu-wrap-primary #mega-menu-primary-home-3 .menu li:hover i, 
            header #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-3 .menu li:hover i, 
            header #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-3 .menu li:hover i,
            #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-2 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:hover,
            #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-2 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:focus,
            #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-3 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:hover,
            #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-3 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:focus,
            #mega-menu-wrap-primary-home-6 #mega-menu-primary-home-6 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:hover,
            #mega-menu-wrap-primary-home-6 #mega-menu-primary-home-6 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:focus,
            #mega-menu-wrap-primary-home-7 #mega-menu-primary-home-7 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:hover,
            #mega-menu-wrap-primary-home-7 #mega-menu-primary-home-7 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:focus,
            #mega-menu-wrap-primary-home-9 #mega-menu-primary-home-9 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:hover,
            #mega-menu-wrap-primary-home-9 #mega-menu-primary-home-9 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:focus,
            #mega-menu-wrap-primary-home-10 #mega-menu-primary-home-10 > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link:focus
            {
            color:' . $autoshowroom_submenu_hover . ';
            }
            body div header nav ul.navbar-nav li > ul.sub-menu,
            #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-flyout ul.mega-sub-menu,
            #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-megamenu > ul.mega-sub-menu,
            #mega-menu-wrap-primary-home-8 #mega-menu-primary-home-8 > li.mega-menu-flyout ul.mega-sub-menu,
            .tz-header .tz-header-cart .widget_shopping_cart,
            #mega-menu-wrap-primary-home-2 #mega-menu-primary-home-2 > li.mega-menu-flyout ul.mega-sub-menu,
            #mega-menu-wrap-primary-home-3 #mega-menu-primary-home-3 > li.mega-menu-flyout ul.mega-sub-menu,
            #mega-menu-wrap-primary-home-6 #mega-menu-primary-home-6 > li.mega-menu-flyout ul.mega-sub-menu,
            #mega-menu-wrap-primary-home-7 #mega-menu-primary-home-7 > li.mega-menu-flyout ul.mega-sub-menu,
            #mega-menu-wrap-primary-home-9 #mega-menu-primary-home-9 > li.mega-menu-flyout ul.mega-sub-menu,
            #mega-menu-wrap-primary-home-10 #mega-menu-primary-home-10 > li.mega-menu-flyout ul.mega-sub-menu
            {
            border-color:' . $autoshowroom_submenu_border . ';
            }
                ';
        }

        $autoshowroom_styles .= '
            

            body .quicksearch_top_right,
            body .quicksearch_top_left,
            body .quicksearch_bottom_left,
            body .quicksearch_bottom_right,
            body .quicksearch_top_center,
            body .quicksearch_bottom_center,
            body header nav ul.navbar-nav li > ul.sub-menu,
            body .TZ-Vehicle-Feature .item .Vehicle-Title a, body .TZ-Vehicle-Grid .item .Vehicle-Title a,
            body .rev_slider_wrapper .Auto-Slider-Title, body .autoshowroom-title h2.AutoshowroomTitle::before, body header,
            body .autoshowroom-blog .autoshowroom-blog-body .autoshowroom-blog-item .autoshowroom-blog-item-wrap,
            body .tzshop-wrap .product-grid ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_info h3.tzShop-item_title a,
            body .vehicle-detail h1.vehicle-title,
            body .vehicle-detail .vehicle-btn-function span,
            body.woocommerce .product-detail .product-content .woocommerce-tabs ul.tabs li:hover a,
            body.woocommerce .product-detail .product-content .woocommerce-tabs ul.tabs li:focus a,
            body.woocommerce .product-detail .product-content .woocommerce-tabs ul.tabs li.active a,
            body .container-content .vehicle-layout-list .vehicle-grid .TZ-Vehicle-Grid .vehicle-btn a,
            body .container-content .vehicle-layout-list .vehicle-grid .TZ-Vehicle-Grid .vehicle-btn span,
            body .products_compare .compare-count,
            body .TZ-Vehicle-Compare .item h3,
            body .vehicle-detail .su-tabs .su-tabs-nav span.su-tabs-current,
            body .vehicle-detail .su-tabs .su-tabs-nav span:hover,
            body .tzshop-wrap .product-list ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_info h3.tzShop-item_title a,
            body.woocommerce div.woocommerce-message,
            body.woocommerce-checkout .woocommerce .woocommerce-info,
            .single-post .autoshowroom-single-author .autoshowroom-single-author-wrap,
            .single-post .autoshowroom-might-also-like .autoshowroom-might-also-like-wrap,
            .single-post .autoshowroom-comment .autoshowroom-comment-wrap,
            .single-post .autoshowroom-single-author .autoshowroom-single-author-wrap .autoshowroom-single-author-info .autoshowroom-single-author-left,
            .TZ-Dealer-Feature .item .Vehicle-Title a,
            .tz-header  .tz-header-cart .widget_shopping_cart .widget_shopping_cart_content .buttons a,
            .um-profile .um-profile-body .um-row-heading, .um-page-user .um-profile-body .item .Vehicle-Title a,
            .um-page-user .um-profile.um-editing .um-profile-body .um-col-alt, .vehicle-detail .vehicle-btn-function span
            {
            border-color:' . $autoshowroom_general_color . ';
            }
            body .vc_btn3.vc_btn3-color-warning 
            {
            border-color:' . $autoshowroom_general_color . ' !important;
            }
            body .autoshowroom-quote .slick-track .autoshowroom-quote-item .autoshowroom-quote-image::after,
            body .autoshowroom-service .autoshowroom-service-icon::after,
            body .tzshop-wrap .grid_pagination_block .tzview-style .switchToList span::after,
            body .tzshop-wrap .grid_pagination_block .tzview-style .switchToGrid span::after,
            body .tzshop-wrap .product-grid ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_image .tzShop-item_button a span::after,
            body .tzshop-wrap .product-grid ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_image .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a span::after,
            .tzshop-wrap .product-grid ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_image .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a span::after,
            div .tz-tabs-descriptios::before, header, .autoshowroom-title h2.AutoshowroomTitle:before, 
            .woocommerce div.woocommerce-message, .autoshowroom-service .autoshowroom-service-icon:after,
            .vehicle-detail .su-tabs .su-tabs-nav span.su-tabs-current, .vehicle-detail .su-tabs .su-tabs-nav span:hover
            {
            border-top-color:' . $autoshowroom_general_color . ';
            }
            .TZ-Vehicle-Feature .item .Vehicle-Title a, .TZ-Vehicle-Grid .item .Vehicle-Title a, .vehicle-detail h1.vehicle-title
            {
            border-left-color:' . $autoshowroom_general_color . ';
            }
            
            div .tz-tabs-descriptios::before, .autoshowroom-title h2.AutoshowroomTitle:before
            {
            border-bottom-color:' . $autoshowroom_general_color . ';
            }
            .single-post .autoshowroom-single-share .autoshowroom-single-share-box .autoshowroom-single-share-item span::after{
            border-right-color:' . $autoshowroom_general_color . ';
            }

            body .autoshowroom-our-process span.autoshowroom-number-process,
            body .autoshowroom-our-process a.autoshowroom_readmore:hover,
            body .tzfilter a.selected, html body a:hover, body .autoshowroom-quote .slick-track .autoshowroom-quote-item .autoshowroom-quote-info .autoshowroom-quote-content small,
            body .autoshowroom-quote .slick-track .autoshowroom-quote-item .autoshowroom-quote-info .autoshowroom-quote-name, html body a,
            body .autoshowroom-footer .autoshowroom-footer-top .footerattr .widget.dw_twitter .dw-twitter-inner .tweet-item::after,
            body .TZ-Vehicle-Search-Vertical h3,
            body header i,body .autoshowroom-list ul li i,
            body .autoshowroom-title.autoshowroom-title-left h2.AutoshowroomTitle em,
            body .autoshowroom-post-slider .autoshowroom-post-slider-box .autoshowroom-post-slider-item .autoshowroom-post-image .autoshowroom-post-date i,
            body header nav ul.navbar-nav li a:hover, body header nav ul.navbar-nav li.current_page_item > a,
            body .autoshowroom-blog .autoshowroom-blog-body .autoshowroom-blog-item .autoshowroom-blog-item-wrap .autoshowroom-blog-item-content .autoshowroom-blog-item-Info span a:hover,
            body .autoshowroom-post-slider .autoshowroom-post-slider-box .autoshowroom-post-slider-item .autoshowroom-post-back .autoshowroom-post-front .autoshowroom-post-front-box .autoshowroom-post-front-info .autoshowroom-post-front-info-author a,
            body .autoshowroom-blog .autoshowroom-blog-body .autoshowroom-blog-item .autoshowroom-blog-item-wrap .autoshowroom-blog-item-content .autoshowroom-blog-item-share:hover .autoshowroom-blog-share-icon a:hover,
            body .tzshop-wrap .grid_pagination_block .tzview-style .switchToGrid.active i,
            body .tzshop-wrap .grid_pagination_block .tzview-style .switchToGrid:hover i,
            body .tzshop-wrap .grid_pagination_block .tzview-style .switchToList:hover i,
            body .autoshowroom-sidebar aside.widget.widget_categories ul li a::before,
            body.woocommerce .widget_price_filter .price_slider_amount .button,
            body .autoshowroom-sidebar aside.woocommerce.widget ul li:hover a,
            body .autoshowroom-sidebar aside.woocommerce.widget ul li ins span,
            body .autoshowroom-sidebar aside.widget h3.black i,
            body .container-content .vehicle-results .vehicle-layouts a.active,
            body .container-content .vehicle-results .vehicle-layouts a:hover,
            body .vehicle-detail .vehicle-btn-function span,
            body .payment-calculator label span,
            body .su-list::before,
            body.woocommerce .product-detail .related ul.products li.related-product-item span.price del span,
            body.woocommerce .product-detail .related ul.products li.related-product-item span.price ins span,
            body .autoshowroom-blog .autoshowroom-blog-body .autoshowroom-blog-item .autoshowroom-blog-item-wrap .autoshowroom-blog-item-content h3.autoshowroom-blog-item-title a:hover,
            body .autoshowroom-title-breadcrumb .autoshowroom-breadcrumb .autoshowroom-breadcrumb-navxt span a:hover,
            body .autoshowroom-text-box i, body .autoshowroom-text-box a,
            body .vehicle_listing .pcd-pricing .pcd-price,
            body .container-content .vehicle-layout-list .vehicle-grid .TZ-Vehicle-Grid .vehicle-btn a,
            body .container-content .vehicle-layout-list .vehicle-grid .TZ-Vehicle-Grid .vehicle-btn span,
            body .products_compare .compare-count, body .container-content .vehicle-results.vehicle-compare-results span.results-text span,
            body .TZ-Vehicle-Compare .owl-controls .owl-nav .owl-next:hover,
            body .TZ-Vehicle-Compare .owl-controls .owl-nav .owl-prev:hover,
            body .vehicle-box .pcd-specs a,
            body .tzshop-wrap .grid_pagination_block .tzview-style .switchToList.active i,
            body .woocommerce .product-list .tzShop-item .tzShop-item-bottom-info .price del span,
            body .woocommerce .product-list .tzShop-item .tzShop-item-bottom-info .price ins span,
            body .autoshowroom-sidebar aside.woocommerce.widget ul li a:hover,
            body .autoshowroom-sidebar aside.woocommerce.widget ul li del span,
            body .woocommerce div.woocommerce-message::before,
            body .woocommerce form table.shop_table tbody tr.cart_item td.product-subtotal span.amount,
            body .woocommerce .cart-collaterals .tzCart_totals .tzCollateralsColumn .cart_totals table tbody tr.order-total td span,
            body.woocommerce-checkout .woocommerce .woocommerce-info::before,
            .autoshowroom-sidebar aside.widget ul li a:hover, .autoshowroom-sidebar aside .vehicle_listings .vehicle_listing h4 a:hover,
            .single-post .autoshowroom-single-author .autoshowroom-single-author-wrap .autoshowroom-single-author-info .autoshowroom-single-author-right .autoshowroom-author-social a:hover,
            .autoshowroom-text-box a.font_awesome_link:hover i, #comments .tzCommentForm .comment-respond form.comment-form p a:hover,
            body #comments .tzCommentContent ol.comment-list li.comment article.comment-body .comment-content h5 a:hover,
            .wpb-js-composer .vc_tta-color-white.vc_tta-style-flat .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab.vc_active a span,
            .wpb-js-composer .vc_tta-color-white.vc_tta-style-flat .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab a:hover span,
            .autoshowroom-top-dealer .um-member .um-member__wrapper .um-member-photo .um-member-card .um-member-name:hover a,
            .wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab a:hover span,
            .homev6_blog .blog_content .blog_content__item .blog_content__media .blog_content__detail .blog_detail__wrapper .blog_content__information .blog-content__author strong,
            .homev6_blog .blog_content .blog_content__item .blog_content__media .blog_content__detail .blog_detail__wrapper .blog_content__information .blog_content__separator,
            .homev6_blog .blog_content .blog_content__item .blog_content__media .blog_content__detail .blog_detail__wrapper h3 a:hover,
            .tz-header  .tz-header-cart .widget_shopping_cart .widget_shopping_cart_content .buttons a,
            .tz-header  .tz-header-cart .widget_shopping_cart .widget_shopping_cart_content p.total span.amount,
            .homev6_blog .blog_content__item.blog-style-2 .blog_content__media .autoshowroom-post-image .autoshowroom-post-date i,
            .car-taxonomy a.car-taxonomy-link, .wpb-js-composer .vc_tta-color-purple.vc_tta-style-flat .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab.vc_active a span,
            .wpb-js-composer .vc_tta-color-purple.vc_tta-style-flat .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab a:hover span,
            .TZ-Motorbike-Feature .item .pcd-pricing .pcd-price, .woocommerce div.woocommerce-message::before,
            .um-account .um-form form .um-account-side ul li a.current .um-account-icon i,
            .um-page-user .um-profile.um-editing .um-profile-body .um-field .um-field-area .um-field-radio .um-field-radio-state i,.about-us .autoshowroom_member_image .autoshowroom_member_content span,
            .about-us .autoshowroom_member_image .autoshowroom_member_content .autoshowroom_social i:hover,.about-us .autoshowroom-counter .autoshowroom-counter-box .autoshowroom-counter-icon i,
            .about-us em,.service2 em, .su-dropcap.su-dropcap-style-simple, .autoshowroom-list.list_style-2 ul li i,
             .autoshowroom-pricing .autoshowroom-field-pricing ul li i,
            .tel_countdown .container #tel-countdown__timer .tel-countdown__item, .autoshowroom-service.style3 .autoshowroom-service-icon i, 
            .autoshowroom-quote-type3.type3 .autoshowroom-quote-item .autoshowroom-quote-info .autoshowroom-image-employment .autoshowroom-name-employment .autoshowroom-quote-name,
            .autoshowroom_post_slider_style2 .autoshowroom_post_item .autoshowroom_post_item_child .autoshowroom_post_item_box .tz_post_info .autoshowroom_post_date a, 
            .autoshowroom_post_slider_style2 .autoshowroom_post_item .autoshowroom_post_item_child .autoshowroom_post_item_box .tz_post_info .autoshowroom-post-author a,
            .autoshowroom-service a.autoshowroom-service-readmore:hover,
            .tzshop-wrap .product-list ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_info .tzShop-item_button_list .tzShop-item_button a,
            .woocommerce-checkout .woocommerce .woocommerce-info a,
            .vc_tta-accordion.vc_tta-style-classic.vc_tta-color-orange .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title a .vc_tta-title-text,
            .wpb-js-composer .vc_tta-tabs:not([class*="vc_tta-gap"]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top.vc_tta-style-outline .vc_tta-tab.vc_active > a span,
            .wpb-js-composer .vc_tta-tabs:not([class*="vc_tta-gap"]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-left.vc_tta-style-outline .vc_tta-tab.vc_active > a span,
            .autoshowroom-counter.autoshowroom-counter-style3 .autoshowroom-counter-icon i,
            .vc_toggle.vc_toggle_default .vc_toggle_content p a,
            .autoshowroom_member_image .autoshowroom_member_content .autoshowroom_social i:hover,
            .autoshowroom_member_image .autoshowroom_member_content span,
            .woocommerce-account .woocommerce p.myaccount_user strong,
            .woocommerce-account .woocommerce p.myaccount_user a:hover,
            .woocommerce .product-list .tzShop-item .tzShop-item-bottom-info .price del span,
            .woocommerce .product-list .tzShop-item .tzShop-item-bottom-info .price ins span,
            .autoshowroom-sidebar aside.widget.widget_meta ul li a::before,
            .um-form .um-misc-ul li:hover a,
            .um-form .um-misc-ul li:hover a::after,
            .single-post .autoshowroom-meta-tags a:hover,
            #comments .tzCommentContent ol.comment-list li.comment article.comment-body .comment-content .tz-commentInfo a:hover,
            .quicksearch_top_right h3,
            .quicksearch_top_left h3,
            .quicksearch_bottom_left h3,
            .quicksearch_bottom_right h3,
            .quicksearch_top_center h3,
            .quicksearch_bottom_center h3,
            .wpcf7-form p em,.autoshowroom-title h2 b,.autoshowroom-ads.autoshowroom-ads-type1 .autoshowroom-button a:hover,
            .tz_blogservice .blog_content__item.blog-style-3 h3 a:hover,.autoshowroom-footer-service .autoshowroom-footer-bottom .autoshowroom-footer-bottom-right .menu li a:hover,
            .content-vehicle-types .title a:hover,
            .content-vehicle-types .title a:active,
            .content-vehicle-types .title a:focus,
            .blog_content .blog_content__item.blog-style-4 h3 a:hover
            {
            color:' . esc_attr($autoshowroom_general_color) . ';
            }
            .autoshowroom-footer-service .autoshowroom-footer-top .textwidget i{
              color:' . esc_attr($autoshowroom_general_color) . ' !important;
            }
            body .autoshowroom-sidebar aside.woocommerce.widget ul li del span{opacity:0.8;}
            body .autoshowroom-service .autoshowroom-service-icon,
            body .autoshowroom-sign-up .autoshowroom-sign-up-box,
            body .autoshowroom-sign-up .autoshowroom-sign-up-box .autoshowroom-sign-up-triangle,
            body .autoshowroom-sign-up .esu-from-shortcode form ul li input.esu-button,
            body .autoshowroom-quote .slick-dots li button,
            body .autoshowroom-post-slider .autoshowroom-post-slider-box .autoshowroom-post-slider-item .autoshowroom-post-image .autoshowroom-post-date,
            body .autoshowroom-post-slider .autoshowroom-post-slider-box .autoshowroom-post-slider-item .autoshowroom-post-back .autoshowroom-post-front .autoshowroom-post-front-box h3.autoshowroom-post-front-title::after,
            body .autoshowroom-footer .autoshowroom-footer-top .footerattr .widget.widget_newsletterwidget .newsletter form::after,
            body .autoshowroom-footer .autoshowroom-footer-bottom .autoshowroom-footer-bottom-center .autoshowrooom-footer-bottom-center-box,
            body .autoshowroom-post-slider .owl-controls .owl-dots .owl-dot span,
            body .autoshowroom-quote .slick-track .autoshowroom-quote-item.slick-center .autoshowroom-quote-image,
            body .autoshowroom-quote .slick-track .autoshowroom-quote-item .autoshowroom-quote-image:hover,
            body .autoshowroom-post-slider .owl-controls .owl-nav .owl-next:hover::after,
            body .autoshowroom-post-slider .owl-controls .owl-nav .owl-prev:hover::after,
            body .TZ-Vehicle-Feature .item .Vehicle-Feature-Image .pcd-pricing, .TZ-Vehicle-Grid .item .Vehicle-Feature-Image .pcd-pricing,
            body .autoshowroom-blog .autoshowroom-blog-body .autoshowroom-blog-item .autoshowroom-blog-item-wrap .autoshowroom-blog-item-icon,
            .autoshowroom-blog .autoshowroom-blog-body .autoshowroom-blog-item .autoshowroom-blog-item-wrap .autoshowroom-blog-item-content h3.autoshowroom-blog-item-title::after,
            body .autoshowroom-title-breadcrumb .autoshowroom-page-title .autoshowroom-page-title-overlay .autoshowroom-page-title-content h1::before,
            body .autoshowroom-title-breadcrumb .autoshowroom-page-title .autoshowroom-page-title-overlay .autoshowroom-page-title-content h1::after,
            body .autoshowroom-blog .autoshowroom-blog-body .autoshowroom-blog-pagenavi .autoshowroom-blog-back,
            body .autoshowroom-contact .autoshowroom-contact-overlay .autoshowroom-contact-content a.autoshowroom-contact-button,
            body .tzshop-wrap .grid_pagination_block .tzview-style .switchToList span,
            body .tzShop-item .tzShop-item-bottom-info,
            body .tzshop-wrap .product-grid ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_image .tzShop-item_button,
            body .tzshop-wrap .product-grid ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_image .yith-wcwl-add-to-wishlist,
            body .autoshowroom-sidebar aside.widget h3.widget-title::before,
            body .autoshowroom-sidebar aside.widget h3.widget-title span::before,
            body .autoshowroom-sidebar aside.widget h3.widget-title span::after,
            body.woocommerce .widget_price_filter .ui-slider .ui-slider-range, body.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
            body .tzshop-wrap .grid_pagination_block .tzview-style .switchToGrid span,
            body .autoshowroom-agency .autoshowroom-agency-item .autoshowroom-agency-content h3.autoshowroom-agency-title a::before,
            body .autoshowroom-agency .autoshowroom-agency-item .autoshowroom-agency-content h3.autoshowroom-agency-title a::after,
            body .autoshowroom-agency .autoshowroom-agency-item .autoshowroom-agency-content a.autoshowroom-agency-more:hover,
            html body button:hover,
            body .container-content .vehicle-results .vehicle-layouts a .tooltip-content::after,
            body .container-content .vehicle-results .vehicle-layouts a .tooltip-content,
            body .container-content .vehicle-grid .TZ-Vehicle-Grid .pcd-pricing,
            body .vehicle-detail .vehicle-box h3.widget-title::before,
            body .vehicle-detail .vehicle-box h3.widget-title span::before,
            body .vehicle-detail .vehicle-box h3.widget-title span::after,
            body .vehicle-detail .pcd-pricing,
            body.woocommerce .product-detail .price,
            body.woocommerce .product-detail .cart .single_add_to_cart_button,
            body.woocommerce .product-detail .yith-wcwl-add-to-wishlist .add_to_wishlist,
            body .autoshowroom-agency-single article .autoshowroom-agency-content .autoshowroom-agency-content-right h3.autoshowroom-agency-single-title::after,
            body .autoshowroom-agency-single article .autoshowroom-agency-content .autoshowroom-agency-content-right .wpcf7-form p.btn.btn-color .wpcf7-submit,
            body .vehicle-search-form .car-search-submit:hover, body .autoshowroom-text-box h3.AutoshowroomTitle::before,
            body .autoshowroom-text-box h3.AutoshowroomTitle span::before,
            body .autoshowroom-text-box h3.AutoshowroomTitle span::after,
            body .tzshop-wrap .product-grid ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_image .tzShop-item_button a span,
            body .tzshop-wrap .product-grid ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_image .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a span,
            body .wp-pagenavi span.current, body .wp-pagenavi a:hover,
            body .container-content .vehicle-layout-list .vehicle-grid .TZ-Vehicle-Grid .vehicle-btn a.active,
            body .container-content .vehicle-layout-list .vehicle-grid .TZ-Vehicle-Grid .vehicle-btn span.active,
            body .products_compare, body .container-content .vehicle-results.vehicle-compare-results .vehicle-layouts a,
            body .TZ-Vehicle-Compare .item .Vehicle-Feature-Image .btn-remove-compare,
            body .TZ-Vehicle-Compare .item p.pcd-pricing
            body .vehicle-detail .vehicle-content h3::before,
            body .vehicle-detail .vehicle-content h3::after,
            body .tzshop-wrap .product-list ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_info .tzShop-item_button_list .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:hover,
            body .tzshop-wrap .product-list ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_info .tzShop-item_button_list .tzShop-item_button a:hover,
            body .tzshop-wrap .product-list ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_info .tzShop-item_button_list .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:hover,
            body .woocommerce div.woocommerce-message a.button,
            body .woocommerce form table.shop_table tbody tr td.actions .coupon input.button,
            body .woocommerce form table.shop_table tbody tr td.actions input.button,
            body .woocommerce .cart-collaterals .tzCart_totals .tzCollateralsColumn .cart_totals .wc-proceed-to-checkout a,
            body.woocommerce-checkout .woocommerce form.checkout #order_review .woocommerce-checkout-payment .place-order input#place_order,
            body .vehicle-detail .vehicle-btn-function span.active,
            body .auto-backtotop:hover, .autoshowroom-sidebar aside.widget .tagcloud a:hover,
             .single-post .autoshowroom-single-share .autoshowroom-single-share-box .autoshowroom-single-share-item a,
             .single-post .autoshowroom-single-author .autoshowroom-single-author-wrap .autoshowroom-single-author-icon,
             .single-post .autoshowroom-might-also-like .autoshowroom-might-also-like-wrap .autoshowroom-might-also-like-icon,
             .single-post .autoshowroom-comment .autoshowroom-comment-wrap .autoshowroom-comment-icon,
             .single-post .autoshowroom-might-also-like .autoshowroom-might-also-like-wrap .autoshowroom-might-also-like-content h3.autoshowroom-might-also-like-title::after,
             .single-post .autoshowroom-single-share .autoshowroom-single-share-box .autoshowroom-single-share-item span,
             .tzshop-wrap .product-grid ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_image .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a span,
             .tzshop-wrap .woocommerce-pagination ul.page-numbers li span.current, .tzshop-wrap .woocommerce-pagination ul.page-numbers li a:hover,
             .woocommerce .product-detail .cart .single_add_to_cart_button:hover, .woocommerce .product-detail .product-content .woocommerce-tabs #reviews .form-submit input#submit,
             .TZ-Vehicle-Compare .item p.pcd-pricing, .payment_result,
             .woocommerce form table.shop_table tbody tr td.actions input.button:hover,.woocommerce form table.shop_table tbody tr td.actions .coupon input.button:hover,
             #add_payment_method .wc-proceed-to-checkout a.checkout-button,
            .woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
            .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
            #add_payment_method .wc-proceed-to-checkout a.checkout-button:hover,
            .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
            .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button:hover,
            .woocommerce form table.shop_table tbody tr.cart_item td.product-remove a:hover,
            div.auto-get-a-quote , body .TZ-Vehicle-Search-Horizontal.tz-cusotm-style .vehicle-search-form .car-search-submit,
            div .vehicle-quote-form .quotes_submit, div h3.quote-title::before, div h3.quote-title span::before, div h3.quote-title span::after,
            div #comments .tzCommentContent h3.comments-title::after,
            div #comments .tzCommentContent ol.comment-list li.comment article.comment-body .comment-content .tz-commentInfo a.comment-reply-link:hover,
            div #comments .tzCommentContent ol.comment-list li.comment article.comment-body .comment-content .tz-commentInfo a.comment-edit-link:hover,
            body .tz-header.tz-header-6 .tz-add-car, body .tz-vehicle-search.type2 .vehicle-search-form .car-search-submit,
            body .TZ-Vehicle-Feature.type2 .owl-dots .owl-dot.active span, .TZ-Vehicle-Grid.type2 .owl-dots .owl-dot.active span,
            .wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active a,
            .TZ-Dealer-Feature .item .Vehicle-Feature-Image .pcd-pricing, .autoshowroom-quote.type2 .slick-dots li.slick-active button,
            .tz-header .tz-header-cart .widget_shopping_cart .widget_shopping_cart_content ul.cart_list li a.remove,
            .tz-header  .tz-header-cart .widget_shopping_cart .widget_shopping_cart_content .buttons a:hover,
            .tz-header.tz-header-7 .tz-menu-header .tz-add-car,
            .homev6_blog .blog_content__item.blog-style-2 .blog_content__media .autoshowroom-post-image .autoshowroom-post-date,
            .homev6_newletter.style2 .col-full form .tnp-button,
            .car-taxonomy h3.car-taxonomy-title::after, .car-taxonomy h3.car-taxonomy-title::before,
            .TZ-Motorbike-Feature .view-list a, .woocommerce p.return-to-shop a.button:hover,
            .woocommerce div.woocommerce-message a.button, .um-page-user .um-profile-nav .active.um-profile-nav-item a,
            .um-profile .um-profile-body .um-row-heading::after, .um-page-user .um-profile-nav .um-profile-nav-item a:hover,
            .um-page-user .um-profile-body .item .Vehicle-Feature-Image .pcd-pricing, .dealer_edit_vehicle:hover, span.dealer_delete_vehicle:hover,
            .um-account .um-form form .um-account-main .um-account-tab .um-account-heading::after,
            .um-own-profile .um-profile.um-editing .um-profile-body .um-field .um-field-area input:focus,
            .woocommerce .tzShopDetail-wrap #review_form #respond .form-submit input,
            .service2 .tzElement_viewService .tzView_Service_Slide .tzView_Service_Slide_Item .tzView_Service_Content a.tzViewService-readmore:hover,
            .service2 .owl-prev:hover,
            .service2 .owl-next:hover, .vc_toggle.vc_toggle_default .vc_toggle_title .vc_toggle_icon,
            .vc_toggle.vc_toggle_default .vc_toggle_title .vc_toggle_icon:before,
            .vc_toggle.vc_toggle_default .vc_toggle_title .vc_toggle_icon:after,
            .autoshowroom-pricing:hover:before, .autoshowroom-pricing:hover .autoshowroom_readmore, .autoshowroom-quote-type3.type3 .owl-controls .owl-dots .owl-dot.active,
            .type3 .autoshowroom-footer-top .tz-newsletter3 .tz-newsletter-border .newsletter-content form.newsletter .tnp-field-button .tnp-button,
            .tz-header.tz-header-8 .tz-menu-header .tz-megamenu-wrap .tz_phone, .tz-autoshoowroom-vehicle-search .tz-vehicle-search.type3 h3:before,
            .tz-autoshoowroom-vehicle-search .tz-vehicle-search.type3 h3 span:before, .tz-autoshoowroom-vehicle-search .tz-vehicle-search.type3 h3 span:after,
            .tz-autoshoowroom-vehicle-search .tz-vehicle-search.type3 .vehicle-search-form .car-search-submit, .autoshowroom-phone-number .autoshowroom-phone-number-item,
            .vehicle-detail .vehicle-content h3:before, .tz-header.tz-header-8 .tz-menu-header .tz-megamenu-wrap .tz-right .tz-header-login .tz_login,
            .widget_newsletterwidgetminimal form .tnp-submit,
            body .um-directory .um-member-directory-header .um-member-directory-header-row .um-member-directory-search-line input[type="button"],
            .wpcf7-form p.btn .wpcf7-submit:hover,
            #comments .tzCommentForm .comment-respond form.comment-form .form-submit input:hover,
            .woocommerce-checkout .woocommerce form.checkout #order_review .woocommerce-checkout-payment .place-order input#place_order:hover,
            .vc_tta-accordion.vc_tta-style-normal.vc_tta-color-orange .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading .vc_tta-panel-title,
            .vc_progress_bar.progress_type-3 .vc_single_bar .vc_bar::before,
            .TZ-Condition-vehicle .owl-dots .owl-dot.active span,
            .autoshowroom-service.style2 .autoshowroom-service-icon,
            .woocommerce-account .woocommerce .addresses .address header.title a:hover,
            form#yith-wcwl-form table.wishlist_table tbody tr td.product-add-to-cart a:hover,
            .woocommerce-account .woocommerce form p input.button:hover,
            .woocommerce-checkout .woocommerce form.checkout_coupon p input.button:hover,
            form#yith-wcwl-form table.wishlist_table tbody tr td.product-remove a:hover,
            form#insert_vehicle .features-bottom .vehicle-feature .fileUpload,
            form#insert_vehicle .features-bottom .form-group .fileUpload,
            form#insert_vehicle > button:hover,.tz_button a:hover,.autoshowroom-ads .tz_newsletter form input.tnp-button,
            .tzView_Service_Grid .tzView_Service_Content,.autoshowroom-quote-type4 .owl-dot:after,.tzwidget-social a:hover,
            .content-vehicle-types .vehicle-count,
            .autoshowroom-owlcarousel .owl-controls .owl-nav .owl-next:hover,
            .autoshowroom-owlcarousel .owl-controls .owl-nav .owl-next:focus, 
            .autoshowroom-owlcarousel .owl-controls .owl-nav .owl-next:active, 
            .autoshowroom-owlcarousel .owl-controls .owl-nav .owl-prev:hover, 
            .autoshowroom-owlcarousel .owl-controls .owl-nav .owl-prev:focus, 
            .autoshowroom-owlcarousel .owl-controls .owl-nav .owl-prev:active,
            .TZ-Vehicle-Feature.type4 .item .Vehicle-Feature-Image .pcd-pricing-read
            {
            background-color:' . esc_attr($autoshowroom_general_color) . ';
            }

            body .vc_btn3.vc_btn3-color-warning,
            body.wpb-js-composer .vc_tta-color-orange.vc_tta-style-modern .vc_tta-tab.vc_active > a,
            .auto-page-content .um-load-items a.um-ajax-paginate,
            .um-account .um-form form .um-account-main .um-account-tab .um-col-alt .um-left input,
            .um-page-user .um-profile.um-editing .um-profile-body .um-col-alt .um-left input, .su-dropcap.su-dropcap-style-light,
            body .vc_progress_bar .vc_single_bar .vc_bar
            {
            background-color:' . esc_attr($autoshowroom_general_color) . ' !important;
            }
            
            body .vehicle-content-tab .nav-item a.nav-link:hover,
            body .vehicle-content-tab .nav-item.active a.nav-link,
           .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
           .woocommerce div.product .woocommerce-tabs ul.tabs li:focus a,
           .woocommerce div.product .woocommerce-tabs ul.tabs li.hover a,
           .tzshop-wrap .product-list ul.products li.tzShop-item .tzShop-item_inner .tzShop-item_info .tzShop-item_button_list .tzShop-item_button a,
           .vc_tta-accordion.vc_tta-style-classic.vc_tta-color-orange .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title a .vc_tta-controls-icon::before,
           .vc_tta-accordion.vc_tta-style-classic.vc_tta-color-orange .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title a .vc_tta-controls-icon::after,
           .wpb-js-composer .vc_tta-tabs:not([class*="vc_tta-gap"]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top.vc_tta-style-outline .vc_tta-tab.vc_active,
           .wpb-js-composer .vc_tta-tabs:not([class*="vc_tta-gap"]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-left.vc_tta-style-outline .vc_tta-tab.vc_active,
           .autoshowroom-sidebar aside.widget .tagcloud a:hover,
           .tz-header .tz-header-cart .widget_shopping_cart
           {
              border-color: ' . esc_attr($autoshowroom_general_color) . ';
           }
            ';


        // logo
        $autoshowroom_colorlogo = ot_get_option('autoshowroom_logoTextcolor');
        if (isset($autoshowroom_colorlogo) && !empty($autoshowroom_colorlogo)) {
            $autoshowroom_styles .= '.tz_logo .tz-logo-text{ color: ' . $autoshowroom_colorlogo . ' }';
        }

        //  Font Options
        // method body font
        $autoshowroom_body_font_type = ot_get_option('autoshowroom_TZFontType', 'TzFontSquirrel');
        $autoshowroom_body_font_weight = ot_get_option('autoshowroom_TzFontFami', '300,400,400italic,600,700');
        $autoshowroom_body_font_family = ot_get_option('autoshowroom_TzFontFaminy');
        $autoshowroom_body_font_selecter = ot_get_option('autoshowroom_TzBodySelecter');
        $autoshowroom_body_font_default = ot_get_option('autoshowroom_TzFontDefault', '');
        if ($autoshowroom_body_font_family) {
            $autoshowroom_body_font_family_url = 'https://fonts.googleapis.com/css?family=' . $autoshowroom_body_font_family;
            if ($autoshowroom_body_font_weight) {
                $autoshowroom_body_font_family_url = 'https://fonts.googleapis.com/css?family=' . $autoshowroom_body_font_family . ':' . $autoshowroom_body_font_weight;
            }
            wp_enqueue_style('body-fontfamily', $autoshowroom_body_font_family_url, false);
        }

        switch ($autoshowroom_body_font_type) {
            case'Tzgoogle':
                $autoshowroom_body_font = $autoshowroom_body_font_family;
                break;
            default:
                $autoshowroom_body_font = $autoshowroom_body_font_default;
                break;

        }

//            if ( isset ( $autoshowroom_body_font_weight ) && $autoshowroom_body_font_weight != ""){ wp_enqueue_style( 'autoshowroom-body-font', autoshowroom_slug_fonts_url($autoshowroom_body_font_family,$autoshowroom_body_font_weight), array(), null ); }
        if (!empty($autoshowroom_body_font)) {
            $autoshowroom_styles .= 'body, body a, body p{
                font-family:"' . esc_attr($autoshowroom_body_font) . '" !important;
                }';
        }
        if (!empty($autoshowroom_body_font_selecter) && !empty($autoshowroom_body_font_selecter)) {

            if (!empty($autoshowroom_body_font) && !empty($autoshowroom_body_font)) {
                $autoshowroom_styles .= '' . esc_attr($autoshowroom_body_font_selecter) . '{
                        font-family:"' . esc_attr($autoshowroom_body_font) . '" !important;}';
            }

        }

        // Method header font

        $autoshowroom_header_font_type = ot_get_option('autoshowroom_TZFontTypeHead', 'TzFontDefault');               // type font google or defaul
        $autoshowroom_header_font_weight = ot_get_option('autoshowroom_TzFontHeadGoodurl', '300,400,400italic,600,700');                            //  url google font
        $autoshowroom_header_font_family = ot_get_option('autoshowroom_TzFontFaminyHead');                             //  font family google       //  font squireel
        $autoshowroom_header_font_selecter = ot_get_option('autoshowroom_TzHeadSelecter');                               //  body selecter
        $autoshowroom_header_font_default = ot_get_option('autoshowroom_TzFontHeadDefault', 'Arial');                     //  font standard
        if ($autoshowroom_header_font_family) {
            $autoshowroom_header_font_family_url = 'https://fonts.googleapis.com/css?family=' . $autoshowroom_header_font_family;
            if ($autoshowroom_header_font_weight) {
                $autoshowroom_header_font_family_url = 'https://fonts.googleapis.com/css?family=' . $autoshowroom_header_font_family . ':' . $autoshowroom_header_font_weight;
            }
            wp_enqueue_style('header-fontfamily', $autoshowroom_header_font_family_url, false);
        }
        switch ($autoshowroom_header_font_type) {
            case'Tzgoogle':
                $autoshowroom_header_font = $autoshowroom_header_font_family;
                break;
            default:
                $autoshowroom_header_font = $autoshowroom_header_font_default;
                break;
        }
        if (!empty($autoshowroom_header_font)) {
            $autoshowroom_styles .= 'body h1, body h2, body h3, body h4, body h5, body h6, body h1 a, body h2 a, body h3 a, body h4 a, body h5 a, body h6 a{
                font-family:"' . esc_attr($autoshowroom_header_font) . '" !important;
                }';
        }

        if (!empty($autoshowroom_header_font_selecter) && !empty($autoshowroom_header_font_selecter)) {

            if (!empty($autoshowroom_header_font) && !empty($autoshowroom_header_font)) {
                $autoshowroom_styles .= '' . esc_attr($autoshowroom_header_font_selecter) . '{
                        font-family:"' . esc_attr($autoshowroom_header_font) . '" !important;}';
            }

        }

        // Method Menu font

        $autoshowroom_menu_font_type = ot_get_option('autoshowroom_TZFontTypeMenu', 'TzFontDefault');
        $autoshowroom_menu_font_weight = ot_get_option('autoshowroom_TzFontMenuGoodurl', '300,400,400italic,600,700');
        $autoshowroom_menu_font_family = ot_get_option('autoshowroom_TzFontFaminyMenu');
        $autoshowroom_menu_font_selecter = ot_get_option('autoshowroom_TzMenuSelecter');
        $autoshowroom_menu_font_default = ot_get_option('autoshowroom_TzFontMenuDefault', 'Arial');

        if ($autoshowroom_menu_font_family) {
            $autoshowroom_menu_font_family_url = 'https://fonts.googleapis.com/css?family=' . $autoshowroom_menu_font_family;
            if ($autoshowroom_menu_font_weight) {
                $autoshowroom_menu_font_family_url = 'https://fonts.googleapis.com/css?family=' . $autoshowroom_menu_font_family . ':' . $autoshowroom_menu_font_weight;
            }
            wp_enqueue_style('menu-fontfamily', $autoshowroom_menu_font_family_url, false);
        }

        switch ($autoshowroom_menu_font_type) {
            case'Tzgoogle':
                $autoshowroom_menu_font = $autoshowroom_menu_font_family;
                break;
            default:
                $autoshowroom_menu_font = $autoshowroom_menu_font_default;
                break;

        }

        if (!empty($autoshowroom_menu_font_selecter) && !empty($autoshowroom_menu_font_selecter)) {

            if (!empty($autoshowroom_menu_font) && !empty($autoshowroom_menu_font)) {
                $autoshowroom_styles .= '' . esc_attr($autoshowroom_menu_font_selecter) . '{
                        font-family:"' . esc_attr($autoshowroom_menu_font) . '" !important;}';
            }

        }


        // Method Custom font
        $autoshowroom_custom_font_type = ot_get_option('autoshowroom_TZFontTypeCustom', 'TzFontDefault');
        $autoshowroom_custom_font_weight = ot_get_option('autoshowroom_TzFontCustomGoodurl', '300,400,400italic,600,700');
        $autoshowroom_custom_font_family = ot_get_option('autoshowroom_TzFontFaminyCustom');
        $autoshowroom_custom_font_selecter = ot_get_option('autoshowroom_TzCustomSelecter');
        $autoshowroom_custom_font_default = ot_get_option('autoshowroom_TzFontCustomDefault', 'Arial');

        switch ($autoshowroom_custom_font_type) {
            case'Tzgoogle':
                $autoshowroom_custom_font = $autoshowroom_custom_font_family;
                break;
            default:
                $autoshowroom_custom_font = $autoshowroom_custom_font_default;
                break;

        }

        if (!empty($autoshowroom_custom_font_selecter) && !empty($autoshowroom_custom_font_selecter)) {

            if (!empty($autoshowroom_custom_font) && !empty($autoshowroom_custom_font)) {
                $autoshowroom_styles .= '' . esc_attr($autoshowroom_custom_font_selecter) . '{
                        font-family:"' . esc_attr($autoshowroom_custom_font) . '" !important;}';
            }

        }
        // add Custom css
        $autoshowroom_customcss = ot_get_option('autoshowroom_TzCustomCss', '');
        if (isset($autoshowroom_customcss) && !empty($autoshowroom_customcss)) {
            $autoshowroom_styles .= esc_attr($autoshowroom_customcss);
        }

        //Background footer
        $autoshowroom_background_footer = ot_get_option('autoshowroom_background_image');
        $autoshowroom_type_footer = ot_get_option('autoshowroom_footer_type', 'type1');
        if ($autoshowroom_type_footer != 'type4' && $autoshowroom_background_footer != '' && $autoshowroom_type_footer != 'type5') {
            $autoshowroom_styles .= '.autoshowroom-footer .autoshowroom-footer-top {background-image:url(' . esc_attr($autoshowroom_background_footer) . ');background-position: center top;background-repeat: no-repeat;background-size: cover;}';
        } else {
            $autoshowroom_styles .= '.autoshowroom-footer-service:after {background-image:url(' . esc_attr($autoshowroom_background_footer) . ');background-attachment: fixed;background-repeat: no-repeat;background-size: cover;background-position:0 88px;content: "";position: absolute;width: 100%; height: 100%;z-index: 0;filter: blur(2px); -webkit-filter:blur(2px);top: 0;}';
        }
        ?>

        <?php
        if (!function_exists('has_site_icon') || !has_site_icon()) {
            if (ot_get_option('autoshowroom_favicon_onoff', 'no') == 'yes') {
                $autoshowroom_favicon = ot_get_option('autoshowroom_favicon');
                if ($autoshowroom_favicon) {
                    echo balanceTags('<link rel="shortcut icon" href="' . $autoshowroom_favicon . '" type="image/x-icon" />');
                }
            }
        }
        ?>

        <?php
        $autoshowroom_styles .= "</style>";
        echo balanceTags($autoshowroom_styles);
    }

endif

?>