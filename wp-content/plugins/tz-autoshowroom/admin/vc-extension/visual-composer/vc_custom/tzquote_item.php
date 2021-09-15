<?php

$args = array(
    "autoshowroom_quote_item_type" => "",
    "autoshowroom_author" => "",
    "autoshowroom_name" => "",
    "autoshowroom_employment" => "",
);
global $autoshowroom_quote_type;
extract(shortcode_atts($args, $atts));

$autoshowroom_img_id = preg_replace('/[^\d]/', '', $autoshowroom_author);
$autoshowroom_width_img = '';
$autoshowroom_height_img = '';
$autoshowroom_images_info = wp_get_attachment_image_src($autoshowroom_img_id, $size = 'medium');

$image_class = '';
if (isset($autoshowroom_images_info) && !empty($autoshowroom_images_info)) {
    $autoshowroom_url_img = $autoshowroom_images_info[0];
    $autoshowroom_width_img = $autoshowroom_images_info[1];
    $autoshowroom_height_img = $autoshowroom_images_info[2];
} else {
    $image_class = 'no_image';
}
?>
<?php if ($autoshowroom_quote_type == 'type1' || $autoshowroom_quote_type == 'type2') { ?>
    <div class="autoshowroom-quote-item <?php echo esc_attr($image_class); ?>">
        <?php if ($autoshowroom_quote_type == 'type2' && $autoshowroom_quote_type != '') { ?>
            <div class="autoshowroom-quote-info">
                <p class="autoshowroom-quote-content">
                    <small>&ldquo;</small><?php echo balanceTags($content); ?></p>
                <span class="autoshowroom-quote-name"><?php echo esc_html($autoshowroom_name); ?></span>
                <?php
                if ($autoshowroom_name != '' && $autoshowroom_employment != '') {
                    ?>
                    <small>-</small>
                    <?php
                }
                ?>

                <span class="autoshowroom-quote-employment"><?php echo esc_html($autoshowroom_employment); ?></span>
            </div>
        <?php } ?>
        <?php if (isset($autoshowroom_images_info) && !empty($autoshowroom_images_info)) { ?>
            <div class="autoshowroom-quote-image">
                <div class="autoshowroom-quote-image-box">
                    <img width="<?php echo esc_attr($autoshowroom_width_img); ?>"
                         height="<?php echo esc_attr($autoshowroom_height_img); ?>"
                         alt="<?php echo esc_attr($autoshowroom_name); ?>"
                         src="<?php echo esc_url($autoshowroom_url_img); ?>">
                </div>
            </div>
        <?php } ?>
        <?php if ($autoshowroom_quote_type == 'type1' && $autoshowroom_quote_type != '') { ?>
            <div class="autoshowroom-quote-info">
                <p class="autoshowroom-quote-content">
                    <small>&ldquo;</small><?php echo balanceTags($content); ?></p>
                <span class="autoshowroom-quote-name"><?php echo esc_html($autoshowroom_name); ?></span>
                <?php
                if ($autoshowroom_name != '' && $autoshowroom_employment != '') {
                    ?>
                    <small>-</small>
                    <?php
                }
                ?>

                <span class="autoshowroom-quote-employment"><?php echo esc_html($autoshowroom_employment); ?></span>
            </div>
        <?php } ?>

    </div>
<?php } ?>
<?php if ($autoshowroom_quote_type == 'type3' || $autoshowroom_quote_type == 'type4') { ?>
    <div class="autoshowroom-quote-item <?php echo esc_attr($image_class); ?>">
        <div class="autoshowroom-quote-info">
            <?php if ($autoshowroom_quote_type == 'type3') { ?>
                <p class="autoshowroom-quote-content">
                    <small>&ldquo;</small><?php echo balanceTags($content); ?>
                    <small>&ldquo;</small>
                </p>
            <?php } else { ?>
                <img src="<?php echo get_template_directory_uri() . '/images/quote_service.png' ?>" alt="No image"/>
                <div class="autoshowroom-quote-content">
                    <?php echo balanceTags($content); ?>
                </div>
            <?php } ?>
            <div class="autoshowroom-image-employment">
                <?php if (isset($autoshowroom_images_info) && !empty($autoshowroom_images_info)) { ?>
                    <div class="autoshowroom-quote-image">
                        <div class="autoshowroom-quote-image-box">
                            <img width="<?php echo esc_attr($autoshowroom_width_img); ?>"
                                 height="<?php echo esc_attr($autoshowroom_height_img); ?>"
                                 alt="<?php echo esc_attr($autoshowroom_name); ?>"
                                 src="<?php echo esc_url($autoshowroom_url_img); ?>">
                        </div>
                    </div>
                <?php } ?>
                <div class="autoshowroom-name-employment">
                    <h3 class="autoshowroom-quote-name"><?php echo esc_html($autoshowroom_name); ?></h3>
                    <span class="autoshowroom-quote-employment"><?php echo esc_html($autoshowroom_employment); ?></span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($autoshowroom_quote_type == 'type5') { ?>
    <div class="autoshowroom-quote-item <?php echo esc_attr($image_class); ?>">
        <div class="autoshowroom-quote-info">
            <?php if (isset($autoshowroom_images_info) && !empty($autoshowroom_images_info)) { ?>
                <div class="autoshowroom-quote-image">
                    <div class="autoshowroom-quote-image-box">
                        <img width="<?php echo esc_attr($autoshowroom_width_img); ?>"
                             height="<?php echo esc_attr($autoshowroom_height_img); ?>"
                             alt="<?php echo esc_attr($autoshowroom_name); ?>"
                             src="<?php echo esc_url($autoshowroom_url_img); ?>">
                    </div>
                </div>
            <?php } ?>

            <div class="autoshowroom-quote-content">
                <?php echo balanceTags($content); ?>
            </div>
            <div class="autoshowroom-name-employment">
                <h3 class="autoshowroom-quote-name"><?php echo esc_html($autoshowroom_name); ?></h3>
                <span class="autoshowroom-quote-employment"><?php echo esc_html($autoshowroom_employment); ?></span>
            </div>

        </div>
    </div>
<?php } ?>
