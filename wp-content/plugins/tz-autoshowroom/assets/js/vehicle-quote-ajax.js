/**
 * Created by tuyen on 3/8/2017.
 */
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }


jQuery('.quotes_submit').on('click',function(){
    var has_active = jQuery(this).hasClass('selected');
    if(has_active ==false){
        jQuery(this).addClass('selected');
        var gcaptcha = jQuery(this).parent().find('div').hasClass('g-recaptcha');

        if(gcaptcha==true){
            var google_cap = grecaptcha.getResponse();
        }else{
            var google_cap = 'none';
        }
        var vehicle_type = jQuery('#car_dealer_field_vehicle_type').val(),
            vehicle_make = jQuery('#car_dealer_field_make').val(),
            vehicle_model = jQuery('#car_dealer_field_model').val(),
            vehicle_date = jQuery('.register').val(),
            vehicle_mileage = jQuery('.quote_mileage').val(),
            cus_name = jQuery('.customer_name').val(),
            cus_phone = jQuery('.customer_phone').val(),
            cus_email = jQuery('.customer_email').val(),
            cus_message = jQuery('.customer_message').val(),
            validate_mail = validateEmail(cus_email);
        if(validate_mail==true) {
            jQuery.ajax({
                url: vehicle_compare_ajax.url,
                type: 'POST',
                data: ({
                    action: 'vehicle_quotes_ajax_action',
                    google_cap: google_cap,
                    vehicle_type: vehicle_type,
                    vehicle_make: vehicle_make,
                    vehicle_model: vehicle_model,
                    vehicle_date: vehicle_date,
                    vehicle_mileage: vehicle_mileage,
                    cus_name: cus_name,
                    cus_phone: cus_phone,
                    cus_email: cus_email,
                    cus_message: cus_message
                }),
                success: function (data) {
                    if (data) {
                        jQuery('.error').remove();
                        jQuery('.sucess').remove();
                        jQuery('.vehicle-quote-form').append(data);
                        jQuery('.vehicle-quote-form .quotes_submit').removeClass('selected');
                        grecaptcha.reset();
                    }
                }
            });
        }else{
            alert('Please validate your email!');
            jQuery('.vehicle-quote-form .quotes_submit').removeClass('selected');
        }
    }
});
