<?php

function autoshowroom_vehicle_quote( $atts )
{
    $autoshowroom_search_title
    = $autoshowroom_quote_fields
    = $autoshowroom_button_submit
    = $autoshowroom_show_captcha
    = $autoshowroom_captcha_key ='';
    extract(shortcode_atts(array(
        'autoshowroom_search_title'              =>  'Submit for free quote',
        'autoshowroom_quote_fields'              =>  '',
        'autoshowroom_button_submit'             =>  '6LeYoTgUAAAAADMVkXB0Df1wjPb5YztQKRPaW80V',
        'autoshowroom_show_captcha'              =>  'show',
        'autoshowroom_captcha_key'               =>  '',
    ), $atts));
    ob_start();

    if($autoshowroom_show_captcha=='show'){
        wp_enqueue_script('recaptcha');
    }
    wp_enqueue_script('autoshowroom-ajax-quote');
    ?>
    <div class="autoshowroom-vehicle-quote">
        <h3 class="quote-title"><span><?php echo balanceTags($autoshowroom_search_title)?></span></h3>
        <div class="vehicle-quote-form">
            <div class="quote-box">
                <?php echo do_shortcode('[vehicle_quotes_form include="'.$autoshowroom_quote_fields.'" ]'); ?>
                <div class="mileage">
                    <label><?php echo esc_html_e('Mileage:','tz-autoshowroom'); ?></label>
                    <input type="text" class="quote_mileage" placeholder="25000"/>
                </div>
                <div class="vehicle_date">
                    <label><?php echo esc_html_e('Date:','tz-autoshowroom'); ?></label>
                    <select class="register">
                        <?php
                        $years_to_show = 10;

                        $start_year = date('Y');
                        for($offset=0; $offset<$years_to_show; $offset++)
                        {
                            $year = $start_year - $offset;
                            echo "<option value=\"{$year}\">{$year}</option>\n";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="info_customer">
                <div class="row">
                    <p class="col-md-4"><input class="customer_name" placeholder="<?php echo esc_html__('Your Name','tz-autoshowroom'); ?>"/></p>
                    <p class="col-md-4"><input class="customer_phone" placeholder="<?php echo esc_html_e('Phone','tz-autoshowroom'); ?>"/></p>
                    <p class="col-md-4"><input class="customer_email" placeholder="<?php echo esc_html__('Email','tz-autoshowroom'); ?>"/></p>
                    <p class="col-md-12"><textarea class="customer_message" placeholder="<?php echo esc_html__('Your message','tz-autoshowroom'); ?>" rows="5"></textarea></p>
                </div>
            </div>
            <?php
            if($autoshowroom_show_captcha=='show'){
                ?>
                <div class="g-recaptcha" data-sitekey="<?php echo esc_attr($autoshowroom_captcha_key); ?>"></div>
                <?php
            }
            ?>
            <button class="quotes_submit" value="Submit for free quote"><?php echo esc_html($autoshowroom_button_submit); ?></button>

        </div>
    </div>


<?php
    $autoshowroom_feature_vehicle = ob_get_contents();
    ob_end_clean();
    return $autoshowroom_feature_vehicle;
}
add_shortcode('autoshowroom-vehicle-quote', 'autoshowroom_vehicle_quote');

?>