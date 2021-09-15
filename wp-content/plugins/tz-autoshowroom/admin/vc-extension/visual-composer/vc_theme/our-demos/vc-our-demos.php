<?php
vc_map(array(
        "name" => __("Our demos", "js_composer"),
        "weight" => 14,
        "base" => "autoshowroom-our-demos",
        "icon" => "tzvc_icon",
        "description" => "",
        "class" => "autoshowroom_our_demos",
        "category" => esc_html__("TZ AutoShowroom", "js_composer"),
        "params" => array(

            array(
                'type' => 'param_group',
                'value' => '',
                'param_name' => 'our_demos_params',
                "heading" => esc_html__("Our demo item", "tz-autoshowroom"),
                // Note params is mapped inside param-group:
                'params' => array(

                    array(
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => esc_html__("Number", "tz-autoshowroom"),
                        "param_name" => "status",
                        "description" => esc_html__("Enter your version number", "tz-autoshowroom"),
                        'value' => array(
                            esc_html__('Ready to use', 'tz-autoshowroom') => '1',
                            esc_html__('Comingsoon', 'tz-autoshowroom') => '0',
                        ),
                    ),

                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => esc_html__("Title", "tz-autoshowroom"),
                        "param_name" => "title",
                        "value" => esc_html__("", "tz-autoshowroom"),
                        "description" => esc_html__("Enter your version title", "tz-autoshowroom"),
                    ),

                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => esc_html__("Label", "tz-autoshowroom"),
                        "param_name" => "demo_label",
                        "value" => esc_html__("", "tz-autoshowroom"),
                        "description" => esc_html__("Enter Label: trend or new...", "tz-autoshowroom"),

                    ),


                    array(
                        "type" => "vc_link",
                        "class" => "",
                        "heading" => esc_html__("URL", "tz-autoshowroom"),
                        "param_name" => "url",
                        "value" => esc_html__("", "tz-autoshowroom"),
                        "description" => esc_html__("", "tz-autoshowroom"),
                        "dependency"    => array(
                            'element'       => 'status ',
                            'value'         => '1',
                        ),
                    ),

                    array(
                        "type" => "attach_image",
                        "class" => "",
                        "heading" => esc_html__("Image", "tz-autoshowroom"),
                        "param_name" => "image",
                        "value" => esc_html__("", "tz-autoshowroom"),
                        "description" => esc_html__("Enter your version number", "tz-autoshowroom"),
                    ),
                )

            )
        )

    )
);
?>