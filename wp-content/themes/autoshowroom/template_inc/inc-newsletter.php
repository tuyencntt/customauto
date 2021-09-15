<?php if(shortcode_exists('newsletter_form')) {
    $autoshowroom_newsletter_title = ot_get_option('autoshowroom_newsletter_title','WE ARE HERE FOR YOU');
    $autoshowroom_newsletter_des = ot_get_option('autoshowroom_newsletter_des','By entering your email address, you will be kept updated about Auto Showroom.');
?>
<?php
    $autoshowroom_type_footer    =   ot_get_option('autoshowroom_footer_type','type1');
    $nameplace = __('email','autoshowroom');
    $signup = __('Sign Up','autoshowroom');
    $emailplace = __('Enter your email...','autoshowroom');
    ?>
<?php if($autoshowroom_type_footer == 'type3'){?>
        <div class="tz-newsletter3">
            <div class="container">
                <div class="row">
                    <div class="tz-newsletter-border">
                        <div class="newsletter-title col-md-6">
                            <h3 class="title">
                                <?php echo esc_html($autoshowroom_newsletter_title); ?>
                            </h3>
                            <p><?php echo esc_html($autoshowroom_newsletter_des); ?></p>

                        </div>
                        <div class="newsletter-content col-md-6">
                            <?php

                            echo do_shortcode(
                                '[newsletter_form button_label="'.$signup.'"]
                                     [newsletter_field name="email" placeholder="'.$emailplace.'"]
                                     [/newsletter_form]');
                            ?>
                        </div>
                        <div class="tz_border"></div>
                    </div>
                </div>
            </div>
        </div>
<?php }elseif($autoshowroom_type_footer == 'type1' || ($autoshowroom_type_footer == 'type2')){?>
        <div class="tz-newsletter">
                <div class="container">
                <div class="row">
                    <div class="newsletter-title col-md-12">
                        <h3 class="title">
                            <?php echo esc_html($autoshowroom_newsletter_title); ?>
                        </h3>
                        <p><?php echo esc_html($autoshowroom_newsletter_des); ?></p>

                    </div>
                    <div class="newsletter-content col-md-12">
                        <?php
                        echo do_shortcode(
                            '[newsletter_form button_label="'.$signup.'"]
                                 [newsletter_field name="email" placeholder="'.$emailplace.'"]
                                 [/newsletter_form]');

                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>