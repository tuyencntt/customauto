<?php

function autoshowroom_get_search_fields(){
    global $car_dealer;
    if ( is_plugin_active( 'progression-car-dealer-master/progression-car-dealer.php' ) ) {
        $fields = $car_dealer->fields->get_registered_fields();
        $auto_fields = array();
        foreach ($fields as $field) {
            $auto_fields[] = array(
                'value' => $field['name'],
                'label' => $field['label']
            );
        }
        $auto_fields1[]=array(
            'value' => 'keyword',
            'label' => 'Key word'
        );
        $auto_fields2[]=array(
            'value' => 'location',
            'label' => 'Location'
        );
        $auto_fields = array_merge($auto_fields,$auto_fields1,$auto_fields2);

        return $auto_fields;
    }
}
vc_map( array(
    'name'      =>  'Search Vehicle',
    'base'      =>  'autoshowroom-vehicle-search',
    'icon'      =>  'tzvc_icon',
    'weight'    => 1,
    'category'  =>  'TZ AutoShowroom',
    'params'    =>  array(
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Search Type','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_search_type',
            'value'         =>  array(
                'Type 1'        =>  'type1',
                'Type 2'        =>  'type2',
                'Type 3'        =>  'type3'
            )
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  esc_html__('Title','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_search_title',
            'value'         =>  'Find Your Car',
            "dependency"    => array('element' => 'autoshowroom_search_type','value'=>array('type1','type3')),
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Search Layout','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_search_layout',
            'value'         =>  array(
                'Vertical'          =>  'vertical',
                'Horizontal'        =>  'horizontal'
            ),
            "dependency"    => array('element' => 'autoshowroom_search_type','value'=>'type1'),
        ),
        array(
            'type'          => 'autocomplete',
            'heading'       => __( 'Include Search fields', 'tz-autoshowroom' ),
            'param_name'    => 'autoshowroom_search_fields',
            'admin_label'   =>  true,
            'description'   => __( '<small>Type to include search fields. vehicle_type,make,model,registration,milage,condition,color,interior,transmission,engine,drivetrain,horsepower,fuel,keyword,order</small>', 'tz-autoshowroom' ),
            'settings'      => array(
                'multiple'  => true,
                'sortable'  => true,
                'groups'    => true,
                'values'    => autoshowroom_get_search_fields()
            )
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Condition','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_condition',
            'value'         =>  array(
                'All Condition'     => 'all',
                'New'               => 'new',
                'Used'              => 'used',
                'Certified Used'    => 'preowned',
            ),
            "dependency"    => array('element' => 'autoshowroom_search_type','value'=>'type2'),
        ),
        array(
            'type'          =>  'checkbox',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Label','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_search_label',
            "dependency"    => Array('element' => "autoshowroom_search_layout", 'value' => 'horizontal','element' => 'autoshowroom_search_type','value'=>'type3'),
            'value'         =>  array(
                'Check to show label'          =>  'show',
            )
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  esc_html__('Button Search','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_button_search',
            'value'         =>  'Search'
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'group'         => 'Special Position',
            'heading'       =>  esc_html__('Position','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_search_position',
            'value'         =>  array(
                'None'         =>  'none',
                'Top Left'         =>  'quicksearch_top_left',
                'Top Right'        =>  'quicksearch_top_right',
                'Bottom Left'      =>  'quicksearch_bottom_left',
                'Bottom Right'     =>  'quicksearch_bottom_right',
                'Top Center'       =>  'quicksearch_top_center',
                'Bottom Center'    =>  'quicksearch_bottom_center',
            )
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'group'         => 'Special Position',
            'heading'       =>  esc_html__('Position Value','tz-autoshowroom'),
            'description'   =>  __('<small>Default 150 (unit: px)</small>','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_search_top',
            'value'         =>  150
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Css Animation", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_search_animation",
            "description"   => __("", "tz-autoshowroom"),
            "value"         => array(
                __("No animation", "tz-autoshowroom")           => '',
                __("Top to bottom", "tz-autoshowroom")          => 'top-to-bottom',
                __("Bottom to top", "tz-autoshowroom")          => 'bottom-to-top',
                __("Left to right", "tz-autoshowroom")          => 'left-to-right',
                __("Right to left", "tz-autoshowroom")          => 'right-to-left',
                __("Appear from center", "tz-autoshowroom")     => 'appear'),
        ),
        array(
            'type'        => 'textfield',
            'param_name'  => 'el_class',
            'heading'     => esc_html__( 'Extra class name', 'tz-autoshowroom' ),
        ),
    )
) );
?>