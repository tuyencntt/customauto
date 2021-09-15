<?php
/*===============================
Shortocde tz-skill-item
===============================*/

function autoshowroom_phone_number($atts, $content=null) {
    $autoshowroom_tz_phone_title = $autoshowroom_tz_phone_number = $autoshowroom_tz_phone_link = '';
    extract(shortcode_atts(array(
        'autoshowroom_tz_phone_title'           => '',
        'autoshowroom_tz_phone_number'          => '',
        'autoshowroom_tz_phone_link'            => '',

    ),$atts));
    ob_start();
    ?>

    <div class="autoshowroom-phone-number">
            <div class="autoshowroom-phone-number-item">
                <div class="autoshowroom-phone-number-item-border">
            <?php
            if($autoshowroom_tz_phone_title != ''){
                ?>
                <h2 class="autoshowroom-phone-title">
                    <?php
                    echo balanceTags($autoshowroom_tz_phone_title);
                    ?>
                </h2>
                <?php
            }
            ?>
            <?php
            if($autoshowroom_tz_phone_number && $autoshowroom_tz_phone_link){
                ?>
                <a href="tel:<?php echo balanceTags($autoshowroom_tz_phone_number);?>" class="autoshowroom-phone-number">
                    <?php
                    echo balanceTags($autoshowroom_tz_phone_number);
                    ?>
                </a>
                <?php
            }else{
            ?>
                <h3 class="autoshowroom-phone-number">
                    <?php
                    echo balanceTags($autoshowroom_tz_phone_number);
                    ?>
                </h3>
                <?php
            }
            ?>
                </div>
            </div>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('autoshowroom_phone_number','autoshowroom_phone_number');
?>
