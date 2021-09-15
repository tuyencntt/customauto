<?php
vc_map( array(
    "name"          => __("Our Process", "js_composer"),
    "weight"        => 1,
    "base"          => "autoshowroom-our-process",
    'icon'          =>  'tzvc_icon',
    "class"         => "tzElement_extended",
    "description"   => "Set our process with style",
    "category"      => __("TZ AutoShowroom", "js_composer"),
    "params"        => array(
        array(
            "type"          => "textfield",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Number", "js_composer"),
            "param_name"    => "autoshowroom_tz_number",
            "description"   => "Input number for process.",
            "value" => "",
        ),

        array(
            "type"          => "textfield",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Name", "js_composer"),
            "param_name"    => "autoshowroom_tz_name",
            "description"   => "Input name for process.",
            "value" => "",
        ),
        array(
            "type"              => "colorpicker",
            "class"             => "",
            "admin_label"       => true,
            "heading"           => __('Color Title', 'tz-autoshowroom'),
            "param_name"        => "autoshowroom_color_title"
        ),
        array(
            "type"              => "dropdown",
            "class"             => "",
            "admin_label"       => true,
            "heading"           => __("Icon Background", "js_composer"),
            "param_name"        => "autoshowroom_icon_bg",
            "value"             => array(
                __("Yes", "js_composer")     => 'yes',
                __("No", "js_composer")      => 'no'),
        ),
        array(
            'type'              => 'iconpicker',
            'heading'           => __( 'Icon Background', 'tz-autoshowroom' ),
            "class"             => "",
            "admin_label"       => true,
            'param_name'        => 'autoshowroom_icon',
            'value'             => 'fa fa-adjust', // default value to backend editor admin_label
            'settings'          => array(
                        'emptyIcon' => false,
                                // default true, display an "EMPTY" icon?
                        'iconsPerPage' => 4000,
                                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'description'       => __( 'Select icon from library.', 'tz-autoshowroom' ),
            "dependency"   => array('element' => 'autoshowroom_icon_bg', 'value' => array('yes'))
        ),
        array(
            "type"              => "dropdown",
            "class"             => "",
            "admin_label"       => true,
            "heading"           => __("Icon Color", "js_composer"),
            "param_name"        => "icon_color",
            "value"             => array(
                __("Default", "js_composer")     => '1',
                __("Custom", "js_composer")      => '2'),
        ),
        array(
            "type"              => "colorpicker",
            "class"             => "",
            "admin_label"       => true,
            "heading"           => __('Custom Color Icon', 'tz-autoshowroom'),
            "param_name"        => "custom_color_icon",
            "dependency"   => array('element' => 'icon_color', 'value' => array('2'))
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "heading"       => __("iCon align", "js_composer"),
            "param_name"    => "autoshowroom_tz_icon_align_option",
            "description"   => __("", "js_composer"),
            "value"         => array(
                __("Left", "js_composer")               => 'left',
                __("Center", "js_composer")             => 'center',
                __("Right", "js_composer")              => 'right'),
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
            "heading"       => __("Readmore Option", "js_composer"),
            "param_name"    => "autoshowroom_tz_readmore_option",
            "description"   => __("", "js_composer"),
            "value"         => array(
                __("Show", "js_composer")               => 'show',
                __("Hide", "js_composer")               => 'hide'),
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Readmore Text", "js_composer"),
            "param_name" => "autoshowroom_tz_readmore_text",
            "description" => "",
            "value" => "",
            "dependency"   => array('element' => 'autoshowroom_tz_readmore_option', 'value' => array('show'))
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Readmore Link", "js_composer"),
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
    )
));
?>