<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Car_Dealer_Fields {

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->fields = array();

		// add query vars of our searchform
		add_filter( 'query_vars', array( $this, 'add_query_vars_filter' ) );
		add_filter( 'pre_get_posts', array( $this, 'filter_posts' ) );
		add_filter( 'acf/save_post', array( $this, 'sync_content_field' ) );

		add_action( 'plugins_loaded', array( $this, 'register_admin_fields' ) );
		add_filter( 'pcd/built_in_fields', array( $this, 'options_remove_fields' ) );
		add_filter( 'init', array( $this, 'options_custom_fields' ));
		add_action( 'init', array( $this, 'register_fields' ) );
		add_filter( 'acf/load_field/name=vehicle_type', array( $this, 'vehicle_type_allow_none' ) );
		add_filter( 'acf/options_page/settings', array( $this, 'acf_options_page_translatable' ) );
		add_filter( 'acf/field_group/get_fields', array( $this, 'acf_fields_translatable' ), 2, 2 );

		$color_choices = array_unique( array_merge( array (
			__( 'Silver', 'progression-car-dealer' ),
			__( 'Black', 'progression-car-dealer' ),
			__( 'White', 'progression-car-dealer' ),
			__( 'Red', 'progression-car-dealer' ),
			__( 'Blue', 'progression-car-dealer' ),
			__( 'Brown/Beige', 'progression-car-dealer' ),
			__( 'Yellow', 'progression-car-dealer' ),
			__( 'Green', 'progression-car-dealer' ),
		), $this->get_meta_values( 'color', 'vehicle' ) ));
		$color_choices = array_combine( $color_choices, $color_choices);

		$int_color_choices = array_unique( array_merge( array (
			'black' => __( 'Black', 'progression-car-dealer' ),
			'white' => __( 'White', 'progression-car-dealer' ),
			'brown' => __( 'Brown (Leather)', 'progression-car-dealer' )
		), $this->get_meta_values( 'interior', 'vehicle' ) ));
		$int_color_choices = array_combine( $int_color_choices, $int_color_choices);


		$this->built_in = array(
			'vehicle_type' => array (
				'label' => __( 'Vehicle Type', 'progression-car-dealer' ),
				'name' => 'vehicle_type',
				'type' => 'taxonomy',
				'taxonomy' => 'vehicle_type',
				'sort' => 0,
				'group' => 'overview'
			),
			'make' => array (
				'label' => __( 'Make', 'progression-car-dealer' ),
				'name' => 'make',
                'instructions' => __( 'If you do not see Make or can not choose it please edit and save again in make manager', 'progression-car-dealer' ),
				'type' => 'taxonomy',
				'taxonomy' => 'make',
				'sort' => 5,
				'group' => 'overview',
				'field_type' => 'select',
				'allow_null' => 0
			),
			'model' => array (
				'label' => __( 'Model', 'progression-car-dealer' ),
				'name' => 'model',
				'type' => 'taxonomy',
                'instructions' => __( 'If you do not see Model or can not choose it please edit and save again in Model manager', 'progression-car-dealer' ),
				'taxonomy' => 'model',
				'field_type' => 'select',
				'sort' => 5,
				'group' => 'overview',
				'allow_null' => 0
			),
            'pricetext' => array (
                'label' => __( 'Text Price', 'progression-car-dealer' ),
                'name' => 'pricetext',
                'type' => 'text',
                'instructions' => __( 'Contact get price', 'progression-car-dealer' ),
                'default_value' => '',
                'placeholder' => __( 'Price Contact', 'progression-car-dealer' ),
                'sort' => 18,
                'group'=>'pricing',
            ),
            'pricelink' => array (
                'label' => __( 'Url Price', 'progression-car-dealer' ),
                'name' => 'pricelink',
                'type' => 'text',
                'instructions' => __( 'URL get price', 'progression-car-dealer' ),
                'default_value' => '',
                'placeholder' => __( 'Url Price', 'progression-car-dealer' ),
                'sort' => 19,
                'group'=>'pricing',
            ),
			'price' => array(
				'label' => __( 'Price', 'progression-car-dealer' ),
				'name' => 'price',
				'instructions' => __( "The price that the customer will have to pay.", 'progression-car-dealer' ),
				'type' => 'number',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => $this->get_price_symbol_for_position('prepend'),
				'append' => $this->get_price_symbol_for_position('append'),
				'min' => 0,
				'max' => '8000000000',
				'step' => '',
				'group' => 'pricing',
				'sort' => 15,
			),
			'msrp' => array(
				'label' => __( 'MSRP', 'progression-car-dealer' ),
				'name' => 'msrp',
				'instructions' => __( "Use integers to set the listing price.", 'progression-car-dealer' ),
				'type' => 'number',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => $this->get_price_symbol_for_position('prepend'),
				'append' => $this->get_price_symbol_for_position('append'),
				'min' => 0,
				'max' => '8000000000',
				'step' => '',
				'group' => 'pricing',
				'sort' => 10,
			),
            'pricerental' => array(
                'label' => __( 'Price Rental', 'progression-car-dealer' ),
                'name' => 'pricerental',
                'instructions' => __( "Prices for rent a day or a week", 'progression-car-dealer' ),
                'type' => 'number',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => $this->get_price_symbol_for_position('prepend'),
                'append' => $this->get_price_symbol_for_position('append'),
                'min' => 0,
                'max' => '8000000000',
                'step' => '',
                'group' => 'pricing',
                'sort' => 16,
            ),
            'time_rental' => array (
                'label' => __( 'Time To Rent', 'progression-car-dealer' ),
                'name' => 'time_rental',
                'type' => 'text',
                'default_value' => 'day',
                'placeholder' => __( 'day', 'progression-car-dealer' ),
                'group' => 'pricing',
                'sort' => 17,
            ),
			'registration' => array (
				'label' => __( 'Registration date', 'progression-car-dealer' ),
				'name' => 'registration',
				'type' => 'number',
				'instructions' => __( 'The year of first registration', 'progression-car-dealer' ),
				'default_value' => '',
				'placeholder' => __( 'e.g. 2009', 'progression-car-dealer' ),
				'min' => 1950,
				'max' => date( 'Y' ) + 1,
				'default_value' => date( 'Y' ),
				'sort' => 15,
			),
			'milage' => array(
				'label' => __( 'Mileage', 'progression-car-dealer' ),
				'name' => 'milage',
				'type' => 'number',
				'instructions' => __( 'The number of miles travelled or covered', 'progression-car-dealer' ),
				'default_value' => '',
				'placeholder' => __( 'e.g. 70000', 'progression-car-dealer' ),
				'prepend' => '',
				'append' => get_option( 'options_pcd_milage_unit', 'mi' ),
				'sort' => 20
			),
			'condition' => array(
				'label' => __( 'Condition', 'progression-car-dealer' ),
				'name' => 'condition',
				'instructions' => '',
				'type' => 'radio',
				'choices' => array(
					'new' => __( 'New', 'progression-car-dealer' ),
					'used' => __( 'Used', 'progression-car-dealer' ),
					'preowned' => __( 'Certified Pre-Owned', 'progression-car-dealer' )
				),
				'default_value' => 'new',
				'other_choice' => 0,
				'sort' => 30
			),
			'color' => array(
				'label' => __( 'Exterior Color', 'progression-car-dealer' ),
				'name' => 'color',
				'type' => 'radio',
				'choices' => $color_choices,
				'other_choice' => 1,
				'save_other_choice' => 1,
				'default_value' => 'silver',
				'layout' => 'vertical',
				'sort' => 40,
			),
			'interior' => array(
				'label' => __( 'Interior Color', 'progression-car-dealer' ),
				'name' => 'interior',
				'type' => 'radio',
				'choices' => $int_color_choices,
				'other_choice' => 1,
				'save_other_choice' => 1,
				'default_value' => 'black',
				'layout' => 'vertical',
				'sort' => 50,
			),
			'transmission' => array(
				'label' => __( 'Transmission', 'progression-car-dealer' ),
				'name' => 'transmission',
				'type' => 'radio',
				'choices' => array (
					'auto' => __( 'Automatic', 'progression-car-dealer' ),
					'manual' => __( 'Manual', 'progression-car-dealer' ),
				),
				'default_value' => '',
				'layout' => 'horizontal',
				'sort' => 60,
			),
			'engine' => array (
				'label' => __( 'Engine', 'progression-car-dealer' ),
				'name' => 'engine',
				'instructions' => __( 'The displacement the engine gives in Litres', 'progression-car-dealer' ),
				'append' => 'L',
				'placeholder' => '4,1',
				'sort' => 70,
	
				'min' => 0,
				'max' => 10
			),
			'drivetrain' => array(
				'label' => __( 'Drivetrain', 'progression-car-dealer' ),
				'name' => 'drivetrain',
				'type' => 'radio',
				'choices' => array (
					'fwd' => __( 'FWD', 'progression-car-dealer' ),
					'rwd' => __( 'RWD', 'progression-car-dealer' ),
					'4wd' => __( '4WD', 'progression-car-dealer' ),
				),
				'default_value' => '',
				'layout' => 'horizontal',
				'sort' => 90,
			),
            'vehicle_overview_title' => array (
                'label' => __( 'Tab title', 'progression-car-dealer' ),
                'name' => 'vehicle_overview_title',
                'type' => 'text',
                'default_value' => 'Vehicle Overview',
                'placeholder' => __( 'Vehicle Overview', 'progression-car-dealer' ),
                'group'=>'auto_content',
                'sort' => 60,
            ),
			'vehicle_overview' => array(
				'label' => __( 'Vehicle Overview', 'progression-car-dealer' ),
				'name' => 'vehicle_overview',
				'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'advanced',
                'media_upload' => 'yes',
                'group' => 'auto_content',
                'sort' => 65,
			),

            'vehicle_options_title' => array (
                'label' => __( 'Tab title', 'progression-car-dealer' ),
                'name' => 'vehicle_options_title',
                'type' => 'text',
                'default_value' => 'Features & Options',
                'placeholder' => __( 'Features & Options', 'progression-car-dealer' ),
                'group'=>'auto_content',
                'sort' => 66,
            ),
			'vehicle_options' => array(
				'label' => __( 'Vehicle Options', 'progression-car-dealer' ),
				'name' => 'vehicle_options',
				'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'advanced',
                'media_upload' => 'yes',
                'group' => 'auto_content',
                'sort' => 70,
			),

            'vehicle_information_title' => array (
                'label' => __( 'Tab title', 'progression-car-dealer' ),
                'name' => 'vehicle_information_title',
                'type' => 'text',
                'default_value' => 'Request information',
                'placeholder' => __( 'Request information', 'progression-car-dealer' ),
                'group'=>'auto_content',
                'sort' => 75,
            ),
			'vehicle_infomation' => array(
				'label' => __( 'Request information', 'progression-car-dealer' ),
				'name' => 'vehicle_information',
				'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'advanced',
                'media_upload' => 'yes',
                'group' => 'auto_content',
                'sort' => 80,
			),

            'vehicle_tab4_title' => array (
                'label' => __( 'Tab title', 'progression-car-dealer' ),
                'name' => 'vehicle_tab4_title',
                'type' => 'text',
                'default_value' => 'New tab',
                'placeholder' => __( 'Tab title', 'progression-car-dealer' ),
                'group'=>'auto_content',
                'sort' => 81,
            ),
			'vehicle_tab4' => array(
				'label' => __( 'New tab content', 'progression-car-dealer' ),
				'name' => 'vehicle_tab4',
				'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'advanced',
                'media_upload' => 'yes',
                'group' => 'auto_content',
                'sort' => 82,
			),

            'vehicle_tab5_title' => array (
                'label' => __( 'Tab title', 'progression-car-dealer' ),
                'name' => 'vehicle_tab5_title',
                'type' => 'text',
                'default_value' => 'New tab',
                'placeholder' => __( 'Tab title', 'progression-car-dealer' ),
                'group'=>'auto_content',
                'sort' => 83,
            ),
			'vehicle_tab5' => array(
				'label' => __( 'New tab content', 'progression-car-dealer' ),
				'name' => 'vehicle_tab5',
				'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'advanced',
                'media_upload' => 'yes',
                'group' => 'auto_content',
                'sort' => 84,
			),
		);
	}

	public function options_custom_fields() {

		global $car_dealer;

		$custom_fields = get_field( 'pcd_custom_fields', 'options' );

		if ( ! empty( $custom_fields )) {
			foreach ( $custom_fields as $i => $field ) {
			    if($field['acf_fc_layout'] !='pcd_text') {

                    $args = array(
                        'label' => sanitize_text_field($field['pcd_name']),
                        'name' => sanitize_key(sanitize_title($field['pcd_name'], 'field_' . mt_rand(100, 100000))),
                        'instructions' => '',
                        'sort' => 100 + $i
                    );


                    if (!empty($field['pcd_choices'])) {
                        $choices = array_filter(explode(',', $field['pcd_choices']));

                        if ('pcd_number_field' == $field['acf_fc_layout']) {
                            $meta_values = array_unique($this->get_meta_values($args['name'], 'vehicle'));
                            $choices = array_unique(array_merge($choices, $meta_values));
                        }

                        if (!empty($choices)) {
                            foreach ($choices as $key => $choice) {
                                unset($choices[$key]);
                                $args['choices'][sanitize_title($choice)] = $choice;
                            }
                        }
                    }
                    if (!empty($field['acf_fc_layout'])) {
                        $args['type'] = $field['acf_fc_layout'] == 'pcd_option' ? 'radio' : 'number';
                    }
                    if (!empty($field['pcd_min'])) {
                        $args['min'] = intval($field['pcd_min']);
                        $args['default_value'] = intval(@$field['pcd_min']);
                    }
                    if (!empty($field['pcd_max'])) {
                        $args['max'] = intval($field['pcd_max']);
                    }
                    if (!empty($field['pcd_append'])) {
                        $args['append'] = esc_html($field['pcd_append']);
                    }

                }else{
                    $args = array(
                        'label' => sanitize_text_field($field['pcd_name']),
                        'name' => sanitize_key(sanitize_title($field['pcd_name'], 'field_' . mt_rand(100, 100000))),
                        'type' =>'text',
                        'sort' => 100 + $i
                    );
                    if (!empty($field['pcd_textvalue'])) {
                        $args['default_value'] = esc_html($field['pcd_textvalue']);
                    }
                }
				$car_dealer->fields->register_field( $args );
			}
		}


	}
	public function options_remove_fields( $fields ) {

		$excludes = get_field( 'pcd_excluded_fields', 'options' );

		if ( ! empty ( $excludes ) ) {
			foreach ( $excludes as $key ) {
				unset($fields[$key]);
			}
		}
		return $fields;
	}

	public function acf_options_page_translatable( $settings ) {
		if( !empty( $settings['pages'])) {
			foreach( $settings['pages'] as $k => $page ) {
				$settings['pages'][$k]['title'] = __( $page['title'], 'progression-car-dealer' );
				$settings['pages'][$k]['slug'] = 'acf-options-settings';
			}
		}
		return $settings;
	}

	public function acf_fields_translatable ( $fields, $post_id ) {

		if( is_array($fields) ){
			foreach( $fields as $k => $field ){
				if ( ! empty( $field['label'] )) {
					$fields[$k]['label'] = __( $field['label'], 'progression-car-dealer' );
				}
				if ( ! empty( $field['layouts'] )) {
					foreach ( $field['layouts'] as $layout => $layout_fields) {
						foreach ($layout_fields as $layout_key => $layout_value) {
							$fields[$k]['layouts'][$layout][$layout_key] = ( $layout_value);
							if ( 'subfields' == $layout_key ) {
								foreach ($layout_value as $subfield_key => $subfield_value) {
									$fields[$k]['layouts'][$layout][$layout_key][$subfield_key] = ( $subfield_value);
								}
							}
						}
					}
				}

				if ( ! empty( $field['instructions'] )) {
					$fields[$k]['instructions'] = __( $field['instructions'], 'progression-car-dealer' );
				}

				if ( ! empty( $field['message'] ) ) {
					if ( 'field_get_shortcode' == $field['key'] ) {
						$fields[$k]['message'] = __( $field['message'], 'progression-car-dealer' ) . '<br><b id="featured_vehicles">[featured_vehicles]</b>';
					} else {
						$fields[$k]['message'] = __( $field['message'], 'progression-car-dealer' );
					}
				}

				if ( ! empty( $field['choices'] ) ) {
					foreach ( $field['choices'] as $key => $value) {
						$fields[$k]['choices'][$key] = __( $value, 'progression-car-dealer' );
					}
				}
			}
		}
		return $fields;
	}


	public function register_fields() {

		$this->register_built_in_fields();

		$fields = array();
		$translations = array( // not used anywhere else
			__( 'Overview', 'progression-car-dealer' ),
			__( 'Pricing', 'progression-car-dealer' ),
			__( 'Specifications', 'progression-car-dealer' ),
			__( 'Media', 'progression-car-dealer' ),
			__( 'Video', 'progression-car-dealer' ),
		);

		$layout_groups = array(
            'Overview' => array(),
            'Content' => array(),
            'Pricing' => array(),
            'Specifications' => array(),
            'Media' => array(
                array (
                    'key' => 'field_52910ed450e20',
                    'label' => __( 'Images', 'progression-car-dealer' ),
                    'name' => 'images',
                    'type' => 'gallery',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                )
            ),
            'Video' => array(
                array (
                    'key' => 'field_52910ed450e90',
                    'label' => __( 'Video', 'progression-car-dealer' ),
                    'name' => 'video',
                    'type' => 'textarea',
                    'formatting' =>'html',
                    'placeholder' => __('Video URL (oEmbed) or Embed Code', 'progression-car-dealer')

                )
            )
        );
		$layout_groups['Overview'] = $this->get_registered_fields( 'overview' );
		$layout_groups['Content'] = $this->get_registered_fields( 'auto_content' );
		$layout_groups['Overview'][] = array (
	        'key' => 'field_52910fe7d4efa',
	        'label' => __( 'Description Text', 'progression-car-dealer' ),
	        'name' => 'content',
	        'type' => 'wysiwyg',
	        'default_value' => '',
	        'toolbar' => 'advanced',
	        'media_upload' => 'yes',
	    );
		$layout_groups['Pricing'] = $this->get_registered_fields('pricing');
		$layout_groups['Pricing'][] = array (
			'key' => 'field_529269012349324',
			'label' => __( 'Message', 'progression-car-dealer' ),
			'name' => '',
			'type' => 'message',
			'message' => sprintf( __( 'See %s for money formatting options.', 'progression-car-dealer' ),
				"<a href='" . admin_url( $this->get_settings_page() ) . "'>" . __( 'settings page', 'progression-car-dealer' ) . "</a>" )
		);
		$layout_groups['Specifications'] = $this->get_registered_fields('specs');

		foreach ( $layout_groups as $label => $field_group ) {
			$fields[] = array (
		        'key' => 'tab_'. $label,
		        'label' => __( $label, 'progression-car-dealer' ),
		        'name' => $label,
		        'type' => 'tab',
		      );
			foreach ( $field_group as $field ) {
				$fields[] = $field;
			};
		};

		if(function_exists("register_field_group"))
		{
		  register_field_group(array (
		    'id' => 'acf_vehicle-data',
		    'title' => __( 'Vehicle Data', 'progression-car-dealer' ),
		    'fields' => $fields,
		    'location' => array (
		      array (
		        array (
		          'param' => 'post_type',
		          'operator' => '==',
		          'value' => 'vehicle',
		          'order_no' => 0,
		          'group_no' => 0,
		        ),
		      ),
		    ),
		    'options' => array (
		      'position' => 'normal',
		      'layout' => 'no_box',
		      'hide_on_screen' => array (
		      	'the_content', 'custom_fields'
		      ),
		    ),
		    'menu_order' => 0,
		  ));
		}
	}

	/**
	 * Registers the specification fields that come preinstalled with Car Dealer
	 * Use the 'pcd/built_in_fields' filter to remove fields from it
	 */
	public function register_built_in_fields() {

		$built_in_fields = apply_filters( 'pcd/built_in_fields', $this->built_in);

		if ( ! empty( $built_in_fields )) {
			foreach ( $built_in_fields as $field ) {
				$this->register_field( $field );
			}
		}

	}
	/**
	 * Corrects behavior of taxnomy select field
	 * @return [type] [description]
	 */
	public function vehicle_type_allow_none( $field ) {
		$field['allow_null'] = 0;
		return $field;
	}

	public function add_query_vars_filter( $vars ) {

		$fields = $this->get_registered_fields();

		if ( $fields ) {
			foreach ( $fields as $field ) {
				if ( 'taxonomy' != $field['type'] ) {
					$vars[] = $field['name'];
				}
			}
		}
        $vars[] = 'car_id';
  		return $vars;

	}
	public function filter_posts( $query ) {

		if ( ! is_post_type_archive('vehicle') && ( isset($query->query['post_type']) && 'vehicle' != $query->query['post_type'] )) {
			return;
		}
		if ( ! $query->is_main_query()  ) {
			return;
		}

		$meta_query = array();
		$fields = $this->get_registered_fields();
		$field[] =array(
		    'type'=>'location',
            'name'=>'location'
        );

        $fields = array_merge($fields,$field);

		if ( $fields ) {

			foreach ( $fields as $field ) {

				$query_var = get_query_var( $field['name'] );

                if(isset($_GET['location'])){
                    $userids=array();
                    $query_loca = $_GET['location'];
                    if(is_array($query_loca)){
                        $query_local = $query_loca[0];
                    }else{
                        $query_local = $query_loca;
                    }
                    $args=array(
                        'meta_key'=>'tz_google_map',
                        'meta_value'=>$query_local,
                        'meta_compare' => 'IN'
                    );
                    $loca_user = get_users( $args );
                    if($loca_user ){
                        foreach ($loca_user as $user){
                            $userids[]=$user->ID;
                        }
                    }
                }else{
                    $query_loca ='';
                }

				$min = 0;
				$max = PHP_INT_MAX;

				if ( empty( $query_var ) ) {
					continue;
				}

				if ( 'number' == $field['type'] ) {

					$min = isset( $query_var['min'] ) && ! empty( $query_var['min'] ) ? $query_var['min'] : $min;
					$max = isset( $query_var['max'] ) && ! empty( $query_var['max'] ) ? $query_var['max'] : $max;

					$meta_query[] = array(
						'key' => $field['name'],
						'value' => array( intval( $min ), intval( $max ) ),
						'type' => 'numeric',
						'compare' => 'BETWEEN'
					);

				} elseif ( 'radio' == $field['type'] || 'checkbox' == $field['type'] ) {
					$meta_query[] = array(
						'key' => $field['name'],
						'value' => $query_var,
						'compare' => 'IN'
					);
				} elseif ( 'text' == $field['type'] ) {
					$meta_query[] = array(
						'key' => $field['name'],
						'value' => $query_var,
						'compare' => '='
					);
				}
			}
		}

		// manually handle sorting by price
		if ( isset( $query->query['orderby'] ) && 'price' == $query->query['orderby'] ) {
			$query->set('orderby', 'meta_value_num');
			$query->set('meta_key', 'price');
		}
//        if(! is_admin()):
//            $query->set('author',$userids );
//            endif;
        $query->set('meta_query', $meta_query);

	}
	/**
	 * Saves the value of the 'content' field to the actual post content
	 * @param  [type] $post_id [description]
	 */
	public function sync_content_field( $post_id ) {
		// vars
		$fields = false;

		// load from post
		if( isset( $_POST['fields'] ) ) {
			$field_key = get_field( '_content', $post_id );
            $content='';
			if ( $field_key ) {
				
			}
			else 		{
				$content = 0;
			}

			// Update post 37
			$updated_post = array(
				'ID'           => $post_id,
				'post_content' => $content
			);

			remove_action( 'acf/save_post', array( $this, 'sync_content_field' ));

			// Update the post into the database
			wp_update_post( $updated_post );

			add_action( 'acf/save_post', array( $this, 'sync_content_field' ));
		}
	}
	/**
	 * Returns all values of given meta key
	 * @param  string $key    [description]
	 * @param  string $type   [description]
	 * @param  string $status [description]
	 * @return [type]         [description]
	 */
	public function get_meta_values( $key = '', $type = 'post', $status = 'publish' ) {

	    global $wpdb;

	    if( empty( $key ) )
	        return;

	    $r = $wpdb->get_col( $wpdb->prepare( "
	        SELECT pm.meta_value FROM {$wpdb->postmeta} pm
	        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
	        WHERE pm.meta_key = '%s'
	        AND p.post_status = '%s'
	        AND p.post_type = '%s'
	    ", $key, $status, $type ) );

	    return $r;
	}
	public function get_field_min_value( $key ) {
	    return min($this->get_meta_values( $key, 'vehicle' ));
	}
	public function get_field_max_value( $key ) {
		return max( $this->get_meta_values( $key, 'vehicle' ));
	}
	public function get_settings_page() {
		return 'edit.php?post_type=vehicle&page=acf-options-settings';
	}

	/**
	 * use this function to add additional fields to a car object
	 * @param  array $args
	 */
	public function register_field( $args ) {

		// ACF requires a unique key per field so lets generate one
		$key = md5( serialize( $args ));

		if ( empty( $args['type'] )) {
			$args['type'] = 'number';
		}
		$type = $args['type'];

		if ( 'taxonomy' == $type ) {
			$field = wp_parse_args( $args, array(
				'key' => $key,
				'label' => '',
				'name' => '',
				'type' => 'taxonomy',
				'instructions' => '',
				'taxonomy' => '',
				'field_type' => 'select',
				'allow_null' => 1,
				'load_save_terms' => 1,
				'return_format' => 'id',
				'multiple' => 0,
				'sort' => 0,
				'group' => 'overview'
			) );
		} else if ( 'radio' == $type ) {
			$field = wp_parse_args( $args, array (
				'key' => $key,
				'label' => '',
				'name' => '',
				'instructions' => '',
				'choices' => array(),
				'other_choice' => 1,
				'save_other_choice' => 1,
				'default_value' => '',
				'layout' => 'horizontal',
				'sort' => 0,
				'group' => 'specs'
			) );
		} else if ( 'checkbox' == $type ) {
			$field = wp_parse_args( $args, array (
				'key' => $key,
				'label' => '',
				'name' => '',
				'instructions' => '',
				'choices' => array(),
				'layout' => 'vertical',
				'sort' => 0,
				'group' => 'specs'
			) );
		} else {
			$field = wp_parse_args( $args, array (
				'key' => $key,
				'label' => '',
				'name' => '',
				'type' => 'number',
				'instructions' => '',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => '',
				'step' => '',
				'sort' => 0,
				'group' => 'specs'
			) );
		}
		$field = apply_filters( 'pcd/register_field', $field );
		$this->fields[$field['name']] = $field;

		return $field;
	}
	/**
	 * returns the sorted registered fields
	 * @return [type] [description]
	 */
	public function get_registered_fields( $group = '' ) {

		$fields = $this->fields;
		$filtered = array();
		$sorted = array();

		foreach ($fields as $key => $field ) {
			$fields[$key]['label'] = __( $field['label'], 'progression-car-dealer' );
		}

		if ( ! empty( $group ) ) {
			foreach ($fields as $field ) {
				if ( $group == $field['group'] ) {
					$filtered[] = $field;
				}
			}
		} else {
			$filtered = $fields;
		}

		foreach ( $filtered as $key => $value ) {
		    $sorted[$key]  = $value['sort'];
		}

		array_multisort( $sorted, SORT_ASC, SORT_NUMERIC, $filtered );

		return apply_filters( 'pcd/fields', $filtered );
	}

	public function get_price_symbol_for_position( $position = 'prepend' ) {

		$symbol 		= get_option( 'options_pcd_currency_symbol', '$' );
		$option 		= get_option( 'options_pcd_symbol_placement', 'prepend' );

		if ( ('prepend' == $option && 'prepend' == $position) ||
			 ( 'append' == $option && 'append' == $position ) ) {
			return $symbol;
		}
		else {
			return '';
		}
	}

	public function register_admin_fields() {

		if ( function_exists( 'acf_add_options_sub_page' ) && function_exists( 'register_field_group' )) {

			acf_add_options_sub_page(array(
		        'title' => __( 'Settings', 'progression-car-dealer' ),
		        'parent' => 'edit.php?post_type=vehicle',
		        'capability' => 'manage_options'
		    ));

		    $built_in_fields = $this->built_in;


		    $choices = array();
		    if ( ! empty( $built_in_fields )) {
		    	foreach ($built_in_fields as $field) {
		    		$choices[$field['name']] = $field['label'];
		    	}
		    }

	    	register_field_group(array (
				'id' => 'car_dealer_settings_page',
				'title' => __( 'Settings', 'progression-car-dealer' ),
				'fields' => array (
					array (
			        'key' => 'field_52910fcad4ef944',
			        'label' => __( 'General', 'progression-car-dealer' ),
			        'name' => '',
			        'type' => 'tab',
			      ),
					array (
						'key' => 'field_5281609138d88',
						'label' => __( 'Mileage unit', 'progression-car-dealer' ),
						'name' => 'pcd_milage_unit',
						'type' => 'radio',
						'choices' => array (
							'mi' => __( 'Miles (mi)', 'progression-car-dealer' ),
							'km' => __( 'Kilometer (km)', 'progression-car-dealer' ),
						),
						'other_choice' => 0,
						'save_other_choice' => 0,
						'default_value' => 'mi',
						'layout' => 'horizontal',
					),
					array (
						'key' => 'field_5281610b906e3',
						'label' => __( 'Currency symbol', 'progression-car-dealer' ),
						'name' => 'pcd_currency_symbol',
						'type' => 'radio',
						'choices' => array (
							'$' => '$',
							'€' => '€',
							'£' => '£',
							'¥' => '¥',
						),
						'other_choice' => 1,
						'save_other_choice' => 1,
						'default_value' => '$',
						'layout' => 'vertical',
					),
					array (
						'key' => 'field_5281618b906e4',
						'label' => __( 'Symbol placement', 'progression-car-dealer' ),
						'name' => 'pcd_symbol_placement',
						'type' => 'radio',
						'choices' => array (
							'prepend' => __( 'Before numbers', 'progression-car-dealer' ),
							'append' => __( 'After numbers', 'progression-car-dealer' ),
						),
						'other_choice' => 0,
						'save_other_choice' => 0,
						'default_value' => 'prepend',
						'layout' => 'vertical',
					),
					array (
						'key' => 'field_52816229906e5',
						'label' => __( 'Thousands separator', 'progression-car-dealer' ),
						'name' => 'pcd_thousands_separator',
						'type' => 'select',
						'choices' => array (
							'space' => __( 'Space', 'progression-car-dealer' ),
							',' => __( 'Comma', 'progression-car-dealer' ),
							'.' => __( 'Dot', 'progression-car-dealer' ),
						),
						'default_value' => 'space',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_529db63c010e5',
						'label' => __( 'Fields', 'progression-car-dealer' ),
						'name' => '',
						'type' => 'tab',
					),
					array (
						'key' => 'field_5288dd811ed6e',
						'label' => __( 'Fields to exclude', 'progression-car-dealer' ),
						'name' => 'pcd_excluded_fields',
						'type' => 'checkbox',
						'instructions' => __( 'Selected fields will not be used', 'progression-car-dealer' ),
						'choices' => $choices,
						'default_value' => '',
						'layout' => 'horizontal',
					),
					array (
						'key' => 'field_52816a1633584',
						'label' => __( 'Add custom fields', 'progression-car-dealer' ),
						'name' => 'pcd_custom_fields',
						'type' => 'flexible_content',
						'layouts' => array (
							array (
								'label' => __( 'Number field', 'progression-car-dealer' ),
								'name' => 'pcd_number_field',
								'display' => 'table',
								'min' => '',
								'max' => '',
								'sub_fields' => array (
									array (
										'key' => 'field_52816abf33585',
										'label' => __( 'Name', 'progression-car-dealer' ),
										'name' => 'pcd_name',
										'type' => 'text',
										'column_width' => 35,
										'default_value' => '',
										'placeholder' => __( 'E.g. "Horsepower"', 'progression-car-dealer' ),
										'prepend' => '',
										'append' => '',
										'formatting' => 'none',
										'maxlength' => '',
									),
									array (
										'key' => 'field_52816af633586',
										'label' => __( 'Minimum value', 'progression-car-dealer' ),
										'name' => 'pcd_min',
										'type' => 'number',
										'column_width' => '',
										'default_value' => 0,
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => '',
										'max' => '',
										'step' => '',
									),
									array (
										'key' => 'field_52816b8d33588',
										'label' => __( 'Maximum value', 'progression-car-dealer' ),
										'name' => 'pcd_max',
										'type' => 'number',
										'column_width' => '',
										'default_value' => 1000,
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'min' => '',
										'max' => '',
										'step' => '',
									),
									array (
										'key' => 'field_52816ba133589',
										'label' => __( 'Append', 'progression-car-dealer' ),
										'name' => 'pcd_append',
										'type' => 'text',
										'column_width' => '',
										'default_value' => '',
										'placeholder' => __( 'e.g. "PS"', 'progression-car-dealer'),
										'prepend' => '',
										'append' => '',
										'formatting' => 'none',
										'maxlength' => 10,
									),
								),
							),
							array (
								'label' => __( 'Options field', 'progression-car-dealer' ),
								'name' => 'pcd_option',
								'display' => 'table',
								'min' => '',
								'max' => '',
								'sub_fields' => array (
									array (
										'key' => 'field_52816dc9ffee1',
										'label' => __( 'Name', 'progression-car-dealer' ),
										'name' => 'pcd_name',
										'type' => 'text',
										'column_width' => 35,
										'default_value' => '',
										'placeholder' => __( 'E.g. "Fuel Type"', 'progression-car-dealer' ),
										'prepend' => '',
										'append' => '',
										'formatting' => 'html',
										'maxlength' => '',
									),
									array (
										'key' => 'field_52816e92ffee6',
										'label' => __( 'Choices', 'progression-car-dealer' ),
										'name' => 'pcd_choices',
										'type' => 'text',
										'instructions' => __( 'Options separated by comma e.g. Petrol, Diesel, Gas, Hybrid', 'progression-car-dealer' ),
										'column_width' => '',
										'default_value' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'formatting' => 'html',
										'maxlength' => '',
									)
								),
							),
							array (
								'label' => __( 'Text field', 'progression-car-dealer' ),
								'name' => 'pcd_text',
								'display' => 'table',
								'sub_fields' => array (
									array (
										'key' => 'field_52816dc9ffee9',
										'label' => __( 'Name', 'progression-car-dealer' ),
										'name' => 'pcd_name',
										'type' => 'text',
										'column_width' => 35,
										'default_value' => '',
										'placeholder' => __( 'Field name', 'progression-car-dealer' ),
										'prepend' => '',
										'append' => '',
										'formatting' => 'html',
										'maxlength' => '',
									),
									array (
										'key' => 'field_52816e92ffee9',
										'label' => __( 'Value', 'progression-car-dealer' ),
										'name' => 'pcd_textvalue',
										'type' => 'text',
										'column_width' => '',
										'default_value' => '',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'formatting' => 'html',
										'maxlength' => '',
									)
								),
							),
						),
						'button_label' => __( 'Add new custom field', 'acf' ),
						'min' => '',
						'max' => '',
					),
					array (
						'key' => 'field_message_custom_fields',
						'label' => __( 'Add custom fields', 'progression-car-dealer' ),
						'name' => '',
						'type' => 'message',
						'message' => __( 'The <b>number</b> field requires an upper and lower value boundary for the range to filter. The <b>choices</b> field will ask for a comma-separated list of values.', 'progression-car-dealer' )
					),
					array (
						'key' => 'field_529db63c010e7',
						'label' => __( 'Shortcodes', 'progression-car-dealer' ),
						'name' => '',
						'type' => 'tab',
					),
					array (
						'key' => 'field_52a10716e5cdd',
						'label' => __( '1. Select vehicles:', 'progression-car-dealer' ),
						'name' => 'featured_vehicles',
						'type' => 'relationship',
						'return_format' => 'object',
						'post_type' => array (
							0 => 'vehicle',
						),
						'taxonomy' => array (
							0 => 'all',
						),
						'filters' => array (
							0 => 'search',
						),
						'result_elements' => array (
							0 => 'featured_image',
							1 => 'post_title',
						),
						'max' => '',
					),
					array (
						'key' => 'field_get_shortcode',
						'label' => __( 'Your Shortcode', 'progression-car-dealer' ),
						'name' => '',
						'type' => 'message',
						'message' => __( '2. Copy your generated shortcode:', 'progression-car-dealer ' ),
					),
					array (
						'key' => 'field_get_shortcode_instructions',
						'label' => __( 'Your Shortcode', 'progression-car-dealer' ),
						'name' => '',
						'type' => 'message',
						'message' => __( '3. Paste your shortcode to a text widget or post or page', 'progression-car-dealer' ),
					)
				),

				'location' => array (
					array (
						array (
							'param' => 'options_page',
							'operator' => '==',
							'value' => 'acf-options-settings',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),

				'options' => array (
					'position' => 'normal',
					'layout' => 'no_box',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0,
			));

			register_field_group( array (
				'id' => 'acf_make-association',
				'title' => __( 'Make Association', 'progression-car-dealer' ),
				'fields' => array (
					array (
						'key' => 'field_529239ef5b2d9',
						'label' => __( 'Associated Make', 'progression-car-dealer' ),
						'name' => 'make',
						'type' => 'taxonomy',
						'taxonomy' => 'make',
						'field_type' => 'multi_select',
						'allow_null' => 0,
						'load_save_terms' => 0,
						'return_format' => 'array',
						'multiple' => 1,
                        'instructions' => __( 'Press and hold the CTRL key and click items in the list to select multiple items. ', 'progression-car-dealer' ),
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'ef_taxonomy',
							'operator' => '==',
							'value' => 'model',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
					'position' => 'normal',
					'layout' => 'no_box',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0,
			));
			register_field_group( array (
				'id' => 'acf_vehicle_type-association',
				'title' => __( 'Type Association', 'progression-car-dealer' ),
				'fields' => array (
					array (
						'key' => 'field_529239ef5b2def',
						'label' => __( 'Associated Type', 'progression-car-dealer' ),
						'name' => 'vehicle_type',
						'type' => 'taxonomy',
						'taxonomy' => 'vehicle_type',
						'field_type' => 'multi_select',
						'allow_null' => 1,
						'load_save_terms' => 0,
						'return_format' => 'array',
						'multiple' => 1,
                        'instructions' => __( 'Press and hold the CTRL key and click items in the list to select multiple items. ', 'progression-car-dealer' ),
                        'default_value'	=>	''
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'ef_taxonomy',
							'operator' => '==',
							'value' => 'make',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
                'options' => array (
                    'position' => 'normal',
                    'layout' => 'no_box',
                    'hide_on_screen' => array (
                    ),
                ),
                'menu_order' => 0,
			));
		}
	}

}
?>