jQuery(document).ready(function () {
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    jQuery('.tz_select').on('click', function () {
        jQuery('.tz_loaction__drop').slideToggle("slow");
    });

    jQuery('.books_rental').on('click', function () {
        var cus_pickupd = jQuery('.customer_start-date').val(),
            cus_dropoffd = jQuery('.customer_end-date').val(),
            cus_pickupl = jQuery('.customer_pickup__location').val(),
            cus_dropoffl = jQuery('.customer_dropoff__location').val();
        jQuery('.tz_customer_start-date').text(cus_pickupd);
        jQuery('.tz_customer_end-date').text(cus_dropoffd);
        jQuery('.tz_customer_location').text(cus_pickupl);
        jQuery('input.pick_up_time').val(cus_pickupd);
        jQuery('input.drop_off_time').val(cus_dropoffd);
        jQuery('input.pick_up_location').val(cus_pickupl);
        jQuery('input.drop_off_location').val(cus_dropoffl);
        var has_active = jQuery(this).hasClass('selected');

        if (( cus_pickupd !== '') && ( cus_dropoffd !== '')  ) {
            var form_show = jQuery('.tz_booking__boxform');
            jQuery(form_show).show("slow");
        }
        var form_hide = jQuery('.tz-close-form-booking');
        jQuery(form_hide).on('click', function () {
            jQuery(form_show).hide("slow");
        });

        if (cus_dropoffl === '') {
            jQuery('.tz_hide').hide();
        } else {
            jQuery('.tz_customer_droplocation').text(cus_dropoffl);
        }
    });
});