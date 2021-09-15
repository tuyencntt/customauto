<?php

vc_map(array(
        "name" => esc_html__("Customers Say", "js_composer"),
        "weight" => 14,
        "base" => "autoshowroom-customers-say",
        "icon" => "tzvc_icon",
        "description" => "",
        "class" => "autoshowroom_customers_say",
        "category" => esc_html__("TZ AutoShowroom", "js_composer"),
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Name", "tz-autoshowroom"),
                "param_name" => "name",
                "value" => esc_html__("", "tz-autoshowroom"),
                "description" => esc_html__("Enter customer name", "tz-autoshowroom"),
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", "tz-autoshowroom"),
                "param_name" => "title",
                "value" => esc_html__("", "tz-autoshowroom"),
                "description" => esc_html__("Enter customer title", "tz-autoshowroom"),
            ),
          
            array(
                "type" => "textarea",
                "class" => "",
                "heading" => esc_html__("Customer comment", "tz-autoshowroom"),
                "param_name" => "comment",
                "value" => esc_html__("", "tz-autoshowroom"),
                "description" => esc_html__("Enter customer comment", "tz-autoshowroom"),
            ),
        )

    )
);
?>