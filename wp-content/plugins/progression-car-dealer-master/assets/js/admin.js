//var car_dealer = {};

(function ($) {
	"use strict";
	$(function () {

		$('#acf-vehicle_type .acf-taxonomy-field select').change(function(){
			var typeName = $(this).find('option:selected').attr( 'data-type' );

			$('#acf-make .acf-taxonomy-field option')
			// first, disable all options
			.attr('disabled','disabled')
			// activate the corresponding models
                .filter( function(index){
                    if($(this).attr('data-type')){
                        var car_type = $(this).attr('data-type');
                    }else{
                        var car_type = '';
                    }
                    return ($(this).val()==-1 || car_type.indexOf(''+typeName+'') != -1)
                }).removeAttr( 'disabled' );
		});

		$('#acf-make .acf-taxonomy-field select').change(function(){
			var makeName = $(this).find('option:selected').attr( 'data-make' );

			$('#acf-model .acf-taxonomy-field option')
			// first, disable all options
			.attr('disabled','disabled')
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

		$('.relationship_list').bind('DOMSubtreeModified', function(){
			var ids = $('.relationship_right a').map(function(){return $(this).attr("data-post_id");}).get();

			if ( ids.length ) {
				$('#featured_vehicles').text( '[featured_vehicles ids="'+ ids.join(',') +'"]' );
			} else {
				$('#featured_vehicles').text( '[featured_vehicles]' );
			}
		});

		$('.quote-delete').on('click', function(){
            if (confirm('Are you sure you want to delete?')) {
                var quote_id = $(this).attr('data-id');
                jQuery.ajax({
                    url: vehicle_quote_ajax.url,
                    type: 'POST',
                    data: ({
                        action: 'tz_vehicle_quote_delete',
                        quoteID: quote_id
                    }),
                    success: function(data){
                        if (data){
                            location.reload();
                        }
                    }
                });
            } else {
                // Do nothing!
            }

		})
		$('.quotes_status').on('change', function(){
            if (confirm('Are you sure you want to change?')) {
                var quote_id = $(this).attr('data-id');
                var quotes_status = $(this).val();
                jQuery.ajax({
                    url: vehicle_quote_ajax.url,
                    type: 'POST',
                    data: ({
                        action: 'tz_vehicle_quote_status',
                        quoteID: quote_id,
                        quotes_status:quotes_status
                    }),
                    success: function(data){
                        if (data){
                            location.reload();
                        }
                    }
                });
            } else {
                // Do nothing!
            }
		});
		$('#acf-vehicle_status input').each(function(){
		    if($(this).is(':checked')==true){
		        if($(this).val()=='rent'){
                    $('#acf-pricerental,#acf-time_rental').addClass('active');
                }
            }
        });
        $('#acf-vehicle_status input').on('change',function(){
            if($(this).val()=='rent'){
                $('#acf-pricerental,#acf-time_rental').addClass('active');
            }else{
                $('#acf-pricerental,#acf-time_rental').removeClass('active');
            }
        })

	});
}(jQuery));