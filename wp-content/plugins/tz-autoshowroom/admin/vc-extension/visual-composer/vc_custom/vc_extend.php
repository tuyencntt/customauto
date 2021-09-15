<?php
/*
 * VC_ROW
 * */
vc_remove_param('vc_row', 'full_width');
vc_add_param('vc_row', array(
        "type" => "dropdown",
        "heading" => esc_html__('Row Type', 'tz-autoshowroom'),
        "param_name" => "tz_row_type",
        "weight" => '0',
        "value" => array(
            esc_html__("Full Width", 'tz-autoshowroom') => 'full_width',
            esc_html__("In Grid", 'tz-autoshowroom') => 'grid',
        )
    )
);

vc_add_param('vc_row', array(
        "type" => "colorpicker",
        "class" => "hide_in_vc_editor",
        "admin_label" => true,
        "heading" => esc_html__("Overlay Parallax", "tz-autoshowroom"),
        "param_name" => "tz_overlay_parallax",
        "dependency" => Array('element' => "parallax", 'value' => array('content-moving', 'content-moving-fade'))
    )
);

vc_add_param('vc_row', array(
    "type" => "checkbox",
    "class" => "hide_in_vc_editor",
    "admin_label" => true,
    "heading" => esc_html__("Ruler Option", "tz-autoshowroom"),
    "param_name" => "tz_ruler",
    "value" => array('' => '1')
));

vc_add_param('vc_row', array(
    "type" => "checkbox",
    "class" => "hide_in_vc_editor",
    "admin_label" => true,
    "heading" => esc_html__("Pattern", "tz-autoshowroom"),
    "param_name" => "tz_pattern",
    "value" => array('' => '1')
));

/*
 * VC_COLUMN
 * */

vc_add_param('vc_column', array(
        "type" => "dropdown",
        "class" => "",
        "heading" => esc_html__("Text Alignment", "tz-autoshowroom"),
        "param_name" => "tztextalign",
        "value" => array(
            esc_html__("Choose align", "tz-autoshowroom") => "",
            esc_html__("Align Center", "tz-autoshowroom") => "center",
            esc_html__("Align Left", "tz-autoshowroom") => "left",
            esc_html__("Align Right", "tz-autoshowroom") => "right",
        ),
        "description" => ""
    )
);

vc_add_param('vc_column', array(
        "type" => "dropdown",
        "class" => "",
        "admin_label" => true,
        "heading" => esc_html__("Css Animation", "tz-autoshowroom"),
        "param_name" => "tz_css_animation",
        "description" => "",
        "value" => array(
            esc_html__("No animation", "tz-autoshowroom") => '',
            esc_html__("Top to bottom", "tz-autoshowroom") => 'top-to-bottom',
            esc_html__("Bottom to top", "tz-autoshowroom") => 'bottom-to-top',
            esc_html__("Left to right", "tz-autoshowroom") => 'left-to-right',
            esc_html__("Right to left", "tz-autoshowroom") => 'right-to-left',
            esc_html__("Appear from center", "tz-autoshowroom") => 'appear'),
    )
);

/*
 * VC_BUTTON
 * */

vc_add_param('vc_btn', array(
        "type" => "dropdown",
        "class" => "",
        "admin_label" => true,
        "heading" => esc_html__("Font Family", "tz-autoshowroom"),
        "param_name" => "tz_font_family",
        "description" => "",
        "value" => array(
            esc_html__("Ubuntu", "tz-autoshowroom") => '',
            esc_html__("Raleway", "tz-autoshowroom") => 'raleway',
            esc_html__("Montserrat", "tz-autoshowroom") => 'montserrat',
            esc_html__("Droid Serif", "tz-autoshowroom") => 'droidserif'),
    )
);

vc_add_param('vc_btn', array(
        "type" => "textfield",
        "class" => "",
        "admin_label" => true,
        "heading" => esc_html__("Margin Top(px)", "tz-autoshowroom"),
        "param_name" => "tz_padding_top",
        "description" => "Ex: 50",
        "value" => "",
    )
);

