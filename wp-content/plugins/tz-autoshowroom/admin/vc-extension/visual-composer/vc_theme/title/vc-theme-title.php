<?php
vc_map( array(
    "name"          => __("Title", "js_composer"),
    "weight"        => 1,
    "base"          => "autoshowroom-title",
    'icon'          =>  'tzvc_icon',
    "class"         => "tzElement_extended",
    "description"   => "Set a title and subtitle with style",
    "category"      => __("TZ AutoShowroom", "js_composer"),
    "params"        => array(
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Section Title", "js_composer"),
            "param_name"    => "autoshowroom_tz_title",
            "description"   => "Define a title for the section",
            "value" => "",
        ),


        array(
            "type" => "colorpicker",
            "class" => "",
            "admin_label" => true,
            "heading" => __('Color Title', 'tz-autoshowroom'),
            "param_name" => "autoshowroom_color_title",
            "description" => __("You can set color of title.", "js_composer"),
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
            "heading"       => __("Text Align", "js_composer"),
            "param_name"    => "autoshowroom_tz_align",
            "description"   => __("", "js_composer"),
            "value"         => array(
                __("Center", "js_composer") => 'center',
                __("Left", "js_composer") => 'left',
                __("Right", "js_composer") => 'right'),
        ),
        array(
            "type"          => "checkbox",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Disable line below the title", "js_composer"),
            "param_name"    => "autoshowroom_tz_line",
            "description"   => __("", "js_composer"),
            "value"         => ""
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
    )
));
?>