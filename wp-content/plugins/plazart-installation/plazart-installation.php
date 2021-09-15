<?php
/*
Plugin Name: Plazart Installation
Plugin URI: http://wordpress.org/plugins/plazart-installation/
Description: This plugin help you install demo data of themes.
Author: plazart-installation
Version: 2.3
Text Domain: plazart-installation
Author URI: http://templaza.com
Forum: https://www.templaza.com/Forums.html
Ticket: https://www.templaza.com/tz_membership/addticket.html
FanPage: https://www.facebook.com/templaza
Twitter: https://twitter.com/templazavn
Google+: https://plus.google.com/+Templaza
*/

defined( 'ABSPATH' ) || exit;

if(!defined('PLAZART_INSTALLATION_PATH')){
    define('PLAZART_INSTALLATION_PATH',  dirname(__FILE__));
}
if(!defined('PLAZART_INSTALLATION_ADMIN_PATH')){
    define('PLAZART_INSTALLATION_ADMIN_PATH', PLAZART_INSTALLATION_PATH.'/admin');
}
if(!defined('PLAZART_INSTALLATION_LIBRARY')){
    define('PLAZART_INSTALLATION_LIBRARY', PLAZART_INSTALLATION_PATH.'/libraries');
}
if(!defined('PLAZART_INSTALLATION_INCLUDES')){
    define('PLAZART_INSTALLATION_INCLUDES', PLAZART_INSTALLATION_PATH.'/includes');
}
if(!defined('PLAZART_INSTALLATION_TEMPLATES')){
    define('PLAZART_INSTALLATION_TEMPLATES', PLAZART_INSTALLATION_PATH.'/templates');
}
if(!defined('PLAZART_INSTALLATION_PREFIX')){
    define('PLAZART_INSTALLATION_PREFIX', 'plzinst');
}
if(!defined('PLAZART_INSTALLATION_NAME')){
    define('PLAZART_INSTALLATION_NAME', basename(dirname( __FILE__  ) ));
}
//if(!defined('PLAZART_INSTALLATION_API_DOMAIN')){
//    define('PLAZART_INSTALLATION_API_DOMAIN', 'https://joomla.templaza.com/tzportfolio.com/joomla');
//}
if(!defined('PLAZART_INSTALLATION_API_DOMAIN')){
    define('PLAZART_INSTALLATION_API_DOMAIN', 'https://www.templaza.com');
}
//if(!defined('PLAZART_INSTALLATION_TEXT_DOMAIN')){
//    define('PLAZART_INSTALLATION_TEXT_DOMAIN', PLAZART_INSTALLATION_NAME);
//}

require_once 'includes/application.php';