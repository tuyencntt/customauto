<?php
/**
 * @package TZ Autoshowroom
 */
/*
Plugin Name: TZ Autoshowroom
Plugin URI: http://templaza.com/
Description: This is plugin for Templaza. This plugin allows you to create post types, taxonomies and Visual Composer's shortcodes
Version: 1.9.6
Author: Templaza
Author URI: http://template.com/
License: GPLv2 or later
*/


/**
 * This is the TZ Autoshowroom loader class.
 *
 * @package   TZ Autoshowroom
 * @author    templaza (http:://templaza.com)
 * @copyright Copyright (c) 2014, Templaza
 */

if ( !class_exists('TZ_Autoshowroom') ):

    class TZ_Autoshowroom{

        /*
         * This method loads other methods of the class.
         */
        public function __construct(){
            /* load languages */
            $this -> load_languages();

            /*load all plazart*/
            $this -> load_plazart();

            /*load all script*/
            $this -> load_script();
            add_filter('upload_mimes', array($this,'plazart_mime_types'));
//            add_action('admin_head', array($this,'plazart_fix_svg_thumb_display'));
        }

        /*
         * Load the languages before everything else.
         */
        public function load_languages(){
            add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        }

        /*
         * Load the text domain.
         */
        public function load_textdomain(){
   
            load_plugin_textdomain('tz-autoshowroom', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
        }

        /*
         * Load script
         */
        public function load_script(){
            if( is_admin() ){
                add_action('admin_enqueue_scripts', array( $this,'admin_scripts') );
            }else{
                add_action('wp_enqueue_scripts', array( $this,'fontend_scripts') );
            }
        }

        /*
         * Load TZPlazart on the 'after_setup_theme' action. Then filters will
         */
        public function load_plazart(){

            $this -> constants();

            $this -> admin_includes();


        }

        /**
         * Constants
         */
        private function constants(){

            define('PLUGIN_PATH', plugin_dir_url( __FILE__ ));

            define('PLUGIN_SERVER_PATH',dirname( __FILE__ ) );
        }
        public function plazart_mime_types($mimes) {
            $mimes['svg'] = 'image/svg+xml';
            return $mimes;
        }
        public function plazart_fix_svg_thumb_display() {
            echo '
            td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { 
              width: 100% !important; 
              height: auto !important; 
            }
          ';
        }


        /*
         * Require file
         */
        public function  admin_includes(){
            require_once PLUGIN_SERVER_PATH.'/admin/admin-init.php';
        }

        /*
        * Require file
        */
        public function  admin_scripts(){
            global $pagenow;
            if ('post-new.php' == $pagenow || 'post.php' == $pagenow) :
                wp_enqueue_style('thickbox');
                wp_enqueue_script('media-upload');
                wp_enqueue_script('thickbox');

                // load css
                wp_enqueue_style('jquery.fancybox', PLUGIN_PATH. 'assets/css/jquery.fancybox.css');
                wp_enqueue_style('shortocde_admin', PLUGIN_PATH. 'assets/css/shortocde_admin.css');

                // load js
                wp_register_script('jquery.fancybox_js', PLUGIN_PATH .'assets/js/jquery.fancybox.js', false, false, $in_footer=true);
                wp_enqueue_script('jquery.fancybox_js');
            endif;
        }

        public function fontend_scripts(){
            // load css
            wp_register_style( 'autoshowroom-owl-animate', PLUGIN_PATH . 'assets/css/animate.css', false );
            wp_register_style( 'autoshowroom-owl-carousel-style', PLUGIN_PATH . 'assets/css/owl.carousel.min.css', false );
            wp_register_script('autoshowroom-owl-carousel-script', PLUGIN_PATH .'assets/js/owl.carousel.min.js', false, false, $in_footer=true);

            // Script & style of quote
            wp_register_style( 'autoshowroom-slick', PLUGIN_PATH . 'assets/css/slick.css', true );

            wp_deregister_script('autoshowroom-slick');
            wp_register_script('autoshowroom-slick', PLUGIN_PATH . 'assets/js/slick.js', false,false, $in_footer=true);

            // Scroll Effect
            wp_deregister_script('autoshowroom-scroll');
            wp_register_script('autoshowroom-scroll', PLUGIN_PATH . 'assets/js/jquery.scrollme.js', false,false, $in_footer=true);

            // Script counter
            wp_deregister_script('autoshowroom-counter');
            wp_register_script('autoshowroom-counter', PLUGIN_PATH . 'assets/js/autoshowroom-counter.js', false,false, $in_footer=false);

            wp_deregister_script('autoshowroom-masonry-pkgd');
            wp_register_script('autoshowroom-masonry-pkgd', PLUGIN_PATH . 'assets/js/masonry.pkgd.js', false,false, $in_footer=true);

            wp_deregister_script('autoshowroom-imagesloaded');
            wp_register_script('autoshowroom-imagesloaded', PLUGIN_PATH . 'assets/js/imagesloaded.pkgd.js', false,false, $in_footer=true);

            wp_deregister_script('autoshowroom-masonry');
            wp_register_script('autoshowroom-masonry', PLUGIN_PATH . 'assets/js/masonry.js', false,false, $in_footer=true);

            wp_deregister_script('autoshowroom-portfolio');
            wp_register_script('autoshowroom-portfolio', PLUGIN_PATH . 'assets/js/vehicle-portfolio.js', false,false, $in_footer=true);
            $admin_url      = admin_url('admin-ajax.php');
            $vehicle_portfolio_url   = array( 'url' => $admin_url);
            wp_localize_script('autoshowroom-portfolio', 'vehicle_portfolio_ajax', $vehicle_portfolio_url);

            wp_deregister_script('autoshowroom-portfolio-ajax');
            wp_register_script('autoshowroom-portfolio-ajax', PLUGIN_PATH . 'assets/js/vehicle-portfolio-ajax.js', false,false, $in_footer=true);

            wp_deregister_script('autoshowroom-owl-carousel');
            wp_register_script('autoshowroom-owl-carousel', PLUGIN_PATH . 'assets/js/autoshowroom-owl-carousel.js', false,false, $in_footer=true);

            wp_deregister_script('autoshowroom-lightgallery');
            wp_register_script('autoshowroom-lightgallery', PLUGIN_PATH . 'assets/js/lightgallery/lightgallery-all.min.js', false,false, $in_footer=true);

            wp_register_script('autoshowroom-custom-plugin', PLUGIN_PATH . 'assets/js/custom.js', false,false, $in_footer=true);

            wp_deregister_script('autoshowroom-post-slider');
            wp_register_script('autoshowroom-post-slider', PLUGIN_PATH . 'assets/js/post-slider.js', false,false, $in_footer=true);

            wp_deregister_script('ldp-customers-say');
            wp_register_script('ldp-customers-say', PLUGIN_PATH . 'assets/js/ldp-customers-say.js', false,false, $in_footer=true);

            wp_deregister_script('resize');
            wp_register_script('resize', PLUGIN_PATH . 'assets/js/resize.js', false,false, $in_footer=true);

            wp_deregister_script('autoshowroom-mousewheel');
            wp_register_script('autoshowroom-mousewheel', PLUGIN_PATH . 'assets/js/lightgallery/jquery.mousewheel.min.js', false,false, $in_footer=true);
            wp_register_style( 'autoshowroom-lightgallery-css', PLUGIN_PATH . 'assets/css/lightgallery.css', false );

            wp_register_script('recaptcha','https://www.google.com/recaptcha/api.js', false,false, $in_footer=false);
            wp_register_script('autoshowroom-ajax-quote',PLUGIN_PATH . 'assets/js/vehicle-quote-ajax.js', false,false, $in_footer=true);
            $admin_url      = admin_url('admin-ajax.php');
            $vehicle_quote_url   = array( 'url' => $admin_url);
            wp_localize_script('autoshowroom-ajax-quote', 'vehicle_quote_ajax', $vehicle_quote_url);
        }
        
    }
    $oj_plazart = new TZ_Autoshowroom();

endif;

?>