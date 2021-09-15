<?php
vc_map( array(
    "name" => esc_html__("Button Autoshowroom", "tz-autoshowroom"),
    'icon'  =>  'tzvc_icon',
    "weight" => 1,
    "base" => "tz-button",
    "class" => "tz-button",
    "category"      => __("TZ AutoShowroom", "js_composer"),
    "params" => array(

        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => false,
            "heading"       => esc_html__("Button Alignment", "tz-autoshowroom"),
            "param_name"    => "btn_type",
            "value"         => array(
                esc_html__("Left", "aventura-plugin") => 'left',
                esc_html__("Center", "aventura-plugin") => 'center',
                esc_html__("Right", "aventura-plugin") => 'right',
            ),
        ),

        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'URL (Link)', 'tz-autoshowroom' ),
            'param_name' => 'link',
            'description' => esc_html__( '', 'tz-autoshowroom' ),
            'admin_label' => false,
            'weight' => 0,
        ),

        array(
            'type'        => 'css_editor',
            'param_name'  => 'css',
            'heading'     => esc_html__( 'CSS box', 'tz-autoshowroom' ),
            'group'       => esc_html__( 'Customize Button', 'tz-autoshowroom' ),
        ),

    )
));
?>