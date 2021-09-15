<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function tel_countdown_view( $atts) {

    $tel_countdown_year                =
    $tel_countdown_month               =
    $tel_countdown_day                 =
    $tel_countdown_hour                =
    $tel_countdown_minute              =
    $tel_countdown_second              =
    $css_animation                     =  "";


    extract( shortcode_atts(array(

        'tel_countdown_year'               =>     '2020',
        'tel_countdown_month'              =>     'Jan',
        'tel_countdown_day'                =>     '1',
        'tel_countdown_hour'               =>     '1',
        'tel_countdown_minute'             =>     '1',
        'tel_countdown_second'             =>     '1',
        'tel_countdown_id'                 =>     '',
        'tel_countdown_style '             =>     '',
        'tel_countdown_class'              =>     '',
        'css_animation'                    =>     '',

    ), $atts) );
    ob_start();
    ?>

    <div class="tel_countdown">
        <div class="container">
        <div id="tel-countdown__timer"></div>
        </div>
        <script>
            // Set the date we're counting down to
            var countDownDate = new Date("<?php  echo esc_attr($tel_countdown_month); ?> <?php echo esc_attr($tel_countdown_day); ?>, <?php echo esc_attr($tel_countdown_year); ?> <?php echo esc_attr($tel_countdown_hour); ?>:<?php echo esc_attr($tel_countdown_minute); ?>:<?php echo esc_attr($tel_countdown_second); ?>").getTime();
            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get todays date and time
               var now = new Date().getTime();
                // Find the distance between now an the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));

                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                document.getElementById("tel-countdown__timer").innerHTML =
                    '<div class="tel-countdown__item">'
                    + days + '<span class="tel-countdown__day"><?php echo esc_html('days','tz-autoshowroom');?></span>' + '</div>' +
                    '<div class="tel-countdown__item">'
                    + hours + '<span class="tel-countdown__hour"><?php echo esc_html('hours','tz-autoshowroom');?></span>' + '</div>' +
                    '<div class="tel-countdown__item">'
                    + minutes + '<span class="tel-countdown__minute"><?php echo esc_html('minutes','tz-autoshowroom');?></span>' + '</div>' +
                    '<div class="tel-countdown__item">'
                    + seconds + '<span class="tel-countdown__second"><?php echo esc_html('seconds','tz-autoshowroom');?></span>' + '<div/>'
                ;

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("tel-countdown__timer").innerHTML = "EXPIRED";
                }
            }, 1000);

        </script>

    </div>

    <?php

    return ob_get_clean();

}

add_shortcode('tel_countdown','tel_countdown_view' );

?>