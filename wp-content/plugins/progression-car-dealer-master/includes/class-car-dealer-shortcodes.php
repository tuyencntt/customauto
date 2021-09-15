<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Car_Dealer_Shortcodes class.
 */
class Car_Dealer_Shortcodes {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		add_shortcode( 'vehicle_specs', array( $this, 'get_vehicle_specs' ) );
		add_shortcode( 'vehicle_description', array( $this, 'get_vehicle_description' ) );
		add_shortcode( 'vehicle_price', array( $this, 'get_vehicle_price' ) );
		add_shortcode( 'vehicle_gallery', array( $this, 'get_vehicle_gallery' ) );
		add_shortcode( 'vehicle_searchform', array( $this, 'get_vehicle_searchform' ) );
		add_shortcode( 'vehicle_quotes_form', array( $this, 'get_vehicle_quotesform' ) );
		add_shortcode( 'featured_vehicles', array( $this, 'get_featured_vehicles' ) );

		add_filter( 'pcd/searchform/field/milage' , array( $this, 'get_range_field' ), 10, 2 );
		add_filter( 'pcd/searchform/field/price' , array( $this, 'get_range_field' ), 10, 2 );
		add_filter( 'pcd/searchform/field/registration' , array( $this, 'get_range_field' ), 10, 2 );

		add_filter( 'pcd/searchform/range/milage' , array( $this, 'get_range_for_milage' ), 10, 2 );
		add_filter( 'pcd/searchform/range/price' , array( $this, 'get_range_for_price' ), 10, 2 );
		add_filter( 'pcd/searchform/range/registration' , array( $this, 'get_range_for_registration' ), 10, 2 );

