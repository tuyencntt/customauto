<?php
/**
 * Initialize the meta boxes.
 */

add_action( 'admin_init', 'autoshowroom_custom_meta_boxes');

/*
 * Methor add meta boxes for custom post type
 */
function autoshowroom_get_sidebars(){
    $autoshowroom_sidebar = array();
     foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
         array_push($autoshowroom_sidebar, array(
             'value'=> $sidebar['id'],
             'label'=>$sidebar['name'],
         ));
     }
    return $autoshowroom_sidebar;
}
function autoshowroom_custom_meta_boxes(){

    /**
     * Create a custom meta boxes array that we pass to
     * the OptionTree Meta Box API Class.
     */

    $autoshowroom_page_option =   array(
        'id'          =>  'autoshowrom_page_option_meta_box',
        'title'       =>  esc_html__('Page Options', 'autoshowroom'),
        'desc'        =>  '',
        'pages'       => array( 'page'),
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            array(
                'label'     => esc_html__('Breadcrumb Background Image', 'autoshowroom'),
                'id'        => 'autoshowroom_page_title_image',
                'type'      => 'upload',
                'desc'      => ''
            ),
            array(
                'id' => 'autoshowroom_footer_type',
                'label' => esc_html__('Footer Type', 'autoshowroom'),
                'desc' => esc_html__('Please choose type of footer', 'autoshowroom'),
                'std' => 'type1',
                'type' => 'select',
                'section' => 'footeroption',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => 'type1',
                        'label' => esc_html__('Type 1', 'autoshowroom'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'type2',
                        'label' => esc_html__('Type 2', 'autoshowroom'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'type3',
                        'label' => esc_html__('Type 3', 'autoshowroom'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'type4',
                        'label' => esc_html__('Type 4', 'autoshowroom'),
                        'src' => ''
                    ),
                    array(
                        'value' => 'type5',
                        'label' => esc_html__('Type 5', 'autoshowroom'),
                        'src' => ''
                    )
                ),
            ),

        ) // end fields
    );


    $autoshowroom_sidebar_option=   array(
        'id'          =>  'autoshowrom_sidebar_option_meta_box',
        'title'       =>  esc_html__('Section Sidebar', 'autoshowroom'),
        'desc'        =>  '',
        'pages'       => array( 'page'),
        'context'     => 'side',
        'priority'    => 'low',
        'fields'      => array(
            array(
                'label'     => esc_html__('SideBar Position', 'autoshowroom'),
                'id'        => 'autoshowroom_sidebar_option_choose',
                'type'      => 'select',
                'choices'   =>  array(
                    array(
                        'value' =>  0,
                        'label' =>   esc_html__('None', 'autoshowroom'),
                    ),
                    array(
                        'value' =>  1,
                        'label' =>   esc_html__('Left', 'autoshowroom'),
                    ),
                    array(
                        'value' =>  2,
                        'label' =>   esc_html__('Right', 'autoshowroom'),
                    ),
                )
            ),
            array(
                'label'     => esc_html__('Select SideBar', 'autoshowroom'),
                'id'        => 'autoshowroom_sidebar_name',
                'type'      => 'select',
                'choices'   => autoshowroom_get_sidebars()

            ),
        ),
    );

    $autoshowroom_contact_option=   array(
        'id'          =>  'autoshowrom_contact_option_meta_box',
        'title'       =>  esc_html__('Section Contact Option', 'autoshowroom'),
        'desc'        =>  '',
        'pages'       => array( 'page'),
        'context'     => 'side',
        'priority'    => 'low',
        'fields'      => array(
            array(
                'label'     => esc_html__('Background Image', 'autoshowroom'),
                'id'        => 'autoshowroom_contact_option_bgimage',
                'type'      => 'upload',
                'desc'      => ''
            ),
            array(
                'label'     => esc_html__('Message Contact', 'autoshowroom'),
                'id'        => 'autoshowroom_contact_option_message',
                'type'      => 'textarea',
                'desc'      => '',
                'std'       => '',
                'rows'      => '',
                'post_type' => '',
                'taxonomy'  => ''
            ),
            array(
                'label'     => esc_html__('Button Text', 'autoshowroom'),
                'id'        => 'autoshowroom_contact_option_button_text',
                'type'      => 'text',
                'desc'      => '',
                'std'       => '',
                'rows'      => '',
                'post_type' => '',
                'taxonomy'  => '',
            ),
            array(
                'label'     => esc_html__('Button Link', 'autoshowroom'),
                'id'        => 'autoshowroom_contact_option_button_link',
                'type'      => 'text',
                'desc'      => '',
                'std'       => '',
                'rows'      => '',
                'post_type' => '',
                'taxonomy'  => '',
            ),
        ) // end fields
    );

    $autoshowroom_vehicle_fields =   array(
        'id'          =>  'autoshowrom_page_option_meta_box',
        'title'       =>  esc_html__('Vehicle Options', 'autoshowroom'),
        'desc'        =>  '',
        'pages'       => array( 'vehicle'),
        'context'     => 'side',
        'priority'    => 'low',
        'fields'      => array(
            array(
                'label'     => esc_html__('Stock Number Manually', 'autoshowroom'),
                'id'        => 'autoshowroom_stock_number_manually',
                'type'      => 'text',
                'desc'      => '',
                'std'       => '',
            ),
            array(
                'label'     => esc_html__('Vehicle Brochure', 'autoshowroom'),
                'id'        => 'autoshowroom_vehicle_brochure',
                'type'      => 'upload',
                'desc'      => ''
            ),
            array(
                'id'        =>  'autoshowroom_vehicle_sold',
                'label'     =>  esc_html__('Vehicle Sold', 'autoshowroom'),
                'desc'      =>  '',
                'sdt'       =>  'no',
                'type'      =>  'radio',
                'class'     =>  '',
                'choices'   =>  array(
                    array(
                        'value' =>  'upcoming',
                        'label' =>   esc_html__('Upcoming', 'autoshowroom'),
                    ),
                    array(
                        'value' =>  'sold',
                        'label' =>   esc_html__('Sold', 'autoshowroom'),
                    ),
                    array(
                        'value' =>  'no',
                        'label' =>   esc_html__('None', 'autoshowroom'),
                    ),

                )
            ),
            array(
                'id'        =>  'autoshowroom_vehicle_status',
                'label'     =>  esc_html__('Vehicle Status', 'autoshowroom'),
                'desc'      =>  '',
                'sdt'       =>  'sale',
                'type'      =>  'radio',
                'class'     =>  '',
                'choices'   =>  array(
                    array(
                        'value' =>  'rent',
                        'label' =>   esc_html__('For Rent', 'autoshowroom'),
                    ),
                    array(
                        'value' =>  'sale',
                        'label' =>   esc_html__('For Sale', 'autoshowroom'),
                    )
                )
            ),

        ) // end fields
    );

    $autoshowroom_agency_meta_box =   array(
        'id'          =>  'autoshowroom_agency_meta_box',
        'title'       =>  esc_html__('Agency Option', 'autoshowroom'),
        'desc'        =>  '',
        'pages'       => array( 'agency'),
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(

            array(
                'label'     => esc_html__('Map', 'autoshowroom'),
                'id'        => 'autoshowroom_agency_map',
                'type'      => 'textarea',
                'desc'      => '',
                'std'       => '',
                'rows'      => '',
                'post_type' => '',
                'taxonomy'  => ''
            ),
            array(
                'label'     => esc_html__('Address', 'autoshowroom'),
                'id'        => 'autoshowroom_agency_address',
                'type'      => 'text',
                'desc'      => '',
                'std'       => '',
                'rows'      => '',
                'post_type' => '',
                'taxonomy'  => ''
            ),
            array(
                'label'     => esc_html__('Phone', 'autoshowroom'),
                'id'        => 'autoshowroom_agency_phone',
                'type'      => 'text',
                'desc'      => '',
                'std'       => '',
                'rows'      => '',
                'post_type' => '',
                'taxonomy'  => ''
            ),
            array(
                'label'     => esc_html__('Email', 'autoshowroom'),
                'id'        => 'autoshowroom_agency_email',
                'type'      => 'text',
                'desc'      => '',
                'std'       => '',
                'rows'      => '',
                'post_type' => '',
                'taxonomy'  => ''
            ),
            array(
                'label'     => esc_html__('Department', 'autoshowroom'),
                'id'        => 'autoshowroom_agency_sales_department',
                'type'      => 'text',
                'desc'      => '',
                'std'       => '',
                'rows'      => '',
                'post_type' => '',
                'taxonomy'  => ''
            ),
            array(
                'label'     => esc_html__('Service', 'autoshowroom'),
                'id'        => 'autoshowroom_agency_service_department',
                'type'      => 'text',
                'desc'      => '',
                'std'       => '',
                'rows'      => '',
                'post_type' => '',
                'taxonomy'  => ''
            ),
            array(
                'label'     => esc_html__('Rate', 'autoshowroom'),
                'id'        => 'autoshowroom_agency_rate',
                'type'      => 'text',
                'desc'      => 'Rate from 0 to 5. Example : 4',
                'std'       => '',
                'rows'      => '',
                'post_type' => '',
                'taxonomy'  => ''
            ),

            array(
                'id'        =>  'autoshowroom_agency_sidebar',
                'label'     =>  esc_html__('Sidebar Option', 'autoshowroom'),
                'desc'      =>  '',
                'sdt'       =>  'no',
                'type'      =>  'select',
                'class'     =>  '',
                'choices'   =>  array(
                    array(
                        'value' =>  1,
                        'label' =>   esc_html__('Show', 'autoshowroom'),
                    ),
                    array(
                        'value' =>  0,
                        'label' =>   esc_html__('Hide', 'autoshowroom'),
                    ),
                )
            ),
        )
    );

    /**
     * Register our meta boxes using the
     * ot_register_meta_box() function.
     */

    ot_register_meta_box( $autoshowroom_vehicle_fields );
    ot_register_meta_box( $autoshowroom_page_option );
    ot_register_meta_box( $autoshowroom_sidebar_option );
    ot_register_meta_box( $autoshowroom_contact_option );
    ot_register_meta_box( $autoshowroom_agency_meta_box );
}
?>