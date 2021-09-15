/**
 * Created by Administrator on 4/12/2016.
 */
"use strict";

jQuery(window).load(function(){
    jQuery('#tzloadding').remove();
    var megamenu_icon ='fa-hand-o-right';
    jQuery('.mega-sub-menu ul.menu li.menu-item').each(function(){
        jQuery(this).prepend('<i class="fa '+megamenu_icon+'"></i>');
    });
    if(jQuery('.autoshowroom-sign-up').length){
        jQuery('.autoshowroom-sign-up').parents('.vc_row').addClass('over-hidden');
    }
    if (jQuery('.autoshowroom-blog-back').length) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = jQuery(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    jQuery('.autoshowroom-blog-back').addClass('show');
                } else {
                    jQuery('.autoshowroom-blog-back').removeClass('show');
                }
            };
        backToTop();
        jQuery(window).on('scroll', function () {
            backToTop();
        });
        jQuery('.autoshowroom-blog-back').on('click', function (e) {
            e.preventDefault();
            jQuery('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
    if (jQuery('.tzmenu_fixed').length) {
        var tzscrollTrigger = 100;
        var menu_fixed = function () {
            var tzscrollTop = jQuery(window).scrollTop();
            if (tzscrollTop > tzscrollTrigger) {
                jQuery('.tzmenu_fixed').addClass('menu_fixed');
            } else {
                jQuery('.tzmenu_fixed').removeClass('menu_fixed');
            }
        };

        jQuery(window).on('scroll', function () {
            menu_fixed();
        });
    }
    if (jQuery('.auto-backtotop').length) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = jQuery(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    jQuery('.auto-backtotop').addClass('show');
                    jQuery('.landing_menu').addClass('landing_fixed');
                } else {
                    jQuery('.auto-backtotop').removeClass('show');
                    jQuery('.landing_menu').removeClass('landing_fixed');
                }
            };
        backToTop();
        jQuery(window).on('scroll', function () {
            backToTop();
        });
        jQuery('.auto-backtotop').on('click', function (e) {
            e.preventDefault();
            jQuery('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
    function clear_form_elements(ele) {

        jQuery(ele).find(':input').each(function() {
            switch(this.type) {
                case 'password':
                case 'text':
                case 'textarea':
                    jQuery(this).val('');
                    break;

                case 'select-multiple':
                case 'select-one':
                    jQuery(this).val('-1');
                    break;
                case 'checkbox':
                case 'radio':
                    this.checked = false;
            }
        });

    }

    var searchform = jQuery('.vehicle-search-form').length;
    if(searchform ){
        clear_form_elements('.vehicle-search-form');
    }

    var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : { allow_single_deselect: true },
        '.chosen-select-no-single' : { disable_search_threshold: 10 },
        '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
        '.chosen-select-rtl'       : { rtl: true },
        '.chosen-select-width'     : { width: '95%' }
    }
    for (var selector in config) {
        jQuery(selector).chosen(config[selector]);
    }

    jQuery('.tz-vehicle-search .field-condition input').each(function () {
        var condition_default = jQuery(this).closest(".tz-vehicle-search").data('condition');
        if (condition_default != '') {
            var con_value = jQuery(this).val();
            if (con_value == condition_default) {
                jQuery(this).attr('checked', 'checked');
            }
        }
    });
    var request_title = jQuery( "div.request_vehicle_title" ).length;
    if(request_title ){
        var vehicle_title = jQuery('.vehicle-title').html();
        if(vehicle_title !=''){
            jQuery('input.form_vehicle_title').val(vehicle_title);
        }
    }
    var vehicle_url = jQuery( "div.request_url" ).length;
    if(vehicle_url ){
        var vehicle_link = jQuery('.vehicle_url').html();
        if(vehicle_link !=''){
            jQuery('input.form_vehicle_url').val(vehicle_link);
        }
    }
    if(jQuery('.svg_logo').length){
        jQuery('.svg_logo').on('click',function(){
            var homepage_url = jQuery(this).attr('data-href');
            location.href = homepage_url;
        })
    }
    if(jQuery('.request-infomation .car-detail').length){
    var vehicle_title = jQuery('.vehicle-title').text();
    jQuery('.car-detail input').val(vehicle_title).attr("disabled", "disabled");
    }
    jQuery('.landing_menu a[href^="#"]').on('click', function(event) {
        var target = jQuery(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            jQuery('html, body').stop().animate({
                scrollTop: target.offset().top - 90
            }, 1000);
        }
    });

    var $rellax_active = jQuery('.rellax');
    if ($rellax_active.length) {
        var rellax = new Rellax('.rellax', {
            speed: -2,
            wrapper: '.rellax_wrapper',
            center: true,
            relativeToWrapper: true,
        });
    }
    jQuery('#vehicle-tab a').on('click', function (e) {
        e.preventDefault();
        jQuery(this).tab('show')
    });

});
