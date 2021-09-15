<?php

function autoshowroom_taxonomy_vehicle( $atts )
{
    $autoshowroom_vehicle_title
      = $autoshowroom_tax_style
    = $autoshowroom_vehicle_link_text
    = $autoshowroom_vehicle_link_url
    = $autoshowroom_vehicle_type
    = $autoshowroom_vehicle_number
    = $autoshowroom_vehicle_image
    = $autoshowroom_vehicle_empty
    = $autoshowroom_vehicle_limit
    = $autoshowroom_vehicle_tax_excludes
    = $autoshowroom_vehicle_layout ='';
    extract(shortcode_atts(array(
        'autoshowroom_vehicle_title'            =>  '',
        'autoshowroom_tax_style'                =>  'style1',
        'autoshowroom_vehicle_link_text'        =>  '',
        'autoshowroom_vehicle_link_url'         =>  '',
        'autoshowroom_vehicle_type'             =>  'make',
        'autoshowroom_vehicle_number'           =>  'show',
        'autoshowroom_vehicle_image'            =>  'show',
        'autoshowroom_vehicle_empty'            =>  'show',
        'autoshowroom_vehicle_limit'            =>  '',
        'autoshowroom_vehicle_layout'           =>  'inline',
        'autoshowroom_vehicle_tax_excludes'           =>  '',
    ), $atts));
    ob_start();
    if($autoshowroom_vehicle_tax_excludes){
       $exclude_tax = explode(',',$autoshowroom_vehicle_tax_excludes);
    }else{
        $exclude_tax =array();
    }
    if($autoshowroom_vehicle_empty == 'show'){
        $terms = get_terms( array(
            'taxonomy'      => $autoshowroom_vehicle_type,
            'limit'         => $autoshowroom_vehicle_limit,
            'hide_empty'    => false,
            'exclude'       =>$exclude_tax
        ) );
    }else{
        $terms = get_terms( array(
            'taxonomy'      => $autoshowroom_vehicle_type,
            'limit'         => $autoshowroom_vehicle_limit,
            'hide_empty'    => true,
            'exclude'       =>$exclude_tax
        ) );
    }

    ?>
    <div class="car-taxonomy car-taxonomy <?php echo esc_attr($autoshowroom_vehicle_layout);?> <?php echo esc_attr($autoshowroom_tax_style); ?> <?php echo esc_attr($autoshowroom_vehicle_type); ?>">
    <?php if($autoshowroom_vehicle_title){ ?>
        <h3 class="car-taxonomy-title"><?php echo esc_attr($autoshowroom_vehicle_title);?></h3>
    <?php } ?>
        <?php if($autoshowroom_vehicle_link_text){ ?>
        <a class="car-taxonomy-link" href="<?php echo esc_url($autoshowroom_vehicle_link_url);?>"><?php echo esc_attr($autoshowroom_vehicle_link_text);?></a>
    <?php } ?>
    <?php
    if($terms){
        ?>
        <div class="make-container">
        <?php
        foreach ($terms as $term){ ?>
            <div class="make-item">
                <?php if($autoshowroom_vehicle_image == 'show'){
                    if(car_dealer_taxonomy_image_url($term->term_id)){ ?>
                        <img src="<?php echo esc_url(car_dealer_taxonomy_image_url($term->term_id));?>" title="<?php echo esc_attr($term->name);?>"/>
                     <?php
                    } else {
                        ?>
                        <img src="<?php echo PLUGIN_PATH."/assets/images/no_image.png" ?>" alt="" />
                        <?php
                    }
                 } ?>
                <a href="<?php echo esc_url(get_term_link( $term->term_id ));?>"><?php echo esc_attr($term->name);?>
                    <?php
                    if($autoshowroom_vehicle_number=='show'){
                        ?>
                        <span>(<?php echo $term->count;?>)</span>
                        <?php
                    }
                    ?>
                </a>
            </div>
        <?php
        }
        ?>
        <div class="clr"></div>
        </div>
    <?php
    }
    ?>
    </div>
    <?php
    $autoshowroom_feature_vehicle = ob_get_contents();
    ob_end_clean();
    return $autoshowroom_feature_vehicle;
}
add_shortcode('autoshowroom-taxonomy-vehicle', 'autoshowroom_taxonomy_vehicle');
?>