vc_add_param('vc_btn', array(
        "type" => "textfield",
        "class" => "",
        "admin_label" => true,
        "heading" => esc_html__("Margin Bottom(px)", "tz-autoshowroom"),
        "param_name" => "tz_padding_bottom",
        "description" => "Ex: 50",
        "value" => "",
    )
);

vc_add_param('vc_btn', array(
        "type" => "textfield",
        "class" => "",
        "admin_label" => true,
        "heading" => esc_html__("Margin Left(px)", "tz-autoshowroom"),
        "param_name" => "tz_padding_left",
        "description" => "Ex: 50",
        "value" => "",
    )
);

vc_add_param('vc_btn', array(
        "type" => "textfield",
        "class" => "",
        "admin_label" => true,
        "heading" => esc_html__("Margin Right(px)", "tz-autoshowroom"),
        "param_name" => "tz_padding_right",
        "description" => "Ex: 50",
        "value" => "",
    )
);

/*
 * VC_GALLERY
 * */

vc_add_param('vc_gallery', array(
        "type" => "dropdown",
        "class" => "",
        "admin_label" => true,
        "heading" => esc_html__("Gallery Type", "tz-autoshowroom"),
        "param_name" => "type",
        "description" => "",
        "value" => array(
            esc_html__("Flex slider fade", "tz-autoshowroom") => 'flexslider_fade',
            esc_html__("Flex slider slide", "tz-autoshowroom") => 'flexslider_slide',
            esc_html__("Nivo slider", "tz-autoshowroom") => 'nivo',
            esc_html__("Owl Carousel", "tz-autoshowroom") => 'owl_carousel',
            esc_html__("Slick slider", "tz-autoshowroom") => 'slickslider',
            esc_html__("Image grid", "tz-autoshowroom") => 'image_grid'),
    )
);

/*
 * VC_GMap
 * */
vc_add_param('vc_gmaps', array(
        "type" => "dropdown",
        "class" => "",
        "admin_label" => true,
        "weight" => -1,
        "heading" => esc_html__("Google Map Type", "tz-autoshowroom"),
        "param_name" => "tz_type",
        "description" => "",
        "value" => array(
            esc_html__("Modern", "tz-autoshowroom") => 'modern',
            esc_html__("Classic", "tz-autoshowroom") => 'classic'),
    )
);

/*
 * VC_TAB
 * */

vc_add_param('vc_tab', array(
        "type" => "textfield",
        "class" => "",
        "admin_label" => true,
        "heading" => esc_html__("Width", "tz-autoshowroom"),
        "param_name" => "tz_width",
        "description" => esc_html__("Insert width( px or % ) of box title. Example: 25% or 250px . Default: 25% ", "tz-autoshowroom"),
        "value" => "",
        "weight" => 1, //  default 0 - unsorted and appended to bottom, 1 - appended to top
    )
);

