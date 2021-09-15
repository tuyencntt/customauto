<?php
function autoshowroom_get_vehicle_dealer_data( $post_type = 'vehicle' ) {
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

function autoshowroom_dealer_get_fields(){
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
    'name'      =>  'Features Dealer',
    'base'      =>  'autoshowroom-feature-dealer',
    'icon'      =>  'tzvc_icon',
    'weight'    => 1,
    'category'  =>  'TZ AutoShowroom',
    'params'    =>  array(
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Type Dealer','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_type_dealer',
            'value'         =>  array(
                'Vehicles Name'              =>  'title',
                'Vehicles New'               =>  'new',
                'Vehicles Used'              =>  'used'
            )
        ),
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
                'values'    => autoshowroom_get_vehicle_dealer_data()
            ),
            "dependency"    =>  Array('element' => "autoshowroom_type_dealer", 'value' => 'title')
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
            ),
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  esc_html__('Limit Description','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_vehicle_description_limit',
            'value'         =>  80,
            "dependency"    => array('element' => "autoshowroom_vehicle_description", 'value' => 'show'),
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
        ),
        array(
            'type'          =>  'checkbox',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Choose Specifications','tz-autoshowroom'),
            "dependency"    => Array('element' => "autoshowroom_vehicle_specifications", 'value' => 'show'),
            'param_name'    =>  'autoshowroom_specifications_values',
            'value'         =>  autoshowroom_dealer_get_fields()
        ),
        array(
            "type"       => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading"    => esc_html__("Limit Item", "tz-autoshowroom"),
            "param_name" => "autoshowroom_limit",
            "description"   => '',
            "value" => "",
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Oder By','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_vehicle_oderby',
            'value'         =>  array(
                'Title'         =>  'title',
                'ID'            =>  'id',
                'Date'          =>  'date'
            ),
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Oder','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_vehicle_oder',
            'value'         =>  array(
                'A --> Z'        =>  'asc',
                'Z --> A'        =>  'desc'
            ),
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
            'type'        => 'textfield',
            'param_name'  => 'el_class',
            'heading'     => esc_html__( 'Extra class name', 'tz-autoshowroom' ),
        ),

    )
) );
?>