<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
vc_map( array(
    'name' => esc_html__( 'Count Down', 'tz-autoshowroom' ),
    'base' => 'tel_countdown',
    'class' => 'tel-countdown',
    'show_settings_on_create' => true,
    "icon" => "tzvc_icon",
    'category' => esc_html__( 'TZ AutoShowroom', 'tz-autoshowroom'),
    'params' => array(

        // Timer coundown setting

        // Year
        array(
            'type' => 'textfield',
            'class' => '',
            'admin_label' => true,
            'heading' => esc_html__( 'Year', 'tz-autoshowroom' ),
            'param_name' => 'tel_countdown_year',
            'description' => esc_html__( 'Eg: 2020', 'tz-autoshowroom' ),
            "value"         => '2020',
        ),
        // Month
        array(
            'type' => 'dropdown',
            'class' => '',
            'admin_label' => true,
            'heading' => esc_html__( 'Month', 'tz-autoshowroom' ),
            'param_name' => 'tel_countdown_month',
            'description' => esc_html__( '', 'tz-autoshowroom' ),
            "value"         => array(
                "January"   => "Jan",
                "February"  => "Feb",
                "March"     => "Mar",
                "April"     => "Apr",
                "May"       => "May",
                "June"      => "Jun",
                "July"      => "Jul",
                "August"    => "Aug",
                "September" => "Sep",
                "October"   => "Oct",
                "November"  => "Nov",
                "December"  => "Dec"
            )
        ),
        // Day
        array(
            'type' => 'textfield',
            'class' => '',
            'admin_label' => true,
            'heading' => esc_html__( 'Day', 'tz-autoshowroom' ),
            'param_name' => 'tel_countdown_day',
            'description' => esc_html__( 'Max: 31', 'tz-autoshowroom' ),
            "value"         => '1',
        ),
        // Hour
        array(
            'type' => 'textfield',
            'class' => '',
            'admin_label' => true,
            'heading' => esc_html__( 'Hour', 'tz-autoshowroom' ),
            'param_name' => 'tel_countdown_hour',
            'description' => esc_html__( 'Max: 24', 'tz-autoshowroom' ),
            "value"         => '1',
        ),
        // Minute
        array(
            'type' => 'textfield',
            'class' => '',
            'admin_label' => true,
            'heading' => esc_html__( 'Minute', 'tz-autoshowroom' ),
            'param_name' => 'tel_countdown_minute',
            'description' => esc_html__( 'Max: 60', 'tz-autoshowroom' ),
            "value"         => '1',
        ),
        // Second
        array(
            'type' => 'textfield',
            'class' => '',
            'admin_label' => true,
            'heading' => esc_html__( 'Second', 'tz-autoshowroom' ),
            'param_name' => 'tel_countdown_second',
            'description' => esc_html__( 'Max: 60', 'tz-autoshowroom' ),
            "value"         => '1',
        ),
    )
) );