vc_add_param('vc_tab', array(
        "type" => "attach_image",
        "class" => "",
        "admin_label" => true,
        "heading" => esc_html__("Image Background", "tz-autoshowroom"),
        "param_name" => "tz_image",
        "description" => esc_html__("Upload image background for element.", "tz-autoshowroom"),
        'weight' => 1, //  default 0 - unsorted and appended to bottom, 1 - appended to top
    )
);
vc_add_param('vc_tab', array(
        "type" => "checkbox",
        "class" => "",
        "admin_label" => true,
        "heading" => esc_html__("Add Icon ?", "tz-autoshowroom"),
        "param_name" => "tz_add_icon",
        "description" => esc_html__("Add icon next to section title.", "tz-autoshowroom"),
        "value" => array('Yes' => '1'),
        "weight" => 0, //  default 0 - unsorted and appended to bottom, 1 - appended to top
    )
);
vc_add_param('vc_tab', array(
        "type" => "dropdown",
        "class" => "",
        "admin_label" => true,
        "heading" => esc_html__("Icon Position", "tz-autoshowroom"),
        "param_name" => "tz_icon_position",
        "description" => esc_html__("Select icon position.", "tz-autoshowroom"),
        "value" => array(
            esc_html__("Above title", "tz-autoshowroom") => 'above',
            esc_html__("Under title", "tz-autoshowroom") => 'under',
            esc_html__("Before title", "tz-autoshowroom") => 'before',
            esc_html__("After title", "tz-autoshowroom") => 'after'),
        "weight" => 0, //  default 0 - unsorted and appended to bottom, 1 - appended to top
        "dependency" => Array('element' => "tz_add_icon", 'value' => array('1')),
    )
);
vc_add_param('vc_tab', array(
        "type" => "dropdown",
        "class" => "",
        "admin_label" => true,
        "heading" => esc_html__("Font Icon", "tz-autoshowroom"),
        "param_name" => "tz_font_icon",
        "description" => esc_html__("Select type of icon.", "tz-autoshowroom"),
        "value" => array(
            esc_html__("Furniture", "tz-autoshowroom") => 'furniture',
            esc_html__("Elegant", "tz-autoshowroom") => 'elegant',
            esc_html__("Et Line", "tz-autoshowroom") => 'et-line',
            esc_html__("Font Awesome", "tz-autoshowroom") => 'awesome'),
        "weight" => 0, //  default 0 - unsorted and appended to bottom, 1 - appended to top
        "dependency" => Array('element' => "tz_add_icon", 'value' => array('1')),
    )
);

vc_add_param('vc_tab', array(
        "type" => "textfield",
        "class" => "",
        "admin_label" => true,
        "heading" => esc_html__("Icon", "tz-autoshowroom"),
        "param_name" => "tz_icon",
        "description" => esc_html__(".If you choose font Et Line icon or font Elegant icon,you can see class of icon in package.If you choose Awesome font, you click on link to go to website: http://fontawesome.io/icons ,and choose suitable class. After that you can fill in textbox.Ex: fa-user", "tz-autoshowroom"),
        "value" => "",
        "weight" => 0, //  default 0 - unsorted and appended to bottom, 1 - appended to top
        "dependency" => Array('element' => "tz_add_icon", 'value' => array('1')),
    )
);

/*
 * VC_TTA_TABS
 */

vc_add_param('vc_tta_tabs', array(
        'type' => 'dropdown',
        'param_name' => 'style',
        'value' => array(
            esc_html__('Classic', 'js_composer') => 'classic',
            esc_html__('Modern', 'js_composer') => 'modern',
            esc_html__('Flat', 'js_composer') => 'flat',
            esc_html__('Outline', 'js_composer') => 'outline',
            esc_html__('Normal', 'js_composer') => 'normal',
        ),
        'heading' => esc_html__('Style', 'js_composer'),
        'description' => esc_html__('Select tabs display style.', 'js_composer'),
    )
);

/*
 * VC_PIE
 */

vc_remove_param('vc_pie', 'units');

vc_add_param('vc_pie', array(
        "type" => "dropdown",
        "class" => "",
        "admin_label" => true,
        "weight" => 1,
        "heading" => esc_html__("Pie Chart Style", "tz-autoshowroom"),
        "param_name" => "tz_type",
        "description" => "",
        "value" => array(
            esc_html__("Style 1", "tz-autoshowroom") => '1',
            esc_html__("Style 2", "tz-autoshowroom") => '2'),
    )
);

/*
 * VC_TTA_ACCORDION
 */

