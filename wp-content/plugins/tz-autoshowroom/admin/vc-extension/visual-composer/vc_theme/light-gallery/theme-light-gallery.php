<?php
/*
 * Element Scroll Object
 * */

function autoshowroom_light_gallery($atts) {
    $autoshowroom_gallery           =
    $autoshowroom_gallery_size      =
    $autoshowroom_gallery_radius    =
    $autoshowroom_gallery_padding   =
    $autoshowroom_gallery_columns   = '';

    extract(shortcode_atts(array(
        'autoshowroom_gallery'              => '',
        'autoshowroom_gallery_size'         => 'thumbnail',
        'autoshowroom_gallery_columns'      => '1',
        'autoshowroom_gallery_radius'       => '2',
        'autoshowroom_gallery_padding'      => '',
    ),$atts));
    ob_start();
    wp_enqueue_style('autoshowroom-lightgallery-css');
    wp_enqueue_script('autoshowroom-lightgallery');
    wp_enqueue_script('autoshowroom-mousewheel');
    $autoshowroom_images = explode( ',', $autoshowroom_gallery );
    $columns = 12/$autoshowroom_gallery_columns;
    if($autoshowroom_gallery_radius){
        if (strpos($autoshowroom_gallery_radius, 'px') !== false) {
            $radius = $autoshowroom_gallery_radius;
        }
        elseif (strpos($autoshowroom_gallery_radius, '%') !== false) {
            $radius = $autoshowroom_gallery_radius;
        } else{
            $radius =  $autoshowroom_gallery_radius.'px';
        }
    }else{
        $radius=0;
    }
    $tz_uid = uniqid();
    ?>
    <div class="autoshowroom-lightgallery ">
        <ul id="lightgallery-<?php echo $tz_uid;?>" class="row tz_lightgallery">
            <?php
    foreach ( $autoshowroom_images as $i => $image ) {
            if ( $image > 0 ) {
                $image_large = wp_get_attachment_url( $image );
                $imageurl = wp_get_attachment_image_src($image,''.$autoshowroom_gallery_size.'');
                $thumbnail = $imageurl[0];
            }
            ?>
            <li class="light-gallery-item col-xs-12 col-sm-<?php echo esc_attr($columns);?> col-md-<?php echo esc_attr($columns);?>"
                style="padding:<?php echo esc_attr($autoshowroom_gallery_padding);?>px"
                data-src="<?php echo esc_url($image_large);?>">
                <img class="light-thumb" style="border-radius:<?php echo esc_attr($radius);?>" src="<?php echo esc_url($thumbnail);?>" alt=""/>
            </li>
    <?php } ?>
        </ul>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#lightgallery-<?php echo $tz_uid;?>').each(function(){
                jQuery(this).lightGallery();
            })
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('autoshowroom-light-gallery','autoshowroom_light_gallery');
?>
