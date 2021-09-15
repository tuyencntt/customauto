<?php
/*
 * Element tz-feature-item
 * */

function autoshowroom_theme_newletter($atts, $content=null) {
    $autoshowroom_newletter_title = $autoshowroom_newletter_description = $autoshowroom_newletter_style  = '';
    extract(shortcode_atts(array(
        'autoshowroom_newletter_title'                     => '',
        'autoshowroom_newletter_description'               => '',
        'autoshowroom_newletter_style'                 => 'style1',
    ),$atts));
    ob_start();
    $signup = __('Sign Up','autoshowroom');
    $emailplace = __('Enter your email...','autoshowroom');
    ?>
    <div class="homev6_newletter <?php echo esc_attr($autoshowroom_newletter_style); ?>">
        <div class="container">
            <?php if($autoshowroom_newletter_style == 'style1'){ ?>
            <div class="col-md-6 col-left">
                <h3><?php echo esc_html__($autoshowroom_newletter_title,'aventura-plugin') ?></h3>
                <p><?php echo esc_html__($autoshowroom_newletter_description,'aventura-plugin') ?></p>
            </div>
            <div class="col-md-6 col-right">
                <?php echo do_shortcode('[newsletter_form type="minimal" placeholder="'.$emailplace.'" button_label="'.$signup.'"]'); ?>
            </div>
            <?php }else{ ?>
            <div class="col-md-12 col-full">
                <?php echo do_shortcode('[newsletter_form button_label="'.$signup.'"][newsletter_field name="email" placeholder="'.$emailplace.'"][/newsletter_form]'); ?>
            </div>
            <?php } ?>
        </div>

    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('autoshowroom-newletter','autoshowroom_theme_newletter');
?>