vc_add_param('vc_tta_accordion', array(
        'type' => 'dropdown',
        'param_name' => 'style',
        'value' => array(
            __('Classic', 'js_composer') => 'classic',
            __('Normal', 'js_composer') => 'normal',
            __('Modern', 'js_composer') => 'modern',
            __('Flat', 'js_composer') => 'flat',
            __('Outline', 'js_composer') => 'outline',
        ),
        'heading' => __('Style', 'js_composer'),
        'description' => __('Select accordion display style.', 'js_composer'),
    )
);
/*Progress Bar custom*/
vc_add_param('vc_progress_bar', array(
        "type" => "dropdown",
        "class" => "",
        "admin_label" => true,
        "weight" => 1,
        "heading" => esc_html__("Progress Bar", "tz-autoshowroom"),
        "param_name" => "tz_type",
        "description" => "",
        "value" => array(
            esc_html__("Type 1", "tz-autoshowroom") => '1',
            esc_html__("Type 2", "tz-autoshowroom") => '2',
            esc_html__("Type 3", "tz-autoshowroom") => '3'),
    )
);


/***********************************************************************************
 * Class WPBakeryShortCode_Tz_Service
 */
class WPBakeryShortCode_tzservice extends WPBakeryShortCodesContainer
{
}

vc_map(array(
    "name" => "Service",
    "base" => "tzservice",
    "weight" => 1,
    "as_parent" => array('only' => 'tzservice_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "category" => 'TZ AutoShowroom',
    "icon" => "tzvc_icon",

    "show_settings_on_create" => true,
    "params" => array(

        array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Select Type", "tz-autoshowroom"),
            "param_name" => "tz_svtype",
            "description" => "",
            "value" => array(
                esc_html__("Slider", "tz-autoshowroom") => '1',
                esc_html__("Grid", "tz-autoshowroom") => '2'),
            "std" => "1",
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Number Item On Desktop", "tz-autoshowroom"),
            "param_name" => "tz_number_item_desk",
            "description" => "",
            "std"  => "3",
            "value" => array(
                esc_html__("1 item", "tz-autoshowroom") => '1',
                esc_html__("2 item", "tz-autoshowroom") => '2',
                esc_html__("3 item", "tz-autoshowroom") => '3',
                esc_html__("4 item", "tz-autoshowroom") => '4'),
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Number Item On Tablet Landscape", "tz-autoshowroom"),
            "param_name" => "tz_number_item_tablet_landscape",
            "description" => "",
            "std"  => "3",
            "value" => array(
                esc_html__("1 item", "tz-autoshowroom") => '1',
                esc_html__("2 item", "tz-autoshowroom") => '2',
                esc_html__("3 item", "tz-autoshowroom") => '3',
                esc_html__("4 item", "tz-autoshowroom") => '4'),
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Number Item On Tablet Portrait", "tz-autoshowroom"),
            "param_name" => "tz_number_item_tablet_portrait",
            "description" => "",
            "value" => array(
                esc_html__("1 item", "tz-autoshowroom") => '1',
                esc_html__("2 item", "tz-autoshowroom") => '2',
                esc_html__("3 item", "tz-autoshowroom") => '3',
                esc_html__("4 item", "tz-autoshowroom") => '4'),
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Number Item On Mobile", "tz-autoshowroom"),
            "param_name" => "tz_number_item_mobile",
            "description" => "",
            "value" => array(
                esc_html__("1 item", "tz-autoshowroom") => '1',
                esc_html__("2 item", "tz-autoshowroom") => '2',
                esc_html__("3 item", "tz-autoshowroom") => '3',
                esc_html__("4 item", "tz-autoshowroom") => '4'),
        ),
        array(
            "type" => "checkbox",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Auto Play", "tz-autoshowroom"),
            "param_name" => "tz_auto_option",
            "description" => "",
            "value" => "",
            "dependency" => array('element' => 'tz_svtype', 'value' => array('1')),
        ),

        array(
            "type" => "checkbox",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Slider Loop", "tz-autoshowroom"),
            "param_name" => "tz_loop_option",
            "description" => "",
            "value" => "",
            "dependency" => array('element' => 'tz_svtype', 'value' => array('1')),
        ),

        array(
            "type" => "checkbox",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Show next/prev buttons", "tz-autoshowroom"),
            "param_name" => "tz_nav_option",
            "description" => "",
            "value" => "",
            "dependency" => array('element' => 'tz_svtype', 'value' => array('1')),
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Css Animation", "tz-autoshowroom"),
            "param_name" => "tz_css_animation",
            "description" => "",
            "value" => array(
                esc_html__("No animation", "tz-autoshowroom") => '',
                esc_html__("Top to bottom", "tz-autoshowroom") => 'top-to-bottom',
                esc_html__("Bottom to top", "tz-autoshowroom") => 'bottom-to-top',
                esc_html__("Left to right", "tz-autoshowroom") => 'left-to-right',
                esc_html__("Right to left", "tz-autoshowroom") => 'right-to-left',
                esc_html__("Appear from center", "tz-autoshowroom") => 'appear'),
        ),
    ),
    "js_view" => 'VcColumnView'
));

