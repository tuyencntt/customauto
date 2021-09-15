<?php
vc_map( array(
    "name"          => __("Text Box", "js_composer"),
    "weight"        => 1,
    "base"          => "autoshowroom-text-box",
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
            "param_name"    => "autoshowroom_text_title",
            "description"   => "Define a title for the section",
            "value" => "",
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
            'type' => 'css_editor',
            'heading' => __( 'CSS box', 'tz-autoshowroom' ),
            'param_name' => 'autoshowroom_textbox_css',
            'group' => __( 'Design Options', 'tz-autoshowroom' )
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