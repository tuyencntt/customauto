<?php
/*
 * Element Post Slider
 * */
$tz_categories_array = array();
$tz_categories_array[] = 'choose category';
$tz_categories = get_categories();
foreach($tz_categories as $tz_category){
        $tz_categories_array[] = $tz_category->name;
}

function autoshowroom_get_post_data( $post_type = 'post' ) {
        $posts = get_posts( array(
            'posts_per_page' 	=> -1,
            'post_type'			=> $post_type,
        ));
        $result = array();
        foreach ( $posts as $post )	{
                $result[] = array(
                    'value' => $post->ID,
                    'label' => $post->post_title,
                );
        }
        return $result;
}

vc_map( array(
    "name"          => __("Post Slider", "js_composer"),
    "icon"          => "tzvc_icon",
    "base"          => "autoshowroom-post-slider",
    "weight"        => 1,
    "description"   => "",
    "class"         => "autoshowroom_post_slider",
    "category"      => __("TZ AutoShowroom", "js_composer"),
    "params"        => array(
        array(
            'type'          =>  'dropdown',
            'admin_label'   =>  true,
            'heading'       =>  esc_html__('Post Style','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_post_style',
            'value'         =>  array(
                'Style 1'        =>  'style1',
                'Style 2'        =>  'style2'
            ),
            "group"         => "Post Option"
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Type Get Post", "js_composer"),
            "param_name"    => "autoshowroom_type_get_post",
            "value"         => array(
                __("Category", "js_composer")   => "category",
                __("All Post", "js_composer")   => "post"),
            "description"   => __("", "js_composer"),
            "group" => "Post Option",
            "dependency"    => array('element' => 'autoshowroom_post_style', 'value' => array('style1')),
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Category", "js_composer"),
            "param_name"    => "autoshowroom_category",
            "value"         => $tz_categories_array,
            "description"   => __("Choose category.", "js_composer"),
            "dependency"    => array('element' => 'autoshowroom_type_get_post', 'value' => array('category')),
            "group"         => "Post Option",
        ),
        array(
            'type'          => 'autocomplete',
            'heading'       => __( 'Include Post', 'tz-autoshowroom' ),
            'param_name'    => 'autoshowroom_post',
            'admin_label'   =>  true,
            'description'   => __( 'Add Post by title.', 'tz-autoshowroom' ),
            'settings'      => array(
                'multiple'  => true,
                'sortable'  => true,
                'groups'    => true,
                'values'    => autoshowroom_get_post_data()
            ),
            "dependency"    => array('element' => 'autoshowroom_type_get_post', 'value' => array('post')),
            "group"         => "Post Option",
        ),
        array(
            "type"          => "textfield",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Limit Post", "js_composer"),
            "param_name"    => "autoshowroom_limit",
            "value"         => "",
            "dependency"    => array(
                'element' => 'autoshowroom_type_get_post', 'value' => array('category'),
            ),
            "group"         => "Post Option",
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  esc_html__('Limit Description','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_post_description_limit',
            'value'         =>  80,
            "group"         => "Post Option",
        ),
        array(
            "type"       => "textfield",
            "class" => "",
            "admin_label" => true,
            "heading"    => esc_html__("Image Size", "tz-autoshowroom"),
            "param_name" => "tz_size",
            "description"   => esc_html__("Enter image size. Example: thumbnail, medium, large, full. Leave empty to use \"large\" size.", "tz-autoshowroom"),
            "value" => "",
            "group"         => "Post Option",
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Order by", "js_composer"),
            "param_name"    => "autoshowroom_orderby",
            "value"         => array(
                __("choose order by", "js_composer")        => '',
                __("Date", "js_composer")                   => 'date',
                __("ID", "js_composer")                     => "id",
                __("Title", "js_composer")                  => "title"),
            "description"   => __("", "js_composer"),
            "dependency"    => array('element' => 'autoshowroom_type_get_post', 'value' => array('category')),
            "group"         => "Post Option",
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Order", "js_composer"),
            "param_name"    => "autoshowroom_order",
            "value"         => array(
                __("choose order", "js_composer")       => 'Z --> A',
                __("desc", "js_composer")               => 'Z --> A',
                __("asc", "js_composer")                => "A --> Z"),
            "description"   => __("", "js_composer"),
            "dependency"    => array('element' => 'autoshowroom_type_get_post', 'value' => array('category')),
            "group"         => "Post Option",
        ),

        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Next/Preview", "js_composer"),
            "param_name"    => "autoshowroom_carousel_button",
            "value"         => array(
                __("Show", "js_composer")   => "true",
                __("Hide", "js_composer")   => "false"),
            "description"   => __("", "js_composer"),
            "group" => "Slider Option",
        ),

        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Navigation", "js_composer"),
            "param_name"    => "autoshowroom_carousel_dot",
            "value"         => array(
                __("Show", "js_composer")   => "true",
                __("Hide", "js_composer")   => "false"),
            "description"   => __("", "js_composer"),
            "group" => "Slider Option",
        ),

        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Autoplay", "js_composer"),
            "param_name"    => "autoshowroom_carousel_autoplay",
            "value"         => array(
                __("Yes", "js_composer")   => "true",
                __("No", "js_composer")   => "false"),
            "description"   => __("", "js_composer"),
            "group" => "Slider Option",
        ),

        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Loop", "js_composer"),
            "param_name"    => "autoshowroom_carousel_loop",
            "value"         => array(
                __("Yes", "js_composer")   => "true",
                __("No", "js_composer")   => "false"),
            "description"   => __("", "js_composer"),
            "group" => "Slider Option",
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
            "group" => "Slider Option",
        ),
    )
));
?>