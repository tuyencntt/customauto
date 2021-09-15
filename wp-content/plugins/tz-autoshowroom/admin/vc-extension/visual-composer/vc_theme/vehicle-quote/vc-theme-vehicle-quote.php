<?php
if ( is_user_logged_in() ) {
    add_action('wp_ajax_vehicle_quotes_ajax_action','vehicle_quotes_ajax_action');
}else{
    add_action('wp_ajax_nopriv_vehicle_quotes_ajax_action','vehicle_quotes_ajax_action');
}
function vehicle_quotes_ajax_action(){
    $autoshowroom_send_admin        =   ot_get_option('autoshowroom_send_admin','');
    $autoshowroom_send_customer     =   ot_get_option('autoshowroom_send_customer','');
    $autoshowroom_send_title     =   ot_get_option('autoshowroom_send_title','');
    $autoshowroom_send_content     =   ot_get_option('autoshowroom_send_content','');
    $autoshowroom_send_from     =   ot_get_option('autoshowroom_send_from','');
    $autoshowroom_send_cc     =   ot_get_option('autoshowroom_send_cc','');
    $autoshowroom_send_bcc     =   ot_get_option('autoshowroom_send_bcc','');

    $blogtime = current_time( 'mysql' );
    $google_cap = $_POST['google_cap'];
    $cus_name = $_POST['cus_name'];
    $cus_message = $_POST['cus_message'];
    $cus_info = array(
        "cus_phone" => $_POST['cus_phone'],
        "cus_email" => $_POST['cus_email'],
    );

    $car_info = array(
        "vehicle_type" => $_POST['vehicle_type'],
        "vehicle_make" => $_POST['vehicle_make'],
        "vehicle_model" => $_POST['vehicle_model'],
        "vehicle_date" => $_POST['vehicle_date'],
        "vehicle_mileage" => $_POST['vehicle_mileage'],
        "date" => $blogtime,
    );
    if(empty($google_cap)){?>
        <div class="error"><?php echo esc_html__('Please check captcha!','tz-autoshowroom');?></div>
        <?php
    }else{
        if($autoshowroom_send_customer == 'yes') {
            $autoshowroom_multimail = array(
                $autoshowroom_send_admin,
                $cus_info['cus_email'],
            );
        }else{
            $autoshowroom_multimail = array(
                $autoshowroom_send_admin,
            );
        }
        $headers[] = 'Content-Type: text/html; charset=UTF-8';
        if($autoshowroom_send_cc != ''){
            $headers[] = 'Cc:'.$autoshowroom_send_cc ;
        }
        if($autoshowroom_send_bcc != ''){
            $headers[] = 'Bcc:'.$autoshowroom_send_bcc;
        }

        wp_mail(
            $autoshowroom_multimail,
            esc_html__('Get A Quote','tz-autoshowroom'),
            '<h3 style="text-align: center;">'. esc_html($autoshowroom_send_title) .'</h3></br>
                                <p> '. $autoshowroom_send_content . '</p> 
                                <table width="100%" style="border: 1px solid #000;">
                                 <tr>
                                    <th>' . esc_html__("Vehicle Type","tz-autoshowroom") . '</th>
                                    <th>' . esc_html__("Make","tz-autoshowroom") . '</th>
                                    <th>' . esc_html__("Model","tz-autoshowroom") . '</th>
                                    <th>' . esc_html__("Mileage","tz-autoshowroom") . '</th>
                                    <th>' . esc_html__("Date","tz-autoshowroom") . '</th>
                                    <th>' . esc_html__("Name","tz-autoshowroom") . '</th> 
                                    <th>' . esc_html__("Phone","tz-autoshowroom") . '</th>                                 
                                    <th>' . esc_html__("Email","tz-autoshowroom") . '</th> 
                                    <th>' . esc_html__("Massage","tz-autoshowroom") . '</th>
                                 </tr>
                                 <tr style="text-align: center;">
                                    <td>' . $car_info['vehicle_type'] .'</td>                                                                                                                                                  </td>
                                    <td>' . $car_info['vehicle_make'] .'</td>
                                    <td>' . $car_info['vehicle_model'] .'</td>
                                    <td>' . $car_info['vehicle_mileage'] .'</td>
                                    <td>' . $car_info['vehicle_date'] .'</td>
                                    <td>' . $cus_name .'</td>
                                    <td>' . $cus_info['cus_phone'] .'</td>
                                    <td>' . $cus_info['cus_email'] .'</td>      
                                    <td>' . $cus_message .'</td>                                                                     
                                 </tr>
                               </table>',$headers

        );
        global $wpdb;
        $table_name = $wpdb->prefix . "vehicle_quotes";
        $quote_query ="insert into ".$table_name." (name,status,options,car_values,message) values('".$cus_name."','0','".serialize($cus_info)."','".serialize($car_info)."','".$cus_message."')";
        $wpdb->query($quote_query);
        echo '<div class="sucess">' . esc_html__("Success, Thanks for submit!","tz-autoshowroom") . '</div>';
    }
    ?>

    <?php
    exit();
}
function autoshowroom_get_quote_fields(){
    $auto_fields= array('vehicle_type','make','model','registration','milage','condition','color','interior','transmission','engine','drivetrain',
        'horsepower','fuel','keyword','order');
    $result= array();
    foreach ( $auto_fields as $auto_field )	{
        $result[] = array(
            'value' => $auto_field,
            'label' => $auto_field
        );
    }
    return $result;
}
vc_map( array(
    'name'      =>  'Vehicle Quotes Form',
    'base'      =>  'autoshowroom-vehicle-quote',
    'icon'      =>  'tzvc_icon',
    'weight'    => 1,
    'category'  =>  'TZ AutoShowroom',
    'params'    =>  array(
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  esc_html__('Title','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_search_title',
            'value'         =>  ''
        ),
        array(
            'type'          =>  'checkbox',
            'holder'        =>  '',
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Quotes Fields','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_quote_fields',
            'value'         =>  array(
                'Vehicle Type'  =>  'vehicle_type',
                'Make'          =>  'make',
                'Model'         =>  'model',
            )
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  esc_html__('Button Submit','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_button_submit',
            'value'         =>  ''
        ),
        array(
            'type'          =>  'dropdown',
            'holder'        =>  '',
            'heading'       =>  esc_html__('Captcha Settings','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_show_captcha',
            'value'         =>  array(
                'Show'          =>  'true',
                'Hide'          =>  'false'
            )
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  esc_html__('Key Google Captcha','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_captcha_key',
            'value'         =>  '',
            'dependency'    => array('element' => 'autoshowroom_show_captcha', 'value' => 'true'),
        ),
    )
) );
?>