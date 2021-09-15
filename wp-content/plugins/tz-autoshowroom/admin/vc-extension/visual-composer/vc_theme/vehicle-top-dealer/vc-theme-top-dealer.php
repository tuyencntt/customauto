<?php
vc_map( array(
    "name"          => __("Top Dealer", "js_composer"),
    "weight"        => 1,
    "base"          => "autoshowroom-top-dealer",
    'icon'          =>  'tzvc_icon',
    "class"         => "tzElement_extended",
    "description"   => "Show Top Dealer Vehicle",
    "category"      => __("TZ AutoShowroom", "js_composer"),
    "params"        => array(
        array(
            "type"          => "dropdown",
            "holder"        => "div",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Layout Display", "js_composer"),
            "param_name"    => "autoshowroom_layout_top_dealer",
            "description"   => "Define a title for the section",
            "value" => array(
                '2 Column'  => '2column',
                '3 Column'  => '3column',
                '4 Column'  => '4column'
            ),
        ),
        array(
            "type"          => "textfield",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Limit Item", "js_composer"),
            "param_name"    => "autoshowroom_limit_top_dealer",
            "description"   => "Limit items display top dealer",
            "value"         => "",
        ),
        array(
            "type"          => "dropdown",
            "holder"        => "div",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Title", "js_composer"),
            "param_name"    => "autoshowroom_title_top_dealer",
            "description"   => "Show/Hide title top dealer",
            "value" => array(
                'Hide'  => 'hide',
                'Show'  => 'show'
            ),
        ),
        array(
            "type"          => "dropdown",
            "holder"        => "div",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Map", "js_composer"),
            "param_name"    => "autoshowroom_address_top_dealer",
            "description"   => "Show/Hide address top dealer",
            "value" => array(
                'Hide'  => 'hide',
                'Show'  => 'show'
            ),
        ),
        array(
            "type"          => "dropdown",
            "holder"        => "div",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Phone", "js_composer"),
            "param_name"    => "autoshowroom_phone_top_dealer",
            "description"   => "Show/Hide phone top dealer",
            "value" => array(
                'Hide'  => 'hide',
                'Show'  => 'show'
            ),
        ),
        array(
            'type' => 'css_editor',
            'heading' => __( 'CSS box', 'tz-autoshowroom' ),
            'param_name' => 'autoshowroom_textbox_css',
            'group' => __( 'Design Options', 'tz-autoshowroom' )
        ),

    )
));
?>