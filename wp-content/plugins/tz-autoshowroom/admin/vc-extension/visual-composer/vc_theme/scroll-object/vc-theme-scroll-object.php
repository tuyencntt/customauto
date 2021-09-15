<?php

vc_map( array(
    "name" => __("Scroll Object", "js_composer"),
    "weight" => 14,
    "base" => "autoshowroom-scroll-object",
    "icon" => "tzvc_icon",
    "description" => "",
    "class" => "autoshowroom_scroll_object",
    "category" => __("TZ AutoShowroom", "tz-autoshowroom"),
    "params" => array(
        array(
            "type"          => "textarea_html",
            "admin_label"   => true,
            "heading"       => __("Content", "tz-autoshowroom"),
            "param_name"    => "content",
            "description"   => __("Define a description for the section(optional)","tz-autoshowroom"),
            "value"         => "",
        ),
        array(
            "type"          => "dropdown",
            "admin_label"   => false,
            "heading"       => __("Scrolling start and end", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_scroll_when",
            "value"         => array(
                __("From top of object", "tz-autoshowroom")      => 'enter',
                __("From bottom of object", "tz-autoshowroom")   => "exit"
            ),
        ),
        array(
            "type"          => "dropdown",
            "admin_label"   => false,
            "heading"       => __("Easing", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_scroll_easing",
            "value"         => array(
                __("easeout", "tz-autoshowroom")    => 'easeout',
                __("easein", "tz-autoshowroom")     => "easein",
                __("easeinout", "tz-autoshowroom")  => "easeinout",
                __("linear", "tz-autoshowroom")     => "linear"
            ),
        ),
        array(
            "type"              => "textfield",
            "group"             => __("Animation", "tz-autoshowroom"),
            "heading"           => __("Opacity", "tz-autoshowroom"),
            "param_name"        => "autoshowroom_scroll_opacity",
            "description"       => __("<span>Value: 0 – 1</span>","tz-autoshowroom"),
            "value"             => ""
        ),
        array(
            "type"              => "textfield",
            "group"             => __("Animation", "tz-autoshowroom"),
            "heading"           => __("Scale", "tz-autoshowroom"),
            "param_name"        => "autoshowroom_scroll_scale",
            "description"       => __("<span>Value: Scaling factor</span>","tz-autoshowroom"),
            "value"             => ""
        ),
        array(
            "type"              => "textfield",
            "group"             => __("Animation", "tz-autoshowroom"),
            "heading"           => __("Scale X", "tz-autoshowroom"),
            "param_name"        => "autoshowroom_scroll_scale_x",
            "description"       => __("<span>Value: Scaling factor</span>","tz-autoshowroom"),
            "value"             => ""
        ),
        array(
            "type"              => "textfield",
            "group"             => __("Animation", "tz-autoshowroom"),
            "heading"           => __("Scale Y", "tz-autoshowroom"),
            "param_name"        => "autoshowroom_scroll_scale_y",
            "description"       => __("<span>Value: Scaling factor</span>","tz-autoshowroom"),
            "value"             => ""
        ),
        array(
            "type"              => "textfield",
            "group"             => __("Animation", "tz-autoshowroom"),
            "heading"           => __("Scale Z", "tz-autoshowroom"),
            "param_name"        => "autoshowroom_scroll_scale_z",
            "description"       => __("<span>Value: Scaling factor</span>","tz-autoshowroom"),
            "value"             => ""
        ),
        array(
            "type"              => "textfield",
            "group"             => __("Animation", "tz-autoshowroom"),
            "heading"           => __("Rotate X", "tz-autoshowroom"),
            "param_name"        => "autoshowroom_scroll_rotate_x",
            "description"       => __("<span>Value: angle of rotation in degrees</span>","tz-autoshowroom"),
            "value"             => ""
        ),
        array(
            "type"              => "textfield",
            "group"             => __("Animation", "tz-autoshowroom"),
            "heading"           => __("Rotate Y", "tz-autoshowroom"),
            "param_name"        => "autoshowroom_scroll_rotate_y",
            "description"       => __("<span>Value: angle of rotation in degrees</span>","tz-autoshowroom"),
            "value"             => ""
        ),
        array(
            "type"              => "textfield",
            "group"             => __("Animation", "tz-autoshowroom"),
            "heading"           => __("Rotate Z", "tz-autoshowroom"),
            "param_name"        => "autoshowroom_scroll_rotate_z",
            "description"       => __("<span>Value: angle of rotation in degrees</span>","tz-autoshowroom"),
            "value"             => ""
        ),
        array(
            "type"              => "textfield",
            "group"             => __("Animation", "tz-autoshowroom"),
            "heading"           => __("Translate X", "tz-autoshowroom"),
            "param_name"        => "autoshowroom_scroll_translate_x",
            "description"       => __("<span>Value: distance in pixels</span>","tz-autoshowroom"),
            "value"             => ""
        ),
        array(
            "type"              => "textfield",
            "group"             => __("Animation", "tz-autoshowroom"),
            "heading"           => __("Translate Y", "tz-autoshowroom"),
            "param_name"        => "autoshowroom_scroll_translate_y",
            "description"       => __("<span>Value: distance in pixels</span>","tz-autoshowroom"),
            "value"             => ""
        ),
        array(
            "type"              => "textfield",
            "group"             => __("Animation", "tz-autoshowroom"),
            "heading"           => __("Translate Z", "tz-autoshowroom"),
            "param_name"        => "autoshowroom_scroll_translate_z",
            "description"       => __("<span>Value: distance in pixels</span>","tz-autoshowroom"),
            "value"             => ""
        )
    )
)
)
;
