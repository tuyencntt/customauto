<?php

namespace PlazartInstallation\Controller;

defined( 'ABSPATH' ) || exit;

use PlazartInstallation\AdminFunctions;
use PlazartInstallation\Application;
use PlazartInstallation\Functions;

if(!class_exists('PlazartInstallation\Controller\BaseController')){

    class BaseController{

        protected $name;
        protected $theme_name;
        protected $text_domain;
        protected $theme_config_registered;

        protected $cache        = array();
        protected $layout       = 'default';
        protected $basePath     = '';
        protected $default_view = '';

        /**
         * Array of class methods to call for a given task.
         *
         * @var    array
         */
        protected $action_map;

        /**
         * The mapped task that was performed.
         *
         * @var    string
         */
        protected $do_task;

        protected static $instance;

        public function __construct($config = array()){
            $this -> text_domain    = Functions::get_text_domain_name();
            if(isset($config['theme_name'])) {
                $this -> theme_name = $config['theme_name'];
            }
            if(isset($config['theme_config_registered'])) {
                $this -> theme_config_registered = $config['theme_config_registered'];
            }

            if(isset($config['basePath'])){
                $this -> basePath   = $config['basePath'];
            }

            $this -> action_map = array();

            $r = new \ReflectionClass($this);
            $rMethods = $r->getMethods(\ReflectionMethod::IS_PUBLIC);

            // Determine the methods to exclude from the base class.
            $xMethods   = get_class_methods('PlazartInstallation\Controller\BaseController');
            $xMethods   = $xMethods?$xMethods:array();

            foreach ($rMethods as $rMethod)
            {
                $mName = $rMethod->getName();

                // Add default display method if not explicitly declared.
                if ($mName === 'display' || !in_array($mName, $xMethods))
                {
                    $this->methods[] = strtolower($mName);

                    // Auto register the methods as tasks.
                    $this->action_map[strtolower($mName)] = $mName;
                }
            }
        }

        public static function getInstance($prefix = '', $config = array()){

            $page   = $_GET['page']?$_GET['page']:($_POST['page']?$_POST['page']:'');

            $basePath = array_key_exists('basePath', $config) ? $config['basePath'] : PLAZART_INSTALLATION_PATH;
            $path       = $basePath.'/controllers';
            $type       = preg_replace('/^'.PLAZART_INSTALLATION_PREFIX.'[-]?/i', '', $page);

            if(!$type){
                $type   = 'Base';
            }

            $file       = $path . '/' . $type.'controller.php';

            if(!$prefix && is_admin()){
                $prefix = 'PlazartInstallation\Admin\Controller\\';
            }elseif(!$prefix && !is_admin()){
                $prefix = 'PlazartInstallation\Controller\\';
            }else{
                $prefix .= '\\';
            }

            if(!file_exists($file)){
                $type       = 'base';
                $prefix     = 'PlazartInstallation\Controller\\';
                $file       = PLAZART_INSTALLATION_PATH . '/controller/basecontroller.php';
            }

            // Get the controller class name.
            $class = $prefix.ucfirst($type).'Controller';

            if (!class_exists($class) && $type && file_exists($file))
            {
                require_once $file;
            }

            if(!class_exists($class)){
                return false;
            }

            // Instantiate the class, store it to the static container, and return it
            return new $class($config);
        }

        /**
         * Method to get the controller name
         *
         * The dispatcher name is set by default parsed using the classname, or it can be set
         * by passing a $config['name'] in the class constructor
         *
         */
        public function get_name()
        {
            if (empty($this->name))
            {
                $page   = $_GET['page']?$_GET['page']:($_POST['page']?$_POST['page']:'');
                $name   = preg_replace('/^'.PLAZART_INSTALLATION_PREFIX.'[-]?/i', '', $page);

                $this -> name   = $name;
            }

            return $this->name;
        }

        public function render(){

        }

        public function display($view = ''){
            if(!$view){
                if($name = $this -> get_name()){
                    $view   = $name;
                }elseif($this -> default_view){
                    $view   = $this -> default_view;
                }
            }

            if($file = AdminFunctions::get_template_file($this -> get_layout(), $view)){
                $result = require_once $file;
                return $result;
            }

            return false;
        }

        public function get_layout(){
            $layout = (isset($_GET['layout']) && $_GET['layout'])?$_GET['layout']:$this -> layout;
            return $layout;
        }

        public function set_layout($layout){
            $this -> layout = $layout;
        }

        public function load_template($tmpl = null){

            $func   = AdminFunctions::get_template_directory();

            $file   = $func.'/'.$this -> get_name().'/'.$this -> get_layout().($tmpl?'_'.$tmpl:'').'.php';

            if(file_exists($file)){
                include $file;
            }
        }


        /**
         * Execute a task by triggering a method in the derived class.
         *
         * @param   string  $action  The task to perform. If no matching task is found, the '__default' task is executed, if defined.
         *
         * @return  mixed   The value returned by the called method.
         *
         * @throws  \Exception
         */
        public function execute($action)
        {
            $this->task = $action;

            $action = strtolower($action);

            if (isset($this->action_map[$action]))
            {
                $doTask = $this->action_map[$action];
            }
            elseif (isset($this->action_map['__default']))
            {
                $doTask = $this->action_map['__default'];
            }
            else
            {
                $app    = Application::get_instance();
                $app -> enqueue_message(sprintf(esc_html__('Action %s not found.'), $action), 'error');
            }

            // Record the actual task being fired
            $this->do_task = $doTask;

            return $this->$doTask();
        }

        public function set($property, $value = null)
        {
            $previous = isset($this->$property) ? $this->$property : null;
            $this->$property = $value;


            return $previous;
        }

        public function get($property, $default = null)
        {
            if (isset($this->$property))
            {
                return $this->$property;
            }

            return $default;
        }
    }
}