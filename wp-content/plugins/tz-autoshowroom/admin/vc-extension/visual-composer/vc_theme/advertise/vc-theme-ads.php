<?php
vc_map( array(
    "name"          => __("Advertise", "js_composer"),
    "weight"        => 1,
    "base"          => "autoshowroom-ads",
    'icon'          =>  'tzvc_icon',
    "class"         => "tzElement_extended",
    "description"   => "",
    "category"      => __("TZ AutoShowroom", "js_composer"),
    "params"        => array(
        array(
            'type' => 'dropdown',
            "class"         => "",
            "admin_label"   => true,
            'heading' => __( 'Advertise Type', 'tz-autoshowroom' ),
            'param_name' => 'autoshowroom_type',
            'value' => array(
                __( 'Type 1', 'tz-autoshowroom' ) => 'type1',
                __( 'Type 2', 'tz-autoshowroom' ) => 'type2',
            ),
            'description' => __( 'Select Type Advertise.', 'tz-autoshowroom' ),
            'group' => 'General Option',
        ),
        array(
            'type' => 'dropdown',
            "class"         => "",
            "admin_label"   => true,
            'heading' => __( 'Style Ads', 'tz-autoshowroom' ),
            'param_name' => 'autoshowroom_style',
            'value' => array(
                __( 'Image - Text', 'tz-autoshowroom' ) => 'image-text',
                __( 'Text - Image', 'tz-autoshowroom' ) => 'text-image',
            ),
            'description' => __( 'Select image alignment.', 'tz-autoshowroom' ),
            'group' => 'General Option',
        ),
        array(
            "type"          => "textfield",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Height(px)", "js_composer"),
            "param_name"    => "autoshowroom_height",
            "description"   => "Set height for box Ads",
            "value"         => "305",
            "group"         => "General Option",
        ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Title", "js_composer"),
            "param_name"    => "autoshowroom_title",
            "description"   => "Define a title for the section",
            "value"         => "",
            "group"         => "General Option",
            "dependency"    => array(
                'element'       => 'autoshowroom_type ',
                'value'         => array('type1','type2'),
            ),
        ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Title Link", "js_composer"),
            "param_name"    => "autoshowroom_title_link",
            "description"   => "Define a title link for the section",
            "value"         => "",
            "group"         => "General Option",
            "dependency"    => array(
                'element'       => 'autoshowroom_type ',
                'value'         => array('type1','type2'),
            ),
        ),

        array(
            "type"          => "textarea_html",
            "class"         => "",
            "admin_label"   => false,
            "heading"       => __("Description", "js_composer"),
            "param_name"    => "content",
            "description"   => "Define a description for the section(optional)",
            "value"         => "",
            "group"         => "General Option",
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'Button URL (Link)', 'tz-autoshowroom' ),
            'param_name' => 'link',
            'description' => esc_html__( '', 'tz-autoshowroom' ),
            'admin_label' => false,
            'weight' => 0,
            "group"         => "General Option",
            "dependency"    => array(
                'element'       => 'autoshowroom_type ',
                'value'         => array('type1','type2'),
            ),
        ),

        array(
            "type" => "colorpicker",
            "class" => "",
            "admin_label" => true,
            "heading" => __('Background Color', 'tz-autoshowroom'),
            "param_name" => "autoshowroom_bgcolor",
            "description" => __("You can set background color for element.", "js_composer"),
            "group"         => "General Option",
        ),

        array(
            'type' => 'attach_image',
            'heading' => __( 'Image', 'tz-autoshowroom' ),
            'param_name' => 'autoshowroom_image',
            'value' => '',
            'description' => __( 'Select image from media library.', 'tz-autoshowroom' ),
            'group'         => 'Image Option',
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Image size', 'tz-autoshowroom' ),
            'param_name' => 'autoshowroom_img_size',
            'value' => array(
                __( 'Thumbnail', 'tz-autoshowroom' ) => 'thumbnail',
                __( 'Medium', 'tz-autoshowroom' ) => 'medium',
                __( 'Large', 'tz-autoshowroom' ) => 'large',
                __( 'Full', 'tz-autoshowroom' ) => 'full',
            ),
            'description' => __( 'Select image size.', 'tz-autoshowroom' ),
            'group' => 'Image Option',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Image alignment', 'tz-autoshowroom' ),
            'param_name' => 'autoshowroom_img_alignment',
            'value' => array(
                __( 'Left', 'tz-autoshowroom' ) => 'left',
                __( 'Right', 'tz-autoshowroom' ) => 'right',
                __( 'Center', 'tz-autoshowroom' ) => 'center',
            ),
            'description' => __( 'Select image alignment.', 'tz-autoshowroom' ),
            'group' => 'Image Option',
        ),

        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Css Animation", "js_composer"),
            "param_name"    => "autoshowroom_css_animation",
            "description"   => __("", "js_composer"),
            "value"         => array(
                __("No animation", "js_composer")           => '',
                __("Top to bottom", "js_composer")          => 'top-to-bottom',
                __("Bottom to top", "js_composer")          => 'bottom-to-top',
                __("Left to right", "js_composer")          => 'left-to-right',
                __("Right to left", "js_composer")          => 'right-to-left',
                __("Appear from center", "js_composer")     => 'appear'),
            'group' => 'Image Option',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Newsletter', 'tz-autoshowroom' ),
            'param_name' => 'autoshowroom_new',
            'value' => array(
                __( 'hide', 'tz-autoshowroom' ) => 'hide',
                __( 'show', 'tz-autoshowroom' ) => 'show',
            ),
            "group"         => "General Option",
        ),
        array(
            'type'        => 'css_editor',
            'param_name'  => 'css',
            'heading'     => esc_html__( 'CSS box', 'tz-autoshowroom' ),
            'group'       => esc_html__( 'Design Option', 'tz-autoshowroom' ),
        ),
    )
));
?>