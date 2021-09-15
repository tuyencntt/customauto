<?php
vc_map(array(
        "name" => __("Our themes", "js_composer"),
        "weight" => 14,
        "base" => "autoshowroom-our-themes",
        "icon" => "tzvc_icon",
        "description" => "",
        "class" => "autoshowroom_our_themes",
        "category" => esc_html__("TZ AutoShowroom", "js_composer"),
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", "tz-autoshowroom"),
                "param_name" => "title",
                "value" => esc_html__("", "tz-autoshowroom"),
                "description" => esc_html__("Enter your  title", "tz-autoshowroom"),
            ),

            array(
                'type' => 'param_group',
                'value' => '',
                'param_name' => 'our_themes_params',
                "heading" => esc_html__("Our theme item", "tz-autoshowroom"),
                // Note params is mapped inside param-group:
                'params' => array(

                    array(
                        "type" => "vc_link",
                        "class" => "",
                        "heading" => esc_html__("URL", "tz-autoshowroom"),
                        "param_name" => "url",
                        "value" => esc_html__("", "tz-autoshowroom"),
                        "description" => esc_html__("", "tz-autoshowroom"),
                    ),

                    array(
                        "type" => "attach_image",
                        "class" => "",
                        "heading" => esc_html__("Image icon", "tz-autoshowroom"),
                        "param_name" => "image_icon",
                        "value" => esc_html__("", "tz-autoshowroom"),
                        "description" => esc_html__("Enter your image icon", "tz-autoshowroom"),
                    ),
                    array(
                        "type" => "attach_image",
                        "class" => "",
                        "heading" => esc_html__("Image ", "tz-autoshowroom"),
                        "param_name" => "image",
                        "value" => esc_html__("", "tz-autoshowroom"),
                        "description" => esc_html__("Enter your image", "tz-autoshowroom"),
                    ),
                )

            )
        )

    )
);
?>