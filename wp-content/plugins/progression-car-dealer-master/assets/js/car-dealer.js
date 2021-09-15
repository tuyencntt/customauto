var car_dealer = {};

(function ($) {
    /*
     * Cleans the form URL from empty parameters on submit
     */
    $('.vehicle-search-form').submit( function() {
        $(this).find( "input[type='number']" ).filter(function(){
            return ($(this).attr( 'min' ) == $(this).attr( 'value' ) || $(this).attr( 'max' ) == $(this).attr( 'value' ));
        }).attr( 'disabled', 'disabled' );

        $(this).find( "input[type='search']" ).filter(function(){
            return ! $(this).val();
        }).attr( 'disabled', 'disabled' );

        $(this).find( "select" ).filter(function(){
            return ! ( $(this).val() && $(this).val() != '-1');
        }).attr( 'disabled', 'disabled' );


    });

    /*
     * Disables all models that do not fit the selected make
     */
    $('.car_dealer_field_vehicle_type').each(function(){
       $(this).on('change',function(){
           var makeName = $(this).find( 'option:selected' ).attr( 'data-type' );
           $(this).parents('.vehicle-search-form').find('.car_dealer_field_make option')
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

           $(this).parents('.vehicle-search-form').find('.car_dealer_field_model option')
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