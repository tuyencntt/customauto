<?php

namespace PlazartInstallation\Admin\Controller;

defined( 'ABSPATH' ) || exit;

use PlazartInstallation\AdminFunctions;
use PlazartInstallation\Application;
use PlazartInstallation\Controller\BaseController;
use PlazartInstallation\Helper\HelperLicense;

if(!class_exists('PlazartInstallation\Admin\Controller\DashboardController')){
    class DashboardController extends BaseController{

        protected $pagehook     = PLAZART_INSTALLATION_NAME.'__admin-dashboard';

        public function __construct(array $config = array())
        {
            parent::__construct($config);
        }

        public function display($view = '', $layout = '')
        {
            $result = parent::display($view, $layout);

            return $result;
        }

        public function render_metabox($post, $metabox){
            $this -> load_template($metabox['args']);
        }

        public function activation(){
            $theme          = $this -> theme_name;
            $option_name    = HelperLicense::get_option_name($theme);
            $options    = get_option($option_name);

            if($options && $options['secret_key'] == $_GET['key']) {
                $data = array(
                    'purchase_code' => $_POST['purchase_code'],
                    'license_type' => $_POST['license_type'],
                    'purchase_date' => $_POST['purchase_date'],
                    'supported_until' => $_POST['supported_until'],
                    'buyer' => $_POST['buyer'],
                    'domain' => $_POST['domain'],
                    'secret_key' => $_GET['key']
                );

                update_option($option_name, $data);

                $app    = Application::get_instance();
                $app -> enqueue_message(__('Congratulations! '.$_POST['buyer']
                    .' has been successfully activated and now you can get latest updates of the theme.',
                    $this -> text_domain), 'success');
                echo '<script>window.close();</script>';
                wp_die();
            }
        }

        public function ajax_deactivate_license(){
            if(get_option(HelperLicense::get_option_name($this -> theme_name))){
                delete_option('_plzinst_envato_license__'.$this -> theme_name);
            }
            $app    = new Application();
            $app -> enqueue_message(__('The license deleted!', $this -> text_domain), 'success');
            echo json_encode(array('success' => true, 'redirect' => admin_url('admin.php?page='.PLAZART_INSTALLATION_PREFIX.'-'.$this -> get_name())));
            wp_die();
        }
    }
}