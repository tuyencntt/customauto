<?php
vc_map( array(
    "name"          => __("Pricing", "js_composer"),
    "weight"        => 1,
    "base"          => "autoshowroom-pricing",
    'icon'          =>  'tzvc_icon',
    "class"         => "tzElement_extended",
    "description"   => "Set our Pricing with style",
    "category"      => __("TZ AutoShowroom", "js_composer"),
    "params"        => array(

        array(
            "type"          => "textfield",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Title", "js_composer"),
            "param_name"    => "autoshowroom_tz_title",
            "description"   => "Input title for pricing.",
            "value" => "",
        ),

        array(
            "type"          => "textfield",
            "class"         => "",
            "admin_label"   => false,
            "heading"       => __("Description", "js_composer"),
            "param_name"    => "content",
            "description"   => "Define a description for the section(optional)",
            "value"         => "",
        ),

        array(
            "type"          => "textfield",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Price", "js_composer"),
            "param_name"    => "autoshowroom_tz_price",
            "value" => "",
        ),

        array(
            "type"          => "textfield",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Per Month", "js_composer"),
            "param_name"    => "autoshowroom_tz_per_month",
            "value" => "",
        ),

        array(
            'type' => 'param_group',
            'param_name' => 'list_items',
            'heading' => esc_html__('Features List', 'js_composer'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'param_name' => 'description',
                    'heading' => esc_html__('Description', 'js_composer'),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'iconpicker',
                    'param_name' => 'icon',
                    'heading' => esc_html__('List Style', 'js_composer'),
                    'std' => 'fa fa-caret-right',
                ),
                array(
                    'type' => 'colorpicker',
                    'param_name' => 'icon_color',
                    'heading' => esc_html__('Icon Color', 'js_composer'),
                    'admin_label' => false,
                    "value" => '',
                ),
            ),
        ),

        array(
            "type"          => "dropdown",
            "class"         => "",
            "heading"       => __("Button Option", "js_composer"),
            "param_name"    => "autoshowroom_tz_readmore_option",
            "description"   => __("", "js_composer"),
            "value"         => array(
                __("Show", "js_composer")               => 'show',
                __("Hide", "js_composer")               => 'hide'),
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Button Text", "js_composer"),
            "param_name" => "autoshowroom_tz_readmore_text",
            "description" => "",
            "value" => "",
            "dependency"   => array('element' => 'autoshowroom_tz_readmore_option', 'value' => array('show'))
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Button Link", "js_composer"),
            "param_name" => "autoshowroom_tz_readmore_link",
            "description" => "",
            "value" => "",
            "dependency"   => array('element' => 'autoshowroom_tz_readmore_option', 'value' => array('show'))
        ),

        array(
            "type"          => "dropdown",
            "class"         => "",
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
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'js_composer' ),
            'param_name' => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
        ),

        array(
            'type' => 'css_editor',
            'heading' => __( 'CSS box', 'js_composer' ),
            'param_name' => 'css',
            'group' => __( 'Design Options', 'js_composer' ),
        ),
    )
));
?>