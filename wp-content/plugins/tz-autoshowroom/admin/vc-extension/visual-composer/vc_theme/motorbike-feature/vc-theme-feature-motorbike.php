<?php
function autoshowroom_get_motorbike_data( $post_type = 'vehicle' ) {
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

function autoshowroom_get_motorbike_fields(){
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
    'name'      =>  'Features Motorbike',
    'base'      =>  'autoshowroom-feature-motorbike',
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
                'values'    => autoshowroom_get_motorbike_data()
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
            'heading'       =>  esc_html__('Vehicle Specifications','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_vehicle_specifications',
            'value'         =>  array(
                'Show'          =>  'show',
                'Hide'          =>  'hide'
            )
        ),
        array(
            'type'          =>  'checkbox',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Choose Specifications','tz-autoshowroom'),
            "dependency"    => Array('element' => "autoshowroom_vehicle_specifications", 'value' => 'show'),
            'param_name'    =>  'autoshowroom_specifications_values',
            'value'         =>  autoshowroom_get_motorbike_fields()
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  esc_html__('Label View All','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_label_view',
            'value'         =>  ''
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  esc_html__('Link View All','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_link_view',
            'value'         =>  ''
        ),
        array(
            "type"       => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading"    => esc_html__("Image Size", "tz-autoshowroom"),
            "param_name" => "tz_size",
            "description"   => esc_html__("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \"large\" size.", "aventura-plugin"),
            "value" => "",
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
            'heading'       =>  esc_html__('Slider Layout','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_vehicle_carousel_layout',
            'value'         =>  array(
                'In Grid'          =>  'grid',
                'Full With'        =>  'full'
            )
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'group'         =>  esc_html__('Slider Option','tz-autoshowroom'),
            'heading'       =>  esc_html__('Number items','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_vehicle_carousel_number',
            'value'         =>  5
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
        ),
        array(
            'type'        => 'textfield',
            'param_name'  => 'el_class',
            'heading'     => esc_html__( 'Extra class name', 'tz-autoshowroom' ),
        ),

    )
) );
?>