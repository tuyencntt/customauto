<?php
/*
 * Element Tz Portfolio Grid
 * */


$vehicle_cat = array();
$taxonomies = 'make';
$vehicle_portfolio = get_terms( $taxonomies );
if ( !empty($vehicle_portfolio) ) {
    foreach ($vehicle_portfolio as $cat){
        $vehicle_cat[$cat->name] = $cat->term_id;
    }
}
function autoshowroom_portfolio_get_fields_sold(){
    global $car_dealer;
    if ( is_plugin_active( 'progression-car-dealer-master/progression-car-dealer.php' ) ) {
        $fields = $car_dealer->fields->get_registered_fields('specs');
        $auto_portfolio_fields = array();
        foreach ($fields as $field) {
            $auto_portfolio_fields[$field['label']] = $field['name'];
        }
        return $auto_portfolio_fields;
    }
}
if ( is_user_logged_in() ) {
    add_action('wp_ajax_tz_autoshowroom_portfolio_ajax_sold','tz_autoshowroom_portfolio_ajax_sold');
}else{
    add_action('wp_ajax_nopriv_tz_autoshowroom_portfolio_ajax_sold','tz_autoshowroom_portfolio_ajax_sold');
}
function tz_autoshowroom_portfolio_ajax_sold(){
    $makeID = $_POST['makeID'];
    $limit = $_POST['limit'];
    $order = $_POST['order'];
    $orderBy = $_POST['orderBy'];
    $makeID_arr = explode(',',$makeID);
    $time_args = array(
        'post_type'         =>  'vehicle',
        'posts_per_page'    =>  $limit,
        'orderby'           =>  $orderBy,
        'order'             =>  $order,
        'tax_query'         => array(
            array(
                'taxonomy' => 'make',
                'field' => 'id',
                'terms' =>  $makeID_arr
            )
        ),
        'meta_query' => array(
            array(
                'key'     => 'autoshowroom_vehicle_sold',
                'value'   => 'sold',
                'compare' => '=',
            ),
        ),
    );
    $showmsrp       = ot_get_option('autoshowroom_Detail_show_msrp','yes');
    $autoshowroom_portfolio_description_limit = 80;
    $autoshowroom_portfolio_specifications_values="registration,transmission,milage";
    $autoshowroom_portfolio_specifications_arr = explode(",",$autoshowroom_portfolio_specifications_values);
    $time_blog = new WP_Query( $time_args );
    if ( $time_blog -> have_posts() ):
        $i = 0;
        while ( $time_blog -> have_posts() ):
            $time_blog -> the_post();
            ?>

            <div id="post-<?php the_ID() ; ?>" <?php post_class("TZ-PortfolioGrid-Item  ") ; ?>>
                <div class="tz-inner">
                    <div class="TZ-Vehicle-Grid">
                        <div class="item">
                            <div class="Vehicle-Feature-Image">
                                <a href="<?php echo get_permalink(); ?>">
                                    <?php the_post_thumbnail( 'large'); ?>
                                </a>
                                <?php echo tz_autoshowroom_filter_vehicle_price(get_the_ID(),$showmsrp); ?>
                            </div>
                            <h4 class="Vehicle-Title">
                                <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <?php if($autoshowroom_portfolio_description_limit){ ?>
                                <div class="vehicle-feature-des">
                                    <p><?php echo substr(strip_tags(do_shortcode('[vehicle_description]')), 0, $autoshowroom_portfolio_description_limit);?></p>
                                </div>
                            <?php } else{
                                echo do_shortcode('[vehicle_description]');
                            } ?>
                            <?php echo tz_autoshowroom_get_vehicle_specs(get_the_ID(),$autoshowroom_portfolio_specifications_arr);?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $i ++ ;
        endwhile;
    endif;
    wp_reset_postdata();
    exit();
}

