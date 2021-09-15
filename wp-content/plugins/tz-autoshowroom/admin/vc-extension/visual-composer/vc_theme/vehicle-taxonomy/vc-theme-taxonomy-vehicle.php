<?php
    vc_map( array(
        'name'      =>  'Taxonomy Vehicle',
        'base'      =>  'autoshowroom-taxonomy-vehicle',
        'icon'      =>  'tzvc_icon',
        'weight'    => 1,
        'category'  =>  'TZ AutoShowroom',
        'params'    =>  array(
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('Taxonomy Style','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_tax_style',
                'value'         =>  array(
                    'Style 1'          =>  'style1',
                    'Style 2'          =>  'style2'
                )
            ),
            array(
                'type'          =>  'textfield',
                'holder'        =>  '',
                'heading'       =>  esc_html__('Title','tz-autoshowroom'),
                'admin_label'   =>  false,
                'param_name'    =>  'autoshowroom_vehicle_title',
                'value'         =>  ''
            ),
            array(
                'type'          =>  'textfield',
                'holder'        =>  '',
                'heading'       =>  esc_html__('Custom link text','tz-autoshowroom'),
                'admin_label'   =>  false,
                'param_name'    =>  'autoshowroom_vehicle_link_text',
                'value'         =>  ''
            ),
            array(
                'type'          =>  'textfield',
                'holder'        =>  '',
                'heading'       =>  esc_html__('Custom link url','tz-autoshowroom'),
                'admin_label'   =>  false,
                'param_name'    =>  'autoshowroom_vehicle_link_url',
                'value'         =>  ''
            ),
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('Taxonomy type','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_type',
                'value'         =>  array(
                    'Vehicle Make'          =>  'make',
                    'Vehicle Type'          =>  'vehicle_type'
                )
            ),
            array(
                'type'          =>  'textfield',
                'holder'        =>  '',
                'heading'       =>  esc_html__('Excludes taxonomy','tz-autoshowroom'),
                'admin_label'   =>  false,
                'description'   =>  esc_html__('Input taxonomy id example: 12,13,14...','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_tax_excludes',
                'value'         =>  ''
            ),
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('Show number','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_number',
                'value'         =>  array(
                    'Show'          =>  'show',
                    'Hide'          =>  'hide'
                )
            ),
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('Vehicle Make/Type is empty:','tz-autoshowroom'),
                'description'   =>  esc_html__('Show or hide Vehicle Makes/Types which do not have vehicles available','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_empty',
                'value'         =>  array(
                    'Show'          =>  'false',
                    'Hide'          =>  'true'
                )
            ),
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('Show image','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_image',
                'value'         =>  array(
                    'Show'          =>  'show',
                    'Hide'          =>  'hide'
                )
            ),

            array(
                'type'          =>  'textfield',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('Limit','tz-autoshowroom'),
                'description'   => __( '<small>0 to display all</small> ','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_limit',
                'value'         =>  ''
            ),
            array(
                'type'          =>  'dropdown',
                'holder'        =>  '',
                'admin_label'   =>  false,
                'heading'       =>  esc_html__('Layout','tz-autoshowroom'),
                'param_name'    =>  'autoshowroom_vehicle_layout',
                'value'         =>  array(
                    'Inline'          =>  'inline',
                    'Block'           =>  'block'
                )
            )
        )
    ) );
?>