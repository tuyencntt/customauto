
var $grid = jQuery('.TZ-Vehicle-content').imagesLoaded( function() {
    $grid.masonry({
        itemSelector: '.TZ-PortfolioGrid-Item',
        percentPosition: true,
        columnWidth: 380,
        containerStyle: null
    });
});
jQuery('.autoshowroom-make').on('click',function(){
    var has_active = jQuery(this).hasClass('selected');
    if(has_active ==false){
    jQuery(this).parent().find('a').removeClass('selected');
    jQuery(this).addClass('selected');
    jQuery('.TZ-PortfolioGrid-Item').fadeOut(500);
    jQuery('.auto-loading').addClass('auto-loading-active');
    var makeid =jQuery(this).attr('data-option-id');
    var limit =jQuery(this).attr('data-option-limit');
    var data_order =jQuery(this).attr('data-option-order');
    var data_orderby =jQuery(this).attr('data-option-orderby');
    var data_sold  =jQuery(this).attr('data-option-sold');
    var show_nav  =jQuery(this).attr('data-option-nav');
    var specs = jQuery(this).attr('data-option-specs');

    jQuery.ajax({
       url: vehicle_compare_ajax.url,
        type: 'POST',
        data: ({
            action: 'tz_autoshowroom_portfolio_ajax',
            makeID: makeid,
            limit: limit,
            order: data_order,
            orderBy: data_orderby,
            sold: data_sold,
            shownav: show_nav,
            specs: specs,
        }),
        success: function(data){
            if (data){
                jQuery('.TZ-Vehicle-content').empty();
                $grid.masonry('destroy');
                jQuery('.TZ-Vehicle-content').append(data);
            }
            jQuery('.auto-loading').removeClass('auto-loading-active');
            var newColWidth = 380;
            jQuery('.TZ-PortfolioGrid-Item').width(newColWidth);
            var container = document.querySelector('.TZ-Vehicle-content');
            var msnry = new Masonry( container, {
                itemSelector: '.TZ-PortfolioGrid-Item',
                percentPosition: true,
                columnWidth: newColWidth
            });
            autoshowroom_portfolio_init(tzDesktop , tztabletportrait, tzmobilelandscape, tzmobileportrait);
        }
    });
    }

});