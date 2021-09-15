<?php
vc_map( array(
    "name"          => __("List", "js_composer"),
    "weight"        => 1,
    "base"          => "autoshowroom-list",
    'icon'          =>  'tzvc_icon',
    "class"         => "tzElement_extended",
    "description"   => "",
    "category"      => __("TZ AutoShowroom", "js_composer"),
    "params"        => array(
        array(
            'type'          =>  'dropdown',
            'admin_label'   =>  true,
            'heading'       =>  esc_html__('List Style','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_list_style',
            'value'         =>  array(
                'Style 1'        =>  '1',
                'Style 2'        =>  '2'
            )
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'tz-autoshowroom' ),
            "class"         => "",
            "admin_label"   => true,
            'param_name' => 'autoshowroom_icon',
            'value' => 'fa fa-adjust', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 50,
                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'description' => __( 'Select icon from library.', 'tz-autoshowroom' ),
        ),
        array(
            "type"          => "textarea_html",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Content", "js_composer"),
            "param_name"    => "content",
            "description"   => "Define a description for the section(optional)",
            "value"         => "",
        ),

        array(
            "type"        =>  "checkbox",
            "class"       =>  "",
            "admin_label" => true,
            "heading"     => esc_html__("Border Bottom","tz-autoshowroom"),
            "param_name"  => "border",
            "value"       => array( '' => 'tz_border'),
            "description" => esc_html__("Select the border display.", 'tz-autoshowroom'),
            "dependency"   => array('element' => 'autoshowroom_list_style', 'value' => array('2')),
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Css Animation", "js_composer"),
            "param_name"    => "autoshowroom_tz_css_animation",
            "description"   => __("", "js_composer"),
            "value"         => array(
                __("No animation", "js_composer")           => '',
                __("Top to bottom", "js_composer")          => 'top-to-bottom',
                __("Bottom to top", "js_composer")          => 'bottom-to-top',
                __("Left to right", "js_composer")          => 'left-to-right',
                __("Right to left", "js_composer")          => 'right-to-left',
                __("Appear from center", "js_composer")     => 'appear'),
        ),
        array(
            'type' => 'css_editor',
            'heading' => __( 'Css', 'my-text-domain' ),
            'param_name' => 'css',
            'group' => __( 'Design options', 'my-text-domain' ),
        ),

    )
));
?>