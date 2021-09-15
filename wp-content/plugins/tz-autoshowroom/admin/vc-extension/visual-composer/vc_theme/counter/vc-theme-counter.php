<?php

vc_map( array(
    "name" => __("Counter", "js_composer"),
    "weight" => 14,
    "base" => "autoshowroom-counter",
    "icon" => "tzvc_icon",
    "description" => "",
    "class" => "autoshowroom_counter",
    "category" => __("TZ AutoShowroom", "js_composer"),
    "params" => array(
        array(
            'type'          =>  'dropdown',
            'admin_label'   =>  true,
            'heading'       =>  esc_html__('Counter Style','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_counter_style',
            'value'         =>  array(
                'Style 1'        =>  'style1',
                'Style 2'        =>  'style2',
                'Style 3'        =>  'style3'
            )
        ),

        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Font Size", "js_composer"),
            "param_name"    => "autoshowroom_fontsize_option",
            "description"   => __("", "js_composer"),
            "value"         => array(
                __("Medium", "js_composer")               => 'medium',
                __("Large", "js_composer")                => 'large'),
            "dependency"   => array('element' => 'autoshowroom_counter_style', 'value' => array('style3'))
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
            'type' => 'colorpicker',
            'param_name' => 'icon_color',
            'heading' => esc_html__('Icon Color', 'amita-plugin'),
            'admin_label' => false,
            "value" => '',
        ),

        array(
            "type"       => "textfield",
            "class"         => "",
            "admin_label" => true,
            "heading"    => __("Count", "js_composer"),
            "param_name" => "autoshowroom_count",
            "value" => "",
        ),

        array(
            'type' => 'colorpicker',
            'param_name' => 'count_color',
            'heading' => esc_html__('Count Color', 'amita-plugin'),
            'admin_label' => false,
            "value" => '',
        ),

        array(
            "type"       => "textfield",
            "class"         => "",
            "admin_label" => true,
            "heading"    => __("Step Count ", "js_composer"),
            "param_name" => "autoshowroom_count_number",
            "value" => "1",
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading"    => __("Title", "js_composer"),
            "param_name" => "autoshowroom_title",
            "value" => "",
        ),

        array(
            'type' => 'colorpicker',
            'param_name' => 'title_color',
            'heading' => esc_html__('Title Color', 'amita-plugin'),
            'admin_label' => false,
            "value" => '',
        ),

        array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading"       => __("Css Animation", "js_composer"),
            "param_name"    => "autoshowroom_css_animation",
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
            "type"       => "textfield",
            "class"         => "",
            "admin_label" => false,
            "heading"    => __("Extra class name", "js_composer"),
            "param_name" => "counter_class",
            "value" => "",
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
        ),
        array(
            'type' => 'css_editor',
            'heading' => __( 'CSS box', 'js_composer' ),
            'param_name' => 'css',
            'group' => __( 'Design Options', 'js_composer' ),
        ),
    )
) );

?>