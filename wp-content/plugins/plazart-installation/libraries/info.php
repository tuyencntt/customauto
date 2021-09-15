<?php

namespace PlazartInstallation;

defined( 'ABSPATH' ) || exit;

if(!class_exists('PlazartInstallation\Info')){
    class Info{

        protected $info = array(
            'success' => false,
            'message' => '',
        );

        public function set($key, $value)
        {
            if($key && $value){
                $this -> info[$key] = $value;
            }
        }
        public function get($key)
        {
            if(isset($this -> info[$key])){
                return $this -> info[$key];
            }
        }

        public function set_message($message = '', $error = true)
        {
            if($message){
                $this -> set('success', !$error);
                $this -> set('message', $message);
            }
        }
        public function reset(){
            $this -> info   = array(
                'success' => false,
                'message' => '',
            );
        }

        public function output($reset = false){
            if(!count($this -> info)){
                return json_encode(array());
            }
            $info   = json_encode($this -> info);

            if($reset) {
                $this->reset();
            }

            return $info;
        }
    }
}