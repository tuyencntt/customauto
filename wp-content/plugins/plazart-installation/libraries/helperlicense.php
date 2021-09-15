<?php
/**
 * Base layout for all admin pages
 */

namespace PlazartInstallation\Helper;

defined( 'ABSPATH' ) || exit;

//$test   = array(
//    'purchase_code' => "3c2028b9-54ac-41a9-9be9-62c35e3487ee",
//    'license_type' => "Regular License",
//    'purchase_date' => "2020-03-10",
//    'supported_until' => "2020-10-29",
//    'buyer' => "templaza",
//    'domain' => "http://localhost/wordpress",
//    'secret_key' => "6f613bedb5398fc9abe544ae212c125e"
//);
//var_dump(serialize($test));
//var_dump(unserialize('a:3:{i:0;s:45:"plazart-installation/plazart-installation.php";i:1;s:66:"videowhisper-live-streaming-integration/videowhisper_streaming.php";i:2;s:30:"youtube-embed-plus/youtube.php";}'));
//var_dump(unserialize('a:7:{s:13:"purchase_code";s:36:"3c2028b9-54ac-41a9-9be9-62c35e3487ee";s:12:"license_type";s:15:"Regular License";s:13:"purchase_date";s:10:"2020-03-10";s:15:"supported_until";s:10:"2020-10-29";s:5:"buyer";s:8:"templaza";s:6:"domain";s:26:"http://localhost/wordpress";s:10:"secret_key";s:32:"6f613bedb5398fc9abe544ae212c125e";}'));
//var_dump(get_option('_plzinst_envato_license__twentytwenty'));
//die();

if(!class_exists('PlazartInstallation\Helper\HelperLicense')){
    class HelperLicense{
        protected static $cache  = array();

        public static function get_license($theme){
            $store_id   = __METHOD__;
            $store_id  .= ':'.$theme;
            $store_id   = md5($store_id);

            if(isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }

            $theme    = strtolower($theme);

            $license = get_option(self::get_option_name($theme));

            if($license && !isset($license['purchase_code'])){
                $license['purchase_code']   = '';
            }
            self::$cache[$store_id] = $license;
            return self::$cache[$store_id];
        }

        public static function get_purchase_code($theme)
        {
            $theme = strtolower($theme);
            $license = self::get_license($theme);

            if (!$license || ($license && !$license['purchase_code'])) {
                return false;
            }

            $purchase_date = strtotime($license['purchase_date']);
//            if($purchase_date <= time()) {
                // Check support date valid
//                $support_until = strtotime($license['support_until']);
//            if ($support_until < time() || $support_until < $purchase_date) {
            return $license['purchase_code'];
//            }
//            }
//            return false;
        }

        public static function is_authorised($theme)
        {
            $theme      = strtolower($theme);
            $license    = self::get_license($theme);

            if($license && isset($license['purchase_code']) && $license['purchase_code']){
                return true;
            }

//            if(!self::has_expired($theme)){
//                return true;
//            }
            return false;
        }

        public static function has_expired($theme){
            $theme          = strtolower($theme);
            $license        = self::get_license($theme);

            if(!$license || ($license && isset($license['purchase_code']) && !$license['purchase_code'])){
                return true;
            }

            $purchase_date  = isset($license['purchase_date'])?strtotime($license['purchase_date']):0;
            $support_until  = isset($license['support_until'])?strtotime($license['support_until']):0;

            if($support_until < time() || $support_until < $purchase_date){
                return false;
            }
            return true;
        }

        public static function get_option_name($theme){
            $theme  = strtolower($theme);
            $name   = '_'.PLAZART_INSTALLATION_PREFIX.'_envato_license__'.$theme;
            return $name;
        }

        public static function generate_secret_key($theme){

            $store_id   = __METHOD__;
            $store_id  .= ':'.$theme;
            $store_id   = md5($store_id);

            if(isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }
            $theme    = strtolower($theme);

            self::$cache[$store_id] = md5(uniqid($theme));
            return self::$cache[$store_id];
        }

        public static function get_secret_key($theme){

            $store_id   = __METHOD__;
            $store_id  .= ':'.$theme;
            $store_id   = md5($store_id);

            if(isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }

            $option = get_option(self::get_option_name($theme));
            self::$cache[$store_id] = $option['secret_key'];
//            $theme    = strtolower($theme);
//
//            self::$cache[$store_id] = md5(uniqid($theme));
            return self::$cache[$store_id];
        }
    }
}