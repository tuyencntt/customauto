<?php

function autoshowroom_vehicle_types( $atts )
{
    $autoshowroom_vehicle_types = $image_vehicle =  $autoshowroom_vehicle_text = '';

    extract(shortcode_atts(array(
        'autoshowroom_vehicle_types'   =>  '',
        'image_vehicle'   =>  '',
        'autoshowroom_vehicle_text'   =>  'Boat',
    ), $atts));
    $vehicle= get_term_by('id',$autoshowroom_vehicle_types, 'vehicle_type');
    if($vehicle){
        $vehicle_link = get_term_link ($vehicle,'vehicle_type');
    }else{
        $vehicle_link ='';
    }
    ob_start();
    ?>
    <div class="auto-vehicle-types">
        <div class="content-vehicle-types">
            <a href="<?php echo $vehicle_link?>" class="type_url">&nbsp;</a>
            <?php if ($image_vehicle != '') :
                echo wp_get_attachment_image($image_vehicle, 'full');
            endif;?>

           <div class="vehicle-wrapper">
               <div class="vehicle-count">
                   <?php
                    if($vehicle){
                    echo $vehicle->count . ' ' . esc_attr($autoshowroom_vehicle_text);
                   } ?>
               </div>
               <h3 class="title">
                   <a href="<?php echo $vehicle_link?>"><?php if($vehicle){ echo esc_html__($vehicle->name,'tz-autoshowroom'); }?></a>
               </h3>
           </div>

        </div>

    </div>
<?php
    return ob_get_clean();
}
add_shortcode('autoshowroom-vehicle-types', 'autoshowroom_vehicle_types');

?>