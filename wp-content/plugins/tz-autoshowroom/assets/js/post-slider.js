"use strict";
/*
 * Method resize image
 */
function aventura_resize_image(obj){
    var widthStage;
    var heightStage ;
    var widthImage;
    var heightImage;
    var width1;
    obj.each(function (i,el){

        heightStage = jQuery(this).height();
        widthStage = jQuery (this).width();

        var img_url = jQuery(this).find('img').attr('src');
        var img_resize = jQuery(this);
        var image = new Image();
        image.src = img_url;

        image.onload = function()
        {
            widthImage = this.naturalWidth;
            heightImage = this.naturalHeight;

            var tzimg	=	new resizeImage(widthImage, heightImage, widthStage, heightStage);
            img_resize.find('img').css ({ top: tzimg.top, left: tzimg.left, width: tzimg.width, height: tzimg.height });
        }

    });
}

jQuery(window).load(function(){
    jQuery('.tz_post_image').each(function () {
        aventura_resize_image(jQuery(this));
    });

});