class WPBakeryShortCode_tzservice_item extends WPBakeryShortCode
{
}

vc_map(array(
    "name" => "Service Item",
    "base" => "tzservice_item",
    "icon" => "icon-element",
    "category" => 'TZ AutoShowroom',
    "icon" => "tzvc_icon",
    "allowed_container_element" => 'vc_row',
    "as_child" => array('only' => 'tzservice'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
        array(
            "type" => "attach_image",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Image Service", "tz-autoshowroom"),
            "param_name" => "tz_image",
            "description" => esc_html__("Upload image for Service.", "tz-autoshowroom"),
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Title", "tz-autoshowroom"),
            "param_name" => "tz_title",
            "value" => "",
        ),

        array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Description Field Type", "tz-autoshowroom"),
            "param_name" => "tz_description_type",
            "description" => esc_html__("Select Field type ( Textarea field or Editor field )", "tz-autoshowroom"),
            "value" => array(
                esc_html__("Textarea Field", "tz-autoshowroom") => 'textarea',
                esc_html__("Editor Field", "tz-autoshowroom") => 'editor')
        ),

        array(
            "type" => "textarea",
            "class" => "",
            "heading" => esc_html__("Description", "tz-autoshowroom"),
            "param_name" => "tz_description",
            "value" => "",
            "dependency" => Array('element' => "tz_description_type", 'value' => array('textarea')),
        ),

        array(
            "type" => "textarea_html",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Description", "tz-autoshowroom"),
            "param_name" => "content",
            "value" => "",
            "dependency" => Array('element' => "tz_description_type", 'value' => array('editor')),
        ),

        array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Option Readmore", "tz-autoshowroom"),
            "param_name" => "tz_option_readmore",
            "description" => esc_html__("You can choose show or hide button readmore.", "tz-autoshowroom"),
            "value" => array(
                esc_html__("Show", "tz-autoshowroom") => 'show',
                esc_html__("Hide", "tz-autoshowroom") => 'hide')
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Readmore Text", "tz-autoshowroom"),
            "param_name" => "tz_readmore_text",
            "value" => "",
            "dependency" => Array('element' => "tz_option_readmore", 'value' => array('show')),
        ),

        array(
            "type" => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading" => esc_html__("Readmore Link", "tz-autoshowroom"),
            "param_name" => "tz_readmore_link",
            "value" => "",
            "dependency" => Array('element' => "tz_option_readmore", 'value' => array('show')),
        ),
    )
));

vc_add_shortcode_param('my_param', 'my_param_settings_field');
function my_param_settings_field($settings, $value)
{
    return '<div class="my_param_block">'
        . '<input name="' . esc_attr($settings['param_name']) . '" class="wpb_vc_param_value wpb-textinput ' .
        esc_attr($settings['param_name']) . ' ' .
        esc_attr($settings['type']) . '_field" type="text" value="' . esc_attr($value) . '" />' .
        '</div>'; // This is html markup that will be outputted in content elements edit form
}

?>