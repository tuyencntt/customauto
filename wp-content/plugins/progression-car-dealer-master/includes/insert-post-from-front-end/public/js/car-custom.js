var car_dealer = {};

(function ($) {
    /*
     * Cleans the form URL from empty parameters on submit
     */


    $('.img_delete').on('click',function(){
        var CarID = $(this).parent().attr('data-id');
        jQuery.ajax({
            url: vehicle_compare_ajax.url,
            type: 'POST',
            data: ({
                action: 'tz_autoshowroom_remove_thumbnail',
                CarID: CarID
            }),
            success: function(data){
                if (data){
                    $('.img_pre').empty().append('<span>Deleted</span>');
                }
            }
        });
    });

    $('.delete_img_gallery').on('click',function(){
        var imageID = $(this).parent().attr('data-id');
        jQuery.ajax({
            url: vehicle_compare_ajax.url,
            type: 'POST',
            data: ({
                action: 'tz_autoshowroom_remove_image_gallery',
                imageID: imageID
            }),
            success: function(data){
                if (data){
                    $('.img_pre').empty();
                    $('.img_pre').append(data);
                }
            }
        });
    });
    $('.dealer_delete_vehicle').on('click',function(){
        var CarID = $(this).attr('data-id');
        var isGood=confirm('Do you want to remove this car?');
        if (isGood) {
            $(this).parent().parent().addClass('car_hide');
            jQuery.ajax({
                url: vehicle_compare_ajax.url,
                type: 'POST',
                data: ({
                    action: 'tz_autoshowroom_remove_car',
                    CarID: CarID
                }),
                success: function(data){
                }
            });
        } else {

        }

    });
    $('.car_dealer_field_vehicle_type').each(function(){
        $(this).on('change',function(){
            var makeName = $(this).find( 'option:selected' ).attr( 'data-type' );
            $(this).parents('.vehicle-new-form').find('.car_dealer_field_make option')
                // first, disable all options
                .attr( 'disabled', 'disabled' )
                // activate the corresponding models
                .filter( function(index){
                    if($(this).attr('data-type')){
                        var car_type = $(this).attr('data-type');
                    }else{
                        var car_type = '';
                    }
                    return ($(this).val()==-1 || car_type.indexOf(''+makeName+'') != -1)
                }).removeAttr( 'disabled' );
        });
    });
    $('.car_dealer_field_make').each(function(){
        $(this).on('change',function(){
            var makeName = $(this).find( 'option:selected' ).attr( 'data-make' );

            $(this).parents('.vehicle-new-form').find('.car_dealer_field_model option')
                // first, disable all options
                .attr( 'disabled', 'disabled' )
                // activate the corresponding models
                .filter( function(index){
                    if($(this).attr('data-make')){
                        var car_type = $(this).attr('data-make');
                    }else{
                        var car_type = '';
                    }
                    return ($(this).val()==-1 || car_type.indexOf(''+makeName+'') != -1)
                }).removeAttr( 'disabled' );
        });
    });

}(jQuery));