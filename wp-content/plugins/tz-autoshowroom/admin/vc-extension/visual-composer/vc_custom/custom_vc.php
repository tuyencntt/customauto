<?php
vc_remove_param('vc_row', 'full_width');


vc_add_param('vc_row',array(
        "type"          => "dropdown",
        "heading"       => __('Row Type', 'tz-autoshowroom'),
        "param_name"    => "tz_row_type",
        "weight"        =>1,
        "value"         => array(
            __("Full Width", 'tz-autoshowroom') => 'full_width',
            __("In Grid", 'tz-autoshowroom') => 'grid',
        )
    )
);
vc_add_param(
    'vc_row',array(
        'type' => 'dropdown',
        'heading' => __( 'Gradient', 'js_composer' ),
        'description' => __( 'Select button display style.', 'js_composer' ),
        'param_name' => 'tz_gradient',
        // partly compatible with btn2, need to be converted shape+style from btn2 and btn1
        'value' => array(
            __( 'None', 'js_composer' )             => 'none',
            __( 'Gradient', 'js_composer' )         => 'gradient',
            __( 'Gradient Custom', 'js_composer' )  => 'gradient-custom',
        ),
    )
);
vc_add_param(
    'vc_row',array(
        'type' => 'dropdown',
        'heading' => __( 'Gradient Color 1', 'js_composer' ),
        'param_name' => 'gradient_color_1',
        'description' => __( 'Select first color for gradient.', 'js_composer' ),
        'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
        'value' => getVcShared( 'colors-dashed' ),
        'std' => 'turquoise',
        'dependency' => array(
            'element' => 'tz_gradient',
            'value' => array( 'gradient' ),
        ),
        'edit_field_class' => 'vc_col-sm-6',
    )
);
vc_add_param(
    'vc_row',array(
        'type' => 'dropdown',
        'heading' => __( 'Gradient Color 2', 'js_composer' ),
        'param_name' => 'gradient_color_2',
        'description' => __( 'Select second color for gradient.', 'js_composer' ),
        'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
        'value' => getVcShared( 'colors-dashed' ),
        'std' => 'blue',
        // must have default color grey
        'dependency' => array(
            'element' => 'tz_gradient',
            'value' => array( 'gradient' ),
        ),
        'edit_field_class' => 'vc_col-sm-6',
    )
);
vc_add_param(
    'vc_row',array(
        'type' => 'colorpicker',
        'heading' => __( 'Gradient Color 1', 'js_composer' ),
        'param_name' => 'gradient_custom_color_1',
        'description' => __( 'Select first color for gradient.', 'js_composer' ),
        'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
        'value' => '#dd3333',
        'dependency' => array(
            'element' => 'tz_gradient',
            'value' => array( 'gradient-custom' ),
        ),
        'edit_field_class' => 'vc_col-sm-4',
    )
);
vc_add_param(
    'vc_row',array(
        'type' => 'colorpicker',
        'heading' => __( 'Gradient Color 2', 'js_composer' ),
        'param_name' => 'gradient_custom_color_2',
        'description' => __( 'Select second color for gradient.', 'js_composer' ),
        'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
        'value' => '#eeee22',
        'dependency' => array(
            'element' => 'tz_gradient',
            'value' => array( 'gradient-custom' ),
        ),
        'edit_field_class' => 'vc_col-sm-4',
    )
);

/***********************************************************************************
 * Class WPBakeryShortCode_Quote
 */
