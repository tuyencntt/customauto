<?php

function autoshowroom_get_vehicle_slider_data( $post_type = 'vehicle' ) {
    $posts = get_posts( array(
        'posts_per_page' 	=> -1,
        'post_type'			=> $post_type,
    ));
    $result = array();
    foreach ( $posts as $post )	{
        $result[] = array(
            'value' => $post->ID,
            'label' => $post->post_title,
        );
    }
    return $result;
}

function autoshowroom_vehicle_slider_get_fields(){
    global $car_dealer;
    if ( is_plugin_active( 'progression-car-dealer-master/progression-car-dealer.php' ) ) {
        $fields = $car_dealer->fields->get_registered_fields('specs');
        $auto_fields = array();
        foreach ($fields as $field) {
            $auto_fields[$field['label']] = $field['name'];
        }
        return $auto_fields;
    }
}
vc_map( array(
    'name'      =>  'Vehicle Slider',
    'base'      =>  'autoshowroom-vehicle-slider',
    'icon'      =>  'tzvc_icon',
    'weight'    => 1,
    'category'  =>  'TZ AutoShowroom',
    'params'    =>  array(
        array(
            'type'          => 'autocomplete',
            'heading'       => __( 'Include Vehicles', 'tz-autoshowroom' ),
            'param_name'    => 'autoshowroom_features_vehicles',
            'admin_label'   =>  true,
            'description'   => __( 'Add Vehicles by title.', 'tz-plazart' ),
            'settings'      => array(
                'multiple'  => true,
                'sortable'  => true,
                'groups'    => true,
                'values'    => autoshowroom_get_vehicle_slider_data()
            )
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Vehicle Title','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_vehicle_title',
            'value'         =>  array(
                'Show'          =>  'show',
                'Hide'          =>  'hide'
            )
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Vehicle Description','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_vehicle_description',
            'value'         =>  array(
                'Show'          =>  'show',
                'Hide'          =>  'hide'
            )
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  esc_html__('Limit Description','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_vehicle_description_limit',
            'value'         =>  80,
            "dependency"    => Array('element' => "autoshowroom_vehicle_description", 'value' => 'show'),
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Vehicle Specifications','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_vehicle_specifications',
            'value'         =>  array(
                'Show'          =>  'show',
                'Hide'          =>  'hide'
            ),
            "dependency"    => Array('element' => "autoshowroom_vehicle_description", 'value' => 'show'),
        ),
        array(
            'type'          =>  'checkbox',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Choose Specifications','tz-autoshowroom'),
            "dependency"    => Array('element' => "autoshowroom_vehicle_specifications", 'value' => 'show'),
            'param_name'    =>  'autoshowroom_specifications_values',
            'value'         =>  autoshowroom_vehicle_slider_get_fields(),

        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
            'heading'       =>  esc_html__('Margin items','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_vehicle_carousel_margin',
            'value'         =>  30
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
            'heading'       =>  esc_html__('Top Title','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_vehicle_carousel_title_top',
            'value'         =>  310
        ),

        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Height','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_vehicle_carousel_height_options',
            'value'         =>  array(
                'Auto'              =>  'auto',
                '= Height Screen'   =>  'screen',
                'Custom'            =>  'custom'
            )
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
            'heading'       =>  esc_html__('Height Value','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_vehicle_carousel_height',
            "dependency"    => Array('element' => "autoshowroom_vehicle_carousel_height_options", 'value' => 'custom'),
            'value'         =>  ''
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Next/Preview','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_vehicle_carousel_button',
            'value'         =>  array(
                'Show'          =>  'true',
                'Hide'          =>  'false'
            )
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Loop','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_vehicle_carousel_loop',
            'value'         =>  array(
                'Yes'          =>  'true',
                'No'           =>  'false'
            )
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('AutoPlay','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_vehicle_carousel_autoplay',
            'value'         =>  array(
                'Yes'          =>  'true',
                'No'           =>  'false'
            )
        )

    )
) );
?>