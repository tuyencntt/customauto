<?php
$menus = get_registered_nav_menus();
global $menuArray;
foreach ( $menus as $location => $description ) {
    $menuArray[ $description ] = $location;
}
vc_map( array(
    'name'      =>  __('Header Option',"tz-autoshowroom"),
    'base'      =>  'tzautoshowroomheader',
    'icon'      =>  'tzvc_icon',
    'category'  =>  'TZ AutoShowroom',
    'params'    =>  array(
        array(
            'type'          =>  'dropdown',
            'holder'        =>  'div',
            'heading'       =>  __('Choose type header',"tz-autoshowroom"),
            'admin_label'   =>  true,
            'param_name'    =>  'autoshowroom_header',
            'value'         =>  array(
                'Header style 1'    =>  'header1',
                'Header style 2'    =>  'header2',
                'Header style 3'    =>  'header3',
                'Header style 4'    =>  'header4',
                'Header style 5'    =>  'header5',
                'Header style 6'    =>  'header6',
                'Header style 7'    =>  'header7',
                'Header style 8'    =>  'header8',
                'Header style 9'    =>  'header9',
            )
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  __('Top Sidebar',"tz-autoshowroom"),
            'param_name'    =>  'autoshowroom_sidebar',
            'value'         =>  array(
                'Show'          =>  'show',
                'Hide'          =>  'hide'
            ),
            "dependency"    =>  Array('element' => "autoshowroom_header", 'value' => array('header1','header2','header3','header4','header5','header6','header7','header9')),
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'heading'       =>  __('Choose type Logo',"tz-autoshowroom"),
            'description'   =>  __('<small>If you select Default, your logo will be logo when you configure in Theme Option</small>',"tz-autoshowroom"),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_logo_type',
            'value'         =>  array(
                'Logo Default'  =>  'default',
                'Logo Image'    =>  'logoimage',
                'Logo Text'     =>  'logotext'
            )
        ),
        array(
            'type'          =>  'attach_image',
            'holder'        =>  '',
            'heading'       =>  __('Logo Image',"tz-autoshowroom"),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_logo_image',
            "dependency"    =>  Array('element' => "autoshowroom_logo_type", 'value' => 'logoimage'),
            'value'         =>  ''
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  __('Logo Top Position',"tz-autoshowroom"),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_logo_position',
            'description'   =>  __('<small>Enter Digital Number (example:15)</small>',"tz-autoshowroom"),
            "dependency"    => Array('element' => "autoshowroom_header", 'value' => 'header2'),
            'value'         =>  ''
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  __('Logo Text',"tz-autoshowroom"),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_logo_text',
            "dependency"    => Array('element' => "autoshowroom_logo_type", 'value' => 'logotext'),
            'value'         =>  ''
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Select Menu", "tz-autoshowroom"),
            "param_name" => "autoshowroom_pagemenu",
            "value" => $menuArray
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  __('Add Car',"tz-autoshowroom"),
            'param_name'    =>  'autoshowroom_addcar',
            'value'         =>  array(
                'Show'          =>  'show',
                'Hide'          =>  'hide'
            ),
            'std'           => 'show',
            "dependency"    => Array('element' => "autoshowroom_header", 'value' => 'header6'),

        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  __('Add Car Link',"tz-autoshowroom"),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_addcar_link',
            "dependency"    => Array('element' => "autoshowroom_addcar", 'value' => 'show'),
            'value'         =>  ''
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  __('Top Header',"tz-autoshowroom"),
            'param_name'    =>  'autoshowroom_header7_top',
            'value'         =>  array(
                'Default'          =>  'default',
                'Customer'         =>  'customer'
            ),
            'std'           => 'show',
            "dependency"    => Array('element' => "autoshowroom_header", 'value' => 'header7'),

        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  __('Phone',"tz-autoshowroom"),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_home7_phone',
            "dependency"    => Array('element' => "autoshowroom_header7_top", 'value' => 'customer'),
            'value'         =>  ''
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  __('Email',"tz-autoshowroom"),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_home7_email',
            "dependency"    => Array('element' => "autoshowroom_header7_top", 'value' => 'customer'),
            'value'         =>  ''
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  __('Hour',"tz-autoshowroom"),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_home7_hour',
            "dependency"    => Array('element' => "autoshowroom_header7_top", 'value' => 'customer'),
            'value'         =>  ''
        ),
        array(
            "type" => "colorpicker",
            "class" => "",
            "admin_label" => true,
            "heading" => __('Top header Color', 'tz-autoshowroom'),
            "param_name" => "autoshowroom_sidebar_color",
            "description" => __("You can set color of Top header.", "tz-autoshowroom"),
            "dependency"    => Array('element' => "autoshowroom_sidebar", 'value' => 'show')
        ),
        array(
            'type' => 'css_editor',
            'heading' => __( 'CSS box', 'tz-autoshowroom' ),
            'param_name' => 'autoshowroom_sidebar_css',
            'group' => __( 'Sidebar Design', 'tz-autoshowroom' ),
            "dependency"    => Array('element' => "autoshowroom_sidebar", 'value' => 'show')
        ),
         array(
             "type" => "textfield",
             "class" => "",
             "admin_label" => false,
             "heading" => "Link Login",
             "param_name" => "autoshowroom_link_login",
             "description" => "",
             "value" => "",
             "dependency"    => Array('element' => "autoshowroom_header", 'value' => array('header8')),
         ),
        array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => false,
            "heading" => "Link Register",
            "param_name" => "autoshowroom_link_register",
            "description" => "",
            "value" => "",
            "dependency"    => Array('element' => "autoshowroom_header", 'value' => array('header8')),
        ),

    )
) );
?>