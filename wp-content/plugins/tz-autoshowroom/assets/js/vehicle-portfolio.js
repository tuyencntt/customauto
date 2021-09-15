var $container          =   jQuery('.TZ-Vehicle-content'),
    autoshowroom_resizeTimer    = null;
/*
 * Method resize image
 */

/*
 * Method portfolio column
 * @variables tzDesktop
 * @variables tztabletportrait
 * @variables tzmobilelandscape
 * @variables tzmobileportrait
 */
if ( typeof  tzDesktop == 'undefined') {
    var tzDesktop = 4
}
if ( typeof  tztabletportrait == 'undefined') {
    var tztabletportrait = 2
}
if ( typeof  tzmobilelandscape == 'undefined') {
    var tzmobilelandscape = 2
}
if ( typeof  tzmobileportrait == 'undefined') {
    var tzmobileportrait = 1
}


/*
 * Method create tags
 * @variables $filter_status
 */

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
    var $grid = jQuery('.TZ-Vehicle-content').masonry({
        itemSelector: '.TZ-PortfolioGrid-Item',
        percentPosition: true,
        columnWidth: newColWidth,
        containerStyle: null
    });
    $grid.imagesLoaded().progress( function() {
        $grid.masonry();
    });
    var msnry = new Masonry( '.TZ-Vehicle-content', {
        columnWidth: newColWidth,
        itemSelector: '.TZ-PortfolioGrid-Item'
    });

}
jQuery(window).on('load resize', function() {
    if (autoshowroom_resizeTimer) clearTimeout(autoshowroom_resizeTimer);
    autoshowroom_resizeTimer = setTimeout("autoshowroom_portfolio_init(tzDesktop, tztabletportrait, tzmobilelandscape, tzmobileportrait)", 100);
});