		add_filter( 'acf/format_value_for_api' , array( $this, 'format_acf_milage_value' ), 10, 3 );
	}

	/**
	 * Returns the specifications of the current car
	 *
	 * @since 1.0.0
	 *
	 */
	public function get_vehicle_specs( $post_id = null ) {

		global $car_dealer;

		$html = '';

		$fields = $car_dealer->fields->get_registered_fields( 'specs' );

		// render output
        if ( ! empty( $fields ) ) {

        	$html .= '<p class="pcd-specs">';

        	foreach ( $fields as $k => $field ) {

        		$label = __( $field['label'], 'progression-car-dealer' );
        		$name  = $field['name'];

        		$value = get_field( $field['name'], $post_id );

        		if ( ! $value ) { 
        			unset( $fields[$k] );
        			continue; 
        		}

        		$field_value = $this->get_field_value( $name );
        		$fields[$k]['value'] = $field_value;

        		$html .= "<strong>". $label."</strong>: ". $field_value ."<br>";

        	}

        	$html .= '</p>';
        }

        return apply_filters( 'pcd/get_specs', $html, $fields );
	}
	/**
	 * Returns the value of the 'content' meta field
	 * @param  int $post_id optional Post ID
	 * @return string content of the description field
	 */
	public function get_vehicle_description( $post_id = null ) {
		return get_field ( 'content', $post_id );
	}

	/**
	 * Returns the price of the current car
	 *
	 * @since 1.0.0
	 *
	 */
	public function get_vehicle_price( $post_id = null ) {

		global $post;
		$html = '';

		if ( ! $post_id ) {
			$post_id = get_post( $post )->ID;
		}

		$msrp 	= get_field( 'msrp', $post_id );
		$price 	= get_field( 'price', $post_id );

		// render output
        if ( ! empty( $price ) ) {

        	$html .= '<p class="pcd-pricing">';

        	if ( $msrp ) {
        		$html .= sprintf( '<span class="pcd-price-msrp"><b>%s</b> %s </span><br>', __( 'MSRP.:', 'progression-car-dealer' ), $this->format_price( $msrp ) );
        	}

        	$html .= sprintf( '<span class="pcd-price"><b>%s</b> %s </span><br>', __( 'Our Price:', 'progression-car-dealer' ), $this->format_price( $price ) );
        	$html .= '</p>';
        }

        return apply_filters( 'pcd/shortcode/get_price', $html, $price, $msrp );
	}

	/**
	 * Searchform Shortcode
	 *
	 * @since 1.0.0
	 *
	 */
	public function get_vehicle_searchform( $shortcode_atts ) {

		global $car_dealer;

		wp_enqueue_script( 'car-dealer-script' );

		$defaults = array(
			'include' 	=> '',
			'exclude'   => '',
			'action' 	=> get_post_type_archive_link( 'vehicle' ), // action url,
	        'form'		=> 'true',
	        'button' 	=> __( 'Search Inventory', 'progression-car-dealer' ),
	        'form_atts' => ''
		);
		extract( shortcode_atts( apply_filters( 'pcd/searchform/defaults', $defaults ), $shortcode_atts ) );

		$registered_fields = $car_dealer->fields->get_registered_fields();
		$fields = array();
		$includes = array();
		$excludes = array();

		if ( ! empty( $include ) && is_string( $include ) ) {
			$includes = explode( ',', $include );
		}
		if ( ! empty( $exclude ) && is_string( $exclude ) ) {
			$excludes = explode( ',', $exclude );
		}

		if ( $registered_fields ) {
			foreach ( $registered_fields as $field ) {

				if ( !empty( $includes ) ) {
					if ( in_array( $field['name'] , $includes ) ) {
						$fields[$field['name']] = $field;
					}
				} else {
					if ( ! empty( $excludes ) && in_array( $field['name'], $excludes ) ) {
						continue;
					} else {
						$fields[$field['name']] = $field;
					}
				}
			}
		}
		if ( ( empty( $includes ) || in_array( 'keyword' , $includes )) && ( ! in_array( 'keyword' , $excludes )) ) {
			$fields['keyword'] = 'keyword';
		}
		if ( empty( $includes ) || in_array( 'order' , $includes ) && ( ! in_array( 'order' , $excludes )) ) {
			$fields['order'] = 'order';
		}
		if ( empty( $includes ) || in_array( 'location' , $includes ) && ( ! in_array( 'location' , $excludes )) ) {
			$fields['location'] = 'location';
		}
		// if include IDs are given, use their order to sort the fields
		if ( ! empty( $includes ) ) {
			$fields = array_merge(array_flip( $includes ), $fields);
			// credits to http://stackoverflow.com/a/9098675
		}

		// build the searchform
		add_filter( 'pcd/searchform/fields', array( $this, 'searchform_fields' ), 10, 2 );

		if ( ! in_array( 'button' , $excludes )) {
			add_filter( 'pcd/searchform/button', array( $this, 'searchform_button' ), 10, 2 );
		}

		$html = '';

		if ( $form == 'true' ) {
			$html .= "<form role='search' method='get' action='$action' class='vehicle-search-form' $form_atts>";
		}

		// add the fields
		$html = apply_filters( 'pcd/searchform/fields', $html, $fields );

		// add the button
		$html = apply_filters( 'pcd/searchform/button', $html, $button );

		$html .= '<input type="hidden" name="post_type" value="vehicle">';

		if ( $form == 'true' ) {
			$html .= '</form>';
		}

		return apply_filters( 'pcd/searchform/html', $html, $shortcode_atts) ;
	}
	public function searchform_fields( $html, $fields ) {
		foreach ( $fields as $field ) {
//            $field_name = $field['name'];
            if(isset($field['type'])){
                $fieldtype = @$field['type'];
            }else{
                $fieldtype = $fields;
            }

			if ( 'taxonomy' === $fieldtype  ) {
				$field_html = '';

				$taxonomy = $field['taxonomy'];
				$term_slug = get_query_var( $field['name'] );
				$term = get_term_by( 'slug', $term_slug, $taxonomy );
				$selected_term = empty( $term ) ? '' : $term->term_id;

				$field_html .= '<p class="field field-'. $field['name'] .' fieldtype-'. $fieldtype .'"><label title="'. __( $field['instructions'], 'progression-car-dealer' ) .'"><b>'. __( $field['label'], 'progression-car-dealer' ) .': </b><br></label>';
				$field_html .= wp_dropdown_categories( array(
					'taxonomy' => $taxonomy,
					'echo' => 0,
					'walker' => new pcd_Walker_CategoryDropdown,
					'selected' => $selected_term,
					'name' => $field['name'],
                    'class'             => 'car_dealer_field_' .$field['name'],
					'orderby' => 'NAME',
					'depth' => 1,
					'id' => 'car_dealer_field_' .$field['name'],
					'show_option_none' => __( 'All', 'progression-car-dealer' ),
				));

				$field_html .= '</p>';

				$html .= apply_filters( 'pcd/searchform/field/'. $field['name'], $field_html, $field );

			}
            if ( 'text' === $fieldtype ) {
                $field_html = '';
                $field_html .= '<p class="field field-text"><label><b>'.$field['name'].'</b></label><br>
                <input name="'. $field['name'].'" type="text" value=""> </p>';

                $html .= apply_filters( 'pcd/searchform/field/'. $field['name'], $field_html, $field );
            }

			if ( 'number' === $fieldtype ) {

				$field_html = '';

				$step 			= str_replace(',', '.', $field['step']);
				$query_var 		= get_query_var( $field['name'] );
				

				$field_html .= '<p class="field field-'. $field['name'] .' fieldtype-'. $fieldtype .'"><label title="'. $field['instructions'] .'"><b>'. $field['label'] .': </b><br></label>';

				if ( $field['prepend'] ) {
					$field_html .= '<span class="pcd-unit_prepend"> '. $field['prepend'] . ' </span>';
				}

				$field_html .= '<input name="'. $field['name'] .'[min]" type="number" min="' . $field['min'] . '" max="' . $field['max'] . '" value="'. ( isset( $query_var['min'] ) ? $query_var['min'] : $field['min'] ) .'" step="'. $step .'"> ';
				$field_html .= '<input name="'. $field['name'] .'[max]" type="number" min="' . $field['min'] . '" max="' . $field['max'] . '" value="'. ( isset( $query_var['max'] ) ? $query_var['max'] : $field['max'] ) .'" step="'. $step .'"> ';

				if ( $field['append'] ) {
					$field_html .= '<span class="pcd-unit_append"> '. $field['append'] . ' </span>';
				}
				$field_html .= '</p>';

				$html .= apply_filters( 'pcd/searchform/field/'. $field['name'], $field_html, $field );

			}

			if ( 'radio' === $fieldtype || 'checkbox' === $fieldtype ) {

				$field_html = '';

				$query_var 	 = get_query_var( $field['name'] );
				$field_html .= '<p class="field field-'. $field['name'] .' fieldtype-'. $fieldtype .'"><label title="'. $field['instructions'] .'"><b>'. $field['label'] .': </b></label><br>';

				foreach ( $field['choices'] as $choice_value => $choice_label ) {
					$checked = ( $query_var ? checked( in_array( $choice_value, $query_var ), true, false ) : '' );
					$counter = $this->get_results_for_query( $field['name'], $choice_value );
					if ( $counter == 0) {
						continue;
					}
					$field_html .=  '<label class="choice choice-'. $choice_value .'">
					<input type="checkbox" name="'. $field['name'] .'[]" value="'. $choice_value .'" '. $checked .'> '. __($choice_label,'progression-car-dealer'). ' ('. $counter .')' .'</label><br>';
				}
				$field_html .= '</p>';

				$html .= apply_filters( 'pcd/searchform/field/'. $field['name'], $field_html, $field );

			}
			if ( 'keyword' == $field ) {
				ob_start();
				    ?>
                    <p class="field field-keyword">
                    <label><b><?php _e( 'Keyword:', 'progression-car-dealer' ) ?></b></label><br>
                    <input type="search" class="search-field" placeholder="<?php _e( 'Search ...', 'progression-car-dealer' ) ?>" value="<?php echo get_query_var('s') ?>" name="s" />
                    <?php
				$html .= apply_filters( 'pcd/searchform/field/keyword', ob_get_clean(), $field );
			}
			if('location' == $field){
                global $wpdb;
                $loca_values = "SELECT  * FROM " . $wpdb->prefix . "usermeta WHERE meta_key= 'tz_google_map'";
                $loca_results = $wpdb->get_results($loca_values);
                ob_start();
                if($loca_results ){
                    ?>
                    <p class="field field-location">
                        <label><b><?php _e( 'Location:', 'progression-car-dealer' ) ?></b></label><br>
                        <select class="chosen-select" multiple name="location[]">
                            <?php
                            foreach ($loca_results as $local){
                                ?>
                                <option value="<?php echo $local->meta_value;?>"><?php echo $local->meta_value;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </p>
                    <?php
                }
                $html .= apply_filters( 'pcd/searchform/field/location', ob_get_clean(), $field );
            }

			if ( 'order' == $field ) {

				ob_start(); ?>

				<p class="field field-order">
					<label><b><?php _e( 'Sorting:', 'progression-car-dealer' ) ?> </b></label><br>
					<select name="orderby">
						<option value="-1">- <?php _e( 'Order by', 'progression-car-dealer' ) ?> -</option>
						<option value="date" <?php selected( get_query_var( 'orderby' ), 'date' ); ?>><?php _e( 'Date', 'progression-car-dealer' ) ?></option>
						<option value="price" <?php selected( "meta_value_num" == get_query_var( 'orderby' ) && "price" == get_query_var( 'meta_key' ), true ); ?>><?php _e( 'Price', 'progression-car-dealer' ) ?></option>
						<option value="name" <?php selected( get_query_var( 'orderby' ), 'name' ); ?>><?php _e( 'Name', 'progression-car-dealer' ) ?></option>
					</select>
					<select name="order">
						<option value="-1">- <?php _e( 'Sort order', 'progression-car-dealer' ) ?> -</option>
						<option value="desc" <?php selected( get_query_var( 'order' ), 'desc' ); ?>><?php _e( 'Descending', 'progression-car-dealer' ) ?></option>
						<option value="asc" <?php selected( get_query_var( 'order' ), 'asc' ); ?>><?php _e( 'Ascending', 'progression-car-dealer' ) ?></option>
					</select>
				</p>

				<?php

				$html .= apply_filters( 'pcd/searchform/field/order', ob_get_clean(), $field );
			}
		}
		return $html;
	}
	/**
	 * Quotes Form Shortcode
	 *
	 * @since 1.0.0
	 *
	 */
	public function get_vehicle_quotesform( $shortcode_atts ) {

		global $car_dealer;

		wp_enqueue_script( 'car-dealer-script' );

		$defaults = array(
			'include' 	=> '',
			'exclude'   => '',
			'action' 	=> get_post_type_archive_link( 'vehicle' ), // action url,
	        'form'		=> 'true',
	        'form_atts' => ''
		);
		extract( shortcode_atts( apply_filters( 'pcd/quotesform/defaults', $defaults ), $shortcode_atts ) );

		$registered_fields = $car_dealer->fields->get_registered_fields();
		$fields = array();
		$includes = array();
		$excludes = array();

		if ( ! empty( $include ) && is_string( $include ) ) {
			$includes = explode( ',', $include );
		}
		if ( ! empty( $exclude ) && is_string( $exclude ) ) {
			$excludes = explode( ',', $exclude );
		}

		if ( $registered_fields ) {
			foreach ( $registered_fields as $field ) {

				if ( !empty( $includes ) ) {
					if ( in_array( $field['name'] , $includes ) ) {
						$fields[$field['name']] = $field;
					}
				} else {
					if ( ! empty( $excludes ) && in_array( $field['name'], $excludes ) ) {
						continue;
					} else {
						$fields[$field['name']] = $field;
					}
				}
			}
		}
		// if include IDs are given, use their order to sort the fields
		if ( ! empty( $includes ) ) {
			$fields = array_merge(array_flip( $includes ), $fields);
			// credits to http://stackoverflow.com/a/9098675
		}

		// build the searchform
		add_filter( 'pcd/quotesform/fields', array( $this, 'quotesform_fields' ), 10, 2 );

		$html = '';
		if ( $form == 'true' ) {
			$html .= "<form role='search' method='get' action='$action' class='vehicle-search-form' $form_atts>";
		}

		// add the fields
		$html = apply_filters( 'pcd/quotesform/fields', $html, $fields );

		// add the button

		$html .= '<input type="hidden" name="post_type" value="vehicle">';

		if ( $form == 'true' ) {
			$html .= '</form>';
		}

		return apply_filters( 'pcd/quotesform/html', $html, $shortcode_atts) ;
	}

	public function quotesform_fields( $html, $fields ) {


		foreach ( $fields as $field ) {

			$fieldtype = @$field['type'];
			if ( 'taxonomy' === $fieldtype  ) {
				$field_html = '';

				$taxonomy = $field['taxonomy'];

				$term_slug = get_query_var( $field['name'] );
				$term = get_term_by( 'slug', $term_slug, $taxonomy );
				$selected_term = empty( $term ) ? '' : $term->term_id;
				if($field['label']=='Make'){
				    $text_label = __('Make','progression-car-dealer');
                }elseif($field['label']=='Model'){
                    $text_label = __('Model','progression-car-dealer');
                }
                elseif($field['label']=='Mileage'){
                    $text_label = __('Mileage','progression-car-dealer');
                }
                elseif($field['label']=='Date'){
                    $text_label = __('Date','progression-car-dealer');
                }else{
                    $text_label = $field['label'];
                }

				$field_html .= '<p class="field field-'. $field['name'] .' fieldtype-'. $fieldtype .'"><label title="'. __( $field['instructions'], 'progression-car-dealer' ) .'"><b>'. $text_label .': </b><br></label>';
                    $option_none ='';
                if($taxonomy == 'vehicle_type'){
                    $option_none = __('Vehicle Type','progression-car-dealer');
                }elseif($taxonomy == 'make'){
                    $option_none = __('Makes','progression-car-dealer');
                }elseif($taxonomy == 'model'){
                    $option_none = __('Models','progression-car-dealer');
                }else{
                    $option_none = $taxonomy;
                }
				$field_html .= wp_dropdown_categories( array(
					'taxonomy' => $taxonomy,
					'echo' => 0,
					'walker' => new pcd_Walker_CategoryDropdown,
					'selected' => $selected_term,
					'name' => $field['name'],
                    'class'             => 'car_dealer_field_' .$field['name'],
					'orderby' => 'NAME',
					'depth' => 1,
					'id' => 'car_dealer_field_' .$field['name'],
					'show_option_none' => $option_none,
				));

				$field_html .= '</p>';

				$html .= apply_filters( 'pcd/quotesform/field/'. $field['name'], $field_html, $field );

			}

		}
		return $html;
	}



	public function searchform_button( $html, $button ) {
		return $html . "<button class='car-search-submit' id='car-search-submit'>$button</button>";
	}
	public function get_vehicle_gallery( $atts ) {

		if ( $images = get_field( 'images' ) ) {
			$ids = array();
			foreach ( $images as $image ) {
				$ids[] = $image['id'];
			}
			$atts[ 'ids' ] = join( ',', $ids );
			$atts[ 'link' ] = 'file';

			return apply_filters( 'pcd/gallery', gallery_shortcode( $atts ), $atts, $images );
		}
		return false;
	}
	/**
	 * return a list of vehicles
	 * @param  array $atts
	 * @return string list output
	 */
	public function get_featured_vehicles ( $atts ) {

		extract( shortcode_atts( apply_filters( 'pcd/featured_vehicles/defaults', array(
			'ids' 	=> '',
			'before_title' => '',
			'after_title' => '',
			'before' => '',
			'after' => ''
		) ), $atts ) );

		$ids = array_filter( explode(',', $ids) );

		ob_start();

		$query_args = array(
			'post_type'           	=> 'vehicle',
			'post_status'         	=> 'publish',
			'ignore_sticky_posts' 	=> 1,
			'post__in'            	=> $ids,
			'orderby' 				=> 'post__in'
		);

		$vehicles = new WP_Query( $query_args );

		if ( $vehicles->have_posts() ) : ?>

			<?php echo $before; ?>

			<?php if ( $title ) echo $before_title . $title . $after_title; ?>

			<ul class="vehicle_listings">

				<?php while ( $vehicles->have_posts() ) : $vehicles->the_post(); ?>

					<li class="vehicle_listing">
						<h4><a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail(array(50,50), array('class' => 'alignright')) ?><?php the_title(); ?></a></h4>
					</li>

				<?php endwhile; ?>

			</ul>

			<?php echo $after; ?>

		<?php endif;

		wp_reset_postdata();

		$content = ob_get_clean();

		return $content;

	}


	public function get_field_value( $field_name ) {
		global $car_dealer, $post;
		$output = '';
		$fields = $car_dealer->fields->get_registered_fields();

		$field_found = false;

		foreach ( $fields as $field ) {
			if ( $field[ 'name' ] == $field_name ) {
				$field_found = $field;
				break;
			}
		}
		if ( empty( $field_found ) ) {
			return;
		}

		if ( 'taxonomy' == $field_found['type']  ) {
			$value = join( ', ', wp_get_object_terms( $post->ID, $field_name, array( 'fields' => 'names' ) ) );
		} elseif ( ! empty( $field['choices'][get_field( $field_name )] ) ) {
			$value = $field_found['choices'][get_field( $field_name )];
		} else {
			$value = get_field( $field_name );
		}
		if ( ! empty( $field_found['prepend'] )) {
			$output .= '<span class="unit_prepend"> '. $field_found['prepend'] . ' </span>';
		}

		$output .= __( $value, 'progression-car-dealer' );

		if ( !empty( $field_found['append'] )) {
			$output .= '<span class="unit_append"> '. $field_found['append'] . ' </span>';
		}
		return apply_filters( 'pcd/get_field_value', $output, $field_name );
	}
	public function get_results_for_query( $key, $value ) {

		global $wp_query;
/*
		if ( is_object( $wp_query->meta_query ) && ! empty( $wp_query->meta_query->queries ) ) {
			$meta_query = $wp_query->meta_query->queries;
			$meta_query[] = array(
				'key' => $key,
				'value' => $value,
				'compare' => 'IN'
			);
		} else {
			$meta_query = array(
				array(
					'key' => $key,
					'value' => $value,
					'compare' => 'IN'
				)
			);
		}
*/

        global $wpdb;
        $values = "SELECT  * FROM " . $wpdb->prefix . "postmeta pm
        LEFT JOIN " . $wpdb->prefix . "posts po ON pm.post_id = po.ID 
        WHERE pm.meta_key= '".$key."' AND  pm.meta_value = '".$value."' AND po.post_status='publish' ";
        $value_results = $wpdb->get_results($values );
        return count($value_results);
/*
$meta_query = array(
				array(
					'key' => $key,
					'value' => $value,
					'compare' => 'IN'
				)
			);


		$args = array(
			'fields' 		=> 'ids',
			'post_type' 	=> 'vehicle',
			'nopaging' 		=> true,
            'posts_per_page' => -1,
			'meta_query' 	=> $meta_query
		);

		if ( (is_post_type_archive( 'vehicle' ) || is_tax( 'vehicle_type' ) || is_tax( 'make' ) || is_tax( 'model' ) ) ) {
			$args = wp_parse_args( $args, $wp_query->query_vars );
		}
		var_dump($args);
		$pre_query = new WP_Query( $args );
        wp_reset_postdata();

		return $pre_query->found_posts;
*/
	}

	public function get_meta_values( $key = '', $post_type = 'post', $status = 'publish' ) {

	    global $wpdb;

	    if( empty( $key ) )
	        return;

	    $r = $wpdb->get_col( $wpdb->prepare( "
	        SELECT pm.meta_value FROM {$wpdb->postmeta} pm
	        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
	        WHERE pm.meta_key = '%s'
	        AND p.post_status = '%s'
	        AND p.post_type = '%s'
	    ", $key, $status, $post_type ) );
	    return $r;
	}
	public function get_range_for_milage( $range ) {
		return array_merge( $range, array( 0, 15000,30000,45000,60000,75000,100000,150000,200000,250000 ));
	}
	public function get_range_for_price( $range ) {
		return array_merge( $range, array( 1000,2000,3000,4000,5000,6000,7000,8000,9000,10000,11000,12000,13000,14000,15000,16000,17000,18000,19000,20000,22000,24000,26000,28000,30000,35000,40000,45000,50000,55000,60000,65000,70000,75000,80000,85000,90000,95000,100000,
            150000, 200000, 250000, 300000, 350000, 400000, 450000,500000));
	}
	public function get_range_for_registration() {
		global $car_dealer;

		return range( $car_dealer->fields->get_field_min_value( 'registration' ), $car_dealer->fields->get_field_max_value( 'registration' ) );
	}
	public function get_dropdown_options( $field, $range, $min, $max, $selected ) {
		$output = '';
		$prepend 		= $field['prepend'] ? $field['prepend']. '&#8201;' : '';
		$append 		= $field['append'] ? '&#8201;' .$field['append'] : '';
		foreach ( $range as $i => $range_step ) {
			if ( 'price' == $field['name'] || 'milage' == $field['name'] ) {
				if ( $range[$i] <= $min ) {
					continue; // skip steps smaller than min value in db
				}
				if ( $range[$i] - 1 >= $max ) {
					break; // skip after first step greater than max value in db
				}
				if ( 'price' == $field['name'] ) {
					$formatted_value = $this->format_price( $range_step );
				}
				if ( 'milage' == $field['name'] ) {
					$formatted_value = $prepend . $this->format_milage( $range_step ) . $append;
				}
			} else {
				$formatted_value = $prepend . $range_step . $append;
			}

			$selected_option = selected( $selected, $range_step, false );
			$output .= sprintf( '<option value="%s" %s>%s</option>', $range_step, $selected_option, $formatted_value );
		}
		return $output;
	}
	public function get_range_field( $field_html, $field ) {

		global $car_dealer;

		$query_var 	= get_query_var( $field['name'] );
		$range 		= apply_filters( 'pcd/searchform/range/'. $field['name'], array(), $field );

		$min = $car_dealer->fields->get_field_min_value( $field['name'] );
		$max = $car_dealer->fields->get_field_max_value( $field['name'] );

		$field_html = '';
		$field_html .= '<p class="field field-'. $field['name'] .' fieldtype-'. $field['type'] .'">
							<label title=" '. __( $field['instructions'], 'progression-car-dealer' ) .'"><b>'. __( $field['label'], 'progression-car-dealer' ) .': </b><br></label>';

		// HTML for  Minimum Dropdown

		$field_html .= sprintf(
			'<select class="car-dealer-min-values" name="%s"><optgroup label="%s">',
			$field['name'] .'[min]', __( 'Lowest value to accept', 'progression-car-dealer' )
		);
		$field_html .= sprintf( '<option value="%s">%s</option>', -1, __( 'Any', 'progression-car-dealer' ));

		$field_html .= $this->get_dropdown_options( $field, $range, $min, $max, ( isset( $query_var['min'] ) ? $query_var['min'] : null ) );

		$field_html .= '</optgroup></select>';

		// HTML for  Maximum Dropdown

		$field_html .= sprintf(
			'<select class="car-dealer-max-values" name="%s"><optgroup label="%s">',
			$field['name'] .'[max]', __( 'Highest value to accept', 'progression-car-dealer' )
		);
		$field_html .= sprintf( '<option value="%s">%s</option>', -1, __( 'Any', 'progression-car-dealer' ));

		$field_html .= $this->get_dropdown_options( $field, $range, $min, $max, ( isset( $query_var['max'] ) ? $query_var['max'] : null ) );

		$field_html .= '</optgroup></select>';

		$field_html .= '</p>';

		return $field_html;
	}
	/**
	 * Takes an integer value and returns a well formated string based on plugin settings
	 * @param  integer $price [description]
	 * @return [type]         [description]
	 */
	public function format_price( $price = '0' ) {

		$original_price = $price;
		$symbol 		= get_option( 'options_pcd_currency_symbol', '$' );
		$placement 		= get_option( 'options_pcd_symbol_placement', 'prepend' );
		$decimal_spaces = 0;
		$decimal_sep 	= ',';
		$thousands_sep 	= get_option( 'options_pcd_thousands_separator', ',' );

		if ( 'space' == $thousands_sep ) {
			$thousands_sep = ' ';
		}

		$price = number_format( $price, $decimal_spaces, $decimal_sep, $thousands_sep );

		if ( 'append' == $placement ) {
			$price = $price. '&nbsp;' .$symbol;
		} else {
			$price = $symbol. '' .$price;
		}
		return apply_filters( 'pcd/format_price', $price, $original_price );
	}

	/**
	 * Takes an integer value and returns a well formated string based on plugin settings
	 * @param  integer $price [description]
	 * @return [type]         [description]
	 */
	public function format_milage( $milage = 0 ) {
		$decimal_spaces = 0;
		$decimal_sep 	= ',';
		$thousands_sep 	= get_option( 'options_pcd_thousands_separator', ',' );
		if ( 'space' == $thousands_sep ) {
			$thousands_sep = ' ';
		}
		return number_format( intval($milage), $decimal_spaces, $decimal_sep, $thousands_sep );
	}
	public function format_acf_milage_value( $value, $post_id, $field ) {
		if ( 'milage' == $field['name'] ) {
			return $this->format_milage( $value );
		}
		return $value;
	}

}

new Car_Dealer_Shortcodes();


/**
 * Create HTML dropdown list of Categories.
 *
 * @package WordPress
 * @since 2.1.0
 * @uses Walker
 */
class pcd_Walker_CategoryDropdown extends Walker {
	/**
	 * @see Walker::$tree_type
	 * @since 2.1.0
	 * @var string
	 */
	var $tree_type = 'category';

	/**
	 * @see Walker::$db_fields
	 * @since 2.1.0
	 * @todo Decouple this
	 * @var array
	 */
	var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string $output   Passed by reference. Used to append additional content.
	 * @param object $category Category data object.
	 * @param int    $depth    Depth of category. Used for padding.
	 * @param array  $args     Uses 'selected' and 'show_count' keys, if they exist. @see wp_dropdown_categories()
	 */
    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $pad = str_repeat('&nbsp;', $depth * 3);
        if ( 'make' == $category->taxonomy ) {

            $make1 = get_field( 'vehicle_type', 'make_'. $category->term_id );
            if($make1){
                $car_type ='';
                if(is_object($make1)){
                    $car_type = $make1->slug;
                }else{
                    if(is_array($make1)){
                        $d=1;
                        foreach ($make1 as $mitem){
                            $term = get_term( $mitem, 'vehicle_type' );
                            if($d==1){
                                $car_type =$term->slug;
                            }else{
                                $car_type .= ','.$term->slug;
                            }
                            $d++;
                        }
                    }else{
                        $make1 = explode(',',$make1);
                        $d=1;
                        foreach ($make1 as $mitem){
                            $term = get_term( $mitem, 'vehicle_type' );
                            if($d==1){
                                $car_type =$term->slug;
                            }else{
                                $car_type .= ','.$term->slug;
                            }
                            $d++;
                        }
                    }
                }
            }

            if ( empty( $make1 ) ) {
                return;
            }

            $make = (object) array( 'slug' => $category->slug );
        }elseif ( 'model' == $category->taxonomy ) {
            $make = get_field( 'make', 'model_'. $category->term_id );
            if($make){
                if(is_object($make)){
                    $make_attr = 'data-make="'. $make->slug .'"';
                }else{
                    $make_attr = '';
                    if(is_array($make)){
                        $d=1;
                        foreach ($make as $mitem){
                            $make_term = get_term_by('id',$mitem,'make');
                            if($make_term){
                                if($d==1){
                                    $make_attr =$make_term->slug;
                                }else{
                                    $make_attr .= ','.$make_term->slug;
                                }
                            }

                            $d++;
                        }
                    }else{
                        $make = explode(',',$make);
                        $d=1;
                        foreach ($make as $mitem){
                            $make_term = get_term_by('id',$mitem,'make');
                            if($d==1){
                                $make_attr =$make_term->slug;
                            }else{
                                $make_attr .= ','.$make_term->slug;
                            }
                            $d++;
                        }
                    }
                }
            }

            if ( empty( $make ) ) {
                return;
            }
        } else {
            $make = (object) array( 'slug' => $category->slug );
        }

        $cat_name = apply_filters('list_cats', $category->name, $category);

        if ( 'make' == $category->taxonomy ) {
            $output .= "\t<option data-make=\"$make->slug\"  data-type=\"$car_type\" class=\"level-$depth\" value=\"" . $category->slug . "\"";
        }elseif(( 'vehicle_type' == $category->taxonomy )){
            $output .= "\t<option data-type=\"$make->slug\" class=\"level-$depth\" value=\"" . $category->slug . "\"";
        }else{
            $output .= "\t<option data-make=\"$make_attr\"  class=\"level-$depth\" value=\"" . $category->slug . "\"";
        }

        if ( $category->term_id == $args['selected'] )
            $output .= ' selected="selected"';
        $output .= '>';

        $output .= $pad.$cat_name;
        if ( $args['show_count'] )
            $output .= '&nbsp;&nbsp;('. $category->count .')';
        $output .= "</option>\n";
    }
}