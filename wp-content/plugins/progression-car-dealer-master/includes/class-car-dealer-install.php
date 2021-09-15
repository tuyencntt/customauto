<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Car_Dealer_Install
 */
class Car_Dealer_Install {

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct() {
        $this->default_terms();
        update_option( 'car_dealer_version', CAR_DEALER_VERSION );
        $this->update_quotes();
    }

    /**
     * default_terms function.
     *
     * @access public
     * @return void
     */
    public function default_terms() {
        if ( get_option( 'car_dealer_installed_terms' ) == 1 )
            return;

        $taxonomies = array(
            'vehicle_type' => array(
                __( 'Car', 'progression-car-dealer' ),
                __( 'Motorcycle', 'progression-car-dealer' ),
                __( 'Truck', 'progression-car-dealer' ),
            )
        );

        foreach ( $taxonomies as $taxonomy => $terms ) {
            foreach ( $terms as $term ) {
                if ( ! get_term_by( 'slug', sanitize_title( $term ), $taxonomy ) ) {
                    wp_insert_term( $term, $taxonomy );
                }
            }
        }

        update_option( 'car_dealer_installed_terms', 1 );
    }
    public function update_quotes(){
        global $wpdb;
        $table_name = $wpdb->prefix . "vehicle_quotes";
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id int(11) NOT NULL AUTO_INCREMENT,
      name varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
      status int(11) NOT NULL,
      options text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
      car_values text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
      message text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      PRIMARY KEY (id)
	) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

    }
}

new Car_Dealer_Install();