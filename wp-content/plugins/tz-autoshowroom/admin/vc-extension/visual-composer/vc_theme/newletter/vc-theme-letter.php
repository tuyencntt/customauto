<?php

vc_map( array(
    "name" => __("Newletter", "tz-autoshowroom"),
    "weight" => 14,
    "base" => "autoshowroom-newletter",
    "icon" => "tzvc_icon",
    "description" => "",
    "class" => "autoshowroom_newletter",
    "category" => esc_html__("TZ AutoShowroom", "tz-autoshowroom"),
    "params" => array(
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => esc_html__("Newsletter Style", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_newletter_style",
            "description"   => esc_html__("Choose style of newsletter", "tz-autoshowroom"),
            "default"       => '',
            "value"         => array(
                esc_html__('Style 1') => 'style1',
                esc_html__('Style 2') => 'style2',
            )
        ),
        array(
            "type"          => "textfield",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => esc_html__("Newletter title", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_newletter_title",
            "description"   => esc_html__("Enter title", "tz-autoshowroom"),
            "default"       => '',
            "dependency"    =>  Array('element' => "autoshowroom_newletter_style", 'value' => 'style1'),
        ),
        array(
            "type"          => "textarea",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => esc_html__("Newletter description", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_newletter_description",
            "description"   => esc_html__("Enter description", "tz-autoshowroom"),
            "default"       => '',
            "dependency"    =>  Array('element' => "autoshowroom_newletter_style", 'value' => 'style1'),
        ),
    )
) );

?>