vc_map( array(
    "name"          => __("Vehicle Sold", "tz-autoshowroom"),
    "icon"          => "tzvc_icon",
    "base"          => "autoshowroom-portfolio-vehicle-sold",
    "weight"        => 1,
    "description"   => "",
    "class"         => "tzElement_extended",
    "category"      => __("TZ AutoShowroom", "tz-autoshowroom"),
    "params"        => array(
        array(
            "type" => "checkbox",
            "class" => "",
            "admin_label" => true,
            "heading" =>  __("Vehicle Make", "tz-autoshowroom"),
            "param_name" => "autoshowroom_make",
            "value" => $vehicle_cat,
            "description" => __("Select Vehicle Make", "tz-autoshowroom")
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Show Vehicle Make", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_filter_option",
            "value"         => array(
                                __("Show", "tz-autoshowroom")  => 'show',
                                __("Hide", "tz-autoshowroom")  => "hide"),
            "description"   => __("", "tz-autoshowroom"),
        ),
        array(
            "type"          => "textfield",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Limit", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_limit",
            "value"         => "",
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Order by", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_orderby",
            "value"         => array(__("Date", "tz-autoshowroom") => 'date', __("ID", "tz-autoshowroom") => "id", __("Title", "tz-autoshowroom") => "title"),
            "description"   => __("", "tz-autoshowroom")
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Order", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_order",
            "value"         => array(__("Z --> A", "tz-autoshowroom") => 'desc', __("A --> Z", "tz-autoshowroom") => "asc"),
            "description"   => __("", "tz-autoshowroom")
        ),

        array(
            "type"          => "textfield",
            "class"         => "",
            'group'         =>  esc_html__('Responsive','tz-autoshowroom'),
            "admin_label"   => true,
            "heading"       => __("Number Column Of Desktop", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_col_desktop",
            "value"         => "",
        ),

        array(
            "type"          => "textfield",
            "class"         => "",
            'group'         =>  esc_html__('Responsive','tz-autoshowroom'),
            "admin_label"   => true,
            "heading"       => __("Number Column Of Tablet Portrait", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_col_tabletportrait",
            "value"         => "",
        ),

        array(
            "type"          => "textfield",
            "class"         => "",
            'group'         =>  esc_html__('Responsive','tz-autoshowroom'),
            "admin_label"   => true,
            "heading"       => __("Number Column Of Mobile Landscape", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_col_mobilelandscape",
            "value"         => "",
        ),

        array(
            "type"          => "textfield",
            "class"         => "",
            'group'         =>  esc_html__('Responsive','tz-autoshowroom'),
            "admin_label"   => true,
            "heading"       => __("Number column of Mobile", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_col_mobile",
            "value"         => "",
        ),
        array(
            'type'          =>  'checkbox',
            'holder'        =>  '',
            "class"         =>  "tz_checkbox_spec",
            'admin_label'   =>  false,
            'heading'       =>  esc_html__('Choose Specifications','tz-autoshowroom'),
            'param_name'    =>  'autoshowroom_portfolio_specifications_values',
            'value'         =>  autoshowroom_portfolio_get_fields_sold()
        ),
        array(
            'type'          =>  'textfield',
            'holder'        =>  '',
            'heading'       =>  esc_html__('Limit Description','tz-autoshowroom'),
            'admin_label'   =>  false,
            'param_name'    =>  'autoshowroom_portfolio_description_limit',
            'value'         =>  80
        ),
        array(
            "type"          => "dropdown",
            "class"         => "",
            "admin_label"   => true,
            "heading"       => __("Only Vehicle Sold", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_vehicle_sold",
            "value"         => array(
                __("Yes", "tz-autoshowroom")  => "yes",
                __("No", "tz-autoshowroom")  => "no"),
            "description"   => __("", "tz-autoshowroom"),
        ),

        array(
            "type" => "dropdown",
            "class" => "",
            "admin_label" => true,
            "heading"       => __("Css Animation", "tz-autoshowroom"),
            "param_name"    => "autoshowroom_css_animation",
            "description"   => __("", "tz-autoshowroom"),
            "value"         => array(
                __("No animation", "tz-autoshowroom")           => '',
                __("Top to bottom", "tz-autoshowroom")          => 'top-to-bottom',
                __("Bottom to top", "tz-autoshowroom")          => 'bottom-to-top',
                __("Left to right", "tz-autoshowroom")          => 'left-to-right',
                __("Right to left", "tz-autoshowroom")          => 'right-to-left',
                __("Appear from center", "tz-autoshowroom")     => 'appear'),
        ),
    )
));
