<?php

vc_map( array(
    "name" => __("Post Column", "js_composer"),
    "weight" => 14,
    "base" => "autoshowroom-blog",
    "icon" => "tzvc_icon",
    "description" => "",
    "class" => "autoshowroom_blog",
    "category" => esc_html__("TZ AutoShowroom", "js_composer"),
    "params" => array(
        array(
            "type"          =>  "dropdown",
            "heading"       =>  "Blog Style",
            "param_name"    =>  "blog_style",
            "value"         =>  array (
                esc_html__("Style 1", "aventura-plugin")    => 1,
                esc_html__("Style 2", "aventura-plugin")    => 2,
                esc_html__("Style 3", "aventura-plugin")    => 3,
                esc_html__("Style 4", "aventura-plugin")    => 4,
            ),
        ),

        array(
            "type"          =>  "dropdown",
            "heading"       =>  "Get Posts",
            "param_name"    =>  "get_posts",
            "value"         =>  array (
                esc_html__("Category Post", "aventura-plugin") => 1,
                esc_html__("Title Post", "aventura-plugin")    => 2,
            ),
        ),

        array(
            "type"          => "checkbox",
            "heading"       => esc_html__("Category Post", "aventura-plugin"),
            "param_name"    => "cate_post",
            "value"         => tz_autoshowroom_check_get_cat( 'category' ),
            "dependency"    =>  array('element' => "get_posts", 'value' => array( '1','4' ) ),
        ),

        array(
            "type"          =>  "autocomplete",
            "heading"       =>  esc_html__("Include Title Post", "aventura-plugin"),
            "param_name"    =>  "get_title_post",
            "description"   =>  "Add Post by title.",
            "settings"      =>  array(
                'multiple'  =>  true,
                'sortable'  =>  true,
                'groups'    =>  true,
                'values'    =>  tz_autoshowroom_get_title_data( 'post' )
            ),
            "dependency"    =>  array('element' => "get_posts", 'value' => array( '2' ) ),
        ),

        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Limit Post","aventura-plugin"),
            "param_name"    => "limit",
            "value"         => 2,
            "dependency"    =>  array('element' => "get_posts", 'value' => array( '1','4' ) ),
        ),

        array(
            "type"          =>  "dropdown",
            "heading"       =>  "Select column",
            "param_name"    =>  "blog_column",
            "value"         =>  array (
                esc_html__("2", "aventura-plugin")     => '2',
                esc_html__("3", "aventura-plugin")     => '3',
                esc_html__("4", "aventura-plugin")     => '4',
            ),
        ),

        array(
            "type"          =>  "dropdown",
            "heading"       =>  "Order By",
            "param_name"    =>  "order_by",
            "value"         =>  array (
                esc_html__("ID", "aventura-plugin")     => 'id',
                esc_html__("Title", "aventura-plugin")  => 'title',
                esc_html__("Name", "aventura-plugin")   => 'name',
                esc_html__("Date", "aventura-plugin")   => 'date'
            ),
        ),

        array(
            "type"          =>  "dropdown",
            "heading"       =>  "Order",
            "param_name"    =>  "order",
            "value"         =>  array (
                esc_html__("ASC", "aventura-plugin")   => 'ASC',
                esc_html__("DESC", "aventura-plugin")  => 'DESC',
            ),
        ),
    )
) );

?>