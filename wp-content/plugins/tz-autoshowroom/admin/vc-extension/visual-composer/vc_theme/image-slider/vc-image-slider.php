<?php
if (function_exists('vc_map')) :
    vc_map(array(
        "name" => esc_html__("Image Slider", "tz-autoshowroom"),
        "weight" => 14,
        "base" => "autoshowroom-image-slider",
        "icon" => "tzvc_icon",
        "description" => "",
        "class" => "autoshowroom_image_slider",
        "category" => esc_html__("TZ AutoShowroom", "tz-autoshowroom"),
        "params" => array(

            array(
                'type' => 'attach_images',
                'param_name' => 'tz_image',
                "admin_label" => false,
                "heading" => esc_html__("Upload Images", "tz-autoshowroom"),
                "description" => esc_html__("Upload image image gallery. ", "tz-autoshowroom"),
            ),
            array(
                "type" => "textfield",
                "admin_label" => false,
                "heading" => esc_html__("Image Size", "tz-autoshowroom"),
                "param_name" => "tz_image_size",
                "description" => esc_html__("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use thumbnail size. If used slides per view, this will be used to define carousel wrapper size. ", "aventura-plugin"),
                "value" => "",
            ),

            array(
                'type' => 'checkbox',
                'holder' => '',
                'heading' => esc_html__('Auto Play', 'tz-autoshowroom'),
                'group' => esc_html__('Slide Options', 'tz-autoshowroom'),
                'admin_label' => false,
                'param_name' => 'auto_play',
                'std' => 'true',
                'value' => array(
                    esc_html__('Yes', 'tz-autoshowroom') => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'holder' => '',
                'heading' => esc_html__('Auto Play Timeout', 'tz-autoshowroom'),
                'group' => esc_html__('Slide Options', 'tz-autoshowroom'),
                'admin_label' => false,
                'param_name' => 'timeout',
                'value' => '3000',
            ),
            array(
                'type' => 'checkbox',
                'holder' => '',
                'heading' => esc_html__('Loop', 'tz-autoshowroom'),
                'group' => esc_html__('Slide Options', 'tz-autoshowroom'),
                'admin_label' => false,
                'param_name' => 'loop',
                'std' => 'true',
                'value' => array(
                    esc_html__('Yes', 'tz-autoshowroom') => 'true',
                ),
            ),

            array(
                'type' => 'textfield',
                'holder' => '',
                'heading' => esc_html__('Number of items displayed', 'tz-autoshowroom'),
                'group' => esc_html__('Slide Options', 'tz-autoshowroom'),
                'admin_label' => false,
                'param_name' => 'item_slider',
                'value' => '1',
            ),
            array(
                'type' => 'css_editor',
                'heading' => __( 'CSS box', 'js_composer' ),
                'param_name' => 'css',
                'group' => __( 'Design Options', 'js_composer' ),
            ),
        )
    ));

endif;
?>