<?php

vc_map( array(
    "name" => __("Service Item", "js_composer"),
    "weight" => 14,
    "base" => "autoshowroom-service-item",
    "icon" => "tzvc_icon",
    "description" => "",
    "class" => "autoshowroom_service",
    "category" => __("TZ AutoShowroom", "js_composer"),
    "params" => array(
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Style ", "js_composer"),
            "param_name"    => "autoshowroom_style",
            "description"   => __("", "js_composer"),
            "value"         => array(
                __("Style 1", "js_composer")               => 'style1',
                __("Style 2", "js_composer")               => 'style2',
                __("Style 3", "js_composer")               => 'style3',
                __("Style 4", "js_composer")               => 'style4',
                __("Style 5", "js_composer")               => 'style5'
            ),
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => esc_html__("Type Icon Services", "aventura-plugin"),
            "param_name"    => "autoshowroom_service_type",
            "description"   => esc_html__("", "aventura-plugin"),
            "value"         => array(
                esc_html__("Icon",  "aventura-plugin")             => '1',
                esc_html__("Image", "aventura-plugin")             => '2'),
            "default"       => '1',
            "dependency"    => array('element' => 'autoshowroom_style', 'value' => array('style1','style2','style3','style4')),
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
            "dependency"    => array('element' => 'autoshowroom_service_type', 'value' => '1'),
        ),

        array(
            "type" => "attach_image",
            "heading"       => esc_html__("Image Services", "aventura-plugin"),
            "param_name"    => "autoshowroom_services_image",
            "description"   => esc_html__("Upload Image Icon.  ", "aventura-plugin"),
            "dependency"    => array(
                'element' =>  'autoshowroom_service_type', 'value' => '2'
            ),
        ),

        array(
            "type" => "attach_image",
            "heading"       => esc_html__("Image Services", "aventura-plugin"),
            "param_name"    => "autoshowroom_services_image_style",
            "description"   => esc_html__("Upload Image Icon.  ", "aventura-plugin"),
            "dependency"    => array(
                'element' =>  'autoshowroom_style', 'value' => 'style5'
            ),
        ),

        array(
            "type" => "attach_image",
            "heading"       => esc_html__("Image Icon", "aventura-plugin"),
            "param_name"    => "autoshowroom_services_image_icon",
            "description"   => esc_html__("Upload Icon.  ", "aventura-plugin"),
            "dependency"    => array(
                'element' => 'autoshowroom_style', 'value' => 'style5'
            ),
        ),
        array(
            "type" => "colorpicker",
            "class" => "",
            "admin_label" => true,
            "heading" => __('Background Icon', 'tz-autoshowroom'),
            "param_name" => "autoshowroom_bg_icon",
            "description" => __("You can set background color of icon.", "js_composer"),
            "value"         => "#ff5400",
        ),
        array(
            "type"       => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading"    => __("Title", "js_composer"),
            "param_name" => "autoshowroom_title",
            "value" => "",
        ),
        array(
            "type" => "colorpicker",
            "class" => "",
            "admin_label" => true,
            "heading" => __('Color Title', 'tz-autoshowroom'),
            "param_name" => "autoshowroom_color_title",
            "description" => __("You can set color of title.", "js_composer"),
            "value"         => "#222222",
        ),

        array(
            "type"          => "textarea_html",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Description", "js_composer"),
            "param_name"    => "content",
            "description"   => "Define a description for the section(optional)",
            "value"         => "",
        ),

        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Readmore Option", "js_composer"),
            "param_name"    => "autoshowroom_readmore_option",
            "description"   => __("", "js_composer"),
            "value"         => array(
                __("Hide", "js_composer")               => 'hide',
                __("Show", "js_composer")               => 'show'),
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Readmore Text", "js_composer"),
            "param_name" => "autoshowroom_readmore_text",
            "description" => "",
            "value" => "",
            "dependency"   => array('element' => 'autoshowroom_readmore_option', 'value' => array('show'))
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Readmore Link", "js_composer"),
            "param_name" => "autoshowroom_readmore_link",
            "description" => "",
            "value" => "",
            "dependency"   => array('element' => 'autoshowroom_readmore_option', 'value' => array('show'))
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Padding Top(px)", "js_composer"),
            "param_name" => "autoshowroom_padding_top",
            "description" => "Ex: 50;",
            "value" => "",
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => __("Padding Bottom(px)", "js_composer"),
            "param_name" => "autoshowroom_padding_bottom",
            "description" => "Ex: 50;",
            "value" => "",
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
            'type'        => 'css_editor',
            'param_name'  => 'css',
            'heading'     => esc_html__( 'CSS box', 'tz-autoshowroom' ),
            'group'       => esc_html__( 'Design Option', 'tz-autoshowroom' ),
        ),
    )
) );

?>