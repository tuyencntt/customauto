<?php

namespace PlazartInstallation;

defined( 'ABSPATH' ) || exit;

if(!class_exists('PlazartInstallation\Uri')){
    class Uri{
        public static function get_plugin_url(){
            return plugins_url().'/'.PLAZART_INSTALLATION_NAME;
        }
    }
}