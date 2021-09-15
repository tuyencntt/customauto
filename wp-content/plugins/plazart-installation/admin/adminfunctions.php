<?php

namespace PlazartInstallation;

defined( 'ABSPATH' ) || exit;

if(!class_exists('PlazartInstallation\AdminFunctions')){
    class AdminFunctions extends Functions {

        public static function get_template_directory($basePath = ''){
            $folder = $basePath?$basePath:get_template_directory().'/'.PLAZART_INSTALLATION_NAME;
            if(!is_dir($folder)){
                $folder   = PLAZART_INSTALLATION_ADMIN_PATH.'/templates';
            }
            if(file_exists($folder)){
                return $folder;
            }
            return false;
        }

        public static function get_template_file($layout, $view = ''){

            if(!$layout){
                return false;
            }

            $file = self::get_template_directory().($view?'/'.$view:'').'/'.$layout.'.php';

            if(file_exists($file)){
                return $file;
            }

            return false;
        }

//        public static function is_plugin_installed($plugin){
//
//            $filePath   = self::_get_plugin_basename_from_slug( $plugin['slug'] );
//
//            return file_exists(ABSPATH .'wp-content/plugins/'.$plugin);
//        }

        /**
         * Check if a plugin is installed. Does not take must-use plugins into account.
         *
         * @since 1.0.0
         *
         * @param string $slug Plugin slug.
         * @return bool True if installed, false otherwise.
         */
        public static function is_plugin_installed( $slug ) {
            $installed_plugins = self::get_plugins(); // Retrieve a list of all installed plugins (WP cached).

            $filePath   = self::_get_plugin_basename_from_slug($slug);

            return ( ! empty( $installed_plugins[$filePath ] ) );
        }

        /**
         * Check if a plugin is active.
         *
         * @since 1.0.0
         *
         * @param string $slug Plugin slug.
         * @return bool True if active, false otherwise.
         */
        public static function is_plugin_active( $slug ) {
            $filePath   = self::_get_plugin_basename_from_slug($slug);
            return is_plugin_active( $filePath );
        }

        public static function get_plugins( $plugin_folder = '' ) {
            if ( ! function_exists( 'get_plugins' ) ) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }

            return get_plugins( $plugin_folder );
        }

        public static function get_plugin_version_by_slug($slug){
            $filePath   = WP_PLUGIN_DIR . '/' .self::_get_plugin_basename_from_slug($slug);

            if(file_exists($filePath)) {
                $plugin = get_file_data($filePath, array('Version' => 'Version'), false);
                if($plugin && isset($plugin['Version']) && $plugin['Version']){
                    return $plugin['Version'];
                }
            }

            return false;
        }

        protected static function _get_plugin_basename_from_slug( $slug ) {
            $keys = array_keys( self::get_plugins() );

            foreach ( $keys as $key ) {
                if ( preg_match( '|^' . $slug . '/|', $key ) ) {
                    return $key;
                }
            }

            return $slug;
        }

        public static function generate_date_number_to_string($dateNumber, $year = false, $month = false, $week = false, $day = true){
            $dateNumber = ceil($dateNumber / 24 / 60 / 60);

            if($dateNumber < 1 || (!$year && !$month && !$week && !$day)){
                return sprintf( _n( '%s day', '%s days', (int) 0, self::get_text_domain_name() ), (int) 0 );
            }

            $str    = array();

            if($year){
                $yearNumber = (int) ($dateNumber / 365);
                if($yearNumber >= 1) {
                    $dateNumber -= (365 * $yearNumber);
                    $str[]  = sprintf( _n( '%s year', '%s years', (int) $yearNumber, self::get_text_domain_name() ), (int) $yearNumber );
                }
            }

            if($month){
                $monthNumber    = (int) ($dateNumber / 30);
                if($monthNumber >= 1) {
                    $dateNumber -= $monthNumber * 30;
                    $str[]  = sprintf( _n( '%s month', '%s months', (int) $monthNumber, self::get_text_domain_name() ), (int) $monthNumber );
                }
            }

            if($week){
                $weekNumber    = (int) ($dateNumber / 7);
                if($weekNumber >= 1) {
                    $dateNumber -= $weekNumber * 7;
                    $str[]  = sprintf( _n( '%s week', '%s weeks', (int) $weekNumber, self::get_text_domain_name() ), (int) $weekNumber );
                }
            }
            if($day){
                $dayNumber    = (int) $dateNumber;
                if($dayNumber >= 1) {
                    $str[]  = sprintf( _n( '%s day', '%s days', (int) $dayNumber, self::get_text_domain_name() ), (int) $dayNumber );
                }
            }

            return implode(' ', $str);
        }
    }
}