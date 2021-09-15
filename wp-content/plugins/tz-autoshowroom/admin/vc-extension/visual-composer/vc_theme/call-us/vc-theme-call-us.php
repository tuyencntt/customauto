<?php
vc_map( array(
    "name"          => __("Call us", "js_composer"),
    "weight"        => 1,
    "base"          => "autoshowroom_phone_number",
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
            "heading"       => __("Title", "js_composer"),
            "param_name"    => "autoshowroom_tz_phone_title",
            "description"   => "Define a title",
            "value" => "",
        ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "admin_label"   => false,
            "heading"       => __("Phone label", "js_composer"),
            "param_name"    => "autoshowroom_tz_phone_number",
            "description"   => "Enter phone number",
            "value" => "",
        ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "admin_label"   => false,
            "heading"       => __("Phone link number", "js_composer"),
            "param_name"    => "autoshowroom_tz_phone_link",
            "value" => "",
        ),

    )
));
?>