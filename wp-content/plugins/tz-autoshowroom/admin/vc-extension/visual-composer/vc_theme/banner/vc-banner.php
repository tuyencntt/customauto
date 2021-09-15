<?php

vc_map(array(
        "name" => __("Banner", "tz-autoshowroom"),
        "weight" => 14,
        "base" => "autoshowroom-banner",
        "icon" => "tzvc_icon",
        "description" => "",
        "class" => "autoshowroom_banner",
        "category" => esc_html__("TZ AutoShowroom", "tz-autoshowroom"),
        "params" => array(

            array(
                "type" => "attach_image",
                "class" => "",
                "heading" => esc_html__( "Background Image", "tz-autoshowroom" ),
                "param_name" => "background",
                "value" => esc_html__( "", "tz-autoshowroom" ),
            ),

            array(
                "type" => "attach_image",
                "class" => "",
                "heading" => esc_html__( "Image", "tz-autoshowroom" ),
                "param_name" => "image",
                "value" => esc_html__( "Default param value", "tz-autoshowroom" ),
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__( "Title", "tz-autoshowroom" ),
                "param_name" => "title",
                "value" => esc_html__( "Default param value", "tz-autoshowroom" ),
            ),

            array(
                "type" => "vc_link",
                "class" => "",
                "heading" => esc_html__( "Url", "tz-autoshowroom" ),
                "param_name" => "link",
                "value" => esc_html__( "Default param value", "tz-autoshowroom" ),
            ),
            array(
                'type' => 'css_editor',
                'heading' => __( 'CSS box', 't-shootr' ),
                'param_name' => 'auto_box_css',
                'group' => __( 'Design Options', 't-shootr' )
            ),

        )

    )
);
?>