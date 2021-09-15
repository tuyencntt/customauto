jQuery(document).ready(function() {
    "use strict";
    // Blog slider  -----------------
    jQuery(".autoshowroom-owlcarousel").each(function() {
        var $items = jQuery(this).parents('.autoshowroom-owl-carousel-container').data('items');
        jQuery(this).autoshowroom_owlCarousel({
            loop: false,
            center: false,
            margin: 30,
            responsiveClass:true,
            autoplay: false,
            dots: false,
            responsive:{
            0:{
                items:1
            },
            600:{
                items:2,
                nav:false
            },
            768:{
                items:3,
                nav:false
            },
            992:{
                items:4,
                nav:false
            },
            1200:{
                items: $items,
                nav: false
            }
        }
        })
    });
});

jQuery(window).load(function(){
    "use strict";

    // height excerpt
    var $opject = jQuery('.autoshowroom-owlcarousel .owl-item');
    var $array_li = [];
    jQuery($opject).parent().parent().parent().find('.owl-item').each(function(){

        $array_li.push(jQuery(this).innerHeight());
    });
    var $max_height = Math.max.apply( Math, $array_li);

    jQuery($opject).css('height',$max_height+'px');
});
