<?php

if (is_plugin_active('progression-car-dealer-master/progression-car-dealer.php')) {
    $auto_fields = array();
    $fields = get_terms([
        'taxonomy' => 'vehicle_type',
        'hide_empty' => true,
    ]);
    if (isset($fields) && !empty($fields)):
        foreach ($fields as $field):
            $auto_fields[$field->name] = $field->term_id;
        endforeach;
    endif;
}

vc_map(array(
    'name' => 'Vehicle Types',
    'base' => 'autoshowroom-vehicle-types',
    'icon' => 'tzvc_icon',
    'weight' => 1,
    'category' => 'TZ AutoShowroom',
    'params' => array(
        array(
            "type" => "attach_image",
            "class" => "",
            "heading" => esc_html__( "Image Vehicle", "tz-autoshowroom" ),
            "param_name" => "image_vehicle",
            "value" => esc_html__( "", "tz-autoshowroom" ),
        ),
        array(
            'type' => 'dropdown',
            'holder' => '',
            'admin_label' => false,
            'heading' => esc_html__('Choose Vehicle Type', 'tz-autoshowroom'),
            'param_name' => 'autoshowroom_vehicle_types',
            'value' => $auto_fields,
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  esc_html__('Vehicle text','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_vehicle_text',
            'value'         =>  ''
        ),
//        array(
//            'type'        => 'textfield',
//            'param_name'  => 'el_class',
//            'heading'     => esc_html__( 'Extra class name', 'tz-autoshowroom' ),
//        ),

    )
));
?>