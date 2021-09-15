<?php

namespace PlazartInstallation;

defined( 'ABSPATH' ) || exit;

require_once PLAZART_INSTALLATION_LIBRARY.'/uri.php';
require_once PLAZART_INSTALLATION_INCLUDES.'/functions.php';
require_once PLAZART_INSTALLATION_LIBRARY.'/basecontroller.php';

use PlazartInstallation\Uri;
use PlazartInstallation\Admin;

if(!class_exists('PlazartInstallation\Application')){

    class Application extends Functions {

        protected $text_domain;
        protected $_message_queue   = array();
        protected static $instance;

        public function __construct()
        {
            $this -> text_domain    = self::get_text_domain_name();
        }

        public static function get_instance(){
            if(self::$instance && self::$instance instanceof Application){
                return self::$instance;
            }

            self::$instance = new Application();
            return self::$instance;
        }

        public function init(){

            if(is_admin()){
                require_once PLAZART_INSTALLATION_ADMIN_PATH . '/admin.php';
                $admin = new Admin();
                add_action('init', array($admin, 'init'));
            }
        }

        public function enqueue_message($msg, $type = 'message'){

            // Don't add empty messages.
            if (trim($msg) === '')
            {
                return;
            }

            // For empty queue, if messages exists in the session, enqueue them first.
            $messages = $this->get_message_queue();

            $message = array('message' => $msg, 'type' => strtolower($type));

            if (!in_array($message, $this->_message_queue))
            {
                // Enqueue the message.
                $this->_message_queue[] = $message;
            }
            $_SESSION[PLAZART_INSTALLATION_PREFIX . '_application.queue']   = $this -> _message_queue;
        }

        public function get_message_queue($clear = false)
        {
            // For empty queue, if messages exists in the session, enqueue them.
            if (!$this->_message_queue)
            {
                $sessionQueue = (isset($_SESSION[PLAZART_INSTALLATION_PREFIX . '_application.queue'])
                    && $_SESSION[PLAZART_INSTALLATION_PREFIX . '_application.queue'])?
                    $_SESSION[PLAZART_INSTALLATION_PREFIX . '_application.queue']:array();

                if ($sessionQueue)
                {
                    $this->_message_queue = array_unique($sessionQueue);
                    $_SESSION[PLAZART_INSTALLATION_PREFIX . '_application.queue']   = array();
                }
            }

            $messageQueue = $this->_message_queue;

            if ($clear)
            {
                $this->_message_queue = array();
            }

            return $messageQueue;
        }
    }
}

$GLOBALS['plazart_installation'] = new Application();
add_action('init', array($GLOBALS['plazart_installation'], 'init'), 1);