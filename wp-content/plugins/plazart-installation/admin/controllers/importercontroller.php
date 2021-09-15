<?php

namespace PlazartInstallation\Admin\Controller;

defined( 'ABSPATH' ) || exit;

require_once PLAZART_INSTALLATION_LIBRARY.'/info.php';

use PlazartInstallation\AdminFunctions;
use PlazartInstallation\Application;
use PlazartInstallation\Controller\BaseController;
use PlazartInstallation\Files;
use PlazartInstallation\Helper\HelperLicense;
use PlazartInstallation\Info;

if(!class_exists('PlazartInstallation\Admin\Controller\ImporterController')){
    class ImporterController extends BaseController{

        protected $pagehook         = PLAZART_INSTALLATION_NAME.'__admin-importer';
        protected $imported_key;
        protected $plugins          = array();
        protected $theme_demo_datas;
        protected $api  = PLAZART_INSTALLATION_API_DOMAIN;
        protected $info;

        public function __construct(array $config = array())
        {
            parent::__construct($config);

            $this -> info   = new Info();

            if(!HelperLicense::is_authorised($this -> theme_name)){
                $app    = Application::get_instance();
                $app -> enqueue_message(sprintf(__(
                    'Theme %s not Activated! To install any of the demo content sites below you must <a href="%s">Activate theme</a>',
                    $this -> text_domain), wp_get_theme()->get('Name'),
                    admin_url('admin.php?page='.PLAZART_INSTALLATION_PREFIX.'-dashboard') ), 'warning');
            }

            $this -> imported_key   = '_'.PLAZART_INSTALLATION_PREFIX.'_'.$this -> theme_name.'__demo_imported';
        }

        public function get_theme_demo_datas(){

            $results    = $this -> get('theme_demo_datas', array());
            return $results;
        }

        public function get_all_plugins(){
            $results    = $this -> get_theme_demo_datas();

            if($results && count($results)){
                foreach($results as $item){
                    if(isset($item['plugins']) && $item['plugins']){
                        foreach($item['plugins'] as $plugin){
                            if(!isset($this -> plugins[$plugin['slug']])){
                                $this -> plugins[$plugin['slug']]   = $plugin;
                            }
                        }
                    }
                }
            }

            return $this -> plugins;
        }

        public function plzinst_plugin_action(){
            add_action('wp_ajax_plzinst_plugin_action', array($this, 'ajax_plugin_action'));
            add_action('wp_ajax_nopriv_plzinst_plugin_action', array($this, 'ajax_plugin_action'));
        }
        public function plzinst_import_demo_data(){
            add_action('wp_ajax_plzinst_import_demo_data', array($this, 'ajax_import_demo_data'));
            add_action('wp_ajax_nopriv_plzinst_import_demo_data', array($this, 'ajax_import_demo_data'));
        }

        public function enable_tgmpa(){
            return true;
        }

        protected $imported = array();

        public function ajax_plugin_action(){
            if ( current_user_can( 'switch_themes' ) ) {
                $prefix = PLAZART_INSTALLATION_PREFIX;
//                if ( isset( $_GET[$prefix.'_activate'] ) && 'activate-plugin' === $_GET[$prefix.'_activate'] ) {

                    check_admin_referer( PLAZART_INSTALLATION_NAME.'-action','_nonce' );

                    if(!isset($_GET['plugin']) && !$_GET['plugin']){
                        echo '<div data-plzinst-install-plugin-message>';
                        wp_send_json(array(
                            'success' => false,
                            'installed' => false,
                            'activated' => false,
                            'message' => __('Not found plugin', $this -> text_domain)
                        ));
                        echo '</div>';
                        exit();
                    }

                    $_plugin    = $_GET['plugin'];
                    $plugins    = $this -> get_all_plugins();
                    $plugin     = $plugins[$_plugin];
                    $failed     = isset($_GET['failed']) && $_GET['failed']?$_GET['failed']:array();
                    $passed     = isset($_GET['passed']) && $_GET['passed']?$_GET['passed']:array();

                    $resultJSON = array(
                        'success'   => false,
                        'update'    => false,
                        'install'   => false,
                        'activate'  => false,
                        'activated' => false
                    );

                    $tgmConfig  = array(
                        'id'            => $this -> text_domain,
                        'has_notices'   => true,
                        'is_automatic'  => true,
                        'strings'       => array(
                            'updating'              => __( 'Updating Plugin: %s', $this -> text_domain ),
                            'plugin_updated'      => _n_noop( 'Plugin "%s" updated successfully.',
                                'Plugins "%s" updated successfully.', $this -> text_domain ),
                            'plugin_activated'      => _n_noop( 'Plugin "%s" activated successfully.',
                                'Plugins "%s" activated successfully.', $this -> text_domain ),
                            'plugin_update_error'   => _n_noop('Can not update plugin "%s". Please check it again!',
                                'Can not update plugins "%s". Please check it again!', $this->text_domain),
                            'plugin_install_error'  => _n_noop('Can not install plugin "%s". Please check it again!',
                                'Can not install plugins "%s". Please check it again!', $this->text_domain),
                            'plugin_activate_error' => _n_noop( 'Can not activate plugin "%s".',
                                'Can not activate plugins "%s".', $this -> text_domain ),
                            'complete'              => __( 'All plugins installed and activated successfully. %1$s',  $this -> text_domain ),
                        )
                    );
                    if(isset($_GET['tgmpa-update']) && 'update-plugin' === $_GET['tgmpa-update']){
                        $tgmConfig['is_automatic']  = false;
                    }

                    tgmpa( $plugins, $tgmConfig);

                    $tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );

                    // Unfortunately 'output buffering' doesn't work here as eventually 'wp_ob_end_flush_all' function is called.
                    $tgmpa_instance->install_plugins_page();

                    echo '<div data-plzinst-install-plugin-message>';
                    if(isset($_GET['tgmpa-install']) && 'install-plugin' === $_GET['tgmpa-install']){
                       // Install Plugin
                       if ($tgmpa_instance->is_plugin_installed($_plugin)) {
                           if($tgmConfig['is_automatic'] && $tgmpa_instance -> is_plugin_active($_plugin)){
                               $resultJSON['success']   = true;
                               $resultJSON['activated'] = true; /* Enable text actived */
                           }else{
                               $resultJSON['success']   = true;
                               $resultJSON['activate']  = true; /* Enable text activate */
                           }

                           $install                 = isset($passed['install']) && $passed['install']?$passed['install']:array();
                           $install[]               = $plugin['name'];
                           $passed['install']       = $install;
                           $msgCount                = count($install);
                           $pluginNames             = $msgCount?implode(", ", $install):$plugin['name'];
                           $message                 = translate_nooped_plural($tgmConfig['strings']['plugin_updated'],$msgCount, $this -> text_domain);

                           $resultJSON['passed']    = $passed;
                           $resultJSON['message']   = sprintf($message, $pluginNames);
                       }else {
                           $install                 = isset($failed['install']) && $failed['install']?$failed['install']:array();
                           $install[]               = $plugin['name'];
                           $failed['install']       = $install;
                           $msgCount                = count($install);
                           $pluginNames             = $msgCount?implode(", ", $install):$plugin['name'];
                           $message                 = translate_nooped_plural($tgmConfig['strings']['plugin_install_error'],$msgCount, $this -> text_domain);

                           $resultJSON['success']   = false;
                           $resultJSON['install']   = true; /* Enable text install */
                           $resultJSON['failed']    = $failed;
//                           $resultJSON['message']   = sprintf($message, $pluginNames);
                       }
                    }elseif(isset($_GET['tgmpa-update']) && 'update-plugin' === $_GET['tgmpa-update']){
                       // Update Plugin
                       $installedVersion    = $tgmpa_instance->get_installed_version($_plugin);
                       if(version_compare($installedVersion, $plugin['version'], '=')){
                           if($tgmpa_instance -> is_plugin_active($_plugin)){
                               $resultJSON['success']   = true;
                               $resultJSON['activated'] = true; /* Enable text activated */
                           }else{
                               $resultJSON['success']   = true;
                               $resultJSON['activate']  = true; /* Enable text activate */
                           }

                           $update                  = isset($passed['update']) && $passed['update']?$passed['update']:array();
                           $update[]                = $plugin['name'];
                           $passed['update']        = $update;
                           $msgCount                = count($update);
                           $pluginNames             = $msgCount?implode(", ", $update):$plugin['name'];
                           $message                 = translate_nooped_plural($tgmConfig['strings']['plugin_updated'],$msgCount, $this -> text_domain);

                           $resultJSON['passed']    = $passed;
                           $resultJSON['message']   = sprintf($message, $pluginNames);
                       }else{
                           $update                  = isset($failed['update']) && $failed['update']?$failed['update']:array();
                           $update[]                = $plugin['name'];
                           $failed['update']       = $update;
                           $msgCount                = count($update);
                           $pluginNames             = $msgCount?implode(", ", $update):$plugin['name'];
                           $message                 = translate_nooped_plural($tgmConfig['strings']['plugin_update_error'],$msgCount, $this -> text_domain);

                           $resultJSON['success']   = false;
                           $resultJSON['update']    = true; /* Enable text update */
                           $resultJSON['failed']    = $failed;
                           $resultJSON['message']   = sprintf($message, $pluginNames);
                       }
                    }elseif(isset($_GET['tgmpa-activate']) && 'activate-plugin' === $_GET['tgmpa-activate']){
                       // Activate Plugin
                       if($tgmpa_instance -> is_plugin_active($_plugin)){
                           $activate                = isset($passed['activate']) && $passed['activate']?$passed['activate']:array();
                           $activate[]              = $plugin['name'];
                           $passed['activate']      = $activate;
                           $msgCount                = count($activate);
                           $pluginNames             = $msgCount?implode(", ", $activate):$plugin['name'];
                           $message                 = translate_nooped_plural($tgmConfig['strings']['plugin_activated'],$msgCount, $this -> text_domain);

                           $resultJSON['success']   = true;
                           $resultJSON['activated'] = true; /* Enable text activated */
                           $resultJSON['passed']    = $passed;
                           $resultJSON['message']   = sprintf($message, $pluginNames);
                       }else{
                           $activate                = isset($failed['activate']) && $failed['activate']?$failed['activate']:array();
                           $activate[]              = $plugin['name'];
                           $failed['activate']      = $activate;
                           $msgCount                = count($activate);
                           $pluginNames             = $msgCount?implode(", ", $activate):$plugin['name'];
                           $message                 = translate_nooped_plural($tgmConfig['strings']['plugin_activate_error'],$msgCount, $this -> text_domain);

                           $resultJSON['success']   = true;
                           $resultJSON['activate']  = true; /* Enable text activate */
                           $resultJSON['failed']    = $failed;
                           $resultJSON['message']   = sprintf($message, $pluginNames);
                       }
                    }

                   if(count($resultJSON)){
                       wp_send_json($resultJSON);
                   }
                   echo '</div>';
                   exit();
//                }
            }
        }

        public function get_pack_by_slug($slug){
            if(!$slug){
                return false;
            }

            $storeId    = __METHOD__;
            $storeId   .= ':'.$slug;
            $storeId    = md5($storeId);

            if(isset($this -> cache[$storeId])){
                return $this -> cache[$storeId];
            }

            $packs  = $this -> get_theme_demo_datas();

            if(!count($packs)){
                return false;
            }

            foreach($packs as $key => $value){
                if(!is_numeric($key) && $key == $slug){
                    $this -> cache[$storeId]    = $value;
                    return $value;
                }elseif(isset($value['slug']) && $value['slug'] == $slug){
                    $this -> cache[$storeId]    = $value;
                    return $value;
                }
            }
            return false;
        }

        public function ajax_import_demo_data(){
            if ( current_user_can( 'switch_themes' ) ) {

                check_admin_referer( PLAZART_INSTALLATION_NAME.'-demo-ajax','security');

//                if ( function_exists( 'ini_get' ) ) {
//                    if ( 300 < ini_get( 'max_execution_time' ) ) {
//                        set_time_limit( 300 );
//                    }
//                    if ( 512 < intval( ini_get( 'memory_limit' ) ) ) {
//                        wp_raise_memory_limit();
//                    }
//                }
//                wp_cache_flush();

                $prefix = PLAZART_INSTALLATION_PREFIX;

                $theme          = $this -> theme_name;

                // Check license
                if(!HelperLicense::is_authorised($theme)){
                    $this -> info -> set_message(esc_html__('You have not a valid license.', $this -> text_domain), true);
                    echo $this -> info -> output(true);
                    die();
                }
                $purchase_code  = HelperLicense::get_purchase_code($theme);

                $step           = isset($_POST['step'])?$_POST['step']:1;
                $url            = $this -> api.'/index.php?option=com_tz_membership';
                $page           = $_POST['page'];
                $pack_type      = $_POST['pack_type'];
                $action         = $_POST['action'];
                $file_name      = isset($_POST['file_name']) && $_POST['file_name']?$_POST['file_name']:'';
                $files          = isset($_POST['files']) && $_POST['files']?$_POST['files']:'';
                $demo_type      = isset($_POST['demo_type']) && $_POST['demo_type']?$_POST['demo_type']:'';
                $demo_title     = isset($_POST['demo_title']) && $_POST['demo_title']?$_POST['demo_title']:'';
                $demo_key       = isset($_POST['demo_key']) && $_POST['demo_key']?$_POST['demo_key']:'';
                $produce        = $_POST['pack'];
                $pack_main      = $_POST['pack_main'];
                $security       = $_POST['security'];
                $action_import  = isset($_POST['action_import'])?$_POST['action_import']:null;


                \WP_Filesystem();
                global $wp_filesystem;

                $upgrade_folder = $wp_filesystem-> wp_content_dir() . 'uploads/plzinst-demo-datas';

                $filePath   = $upgrade_folder.'/'.$produce.'_'.$pack_type.'.zip';

                if($action_import && $action_import == 'download'){

                    if($step == 1 && file_exists($filePath)){
                        unlink($filePath);
                    }

                    $postdata =array(
                        'task'          => 'download.package',
                        'produce'       => $produce,
                        'purchase_code' => $purchase_code,
                        'step'          => $step,
                        'type'          => $pack_type,
                        'domain'        => get_site_url()
                    );

//                    $url   = 'http://joomla.templaza.com/templazaplus/index.php?option=com_tz_membership';
                    // Get package file from server with post data
                    $response = wp_remote_post(
                        $url,
                        array(
                            'method' => 'POST',
//                            'timeout'  => 300,
                            'timeout' => 45,
                            'body' => $postdata
                        )
                    );

                    if(is_wp_error($response)){
                        $this -> info -> set_message(esc_html__($response -> get_error_message()), true);
                    }else{
                        $header = $response['headers']; // array of http header lines
                        $body = $response['body']; // use the content

                        if($header['content-type'] == 'application/json'){
                            $body   = json_decode($body);
                            if($body -> code == 400 && $body -> success == false){
                                $this -> info -> set_message(__($body -> message), true);
                                echo $this -> info -> output(true);
                                die();
                            }
                        }

                        if(!is_dir($upgrade_folder)){
                            wp_mkdir_p($upgrade_folder);
                        }

                        // Put multiple parts of package files to one file
                        file_put_contents($filePath, $body, FILE_APPEND);

                        $this -> info -> set_message(esc_html__('Download file completed'), false);

                        $next_step  = array(
                            'action'    => $action,
                            'page'      => $page,
                            'security'  => $security,
                            'pack'      => $produce,
                            'pack_type' => $pack_type,
                        );
                        if($pack_main){
                            $next_step['pack_main']  = $pack_main;
                        }
                        if($demo_title){
                            $next_step['demo_title']  = $demo_title;
                        }
                        if($demo_type){
                            $next_step['demo_type']  = $demo_type;
                        }
                        if($file_name){
                            $next_step['file_name']  = $file_name;
                        }
                        if($demo_key){
                            $next_step['demo_key']  = $demo_key;
                        }
                        if(isset($header['files-part-count']) && $header['files-part-count']) {
                            $next_step['total_step'] = (int)$header['files-part-count'];
                        }

                        if($step < $header['files-part-count']){
                            $next_step['step']              = $step + 1;
                            $next_step['action_import']     = $action_import;
                        }
                        $this -> info -> set('nextstep', $next_step);
                    }
                }else{

                    // Extract file and import
                    if(file_exists($filePath)){

                        try {

                            $folder_path    = $upgrade_folder . '/' . $produce . '_' . $pack_type;
                            unzip_file($filePath, $folder_path);

                            switch ($demo_type) {
                                default:
                                case 'classic':
                                    $this -> import_content($folder_path, $file_name);
                                    break;
                                case 'revslider':
                                    $result = $this -> import_revslider($folder_path, $file_name);
                                    break;
                                case 'option-tree':
                                    $this -> import_theme_options($folder_path, $file_name);
                                    break;
                                case 'widget':
                                case 'widget-importer':
                                    $this -> import_widgets($folder_path, $file_name);
                                    break;
                                case 'woocommerce':
                                    $this -> import_woocommerce($folder_path, $file_name);
                                    break;
                                case 'megamenu':
                                    $this -> import_maxmegamenu($folder_path, $file_name, $demo_key);
                                    break;
                                case 'redux-framework':
                                    $this -> import_redux_framework($folder_path, $file_name);
                                    break;
                            }

                            // Import error
                            if(isset($result) && !$result){
                                // Remove package import folder.
                                $wp_filesystem -> delete($folder_path, true, 'd');

                                // Remove package import file
                                $wp_filesystem->delete($filePath);

                                echo $this -> info -> output(false);
                                die();
                            }

                            $itmImportLast   = $_POST['demo_item_last'];

                            if($itmImportLast && $itmImportLast == 1){

                                $pack_slug  = $pack_main?$pack_main:$produce;
                                $pack       = $this -> get_pack_by_slug($pack_slug);

                                // Set front page (the page will be active of demo import version)
                                if($pack && isset($pack['front_page']) && $pack['front_page']) {
                                    $frontTitle    = isset($pack['front_page_title'])?$pack['front_page_title']:$pack['title'];
                                    $homepage 	= get_page_by_title( $frontTitle );

                                    if( isset($homepage->ID)) {
                                        update_option('show_on_front', 'page');
                                        update_option('page_on_front',  $homepage->ID); // Front Page
                                    }
                                }

                                // Set location for menu
                                if($pack && isset($pack['menu_locations']) && count($pack['menu_locations'])){
                                    $locations  = get_theme_mod( 'nav_menu_locations' );
                                    foreach($pack['menu_locations'] as $location){
                                        if($menu = wp_get_nav_menu_object($location['title'])){
                                            $locations[$location['location']]   = $menu -> term_id;
                                        }
                                    }
                                    if(count($locations)){
                                        set_theme_mod( 'nav_menu_locations', $locations );
                                    }
                                }
                            }

                            // Remove package import folder when import successfully.
                            $wp_filesystem -> delete($folder_path, true, 'd');

                            if(!$this -> info -> get('nextstep')) {

                                // Remove package import file
                                $wp_filesystem->delete($filePath);

                                $this->info->set_message(esc_html__('Imported demo content successfully.', $this->text_domain), false);

                                // Store the demo import type
                                //'_plzinst_demo_imported'
//                                $optionName = $this -> imported_key;

                                $pack_slug       = $pack_main?$pack_main:$produce;
                                $options         = get_option($this -> imported_key, array());
                                if(!isset($options['pack'])){
                                    $options['pack']    = array();
                                }
                                if(!is_array($options['pack'])){
                                    $options['pack']    = (array) $options['pack'];
                                }
                                if(!in_array($pack_slug, $options['pack'])){
                                    $options['pack'][]  = $pack_slug;
                                }

                                update_option($this -> imported_key, $options);

                            }else {
                                $this->info->set_message(sprintf(esc_html__('Imported %s successfully.', $this->text_domain), $demo_title), false);
                            }
                        }catch (\Exception $e){
                            $this -> info -> set_message(esc_html__('Error: '.$e -> getCode().' '
                                .$e -> getMessage(), $this -> text_domain), true);
                        }
                    }
                    else{
                        $this -> info -> set_message(esc_html__('Not found file to import. Please contact us to support it.',
                            $this -> text_domain), true);
                    }
                }

                echo $this -> info -> output(true);

                die();
            }
        }

        protected function import_content($folder_path, $filename = '',  $file_filter = '.xml'){
            if ( ! class_exists( 'WXR_Importer' ) ) {
                include wp_normalize_path( PLAZART_INSTALLATION_LIBRARY . '/importer/class-logger.php' );
                include wp_normalize_path( PLAZART_INSTALLATION_LIBRARY . '/importer/class-logger-html.php' );

                $wp_import = wp_normalize_path( PLAZART_INSTALLATION_LIBRARY . '/importer/class-wxr-importer.php' );
                include $wp_import;
            }

            if ( ! class_exists( 'Plzinst_WXR_Importer' ) ) {
                $class_wp_importer = PLAZART_INSTALLATION_LIBRARY.'/importer/class-plazart-wxr-importer.php';
                if ( file_exists( $class_wp_importer ) )
                    require_once $class_wp_importer;
            }

            if(!class_exists('Plzinst_WXR_Importer')){
                $this -> info -> set_message(esc_html__('The class Plzinst_WXR_Importer not found.', $this -> text_domain), true);
                echo $this -> info -> output(true);
                die();
            }

            $_file   = $this -> get_substeps($folder_path, $filename, $file_filter);

            $logger = new \WP_Importer_Logger_HTML();
            $importer = new \Plzinst_WXR_Importer(
                array(
                    'fetch_attachments' => true,
                    'prefill_existing_posts' => false,
                    'aggressive_url_search' => true,
                )
            );

            $importer->set_logger($logger);

            ob_start();
            $importer->import($folder_path.'/'.$_file);
            ob_end_clean();

            return true;
        }
        protected function import_revslider($folder_path, $filename = '',  $file_filter = '.zip'){

            if(!class_exists('RevSliderSliderImport') && !class_exists('RevSlider')){
                $this -> info -> set_message(esc_html__('Class RevSlider not found. Please install the revslider plugin to continue import it.',
                    $this -> text_domain), true);
                echo $this -> info -> output();
                die();
            }

            if(class_exists('RevSliderSliderImport')){
                $importer   = new \RevSliderSliderImport();
            }else{
                $importer = new \RevSlider();
            }

            if($file = $this->get_substeps($folder_path, $filename, $file_filter)){
                list($_filename, $fileExt) = explode('.', $file);
            }else{
                $_filename      = basename($folder_path);
                $folder_path    = preg_replace('#/'.$_filename.'$#', '', $folder_path);
                $fileExt        = 'zip';
                $file           =   $_filename.'.'.$fileExt;
            }

            if(class_exists('RevSliderSliderImport') && method_exists($importer, 'import_slider')){
                $result = $importer -> import_slider(true, $folder_path . '/' . $file);
            }else {
                $result = $importer->importSliderFromPost(true, false, $folder_path . '/' . $file);
            }

            if($result && $result['success'] == true){
                $this -> info -> set_message(sprintf(esc_html__('Data %s of Revolution Slider successfully.'), $_filename), false);
                return $result['success'];
            }elseif($result && !$result['success'] && isset($result['error'])){
                $this -> info -> set_message(sprintf(esc_html__('Error import data of Revolution Slider: %s'), $result['error']), true);
            }
            return false;
        }

        protected function import_theme_options($folder_path, $filename = '',  $file_filter = '.txt|.json'){

            /* needed option tree file for operatiob */
            include_once( WP_PLUGIN_DIR . '/option-tree/includes/ot-functions-admin.php' );

            if(!function_exists('ot_stripslashes')){
                $this -> info -> set_message(esc_html__('Function ot_stripslashes not exists. Please install and active plugin optionTree to continue import it.'), true);
                echo $this -> info ->output(true);
                die();
            }

            if($file = $this->get_substeps($folder_path, $filename, $file_filter)){
                list($_filename, $fileExt) = explode('.', $file);
            }

            $options    = file_get_contents($folder_path.'/'.$file);

            $options    = $fileExt == 'txt'?unserialize($options):json_decode($options);

            /* get settings array */
            $settings = get_option( 'option_tree_settings', array());

            /* has options */
            if(!$options){
                return false;
            }

            /* validate options */
            if ( is_array($settings) && count( $settings ) ) {

                foreach( $settings['settings'] as $setting ) {

                    $settingId  = $setting['id'];
                    if(is_array($options)){
                        if ( isset( $options[$settingId] ) ) {
                            $content = ot_stripslashes( $options[$settingId] );
                            $options[$settingId] = ot_validate_setting( $content, $setting['type'], $settingId );
                        }
                    }elseif(isset($options -> $settingId)){
                        $content = ot_stripslashes( $options -> $settingId );
                        $options[$options -> $settingId] = ot_validate_setting( $content, $setting['type'], $options -> $settingId );
                    }

                }

            }

            /* update the option tree array */
            update_option('option_tree', $options);

            return true;
        }

        protected function import_widgets($folder_path, $filename = '',  $file_filter = '.wie|.json') {
            /* needed option tree file for operatiob */
            include_once( PLAZART_INSTALLATION_LIBRARY . '/importer/class-widget-importer.php' );

            if(!class_exists('Plzinst_Widget_Importer')){
                $this -> info -> set_message(esc_html__('Class Plzinst_Widget_Importer not exists.'), false);
                echo $this -> info ->output(true);
                die();
            }
            $widget_importer    = new \Plzinst_Widget_Importer();

            $file   = $this -> get_substeps($folder_path, $filename, $file_filter);

            $options    = file_get_contents($folder_path.'/'.$file);
            $options    = json_decode($options);

            $results    = $widget_importer -> wie_import_data($options);
            if(!count($results)){
                $this -> info -> set_message(esc_html__('Can not import widgets.'), false);
                echo $this -> info -> output(true);
                die();
            }
        }

        protected function import_woocommerce($folder_path, $filename = '', $file_filter = '.xml|.json' ){

            // Import WooCommerce if WooCommerce Exists.
            if (!class_exists( 'WooCommerce' )) {
                $this -> info -> set_message(esc_html__('Please install and active the woocommerce plugin to continue import it.',
                    $this -> text_domain), true);
                echo $this -> info -> output();
                die();
            }
            $this -> import_content($folder_path);

            // Get json settings file
            $file   = $this -> get_substeps($folder_path, $filename, '.json');

            $settings   = file_get_contents($folder_path.'/'.$file);
            $settings   = json_decode($settings);

            foreach ( $settings as $woo_page_name => $woo_page_title ) {
                $woopage = get_page_by_title( $woo_page_title );
                if ( isset( $woopage ) && $woopage->ID ) {
                    update_option( $woo_page_name, $woopage->ID ); // Front Page.
                }
            }

            // We no longer need to install pages.
            delete_option( '_wc_needs_pages' );
            delete_transient( '_wc_activation_redirect' );
        }

        protected function import_maxmegamenu($folder_path, $filename = '', $demo_key = null, $file_filter = '.json|.txt' ){

            list($_filename, $fileExt)   = explode('.', $filename);

            if (!class_exists( 'Mega_Menu_Themes' ) && !class_exists( 'Mega_Menu_Settings' )) {
                $this -> info -> set_message(esc_html__('Please install and active the Mega Menu plugin to continue import it.',
                    $this -> text_domain), true);
                echo $this -> info -> output();
                die();
            }

            $file   = $this -> get_substeps($folder_path, $filename, $file_filter);

            if(!$file){
                $this -> info -> set_message(esc_html__('File not found.', $this -> text_domain), true);
                echo $this -> info -> output();
                die();
            }

            $import  = file_get_contents($folder_path.'/'.$file);
            if($import){
                if(class_exists('Mega_Menu_Themes')){
                    $megamenu = new \Mega_Menu_Themes();
                }else {
                    $megamenu = new \Mega_Menu_Settings();
                }

                $import = json_decode( stripslashes( $import ), true );

                $saved_themes = max_mega_menu_get_themes();

                $next_id = $megamenu->get_next_theme_id();

                $import['title'] = $import['title'] . " " . __(' - Imported', $this -> text_domain);

                $new_theme_id = "custom_theme_" . $next_id;

                $saved_themes[ $new_theme_id ] = $import;

                max_mega_menu_save_themes( $saved_themes );

                if($demo_key != null) {
                    $produce        = $_POST['pack'];
                    $pack_main      = $_POST['pack_main'];
                    $pack   = $pack_main?$pack_main:$produce;

                    $packDatas  = $this -> get_pack_by_slug($pack);
                    $demoDatas      = $packDatas['demo-datas'];
                    $demo_options   = $demoDatas[$demo_key];

                    if($demo_options && count($demo_options) && isset($demo_options['options'])){
                        $demo_options           = $demo_options['options'];
                        $demo_options['theme']   = $new_theme_id;
                        $megamenuOption = get_option('megamenu_settings', array());

                        if(isset($demo_options['theme_location'])){
                            $theme_location = $demo_options['theme_location'];
                            unset($demo_options['theme_location']);

                            if(count($demo_options)) {
                                if(!count($megamenuOption)){
                                    $megamenuOption[$theme_location]    = array();
                                }
                                foreach($demo_options as $key => $value) {
                                    $megamenuOption[$theme_location][$key]  = $value;
                                }
                            }
                        }
                        if(count($megamenuOption)){
                            update_option('megamenu_settings', $megamenuOption);

                            // Generate mega menu style css
                            if(class_exists('Mega_Menu_Style_Manager')){
                                $megamenuStyle  = new \Mega_Menu_Style_Manager();
                                $megamenuStyle -> delete_cache();
                            }
                        }
                    }
                }
                return true;
            }

            $this -> info -> set_message(esc_html__('Can not import mega menu. Please check it again', $this -> text_domain), true);
            echo $this -> info -> output();
            die();
        }

        protected function import_redux_framework($folder_path, $filename = '',  $file_filter = '.txt|.json'){

            $values = array();
            if($file = $this->get_substeps($folder_path, $filename, $file_filter)){
                list($_filename, $fileExt) = explode('.', $file);
            }
            $settings = get_option( 'aventura_options-transients', array());

            $options    = file_get_contents($folder_path.'/'.$file);

            $options    = $fileExt == 'txt'?unserialize($options):json_decode($options,true);

            $values = $options;

            /* has options */
            if(!$options){
                return false;
            }

            /* update the redux option array */
            update_option('aventura_options', $values);



            return true;
        }

        protected function get_substeps($folder_path, $filename = '', $file_filter = '.'){
            $_files  = array();
            if(!$filename){
                $_files  = Files::get_files_of_folder($folder_path, $file_filter);
            }else {
                $_files[]    = $filename;
            }

            if(!count($_files)){
                $this -> info -> set_message(esc_html__('Files not found.', $this -> text_domain), true);
                return false;
            }

            $substeps      = isset($_POST['substeps']) && $_POST['substeps']?$_POST['substeps']:$_files;

            if(!$substeps || ($substeps && !count($substeps))){
                return array();
            }

            $page           = $_POST['page'];
            $pack_type      = $_POST['pack_type'];
            $action         = $_POST['action'];
            $demo_type      = isset($_POST['demo_type']) && $_POST['demo_type']?$_POST['demo_type']:'';
            $demo_title     = isset($_POST['demo_title']) && $_POST['demo_title']?$_POST['demo_title']:'';
            $demo_key       = isset($_POST['demo_key']) && $_POST['demo_key']?$_POST['demo_key']:'';
            $produce        = $_POST['pack'];
            $security       = $_POST['security'];

            $next_step  = array(
                'action'    => $action,
                'page'      => $page,
                'security'  => $security,
                'pack'      => $produce,
                'pack_type' => $pack_type,
            );

            if($demo_title){
                $next_step['demo_title'] = $demo_title;
            }
            if($demo_type){
                $next_step['demo_type'] = $demo_type;
            }
            if($demo_key){
                $next_step['demo_key'] = $demo_key;
            }

            $current_step               = array_shift($substeps);
            $next_step['substeps']      = $substeps;
            $next_step['total_step']    = count($substeps);

            if($next_step && count($next_step) && $next_step['total_step']) {
                $this -> info -> set('nextstep', $next_step);
            }

            return $current_step;
        }

    }
}