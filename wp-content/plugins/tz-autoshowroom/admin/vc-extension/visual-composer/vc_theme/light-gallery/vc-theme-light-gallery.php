<?php

vc_map( array(
    "name" => __("Light Gallery", "tz-autoshowroom"),
    "weight" => 14,
    "base" => "autoshowroom-light-gallery",
    "icon" => "tzvc_icon",
    "description" => "",
    "class" => "autoshowroom_light_gallery",
    "category" => __("TZ AutoShowroom", "tz-autoshowroom"),
    "params" => array(
        array(
            "type"          => "attach_images",
            "heading"       => __("Images", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_gallery",
            'description'   => __( 'Select images from media library.', 'tz-autoshowroom' ),
            "value"         => "",
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => false,
            "heading"       => __("Image Size", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_gallery_size",
            "description"   => __("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme.
             Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \"thumbnail\" size.","tz-autoshowroom"),
            "value"         => "",
        ),
        array(
            "type"          => "dropdown",
            "admin_label"   => false,
            "heading"       => __("Columns", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_gallery_columns",
            "value"         => array(
                                __("1 Column", "tz-autoshowroom")               => '1',
                                __("2 Columns", "tz-autoshowroom")              => '2',
                                __("3 Columns", "tz-autoshowroom")              => '3',
                                __("4 Columns", "tz-autoshowroom")              => '4',
                                __("6 Columns", "tz-autoshowroom")              => '6'
            ),
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => false,
            "heading"       => __("Border Radius", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_gallery_radius",
            "description"   => __("Enter Border radius value. Eg: 5px or 5%","tz-autoshowroom"),
            "value"         => ''
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => false,
            "heading"       => __("Padding item", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_gallery_padding",
            "description"   => __("Enter Padding value . Eg: 10","tz-autoshowroom"),
            "value"         => ''
        )

    )
)
)
;
