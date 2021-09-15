<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/hellomohsinkhan
 * @since      1.0.0
 *
 * @package    Insert_post_from_front_end
 * @subpackage Insert_post_from_front_end/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Insert_post_from_front_end
 * @subpackage Insert_post_from_front_end/public
 * @author     Mohsin Khan <hellomohsinkhan@gmail.com>
 */
class Insert_post_from_front_end_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        add_action('wp_ajax_tz_autoshowroom_remove_thumbnail',array($this,'tz_autoshowroom_remove_thumbnail'));
        add_action('wp_ajax_nopriv_tz_autoshowroom_remove_thumbnail',array($this,'tz_autoshowroom_remove_thumbnail'));
        add_action('wp_ajax_tz_autoshowroom_remove_car',array($this,'tz_autoshowroom_remove_car'));
        add_action('wp_ajax_nopriv_tz_autoshowroom_remove_car',array($this,'tz_autoshowroom_remove_car'));
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Insert_post_from_front_end_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Insert_post_from_front_end_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/insert_post_from_front_end-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Insert_post_from_front_end_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Insert_post_from_front_end_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/insert_post_from_front_end-public.js', array('jquery'), $this->version, false);
        wp_enqueue_script('car-dealer-custom', plugin_dir_url(__FILE__) . 'js/car-custom.js', array('jquery'), $this->version, true);
        wp_enqueue_script('car-dealer-validate-form', plugin_dir_url(__FILE__) . 'js/jquery.validate.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script('car-dealer-validate', plugin_dir_url(__FILE__) . 'js/validate.js', array('jquery'), $this->version, true);
        wp_localize_script($this->plugin_name, 'my_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    }
    function tz_autoshowroom_remove_thumbnail(){
        $CarID = $_POST['CarID'];
        delete_post_thumbnail( $CarID );
        ?>
        <p class="sucess"><?php echo esc_html_e('Deleted','progression-car-dealer');?></p>
        <?php
        exit();
    }
    function tz_autoshowroom_remove_image_gallery(){
        $imageID = $_POST['imageID'];
        delete_post_thumbnail( $imageID );
        ?>
        <p class="sucess"><?php echo esc_html_e('Deleted','progression-car-dealer');?></p>
        <?php
        exit();
    }
    function tz_autoshowroom_remove_car(){
        $carID = $_POST['CarID'];
        wp_delete_post( $carID );
        ?>
        <p class="success"><?php echo esc_html_e('Deleted','progression-car-dealer');?></p>
        <?php
        exit();
    }

    function Insert_post_from_frontEnd($atts) {
        if (!empty($atts)) {
            $posttype = $atts['post_type'];
            $poststatus = $atts['status'];
            $task = $atts['task'];
        } else {
            $posttype = "vehicle";
            $task ="add";
        }
        $login = is_user_logged_in();

        if($login==true ){
            $user = wp_get_current_user();
            $user_id = $user->ID;
            $user_meta=get_userdata($user_id);
            $user_role_true ='';
            if ( in_array( 'um_dealer', (array) $user_meta->roles ) ) {
                $user_role_true=1;
            }elseif ( in_array( 'um_admin', (array) $user_meta->roles ) ) {
                $user_role_true=1;
            }elseif ( in_array( 'administrator', (array) $user_meta->roles ) ) {
                $user_role_true=1;
            }
            if($user_role_true==1) {
                if (isset($_POST['title'])) {

                    if (!isset($_POST['verify_insert_post']) || !wp_verify_nonce($_POST['verify_insert_post'], 'inser_post_from_front')) {
                        print 'Sorry, your nonce did not verify.';
                        exit;
                    }

                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    require_once(ABSPATH . 'wp-admin/includes/file.php');
                    $wp_upload_directory = wp_upload_dir();
                    $wp_upload_dir = $wp_upload_directory['path'];
                    $upload_overrides = array('test_form' => false);
                    $post_content = $_POST['mycustomeditor'];
                    $post_excerpt = $_POST['car_excerpt'];
                    $term = $_POST['vehicle_type'];
                    $make = $_POST['make'];
                    $model = $_POST['model'];
                    $condition = $_POST['auto_condition'];
                    $color = $_POST['auto_color'];
                    $interior = $_POST['auto_interior'];
                    $transmission = $_POST['auto_transmission'];
                    $drivetrain = $_POST['auto_drivetrain'];
                    $price = $_POST['vehicle_price'];
                    $price_text = $_POST['vehicle_price_text'];
                    $registration = $_POST['auto_registration'];
                    $milage = $_POST['auto_milage'];
                    $engine = $_POST['auto_engine'];
                    $vehicle_sold = $_POST['autoshowroom_vehicle_sold'];

                    $new_post = array(
                        'post_title' => wp_strip_all_tags($_POST['title']),
                        'post_status' => 'publish',
                        'post_type' => 'vehicle',
                        'post_content' => '',
                        'post_excerpt' => $post_excerpt,
                    );

                    if ($task == 'edit') {
                        $carID = get_query_var('car_id');
                        $update_post = array(
                            'ID' => $carID,
                            'post_title' => wp_strip_all_tags($_POST['title']),
                            'post_excerpt' => $post_excerpt,
                        );
                        $pid = wp_update_post($update_post);

                    } else {
                        $pid = wp_insert_post($new_post);
                    }
                    //save the new post

                    wp_set_object_terms($pid, $term, 'vehicle_type');
                    wp_set_object_terms($pid, $make, 'make');
                    wp_set_object_terms($pid, $model, 'model');
                    if ( ! add_post_meta( $pid, 'content', $post_content, true ) ) {
                        update_post_meta( $pid, 'content', $post_content );
                    }
                    if ( ! add_post_meta( $pid, 'condition', $condition, true ) ) {
                        update_post_meta($pid, 'condition', $condition);
                    }
                    if ( ! add_post_meta( $pid, 'color', $color, true ) ) {
                        update_post_meta($pid, 'color', $color);
                    }
                    if ( ! add_post_meta( $pid, 'interior', $interior, true ) ) {
                        update_post_meta($pid, 'interior', $interior);
                    }
                    if ( ! add_post_meta( $pid, 'transmission', $transmission, true ) ) {
                        update_post_meta($pid, 'transmission', $transmission);
                    }
                    if ( ! add_post_meta( $pid, 'drivetrain', $drivetrain, true ) ) {
                        update_post_meta($pid, 'drivetrain', $drivetrain);
                    }
                    if ( ! add_post_meta( $pid, 'price', $price, true ) ) {
                        update_post_meta($pid, 'price', $price);
                    }
                    if ( ! add_post_meta( $pid, 'pricetext', $price_text, true ) ) {
                        update_post_meta($pid, 'pricetext', $price_text);
                    }
                    if ( ! add_post_meta( $pid, 'registration', $registration, true ) ) {
                        update_post_meta($pid, 'registration', $registration);
                    }
                    if ( ! add_post_meta( $pid, 'milage', $milage, true ) ) {
                        update_post_meta($pid, 'milage', $milage);
                    }
                    if ( ! add_post_meta( $pid, 'engine', $engine, true ) ) {
                        update_post_meta($pid, 'engine', $engine);
                    }
                    if ( ! add_post_meta( $pid, 'autoshowroom_vehicle_sold', $vehicle_sold, true ) ) {
                        update_post_meta($pid, 'autoshowroom_vehicle_sold', $vehicle_sold);
                    }
                    global $car_dealer;
                    if ( is_plugin_active( 'progression-car-dealer-master/progression-car-dealer.php' ) ) {
                        $fields = $car_dealer->fields->get_registered_fields('specs');
                        arsort($fields);
                        foreach ( $fields as $k => $field ) {
                            if ( ! add_post_meta( $pid, $field['name'], $_POST['auto_'.$field['name']], true ) ) {
                                update_post_meta($pid, $field['name'], $_POST['auto_'.$field['name']]);
                            }
                        }
                    }

                    $files = $_FILES['feature_image'];
                    $file_brochure = $_FILES['brochure'];
                    if ($files['name']) {
                        $uploadedfile = array(
                            'name' => $files['name'],
                            'type' => $files['type'],
                            'tmp_name' => $files['tmp_name'],
                            'error' => $files['error'],
                            'size' => $files['size']
                        );
                    }
                    if ($file_brochure['name']) {
                        $uploaded_brochure = array(
                            'name' => $file_brochure['name'],
                            'type' => $file_brochure['type'],
                            'tmp_name' => $file_brochure['tmp_name'],
                            'error' => $file_brochure['error'],
                            'size' => $file_brochure['size']
                        );
                    }
                    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
                    $movefile_brochure = wp_handle_upload($uploaded_brochure, $upload_overrides);

                    if ($movefile && !isset($movefile['error'])) {
                        $attachment = array(
                            'guid' => $movefile['url'],
                            'post_mime_type' => $movefile['type'],
                            'post_title' => preg_replace('/\.[^.]+$/', '', basename($wp_upload_dir . '/' . $files['name'])),
                            'post_content' => '',
                            'post_status' => 'inherit'
                        );
                        $attach_id = wp_insert_attachment($attachment, $wp_upload_dir . '/' . $files['name'], $pid);
                        $attach_data = wp_generate_attachment_metadata($attach_id, $wp_upload_dir . '/' . $files['name']);
                        wp_update_attachment_metadata($attach_id, $attach_data);
                        set_post_thumbnail($pid, $attach_id);

                    }
                    if ($movefile_brochure && !isset($movefile_brochure['error'])) {
                        $attachment = array(
                            'guid' => $movefile_brochure['url'],
                            'post_mime_type' => $movefile_brochure['type'],
                            'post_title' => preg_replace('/\.[^.]+$/', '', basename($wp_upload_dir . '/' . $file_brochure['name'])),
                            'post_content' => '',
                            'post_status' => 'inherit'
                        );
                        $attach_id = wp_insert_attachment($attachment, $wp_upload_dir . '/' . $file_brochure['name'], $pid);
                        $attach_data = wp_generate_attachment_metadata($attach_id, $wp_upload_dir . '/' . $file_brochure['name']);
                        wp_update_attachment_metadata($attach_id, $attach_data);
//                set_post_thumbnail($pid, $attach_id);
                        $brochure = wp_get_attachment_url($attach_id);
                        update_post_meta($pid, 'autoshowroom_vehicle_brochure', $brochure);

                    }
                    $galleries = $_FILES['gallery'];
                    $gallery_count = count($galleries['name']);
                    $gallery_arr = array();
                    if ($galleries['name'][0] != '') {
                        for ($i = 0; $i < $gallery_count; $i++) {
                            if ($galleries['name'][$i]) {
                                $uploaded_gallery = array(
                                    'name' => $galleries['name'][$i],
                                    'type' => $galleries['type'][$i],
                                    'tmp_name' => $galleries['tmp_name'][$i],
                                    'error' => $galleries['error'][$i],
                                    'size' => $galleries['size'][$i]
                                );
                            }
                            $movefile_gallery = wp_handle_upload($uploaded_gallery, $upload_overrides);
                            if ($movefile_gallery && !isset($movefile_gallery['error'])) {
                                $attachment = array(
                                    'guid' => $movefile_gallery['url'],
                                    'post_mime_type' => $movefile_gallery['type'],
                                    'post_title' => preg_replace('/\.[^.]+$/', '', basename($wp_upload_dir . '/' . $galleries['name'][$i])),
                                    'post_content' => '',
                                    'post_status' => 'inherit'
                                );
                                $attach_id = wp_insert_attachment($attachment, $wp_upload_dir . '/' . $galleries['name'][$i], $pid);
                                $attach_data = wp_generate_attachment_metadata($attach_id, $wp_upload_dir . '/' . $galleries['name'][$i]);
                                wp_update_attachment_metadata($attach_id, $attach_data);
//                        set_post_thumbnail($pid, $attach_id);
//                        $brochure = wp_get_attachment_url($attach_id);
//                        update_post_meta( $pid, 'autoshowroom_vehicle_brochure', $brochure );
                                $gallery_arr[] = (string)$attach_id;

                            }
                        }
                        $galleries_ids = $gallery_arr;

                        update_post_meta($pid, 'images', $galleries_ids);
                    }
                    ?>
                <div class="alert alert-success">
                <strong><?php echo esc_html__('Success!','progression-car-dealer');?></strong>
                </div>
<?php
                }
            }

        }else{
            ?>
            <div class="uk-alert-warning uk-padding " data-uk-alert>
                <a class="uk-alert-close" data-uk-close></a>
               <h3><?php echo esc_html__('Please login with dealer role to add car!','progression-car-dealer');?></h3>
            </div>
<?php
        }

        if($task=='edit'){
            include "partials/edit_post_from_front_end-public-display.php";
        }else{
            include "partials/insert_post_from_front_end-public-display.php";
        }

    }

}
