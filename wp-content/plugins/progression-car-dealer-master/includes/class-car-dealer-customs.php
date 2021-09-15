<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Car_Dealer_Customs {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_customs' ) );
		add_action( 'admin_menu', array( $this, 'remove_taxonomy_metaboxes' ) );
	}
	/**
	 * Registers the necessary custom post types and taxonomies for the plugin
	 */
	public function register_customs() {

		$singular  = __( 'Vehicle Type', 'progression-car-dealer' );
		$plural    = __( 'Vehicle Types', 'progression-car-dealer' );

		$args = array(
			'label' 					=> $plural,
            'labels' => array(
                'name' 					=> $singular,
                'singular_name' 		=> $singular,
                'menu_name'				=> $plural,
                'search_items' 			=> sprintf( __( 'Search %s', 'progression-car-dealer' ), $plural ),
                'all_items' 			=> sprintf( __( 'All %s', 'progression-car-dealer' ), $plural ),
                'parent_item' 			=> sprintf( __( 'Parent %s', 'progression-car-dealer' ), $singular ),
                'parent_item_colon'		=> sprintf( __( 'Parent %s:', 'progression-car-dealer' ), $singular ),
                'edit_item' 			=> sprintf( __( 'Edit %s', 'progression-car-dealer' ), $singular ),
                'update_item' 			=> sprintf( __( 'Update %s', 'progression-car-dealer' ), $singular ),
                'add_new_item' 			=> sprintf( __( 'Add New %s', 'progression-car-dealer' ), $singular ),
                'new_item_name' 		=> sprintf( __( 'New %s Name', 'progression-car-dealer' ),  $singular )
        	),
			'hierarchical'               => false,
			'show_admin_column'          => true
		);
		register_taxonomy( 'vehicle_type', 'vehicle', $args );

		$singular  = __( 'Make', 'progression-car-dealer' );
		$plural    = __( 'Makes', 'progression-car-dealer' );

		$args = array(
			'label' 					=> $plural,
            'labels' => array(
                'name' 					=> $singular,
                'singular_name' 		=> $singular,
                'menu_name'				=> $plural,
                'search_items' 			=> sprintf( __( 'Search %s', 'progression-car-dealer' ), $plural ),
                'all_items' 			=> sprintf( __( 'All %s', 'progression-car-dealer' ), $plural ),
                'parent_item' 			=> sprintf( __( 'Parent %s', 'progression-car-dealer' ), $singular ),
                'parent_item_colon'		=> sprintf( __( 'Parent %s:', 'progression-car-dealer' ), $singular ),
                'edit_item' 			=> sprintf( __( 'Edit %s', 'progression-car-dealer' ), $singular ),
                'update_item' 			=> sprintf( __( 'Update %s', 'progression-car-dealer' ), $singular ),
                'add_new_item' 			=> sprintf( __( 'Add New %s', 'progression-car-dealer' ), $singular ),
                'new_item_name' 		=> sprintf( __( 'New %s Name', 'progression-car-dealer' ),  $singular )
        	),
			'hierarchical'               => false,
			'show_admin_column'          => true
		);
		register_taxonomy( 'make', 'vehicle', $args );

		$singular  = __( 'Model', 'progression-car-dealer' );
		$plural    = __( 'Models', 'progression-car-dealer' );

		$args = array(
			'label' 					=> $plural,
            'labels' => array(
                'name' 					=> $singular,
                'singular_name' 		=> $singular,
                'menu_name'				=> $plural,
                'search_items' 			=> sprintf( __( 'Search %s', 'progression-car-dealer' ), $plural ),
                'all_items' 			=> sprintf( __( 'All %s', 'progression-car-dealer' ), $plural ),
                'parent_item' 			=> sprintf( __( 'Parent %s', 'progression-car-dealer' ), $singular ),
                'parent_item_colon'		=> sprintf( __( 'Parent %s:', 'progression-car-dealer' ), $singular ),
                'edit_item' 			=> sprintf( __( 'Edit %s', 'progression-car-dealer' ), $singular ),
                'update_item' 			=> sprintf( __( 'Update %s', 'progression-car-dealer' ), $singular ),
                'add_new_item' 			=> sprintf( __( 'Add New %s', 'progression-car-dealer' ), $singular ),
                'new_item_name' 		=> sprintf( __( 'New %s Name', 'progression-car-dealer' ),  $singular )
        	),
			'hierarchical'               => false,
			'show_admin_column'          => true
		);
		register_taxonomy( 'model', 'vehicle', $args );

		/**
		 * Post types
		 */
		$singular  = __( 'Vehicle', 'progression-car-dealer' );
		$plural    = __( 'Vehicles', 'progression-car-dealer' );

		$args = array(
			'description'         => __( 'This is where you can create and manage vehicles.', 'progression-car-dealer' ),
			'labels' => array(
				'name' 					=> $plural,
				'singular_name' 		=> $singular,
				'menu_name'             => $plural,
				'all_items'             => sprintf( __( 'All %s', 'progression-car-dealer' ), $plural ),
				'add_new' 				=> __( 'Add New', 'progression-car-dealer' ),
				'add_new_item' 			=> sprintf( __( 'Add %s', 'progression-car-dealer' ), $singular ),
				'edit' 					=> __( 'Edit', 'progression-car-dealer' ),
				'edit_item' 			=> sprintf( __( 'Edit %s', 'progression-car-dealer' ), $singular ),
				'new_item' 				=> sprintf( __( 'New %s', 'progression-car-dealer' ), $singular ),
				'view' 					=> sprintf( __( 'View %s', 'progression-car-dealer' ), $singular ),
				'view_item' 			=> sprintf( __( 'View %s', 'progression-car-dealer' ), $singular ),
				'search_items' 			=> sprintf( __( 'Search %s', 'progression-car-dealer' ), $plural ),
				'not_found' 			=> sprintf( __( 'No %s found', 'progression-car-dealer' ), $plural ),
				'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', 'progression-car-dealer' ), $plural ),
				'parent' 				=> sprintf( __( 'Parent %s', 'progression-car-dealer' ), $singular )
			),
			'supports'            => array( 'title', 'editor', 'thumbnail','excerpt', 'custom-fields','comments' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 20,
			'menu_icon'           => CAR_DEALER_PLUGIN_URL . '/assets/images/icon.svg',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'rewrite'			  => array( 'slug' => 'inventory' )
		);
		register_post_type( 'vehicle', $args );

	}
	/**
	 * Removes the default taxonomy metaboxes from the edit screen.
	 * We use the advanced custom fields instead and sync the data.
	 */
	public function remove_taxonomy_metaboxes(){
		remove_meta_box( 'tagsdiv-make', 'vehicle', 'normal' );
		remove_meta_box( 'tagsdiv-model', 'vehicle', 'normal' );
		remove_meta_box( 'tagsdiv-vehicle_type', 'vehicle', 'normal' );
	}

	/**
	 * Since our vehicle post type doesn't have an editor field we need to display some of the meta values instead
	 * @param  string $content 	the existing content
	 * @return string $content 	the updated content
	 */
	function vehicle_content( $content ) {
		global $post;

		if ( $post->post_type == 'vehicle' ) {

			$content = do_shortcode( '[vehicle_description]' );
		}

		return $content;
	}
}
?>