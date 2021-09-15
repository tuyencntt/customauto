<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Vehicle Dealer Widget base
 */
class Car_Dealer_Widget extends WP_Widget {

    public $widget_cssclass;
    public $widget_description;
    public $widget_id;
    public $widget_name;
    public $settings;

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct() {
        $widget_ops = array(
            'classname'   => $this->widget_cssclass,
            'description' => $this->widget_description
        );

        parent::__construct( $this->widget_id, $this->widget_name, $widget_ops );

        add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
        add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
        add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
    }

    /**
     * get_cached_widget function.
     */
    function get_cached_widget( $args ) {
        $cache = wp_cache_get( $this->widget_id, 'widget' );

        if ( ! is_array( $cache ) )
            $cache = array();

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return true;
        }

        return false;
    }

    /**
     * Cache the widget
     */
    public function cache_widget( $args, $content ) {
        $cache[ $args['widget_id'] ] = $content;

        wp_cache_set( $this->widget_id, $cache, 'widget' );
    }

    /**
     * Flush the cache
     * @return [type]
     */
    public function flush_widget_cache() {
        wp_cache_delete( $this->widget_id, 'widget' );
    }

    /**
     * update function.
     *
     * @see WP_Widget->update
     * @access public
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        if ( ! $this->settings )
            return $instance;

        foreach ( $this->settings as $key => $setting ) {
            $instance[ $key ] = sanitize_text_field( $new_instance[ $key ] );
        }

        $this->flush_widget_cache();

        return $instance;
    }

    /**
     * form function.
     *
     * @see WP_Widget->form
     * @access public
     * @param array $instance
     * @return void
     */
    function form( $instance ) {

        if ( ! $this->settings )
            return;

        foreach ( $this->settings as $key => $setting ) {
            $value = isset( $instance[ $key ] ) ? $instance[ $key ] : $setting['std'];

            switch ( $setting['type'] ) {
                case 'text' :
                    ?>
                    <p>
                        <label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
                    </p>
                    <?php
                    break;
                case 'number' :
                    ?>
                    <p>
                        <label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="number" step="<?php echo esc_attr( $setting['step'] ); ?>" min="<?php echo esc_attr( $setting['min'] ); ?>" max="<?php echo esc_attr( $setting['max'] ); ?>" value="<?php echo esc_attr( $value ); ?>" />
                    </p>
                    <?php
                    break;
                case 'taxonomy' :
                    ?>
                    <p>
                        <label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?> </label>
                        <?php wp_dropdown_categories(array(
                            'show_option_all' => __( 'All', 'progression-car-dealer' ),
                            'taxonomy' => $setting['taxonomy'],
                            'name'     => $this->get_field_name( $key ),
                            'selected' => $value
                        )); ?>
                    </p>
                    <?php
                    break;
            }
        }
    }
}

/**
 * Recent Vehicles Widget
 */
class Car_Dealer_Widget_Recent_Vehicles extends Car_Dealer_Widget {

    /**
     * Constructor
     */
    public function __construct() {
        $this->widget_cssclass    = 'car_dealer widget_recent_vehicles';
        $this->widget_description = __( 'Display a list of the most recent vehicles on your site.', 'progression-car-dealer' );
        $this->widget_id          = 'widget_recent_vehicles';
        $this->widget_name        = __( 'Recent Vehicle Listings', 'progression-car-dealer' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => __( 'Recent Vehicles', 'progression-car-dealer' ),
                'label' => __( 'Title', 'progression-car-dealer' )
            ),
            'number' => array(
                'type'  => 'number',
                'step'  => 1,
                'min'   => 1,
                'max'   => '',
                'std'   => 5,
                'label' => __( 'Number of vehicles to show', 'progression-car-dealer' )
            ),
            'size' => array(
                'type'  => 'text',
                'std'   => __( 'thumbnail', 'progression-car-dealer' ),
                'label' => __( 'Image Size', 'progression-car-dealer' )
            ),
            'vehicle_type' => array(
                'type'  	=> 'taxonomy',
                'label' 	=> __( 'Vehicle Type', 'progression-car-dealer' ),
                'taxonomy' 	=> 'vehicle_type'
            ),
        );
        parent::__construct();
    }

    /**
     * widget function.
     *
     * @see WP_Widget
     * @access public
     * @param array $args
     * @param array $instance
     * @return void
     */
    function widget( $args, $instance ) {
        global $car_dealer;

        if ( $this->get_cached_widget( $args ) )
            return;

        ob_start();

        extract( $args );

        $title  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
        $number = absint( $instance['number'] );
        $size   =   $instance['size'];
        $vehicle_type  = absint( $instance['vehicle_type'] );

        $query_args = array(
            'post_type'           => 'vehicle',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $number,
            'orderby'             => 'date',
            'order'               => 'DESC',
        );

        if ( $vehicle_type ) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'vehicle_type',
                    'field' => 'id',
                    'terms' => $vehicle_type
                )
            );
        }

        $vehicles = new WP_Query( $query_args );

        if ( $vehicles->have_posts() ) : ?>

            <?php echo $before_widget; ?>

            <?php if ( $title ) echo $before_title . $title . $after_title; ?>

            <ul class="vehicle_listings">

                <?php while ( $vehicles->have_posts() ) : $vehicles->the_post(); ?>

                    <li class="vehicle_listing">
                        <h4><a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail($size, array('class' => 'alignright')) ?> <?php the_title(); ?></a></h4>
                    </li>

                <?php endwhile; ?>

            </ul>

            <?php echo $after_widget; ?>

        <?php endif;

        wp_reset_postdata();

        $content = ob_get_clean();

        echo $content;

        $this->cache_widget( $args, $content );
    }
}

register_widget( 'Car_Dealer_Widget_Recent_Vehicles' );
