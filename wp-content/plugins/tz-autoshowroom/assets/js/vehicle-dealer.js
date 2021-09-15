'use strict';
function autoshowroom_portfolio_init(tzDesktop , tztabletportrait, tzmobilelandscape, tzmobileportrait){
    var contentWidth    = jQuery('.TZ-Vehicle-content').width();
    var numberItem      = 3;
    var newColWidth     = 0;
    var widthWindwow = jQuery(window).width();
    if (widthWindwow >= 992) {
        numberItem = tzDesktop;
    } else if (  widthWindwow >= 768) {
        numberItem = tztabletportrait ;
    } else if (  widthWindwow >= 550) {
        numberItem = tzmobilelandscape ;
    } else if (widthWindwow < 550) {
        numberItem = tzmobileportrait ;
    }
    newColWidth = Math.floor(contentWidth / numberItem);
    jQuery('.TZ-PortfolioGrid-Item').width(newColWidth);

    var $grid = jQuery('.TZ-Vehicle-content').imagesLoaded( function() {
        $grid.masonry({
            itemSelector: '.TZ-PortfolioGrid-Item',
            percentPosition: true,
            columnWidth: newColWidth,
            containerStyle: null
        });
    });
}