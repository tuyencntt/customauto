<?php

namespace PlazartInstallation;

defined( 'ABSPATH' ) || exit;

if(!class_exists('PlazartInstallation\Functions')){

    class Functions{
        protected static $cache    = array();

        public static function get_my_plugin_data(){
            $storeId    = md5(__METHOD__);

            if(isset(self::$cache[$storeId])){
                return self::$cache[$storeId];
            }

            $file   = PLAZART_INSTALLATION_PATH.'/'.PLAZART_INSTALLATION_NAME.'.php';

            if(!file_exists($file)){
                return false;
            }
            if( !function_exists('get_plugin_data') ){
                require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            }

            if($plugin = get_plugin_data( $file, true, true )){

                $other_data = get_file_data( $file,
                    array(
                        'Forum' => 'Forum',
                        'Ticket' => 'Ticket',
                        'FanPage' => 'FanPage',
                        'Twitter' => 'Twitter',
                        'Google' => 'Google+'
                    ),
                    'plugin' );
                $plugin = array_merge($plugin, $other_data);

                self::$cache[$storeId]  = $plugin;
                return $plugin;
            }
            return false;
        }

        public static function get_plugin_url(){
            return plugins_url().'/'.PLAZART_INSTALLATION_NAME;
        }

        public static function get_plugin_version(){
            $plugin = self::get_my_plugin_data();

            return $plugin['Version'];
        }

        public static function get_template_directory(){
            $file   = get_template_directory().'/'.PLAZART_INSTALLATION_NAME;
            if(!file_exists($file)){
                $file   = PLAZART_INSTALLATION_PATH.'/templates';
            }
            if(file_exists($file)){
                return $file;
            }
            return false;
        }

        public static function get_text_domain_name(){
            $plugin = self::get_my_plugin_data();

            if(!$plugin){
                return false;
            }
            return $plugin['TextDomain'];
        }

        public static function get_page_type(){
            if(!isset($_GET['page']) || (isset($_GET['page']) && !$_GET['page'])){
                return false;
            }

            $page   = $_GET['page'];
            $type       = preg_replace('/^'.PLAZART_INSTALLATION_PREFIX.'[-]?/i', '', $page);
            return $type;
        }
    }
}