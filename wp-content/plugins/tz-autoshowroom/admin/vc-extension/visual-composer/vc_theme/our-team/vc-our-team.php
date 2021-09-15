<?php
/**
 * Created by PhpStorm.
 * User: HN
 * Date: 03/18/19
 * Time: 09:09 AM
 */

vc_map( array(
    "name"                      =>  "Our Team",
    "base"                      =>  "tz_our_team",
    "icon"                      =>  "tzvc_icon",
    "category"                  =>  'TZ AutoShowroom',
    "allowed_container_element" =>  'vc_row',
    "params"                    =>  array(
        array(
            "type"          =>  "attach_image",
            "heading"       =>  esc_html__("Image Nember", "tz-autoshowroom"),
            "param_name"    =>  "member_image",
            "description"   =>  esc_html__("Upload image of member in team.", "tz-autoshowroom"),
            "group"         =>  esc_html__("Member","tz-autoshowroom"),
        ),
        array(
            "type"          =>  "textfield",
            "class"         =>  "",
            "heading"       =>  "Employment",
            "param_name"    =>  "employment",
            "group"         =>  esc_html__("Member","tz-autoshowroom"),
        ),
        array(
            "type"          =>  "textfield",
            "class"         =>  "",
            "heading"       =>  "Name",
            "param_name"    =>  "name",
            "group"         =>  esc_html__("Member","tz-autoshowroom"),
        ),
        array(
            "type"          =>  "textarea_html",
            "heading"       =>  "Content",
            "param_name"    =>  "content",
            "value"         =>  "",
            "description"   =>  "Show on click light box",
            "group"         =>  esc_html__("Member","tz-autoshowroom"),
        ),
        array(
            "type"          =>  "checkbox",
            "class"         =>  "",
            "heading"       =>  "",
            "param_name"    =>  "open_link",
            "value"         =>  array(
                'Open link in  a new window/tab'    =>  'link_target'
            ),
            "group"         => esc_html__("Social Network","tz-autoshowroom"),
        ),
        array(
            "type"          => "textfield",
            "class"         =>  "",
            "heading"       =>  esc_html__("Facebook Url","tz-autoshowroom"),
            "param_name"    =>  "facebook_url",
            "value"         =>  "",
            "group"         =>  esc_html__("Social Network","tz-autoshowroom"),
        ),
        array(
            "type"          => "textfield",
            "class"         =>  "",
            "heading"       =>  esc_html__("Twitter Url","tz-autoshowroom"),
            "param_name"    =>  "twitter_url",
            "value"         =>  "",
            "group"         =>  esc_html__("Social Network","tz-autoshowroom"),
        ),
        array(
            "type"          => "textfield",
            "class"         =>  "",
            "heading"       =>  esc_html__("Flickr Url","tz-autoshowroom"),
            "param_name"    =>  "flickr_url",
            "value"         =>  "",
            "group"         =>  esc_html__("Social Network","tz-autoshowroom"),
        ),
        array(
            "type"          => "textfield",
            "class"         =>  "",
            "heading"       =>  esc_html__("GooglePlus Url","tz-autoshowroom"),
            "param_name"    =>  "googleplus_url",
            "value"         =>  "",
            "group"         =>  esc_html__("Social Network","tz-autoshowroom"),
        ),
        array(
            "type"          => "textfield",
            "class"         =>  "",
            "heading"       =>  esc_html__("Skype Url","tz-autoshowroom"),
            "param_name"    =>  "skype_url",
            "value"         =>  "",
            "group"         =>  esc_html__("Social Network","tz-autoshowroom"),
        ),
        array(
            "type"          =>  "textfield",
            "class"         =>  "",
            "heading"       =>  "Phone",
            "param_name"    =>  "phone",
            "group"         =>  esc_html__("Member","tz-autoshowroom"),
        ),
        array(
            "type"          =>  "textfield",
            "class"         =>  "",
            "heading"       =>  "Email",
            "param_name"    =>  "email",
            "group"         =>  esc_html__("Member","tz-autoshowroom"),
        ),
    )
) );