class WPBakeryShortCode_TZQuote  extends WPBakeryShortCodesContainer {}
vc_map( array(
    "name" => "Quote",
    "base" => "tzquote",
    "weight" => 1,
    "as_parent" => array('only' => 'tzquote_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "category" => 'TZ AutoShowroom',
    "icon" => "tzvc_icon",
    "show_settings_on_create" => true,
    "params" => array(
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Type Quote", "js_composer"),
            "param_name"    => "autoshowroom_quote_type",
            "description"   => __("", "tz-autoshowroom"),
            "value"         => array(
                __("Type 1", "js_composer")             => 'type1',
                __("Type 2", "js_composer")             => 'type2',
                __("Type 3", "js_composer")             => 'type3',
                __("Type 4", "js_composer")    => 'type4',
                __("Type 5", "js_composer")    => 'type5',
            ),
            "group" => "General",
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Choose columns", "js_composer"),
            "param_name"    => "tz_autoshowroom_number_item",
            "description"   => __("", "tz-autoshowroom"),
            "value"         => array(
                __("1", "js_composer")             => '1',
                __("2", "js_composer")             => '2',
                __("3", "js_composer")             => '3',
                __("6", "js_composer")             => '4'),
            "group" => "General",
            "dependency"    => Array('element' => "autoshowroom_quote_type", 'value' => array('type3','type5')),
        ),
        array(
            "type" => "checkbox",
            "class" => "",
            "admin_label" => true,
            "heading"       => esc_html__("Slider Autoplay", "tz-autoshowroom"),
            "param_name"    => "tz_autoplay_option",
            "description"   => "",
            "value" => "",
            "group" => "General",
            "dependency"    => Array('element' => "autoshowroom_quote_type", 'value' => array('type3','type4','type5')),
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => "Slider TimeOut",
            "param_name" => "tz_autoplay_time",
            "description" => "",
            "value" => "",
            "group" => "General",
            "dependency"    => Array('element' => "tz_autoplay_option", 'value' => array('true')),
        ),
        array(
            "type" => "checkbox",
            "class" => "",
            "admin_label" => true,
            "heading"       => esc_html__("Slider Loop", "tz-autoshowroom"),
            "param_name"    => "tz_loop_option",
            "description"   => "",
            "value" => "",
            "group" => "General",
            "dependency"    => Array('element' => "autoshowroom_quote_type", 'value' => array('type3','type4','type5')),
        ),
        array(
            "type" => "checkbox",
            "class" => "",
            "admin_label" => true,
            "heading"       => esc_html__("Show Dots.", "tz-autoshowroom"),
            "param_name"    => "tz_dots_option",
            "description"   => "",
            "value" => "",
            "group" => "General",
            "dependency"    => Array('element' => "autoshowroom_quote_type", 'value' => array('type3','type4','type5')),
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => false,
            "heading"       => __("Center Mode", "js_composer"),
            "param_name"    => "autoshowroom_center_mode",
            "description"   => __("Enables centered view. Use with odd numbered slidesToShow counts.", "tz-autoshowroom"),
            "value"         => array(
                __("Yes", "js_composer")             => 'true',
                __("No", "js_composer")             => 'false'),
            "group" => "General",
            "dependency"    => Array('element' => "autoshowroom_quote_type", 'value' => array('type1','type2')),
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => false,
            "heading"       => __("Number Item Desktop", "js_composer"),
            "param_name"    => "autoshowroom_number_item_des_center",
            "description"   => __("", "tz-autoshowroom"),
            "value"         => array(
                __("3", "js_composer")             => '3',
                __("5", "js_composer")             => '5'),
            "group" => "Number Item Center Mode",
            "dependency"    => Array('element' => "autoshowroom_center_mode", 'value' => array('true')),
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => false,
            "heading"       => __("Number Item Tablet Landscape", "js_composer"),
            "param_name"    => "autoshowroom_number_item_tablet_landscape_center",
            "description"   => __("", "tz-autoshowroom"),
            "value"         => array(
                __("3", "js_composer")             => '3',
                __("5", "js_composer")             => '5'),
            "group" => "Number Item Center Mode",
            "dependency"    => Array('element' => "autoshowroom_center_mode", 'value' => array('true')),
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => false,
            "heading"       => __("Number Item Tablet Portrait", "js_composer"),
            "param_name"    => "autoshowroom_number_item_tablet_portrait_center",
            "description"   => __("", "tz-autoshowroom"),
            "value"         => array(
                __("3", "js_composer")             => '1',
                __("5", "js_composer")             => '3'),
            "group" => "Number Item Center Mode",
            "dependency"    => Array('element' => "autoshowroom_center_mode", 'value' => array('true')),
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => false,
            "heading"       => __("Number Item Mobile", "js_composer"),
            "param_name"    => "autoshowroom_number_item_mobile_center",
            "description"   => __("", "tz-autoshowroom"),
            "value"         => array(
                __("3", "js_composer")             => '1',
                __("5", "js_composer")             => '3'),
            "group" => "Number Item Center Mode",
            "dependency"    => Array('element' => "autoshowroom_center_mode", 'value' => array('true')),
        ),

        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => false,
            "heading"       => __("Number Item Desktop", "js_composer"),
            "param_name"    => "autoshowroom_number_item_des",
            "description"   => __("", "tz-autoshowroom"),
            "value"         => array(
                __("1", "js_composer")             => '1',
                __("2", "js_composer")             => '2',
                __("3", "js_composer")             => '3',
                __("4", "js_composer")             => '4',
                __("5", "js_composer")             => '5'),
            "group" => "Number Item Normal Mode",
            "dependency"    => Array('element' => "autoshowroom_center_mode", 'value' => array('false')),
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => false,
            "heading"       => __("Number Item Tablet Landscape", "js_composer"),
            "param_name"    => "autoshowroom_number_item_tablet_landscape",
            "description"   => __("", "tz-autoshowroom"),
            "value"         => array(
                __("1", "js_composer")             => '1',
                __("2", "js_composer")             => '2',
                __("3", "js_composer")             => '3',
                __("4", "js_composer")             => '4',
                __("5", "js_composer")             => '5'),
            "group" => "Number Item Normal Mode",
            "dependency"    => Array('element' => "autoshowroom_center_mode", 'value' => array('false')),
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => false,
            "heading"       => __("Number Item Tablet Portrait", "js_composer"),
            "param_name"    => "autoshowroom_number_item_tablet_portrait",
            "description"   => __("", "tz-autoshowroom"),
            "value"         => array(
                __("1", "js_composer")             => '1',
                __("2", "js_composer")             => '2',
                __("3", "js_composer")             => '3'),
            "group" => "Number Item Normal Mode",
            "dependency"    => Array('element' => "autoshowroom_center_mode", 'value' => array('false')),
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => false,
            "heading"       => __("Number Item Mobile", "js_composer"),
            "param_name"    => "autoshowroom_number_item_mobile",
            "description"   => __("", "tz-autoshowroom"),
            "value"         => array(
                __("1", "js_composer")             => '1',
                __("2", "js_composer")             => '2',
                __("3", "js_composer")             => '3'),
            "group" => "Number Item Normal Mode",
            "dependency"    => Array('element' => "autoshowroom_center_mode", 'value' => array('false')),
        ),

        array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
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
            "group" => "General",
        ),
    ),
    "js_view" => 'VcColumnView'
) );

