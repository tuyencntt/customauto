<?php

defined( 'ABSPATH' ) || exit;

if(!defined('PLAZART_INSTALLATION_PATH')){
    define('PLAZART_INSTALLATION_PATH', dirname( dirname(__FILE__)));
}
if(!defined('PLAZART_INSTALLATION_ADMIN_PATH')){
    define('PLAZART_INSTALLATION_ADMIN_PATH', PLAZART_INSTALLATION_PATH.'/admin');
}
//if(!defined('PLAZART_INSTALLATION_TEXT_DOMAIN')){
//    define('PLAZART_INSTALLATION_TEXT_DOMAIN', 'plazart-installation');
//}
if(!defined('PLAZART_INSTALLATION_MENU_SLUG_PREFIX')){
    define('PLAZART_INSTALLATION_MENU_SLUG_PREFIX', 'plazart-installation');
}