// Customer say item
class WPBakeryShortCode_TZQuote_Item  extends WPBakeryShortCode {}
vc_map( array(
    "name" => "Quote Item",
    "base" => "tzquote_item",
    "icon" => "tzvc_icon",
    "category" => 'TZ AutoShowroom',
    "allowed_container_element" => 'vc_row',
    "as_child" => array('only' => 'tzquote'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
        array(
            "type" => "attach_image",
            "class"         => "",
            "admin_label"   => true,
            "heading" => __("Image Author", "js_composer"),
            "param_name" => "autoshowroom_author",
            "description" => __("Upload image author of quote.", "js_composer"),
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => "Name",
            "param_name" => "autoshowroom_name",
            "description" => "",
            "value" => "",
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => "Employment Or Car Ownership",
            "param_name" => "autoshowroom_employment",
            "description" => "",
            "value" => "",
        ),

        array(
            "type"          => "textarea_html",
            "class"         => "",
            "holder"        => "div",
            "heading"       => __("Quote Content", "js_composer"),
            "param_name"    => "content",
            "description"   => "",
            "value"         => "",
        ),
    )
) );

/*
 * VC_GALLERY
 * */

vc_add_param('vc_gallery',array(
        "type" => "dropdown",
        "class" => "",
        "admin_label" => true,
        "heading" => __("Gallery Type", "js_composer"),
        "param_name" => "type",
        "description" => __("", "js_composer"),
        "value" => array(
            __("Flex slider fade", "js_composer") => 'flexslider_fade',
            __("Flex slider slide", "js_composer") => 'flexslider_slide',
            __("Nivo slider", "js_composer") => 'nivo',
            __("Image grid", "js_composer") => 'image_grid',
            __("Owl Carousel", "js_composer") => 'owl_carousel',
            __("Autoshowroom grid", "js_composer") => 'autoshowroom_grid'),
    )
);
vc_add_param('vc_gallery',array(
        "type" => "textfield",
        "class" => "",
        "admin_label" => true,
        "heading" => __("Number Items Slider", "js_composer"),
        "param_name" => "number_items",
        "description" => __("", "js_composer"),
        "value" => "",
        "std"   => '4',
        "dependency"    => array('element' => 'type', 'value' => array('owl_carousel')),
    )
);
vc_add_param('vc_gallery',array(
        "type" => "dropdown",
        "class" => "",
        "admin_label" => true,
        "heading" => __("Next/Preview Slider", "js_composer"),
        "param_name" => "autoshowroom_carousel_button",
        "description" => __("", "js_composer"),
        'value'         =>  array(
            'Show'          =>  'true',
            'Hide'          =>  'false'
        ),
        "std"   => '4',
        "dependency"    => array('element' => 'type', 'value' => array('owl_carousel')),
    )
);

/*
 * VC_column
 * */
vc_add_param('vc_column',array(
        "type" => "checkbox",
        "class" => "",
        "admin_label" => true,
        "heading" => __("Rellax effect", "js_composer"),
        "param_name" => "rellax_effect",
        "description" => __("", "js_composer"),
        "value" =>  __("", "js_composer"),
    )
);
vc_add_param('vc_column',array(
        "type" => "textfield",
        "class" => "",
        "admin_label" => true,
        "heading" => __("Speed Rellax effect", "js_composer"),
        "param_name" => "rellax_effect_speed",
        "description" => __("Add speed number -10 to 10", "js_composer"),
        "value" =>  __("2", "js_composer"),
        "dependency"    => array('element' => 'rellax_effect', 'value' => array('true')),
    )
);