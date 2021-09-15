<?php
add_action('after_setup_theme', 'tz_autoshowroom_setup_theme');
if (!function_exists('tz_autoshowroom_setup_theme')) :
    function tz_autoshowroom_setup_theme()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
        */
        load_theme_textdomain('autoshowroom', get_template_directory() . '/languages');
        //Enable support for Post Thumbnails
        add_theme_support('post-thumbnails');

        add_theme_support('post-formats', array('gallery', 'video', 'audio', 'link', 'quote'));
        // Add RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');

        // add theme support title-tag
        add_theme_support('title-tag');
        // Setup the WordPress core custom background feature.
        add_theme_support('custom-background');
        add_theme_support('custom-header');

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menu('primary', esc_html__('Primary Menu', 'autoshowroom'));
        register_nav_menu('primary-home-2', esc_html__('Primary Menu Home 2', 'autoshowroom'));
        register_nav_menu('primary-home-3', esc_html__('Primary Menu Home 3', 'autoshowroom'));
        register_nav_menu('primary-home-4', esc_html__('Primary Menu Home 4', 'autoshowroom'));
        register_nav_menu('primary-home-motor', esc_html__('Primary Menu Motorbike', 'autoshowroom'));
        register_nav_menu('primary-home-6', esc_html__('Primary Menu Home 6', 'autoshowroom'));
        register_nav_menu('primary-home-7', esc_html__('Primary Menu Home 7', 'autoshowroom'));
        register_nav_menu('primary-home-8', esc_html__('Primary Menu Home 8', 'autoshowroom'));
        register_nav_menu('primary-home-9', esc_html__('Primary Menu Home 9', 'autoshowroom'));
        register_nav_menu('primary-home-10', esc_html__('Primary Menu Home 10', 'autoshowroom'));
        register_nav_menu('footer-menu', 'Footer Menu');

        /*
       * This theme styles the visual editor to resemble the theme style,
       * specifically font, colors, icons, and column width.
       */
        add_editor_style(array('css/editor-style.css', tz_autoshowroom_fonts_url()));
    }
endif;
function replace_core_jquery_version() {
    wp_deregister_script( 'jquery-core' );
    // Change the URL if you want to load a local copy of jQuery from your own server.
    wp_register_script( 'jquery-core',  get_template_directory_uri() . '/js/jquery-2.2.4.min.js', array(), '2.2.4' );
}
add_action( 'wp_enqueue_scripts', 'replace_core_jquery_version' );
//Remove JQuery migrate
function remove_jquery_migrate($scripts)
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];

        if ($script->deps) { // Check whether the script has any dependencies
            $script->deps = array_diff($script->deps, array(
                'jquery-migrate'
            ));
        }
    }
}

add_action('wp_default_scripts', 'remove_jquery_migrate');
function tz_autoshowroom_fonts_url()
{
    $tz_autoshowroom_fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $tz_autoshowroom_Montserrat = _x('on', 'Montserrat font: on or off', 'autoshowroom');

    $tz_autoshowroom_Muli = _x('on', 'Muli font: on or off', 'autoshowroom');

//    wp_enqueue_style('Droidserif', 'http://fonts.googleapis.com/css?family=Droid+Serif:400italic');

    if ('off' !== $tz_autoshowroom_Montserrat || 'off' !== $tz_autoshowroom_Muli) {
        $font_families = array();

        if ('off' !== $tz_autoshowroom_Montserrat) {
            $font_families[] = 'Montserrat:300,400,500,600,700';
        }

        if ('off' !== $tz_autoshowroom_Muli) {
            $font_families[] = 'Muli:300,400,300italic,600,700';
        }

        $tz_autoshowroom_query_args = array(
            'family' => urlencode(implode('|', $font_families)),
            'subset' => urlencode('latin,latin-ext'),
        );

        $tz_autoshowroom_fonts_url = add_query_arg($tz_autoshowroom_query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($tz_autoshowroom_fonts_url);
}

add_action('init', 'tz_autoshowroom_register_theme_scripts');
function tz_autoshowroom_register_theme_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php') {

        if (is_admin()) {
            add_action('admin_enqueue_scripts', 'tz_autoshowroom_register_back_end_scripts');
        } else {
            add_action('wp_enqueue_scripts', 'tz_autoshowroom_register_front_end_styles');
            add_action('wp_enqueue_scripts', 'tz_autoshowroom_register_front_end_scripts');
        }
    }
}

//Register Back-End script
function tz_autoshowroom_register_back_end_scripts()
{

    wp_enqueue_style('autoshowroom-admin-styles', get_template_directory_uri() . '/extension/assets/css/admin-styles.css');
    wp_enqueue_style('autoshowroom-option', get_template_directory_uri() . '/extension/assets/css/tz-theme-options.css');

    wp_register_script('autoshowroom-portfolio-meta-boxes', get_template_directory_uri() . '/extension/assets/js/portfolio-meta-boxes.js', array(), false, $in_footer = true);
    wp_enqueue_script('autoshowroom-portfolio-meta-boxes');

    wp_register_script('autoshowroom-portfolio-theme-option', get_template_directory_uri() . '/extension/assets/js/portfolio-theme-option.js', array(), false, $in_footer = true);
    wp_enqueue_script('autoshowroom-portfolio-theme-option');
}

//Register Front-End Styles
function tz_autoshowroom_register_front_end_styles()
{
    wp_enqueue_style('autoshowroom-bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css', false);
    wp_enqueue_style('autoshowroom-fonts', tz_autoshowroom_fonts_url(), array(), null);
    wp_enqueue_style('autoshowroom-muli-bold', get_template_directory_uri() . '/fonts/muli-bold/stylesheet.css', false);
    wp_enqueue_style('autoshowroom-ironfieldCF', get_template_directory_uri() . '/fonts/ironfieldCF/stylesheet.css', false);
    wp_enqueue_style('autoshowroom-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', false);
    wp_enqueue_style('Linearicons', get_template_directory_uri() . '/css/Linearicons.css', false);

    if (is_single() || is_home() || is_tag() || is_category() || is_archive() || is_author() || is_search()) {
        wp_enqueue_style('autoshowroom-flexslider', get_template_directory_uri() . '/css/flexslider/flexslider.css', false);
    }
    wp_enqueue_style('autoshowroom-owl-carousel-style', get_template_directory_uri() . '/owl.carousel.min.css', false);
    wp_enqueue_style('autoshowroom-style', get_template_directory_uri() . '/style.css', false);
    wp_enqueue_style('autoshowroom-custom-update', get_template_directory_uri() . '/css/custom.css', false);
    wp_enqueue_style('autoshowroom-custom_options_css', get_template_directory_uri() . '/css/custom/custom_options_css.css', false);
    wp_enqueue_style('autoshowroom-chosen_css', get_template_directory_uri() . '/css/chosen.css', false);
    if (is_singular('vehicle')) {
        wp_register_style('autoshowroom-lightgallery-css', get_template_directory_uri() . '/css/lightgallery.css', false);
        wp_register_style('autoshowroom-ekko-css', get_template_directory_uri() . '/css/ekko-lightbox.css', false);

    }
    wp_enqueue_style('autoshowroom-skill-css', get_template_directory_uri() . '/css/skill.css', false);
    wp_enqueue_style('autoshowroom-colorpicker-css', get_template_directory_uri() . '/css/colorpicker.css', false);

}

//Register Front-End Scripts
function tz_autoshowroom_register_front_end_scripts()
{
    $vehicle_layout = ot_get_option('autoshowroom_TZVehicle_layout', 1);
    wp_enqueue_script('autoshowroom-bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), false, $in_footer = true);

    if (is_single() || is_tag() || is_category() || is_archive() || is_author() || is_search()) {
        wp_register_script('autoshowroom-jsflexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array(), false, $in_footer = true);
        wp_enqueue_script('autoshowroom-jsflexslider');

        wp_register_script('autoshowroom-single', get_template_directory_uri() . '/js/single.js', array(), false, $in_footer = true);
        wp_enqueue_script('autoshowroom-single');
    }
    if ($vehicle_layout == 0) {
        wp_register_script('autoshowroom-vehiclelist', get_template_directory_uri() . '/js/vehicle-list.js', array(), false, $in_footer = true);
        wp_enqueue_script('autoshowroom-vehiclelist');
    }
    wp_register_script('autoshowroom-masonry.pkgd', get_template_directory_uri() . '/js/masonry.pkgd.js', array(), false, $in_footer = true);

    wp_register_script('autoshowroom-imagesloaded.pkgd', get_template_directory_uri() . '/js/imagesloaded.pkgd.js', array(), false, $in_footer = true);

    wp_register_script('autoshowroom-masonry', get_template_directory_uri() . '/js/masonry.js', array(), false, $in_footer = true);

    wp_register_script('autoshowroom-vehicle-masonry', get_template_directory_uri() . '/js/vehicle-masonry.js', array(), false, $in_footer = true);

    $admin_url = admin_url('admin-ajax.php');
    $vehicle_ajax_url = array('url' => $admin_url);
    wp_localize_script('autoshowroom-bootstrap.min', 'vehicle_compare_ajax', $vehicle_ajax_url);

    wp_register_script('autoshowroom-owl-carousel-script', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), false, $in_footer = true);
    wp_enqueue_script('autoshowroom-owl-carousel-script');

    wp_register_script('autoshowroom-autoshowroom-script', get_template_directory_uri() . '/js/autoshowroom.js', array('jquery'), false, $in_footer = true);
    wp_enqueue_script('autoshowroom-autoshowroom-script');
    wp_register_script('rellax-script', get_template_directory_uri() . '/js/rellax.min.js', array('jquery'), false, $in_footer = true);
    wp_enqueue_script('rellax-script');
    wp_register_script('debounce-script', get_template_directory_uri() . '/js/jquery.debounce.js', array('jquery'), false, $in_footer = true);
    wp_enqueue_script('debounce-script');
    wp_register_script('autoshowroom-colorpicker', get_template_directory_uri() . '/js/colorpicker.js', array(), false, $in_footer = true);
    wp_enqueue_script('autoshowroom-colorpicker');

    wp_register_script('autoshowroom-chosen-script', get_template_directory_uri() . '/js/chosen.jquery.min.js', array('jquery'), false, $in_footer = true);
    wp_enqueue_script('autoshowroom-chosen-script');
    if (is_singular('vehicle') || is_post_type_archive('vehicle') || is_archive()) {
        wp_enqueue_script('autoshowroom-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), false, $in_footer = true);
        wp_deregister_script('autoshowroom-lightgallery');

        wp_register_script('autoshowroom-lightgallery', get_template_directory_uri() . '/js/lightgallery/lightgallery-all.min.js', false, false, $in_footer = true);

        wp_deregister_script('autoshowroom-mousewheel');
        wp_register_script('autoshowroom-mousewheel', get_template_directory_uri() . '/js/lightgallery/jquery.mousewheel.min.js', false, false, $in_footer = true);

        wp_register_script('autoshowroom-ekko', get_template_directory_uri() . '/js/ekko-lightbox.js', false, false, $in_footer = true);

    }
    wp_enqueue_script('autoshowroom-cookie', get_template_directory_uri() . '/js/autocookie.js', false, false, $in_footer = true);
}

/*
 * Required: include plugin theme scripts
 */
require get_template_directory() . '/extension/tz-process-option.php';


if (class_exists('OT_Loader')):
    /*
     * Required: Theme option
     */
    require get_template_directory() . '/extension/ot-support/theme-options.php';

    /*
     * Required: Metabox
     */
    require get_template_directory() . '/extension/ot-support/add-meta-boxes.php';
endif;
if (!is_admin()):
    add_action('pre_get_posts', 'autoshowroom_filter_press_tax');
    add_action('pre_get_posts', 'autoshowroom_filter_press_sold');

    if (!function_exists('autoshowroom_filter_press_tax')) {
        function autoshowroom_filter_press_tax($query)
        {
            $autoshowroom_post_per_page = ot_get_option('autoshowroom_post_per_page', 9);
            $autoshowroom_orderby = ot_get_option('autoshowroom_orderby', 'orderby');
            $autoshowroom_order = ot_get_option('autoshowroom_order', 'order');
            $autoshowroom_vehicle_sold = ot_get_option('autoshowroom_TZVehicle_sold', 'show');

            if (isset($_GET['orderby'])) {
                $sort_value = $_GET['orderby'];
            }

            if (isset($_GET['order'])) {
                $sort_price = $_GET['order'];
            }
            $agrs_color = $agrs_interior = $agrs_condition = array();
            if (isset($_GET['color'])) {
                $sort_color = $_GET['color'];
                $agrs_color = array(
                    'key' => 'color',
                    'value' => $sort_color,
                    'compare' => 'IN',
                );
            }
            if (isset($_GET['interior'])) {
                $sort_interior = $_GET['interior'];
                $agrs_interior = array(
                    'key' => 'interior',
                    'value' => $sort_interior,
                    'compare' => 'IN',
                );
            }
            if (isset($_GET['condition'])) {
                $sort_condition = $_GET['condition'];
                $agrs_condition = array(
                    'key' => 'condition',
                    'value' => $sort_condition,
                    'compare' => 'IN',
                );
            }

            if (is_post_type_archive('vehicle') && $query->is_main_query() && !is_admin()):

                $query->set('posts_per_page', $autoshowroom_post_per_page);

                if (isset($sort_value) && isset($sort_price) && (isset($sort_color) || isset($sort_interior) || isset($sort_condition))) {
                    $query->set('meta_query', array(
                        'relation' => 'AND',
                        $agrs_color,
                        $agrs_interior,
                        $agrs_condition
                    ));
                    //sort by a meta value
                    $query->set('key', $sort_value);
                } elseif (isset($sort_value) && isset($sort_price)) {
                    if ($sort_value === 'price') {
                        $query->set('meta_query', array(
                            array('key' => 'price',
                                'value' => array(0, 8000000000),
                                'compare' => 'BETWEEN',
                                'type' => 'NUMERIC'
                            )
                        ));
                    } else {
                        $query->set('key', 'date');
                    }

                    //sort by a meta value
                    $query->set('orderby', 'meta_value_num');
                    $query->set('order', '' . $sort_price . '');
                } elseif (isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'exhibition') {
                    $query->set('orderby', array('meta_value_num' => 'DESC'));
                    $query->set('key', 'newness');
                }

                return;
            endif;
        }
    }
    if (!function_exists('autoshowroom_filter_press_sold')) {
        function autoshowroom_filter_press_sold($query)
        {
            $autoshowroom_vehicle_sold = ot_get_option('autoshowroom_TZVehicle_sold', 'show');
            if ($autoshowroom_vehicle_sold == 'show') {
                add_action('pre_get_posts', 'autoshowroom_filter_press_sold');
            }
            if (is_post_type_archive('vehicle') && ($autoshowroom_vehicle_sold == 'hide') && !is_admin() ||
                is_tax('vehicle_type') && ($autoshowroom_vehicle_sold == 'hide') && !is_admin() ||
                is_tax('make') && ($autoshowroom_vehicle_sold == 'hide') && !is_admin() ||
                is_tax('model') && ($autoshowroom_vehicle_sold == 'hide') && !is_admin())
            :
                $meta_query_old = $query->get('meta_query');
                $meta_query_new = array();
                if (is_array($meta_query_old)) {
                    foreach ($meta_query_old as $meta_query) {
                        $meta_query_new = $meta_query;
                    }
                }
                $custom_query = array(
                    'relation' => 'AND',
                    array(
                        'relation' => 'OR',
                        array(
                            'key' => 'autoshowroom_vehicle_sold',
                            'value' => 'sold',
                            'compare' => '!=',
                        ),
                        array(
                            'key' => 'autoshowroom_vehicle_sold',
                            'compare' => 'NOT EXISTS',
                        ),
                    ),
                    $meta_query_new
                );

                $query->set('meta_query', $custom_query);
                return;
            endif;
        }
    }

endif;
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width))
    $content_width = 900;


/*
 * Adds JavaScript to pages with the comment form to support
 * sites with threaded comments (when in use).
 */
if (is_singular() && comments_open() && get_option('thread_comments'))
    wp_enqueue_script('comment-reply');

if (!function_exists('tz_autoshowroom_paging_nav')) {
    function tz_autoshowroom_paging_nav()
    {
        global $wp_query, $wp_rewrite;
        // Don't print empty markup if there's only one page.
        if ($wp_query->max_num_pages < 2) {
            return;
        }

        $tz_autoshowroom_paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
        $tz_autoshowroom_pagenum_link = html_entity_decode(get_pagenum_link());
        $tz_autoshowroom_query_args = array();
        $tz_autoshowroom_url_parts = explode('?', $tz_autoshowroom_pagenum_link);

        if (isset($tz_autoshowroom_url_parts[1])) {
            wp_parse_str($tz_autoshowroom_url_parts[1], $tz_autoshowroom_query_args);
        }

        $tz_autoshowroom_pagenum_link = remove_query_arg(array_keys($tz_autoshowroom_query_args), $tz_autoshowroom_pagenum_link);
        $tz_autoshowroom_pagenum_link = trailingslashit($tz_autoshowroom_pagenum_link) . '%_%';

        $tz_autoshowroom_format = $wp_rewrite->using_index_permalinks() && !strpos($tz_autoshowroom_pagenum_link, 'index.php') ? 'index.php/' : '';
        $tz_autoshowroom_format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';
        // Set up paginated links.
        $tz_autoshowroom_links = paginate_links(array(
            'base' => $tz_autoshowroom_pagenum_link,
            'format' => $tz_autoshowroom_format,
            'total' => $wp_query->max_num_pages,
            'current' => $tz_autoshowroom_paged,
            'mid_size' => 1,
            'add_args' => array_map('urlencode', $tz_autoshowroom_query_args),
            'prev_text' => esc_html__('Previous', 'autoshowroom'),
            'next_text' => esc_html__('Next', 'autoshowroom'),
        ));

        if ($tz_autoshowroom_links) :

            ?>
            <nav class="navigation paging-navigation" role="navigation">
                <div class="tzpagination2 loop-pagination">
                    <?php echo balanceTags($tz_autoshowroom_links); ?>
                </div><!-- .pagination -->
            </nav><!-- .navigation -->
        <?php
        endif;
    }
}

/*
 * Fuction override post_class()
*/
function tz_autoshowroom_post_classes($classes, $class, $post_id)
{
    if (is_single()):
        $classes[] = 'autoshowroom-blog-item';
    endif;

    return $classes;
}

add_filter('post_class', 'tz_autoshowroom_post_classes', 10, 3);

if (!function_exists('tz_autoshowroom_custom_paging_nav')) {
    function tz_autoshowroom_custom_paging_nav($tz_autoshowroom_query_total)
    {
        global $wp_query, $wp_rewrite;
        // Don't print empty markup if there's only one page.
        if ($tz_autoshowroom_query_total < 2) {
            return;
        }

        $tz_autoshowroom_paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
        $tz_autoshowroom_pagenum_link = html_entity_decode(get_pagenum_link());
        $tz_autoshowroom_query_args = array();
        $tz_autoshowroom_url_parts = explode('?', $tz_autoshowroom_pagenum_link);

        if (isset($tz_autoshowroom_url_parts[1])) {
            wp_parse_str($tz_autoshowroom_url_parts[1], $tz_autoshowroom_query_args);
        }

        $tz_autoshowroom_pagenum_link = remove_query_arg(array_keys($tz_autoshowroom_query_args), $tz_autoshowroom_pagenum_link);
        $tz_autoshowroom_pagenum_link = trailingslashit($tz_autoshowroom_pagenum_link) . '%_%';

        $tz_autoshowroom_format = $wp_rewrite->using_index_permalinks() && !strpos($tz_autoshowroom_pagenum_link, 'index.php') ? 'index.php/' : '';
        $tz_autoshowroom_format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';
        // Set up paginated links.
        $tz_autoshowroom_links = paginate_links(array(
            'base' => $tz_autoshowroom_pagenum_link,
            'format' => $tz_autoshowroom_format,
            'total' => $tz_autoshowroom_query_total,
            'current' => $tz_autoshowroom_paged,
            'mid_size' => 1,
            'add_args' => array_map('urlencode', $tz_autoshowroom_query_args),
            'prev_text' => esc_html__('Previous', 'autoshowroom'),
            'next_text' => esc_html__('Next', 'autoshowroom'),
        ));

        if ($tz_autoshowroom_links) :

            ?>
            <nav class="navigation paging-navigation" role="navigation">
                <div class="tzpagination2 loop-pagination">
                    <?php echo balanceTags($tz_autoshowroom_links); ?>
                </div><!-- .pagination -->
            </nav><!-- .navigation -->
        <?php
        endif;
    }
}
if (!function_exists('tz_autoshowroom_custom_paging_nav')) {
    function tz_autoshowroom_custom_paging_nav($tz_autoshowroom_query_total)
    {
        global $wp_query, $wp_rewrite;
        // Don't print empty markup if there's only one page.
        if ($tz_autoshowroom_query_total < 2) {
            return;
        }

        $tz_autoshowroom_paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
        $tz_autoshowroom_pagenum_link = html_entity_decode(get_pagenum_link());
        $tz_autoshowroom_query_args = array();
        $tz_autoshowroom_url_parts = explode('?', $tz_autoshowroom_pagenum_link);

        if (isset($tz_autoshowroom_url_parts[1])) {
            wp_parse_str($tz_autoshowroom_url_parts[1], $tz_autoshowroom_query_args);
        }

        $tz_autoshowroom_pagenum_link = remove_query_arg(array_keys($tz_autoshowroom_query_args), $tz_autoshowroom_pagenum_link);
        $tz_autoshowroom_pagenum_link = trailingslashit($tz_autoshowroom_pagenum_link) . '%_%';

        $tz_autoshowroom_format = $wp_rewrite->using_index_permalinks() && !strpos($tz_autoshowroom_pagenum_link, 'index.php') ? 'index.php/' : '';
        $tz_autoshowroom_format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';
        // Set up paginated links.
        $tz_autoshowroom_links = paginate_links(array(
            'base' => $tz_autoshowroom_pagenum_link,
            'format' => $tz_autoshowroom_format,
            'total' => $tz_autoshowroom_query_total,
            'current' => $tz_autoshowroom_paged,
            'mid_size' => 1,
            'add_args' => array_map('urlencode', $tz_autoshowroom_query_args),
            'prev_text' => esc_html__('Previous', 'autoshowroom'),
            'next_text' => esc_html__('Next', 'autoshowroom'),
        ));

        if ($tz_autoshowroom_links) :

            ?>
            <nav class="navigation paging-navigation" role="navigation">
                <div class="tzpagination2 loop-pagination">
                    <?php echo balanceTags($tz_autoshowroom_links); ?>
                </div><!-- .pagination -->
            </nav><!-- .navigation -->
        <?php
        endif;
    }
}

/*
 * Method add ot_get_option
 */

if (!is_admin()):

    if (!function_exists('ot_get_option')) {
        function ot_get_option($tz_autoshowroom_option_id, $tz_autoshowroom_default = '')
        {
            /* get the saved options */
            $tz_autoshowroom_options = get_option('option_tree');
            /* look for the saved value */
            if (isset($tz_autoshowroom_options[$tz_autoshowroom_option_id]) && '' != $tz_autoshowroom_options[$tz_autoshowroom_option_id]) {
                return $tz_autoshowroom_options[$tz_autoshowroom_option_id];
            }
            return $tz_autoshowroom_default;
        }
    }

endif;


if (function_exists('ot_get_option')) {
    /*
     * Method limit excerpt
     */
    function limitexcerpt($lenght)
    {
        return ot_get_option('tz_autoshowroom_porlimitexcerpt', 50);
    }

    add_filter('excerpt_length', 'limitexcerpt');
}

/*
 *  Show full editor
 * */

function tz_autoshowroom_ilc_mce_buttons($buttons)
{
    array_push($buttons,
        "backcolor",
        "anchor",
        "hr",
        "sub",
        "sup",
        "fontselect",
        "fontsizeselect",
        "styleselect",
        "cleanup"
    );
    return $buttons;
}

add_filter("mce_buttons_2", "tz_autoshowroom_ilc_mce_buttons");

function tz_autoshowroom_customize_text_sizes($initArray)
{
    $initArray['fontsize_formats'] = "8px 10px 12px 13px 14px 15px 16px 18px 19px 20px 23px 26px 30px 36px";
    return $initArray;
}

add_filter('tiny_mce_before_init', 'tz_autoshowroom_customize_text_sizes');

/*
* This function is used to get people to check out the article
*/
function tz_autoshowroom_getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') { // If such views are not
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0"; // return value of 0
    }
    return $count; // Returns views
}

/*
* This function is used to set and update the article views.
*/
function tz_autoshowroom_setPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++; // Incremental view
        update_post_meta($postID, $count_key, $count); // update count
    }
}

/*
 * Modify The Read More Link Text
 */

add_filter('the_content_more_link', 'tz_autoshowroom_read_more_link');
function tz_autoshowroom_read_more_link()
{
    return '<a class="more-link" href="' . get_permalink() . '"><i class="fa fa-arrow-circle-right"></i> ' . esc_html__('Read more', 'autoshowroom') . '</a>';
}


/*
 * TWITTER AMPERSAND ENTITY DECODE
 */

function tz_autoshowroom_social_title($title)
{
    $title = html_entity_decode($title);
    $title = urlencode($title);
    return $title;
}

/*
 * Register Auto Showroom widget areas.
 */
function tz_autoshowroom_widgets_init()
{
    if (function_exists('ot_get_option')) {
        $autoshowroom_type_footer = ot_get_option('autoshowroom_footer_type', 'type1');
    }else{
        $autoshowroom_type_footer = '';
    }
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'autoshowroom'),
        'id' => 'sidebar',
        'description' => esc_html__('Display sidebar on all page.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('HeaderTop - Left', 'autoshowroom'),
        'id' => 'headertop-left',
        'description' => esc_html__('Header Top Sidebar that appears on the Top Header Left.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('HeaderTop - Right', 'autoshowroom'),
        'id' => 'headertop-right',
        'description' => esc_html__('Header Top Sidebar that appears on the Top Header Right.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Quick Search', 'autoshowroom'),
        'id' => 'quicksearch',
        'description' => esc_html__('Auto Quick Search that appears on the Sidebar.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 1', 'autoshowroom'),
        'id' => 'footer-1',
        'description' => esc_html__('Display footer 1.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 2', 'autoshowroom'),
        'id' => 'footer-2',
        'description' => esc_html__('Display footer 2.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 3', 'autoshowroom'),
        'id' => 'footer-3',
        'description' => esc_html__('Display footer 3.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 4', 'autoshowroom'),
        'id' => 'footer-4',
        'description' => esc_html__('Display footer 4.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Bottom - Left', 'autoshowroom'),
        'id' => 'footer-bottom-left',
        'description' => esc_html__('Footer Bottom Sidebar that appears on the Footer Bottom Left.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    if ($autoshowroom_type_footer != 'type4') {
        register_sidebar(array(
            'name' => esc_html__('Footer Bottom - Center', 'autoshowroom'),
            'id' => 'footer-bottom-center',
            'description' => esc_html__('Footer Bottom Sidebar that appears on the Footer Bottom Center.', 'autoshowroom'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
    register_sidebar(array(
        'name' => esc_html__('Footer Bottom - Right', 'autoshowroom'),
        'id' => 'footer-bottom-right',
        'description' => esc_html__('Footer Bottom Sidebar that appears on the Footer Bottom Right.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Vehicle Detail- Right', 'autoshowroom'),
        'id' => 'vehicle-bottom-right',
        'description' => esc_html__('Widget will appears on the Bottom Right Sidebar of Vehicle detail page.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Sidebar Shop', 'autoshowroom'),
        'id' => 'autoshowroom-sidebar-shop',
        'description' => esc_html__('Display sidebar shop on page of woocommerce.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="%2$s widget">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ));
    register_sidebar(array(
        'name' => esc_html__('Sidebar Agency', 'autoshowroom'),
        'id' => 'autoshowroom-sidebar-agency',
        'description' => esc_html__('Display sidebar shop on page of woocommerce.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="%2$s widget">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ));
    register_sidebar(array(
        'name' => esc_html__('Sidebar Contact', 'autoshowroom'),
        'id' => 'autoshowroom-sidebar-contact',
        'description' => esc_html__('Display sidebar Contact page.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="%2$s widget">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ));
    register_sidebar(array(
        'name' => esc_html__('Sidebar Inventory', 'autoshowroom'),
        'id' => 'autoshowroom-sidebar-inventory',
        'description' => esc_html__('Display sidebar on page of Inventory.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="%2$s widget">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ));
    register_sidebar(array(
        'name' => esc_html__('Sidebar Shop Detail', 'autoshowroom'),
        'id' => 'autoshowroom-sidebar-shop-detail',
        'description' => esc_html__('Display sidebar shop on page of woocommerce.', 'autoshowroom'),
        'before_widget' => '<aside id="%1$s" class="%2$s widget">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ));

}

if (class_exists('WooCommerce')):
    /*
     * Required: woocommerce
     */
    require get_template_directory() . '/extension/autoshowroom-woocommerce.php';
    /**
     * Required: include plugin Aqua Resizer
     */
    require get_template_directory() . '/extension/aq_resizer.php';
endif;


add_action('widgets_init', 'tz_autoshowroom_widgets_init');
/*
 * Autoshowroom Price
 */

function tz_autoshowroom_filter_vehicle_price($post_id = null, $showmsrp='')
{
    global $post;
    $html = '';
    if (!$post_id) {
        $post_id = get_post($post)->ID;

    }
    $msrp = get_field('msrp', $post_id);
    $price = get_field('price', $post_id);
    // render output
    if (!empty($price)) {

        $html .= '<p class="pcd-pricing">';

        $html .= sprintf('<span class="pcd-price"><b> %s</b> %s </span>', esc_html__(' ', 'autoshowroom'), tz_autoshowroom_format_price($price));
        if (!empty($msrp) && $showmsrp == 'yes') {
            $html .= sprintf('<span class="pcd-price-msrp"> %s  %s </span>', esc_html__('MSRP:', 'autoshowroom'), tz_autoshowroom_format_price($msrp));
        };
        $html .= '</p>'
        ?>
        <?php
    }

    return $html;

}

/*
 * Autoshowroom MSRP Price
 */
function tz_autoshowroom_filter_vehicle_msrp_price($post_id = null)
{
    $html = '';
    $msrp = get_field('msrp', $post_id);
    // render output
    $html .= '<span>';
    if ($msrp) {
        $html .= sprintf('<span class="pcd-price-msrp"> %s  %s </span>', esc_html__('', 'autoshowroom'), tz_autoshowroom_format_price($msrp));
    }
    $html .= '</span>';

    return $html;

}

add_filter('pcd/shortcode/get_price', 'tz_autoshowroom_filter_vehicle_price', 10, 2);

/*
 * Autoshowroom Format Price
 */
function tz_autoshowroom_format_price($price = '0')
{

    $original_price = $price;
    $symbol = get_option('options_pcd_currency_symbol', '$');
    $placement = get_option('options_pcd_symbol_placement', 'prepend');
    $decimal_spaces = 0;
    $decimal_sep = ',';
    $thousands_sep = get_option('options_pcd_thousands_separator', ',');

    if ('space' == $thousands_sep) {
        $thousands_sep = ' ';
    }
    $price = number_format($price, $decimal_spaces, $decimal_sep, $thousands_sep);

    if ('append' == $placement) {
        $price = $price . '&nbsp;' . $symbol;
    } else {
        $price = $symbol . '' . $price;
    }
    return apply_filters('pcd/format_price', $price, $original_price);
}

/*
 * Autoshowroom Vehicle Spec
 */
function tz_autoshowroom_get_vehicle_specs($post_id = null, $tz_autoshowroom_specifications_arr='')
{

    global $car_dealer;

    $html = '';

    $fields = $car_dealer->fields->get_registered_fields('specs');

    // render output
    if (!empty($fields)) {

        $html .= '<div class="pcd-specs">';

        foreach ($fields as $k => $field) {

            $label = $field['label'];
            $name = $field['name'];
            $field_icon = ot_get_option('spec_' . $name . '');
            if ($tz_autoshowroom_specifications_arr == 'all') {
                $value = get_field($field['name'], $post_id);

                if (!$value) {
                    unset($fields[$k]);
                    continue;
                }

                $field_value = tz_autoshowroom_get_field_value($name);
                $fields[$k]['value'] = $field_value;


                $html .= "<div><label>" . $label . "</label> <span class='$name'>" . $field_value . "</span></div>";
            }
            if ($tz_autoshowroom_specifications_arr != 'all' && $tz_autoshowroom_specifications_arr != '') {
                if (in_array($name, $tz_autoshowroom_specifications_arr)) {
                    $value = get_field($field['name'], $post_id);
                    $field_icon = ot_get_option('spec_' . $name . '');
                    if (!$value) {
                        unset($fields[$k]);
                        continue;
                    }

//                    $field_value = tz_autoshowroom_get_field_value($name);
//                    var_dump($field_value);
//                    $fields[$k]['value'] = $field_value;


                    $html .= "<span class='$name'><i class=' $field_icon'></i>" . $value . "</span>";
                }
            }
        }

        $html .= '<div class="clr">&nbsp;</div> </div>';
    }

    return $html;
}

/*
 * Autoshowroom Fields
 */
function tz_autoshowroom_get_field_value($field_name)
{
    global $car_dealer, $post;
    $output = '';
    $fields = $car_dealer->fields->get_registered_fields();

    $field_found = false;

    foreach ($fields as $field) {
        if ($field['name'] == $field_name) {
            $field_found = $field;
            break;
        }
    }
    if (empty($field_found)) {
        return;
    }

    if ('taxonomy' == $field_found['type']) {
        $value = join(', ', wp_get_object_terms($post->ID, $field_name, array('fields' => 'names')));
    } elseif (!empty($field['choices'][get_field($field_name)])) {
        $value = $field_found['choices'][get_field($field_name)];
    } else {
        $value = get_field($field_name);
    }
    if (!empty($field_found['prepend'])) {
        $output .= '<em class="unit_prepend"> ' . $field_found['prepend'] . ' </em>';
    }

    $output .= __($value,'progression-car-dealer');

    if (!empty($field_found['append'])) {
        $output .= '<em class="unit_append"> ' . $field_found['append'] . ' </em>';
    }
    return $output;
}

add_filter('pcd/get_field_value', 'tz_autoshowroom_get_field_value', 10, 2);

/*
 * Autoshowroom Search
 */
/*
 * Autoshowroom poftfolio
 * */

/*Ajax Compare Auto*/
if (is_user_logged_in()) {
    add_action('wp_ajax_tz_autoshowroom_compare_ajax', 'tz_autoshowroom_compare_ajax');

} else {
    add_action('wp_ajax_nopriv_tz_autoshowroom_compare_ajax', 'tz_autoshowroom_compare_ajax');
}
function tz_autoshowroom_compare_ajax()
{
    $autoshowroom_portfolio_description_limit = ot_get_option('autoshowroom_TZVehicle_limit');
    $vehicle_cp_text = ot_get_option('autoshowroom_TZVehicle_compare_text');
    $vehicle_cp_phone = ot_get_option('autoshowroom_TZVehicle_compare_phone');
    $vehicle_cp_bt_text = ot_get_option('autoshowroom_TZVehicle_compare_button_text');
    $vehicle_cp_bt_link = ot_get_option('autoshowroom_TZVehicle_compare_button_link');
    $vehicle_cp_bt_remove_txt = ot_get_option('autoshowroom_TZVehicle_compare_remove_txt');
    $vehicleids = $_POST['vehicleIDS'];
    $vehicleid_arr = explode('|', $vehicleids);
    $vehicle_args = array(
        'post_type' => 'vehicle',
        'post__in' => $vehicleid_arr,
        'posts_per_page ' => 20
    );
    $ajax_vehicle = new WP_Query($vehicle_args);
    $i = 0; ?>
    <div class="container">
        <div class="vehicle-results vehicle-compare-results">
            <span class="results-text"><?php echo esc_html($vehicle_cp_text); ?> <a href="tel:<?php echo esc_html($vehicle_cp_phone); ?>"><span><?php echo esc_html($vehicle_cp_phone); ?></span></a></span>
            <div class="vehicle-layouts">
                <a href="<?php echo esc_url($vehicle_cp_bt_link); ?>"><i
                            class="fa fa-arrow-circle-right"></i> <?php echo esc_html($vehicle_cp_bt_text) ?> </a>
            </div>
            <div class="clr"></div>
        </div>
        <div class="owl-carousel TZ-Vehicle-Compare">
            <?php
            while ($ajax_vehicle->have_posts()):
                $ajax_vehicle->the_post();
                ?>
                <div class="item">
                    <div class="Vehicle-Feature-Image">
                        <?php the_post_thumbnail('large'); ?>
                        <span data-id="<?php the_ID(); ?>"
                              class="btn-remove-compare"><?php echo esc_html($vehicle_cp_bt_remove_txt); ?></span>
                    </div>
                    <h3 class="Vehicle-Title">
                        <a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a>
                    </h3>
                    <p><?php
                        $autoshowroom_des = substr(strip_tags(get_the_excerpt()), 0, $autoshowroom_portfolio_description_limit);
                        echo esc_html($autoshowroom_des); ?></p>
                    <div class="pcd-specs">
                        <div>
                            <label><?php esc_html_e('Make', 'autoshowroom'); ?></label>
                            <span>
                                    <?php $autoshowroom_vehicle_make = wp_get_post_terms(get_the_ID(), 'make');
                                    foreach ($autoshowroom_vehicle_make as $make) {
                                        echo esc_attr($make->name);
                                    }
                                    ?>
                                </span>
                        </div>
                        <div>
                            <label><?php esc_html_e('Model', 'autoshowroom'); ?></label>
                            <span>
                                    <?php $autoshowroom_vehicle_make = wp_get_post_terms(get_the_ID(), 'model');
                                    foreach ($autoshowroom_vehicle_make as $make) {
                                        echo esc_attr($make->name);
                                    }
                                    ?>
                                </span>
                        </div>
                    </div>
                    <?php echo balanceTags(tz_autoshowroom_get_vehicle_specs(get_the_ID(), 'all')); ?>
                    
                    <?php
                    $pricesold = get_field('autoshowroom_vehicle_sold', get_the_ID());
                    $pricetext = get_field('pricetext', get_the_ID());
                    $pricelink = get_field('pricelink', get_the_ID());
                    if ($pricesold == 'sold') { ?>
                        <p class="pcd-pricing">
                            <span class="pcd-price"><?php echo esc_html__('SOLD', 'autoshowroom'); ?></span>
                        </p>
                        <?php
                    } elseif ($pricetext != '') { ?>
                        <p class="pcd-pricing">
                            <?php
                            if ($pricelink != ''){ ?>
                            <a class="priceurl" href="<?php echo esc_url($pricelink); ?>">
                                <?php }
                                ?>

                                <span class="pcd-price"><?php echo esc_attr($pricetext); ?></span>
                                <?php
                                if ($pricelink != ''){ ?>
                            </a>
                        <?php }
                        ?>
                        </p>
                        <?php
                    } else {
                        echo balanceTags(tz_autoshowroom_filter_vehicle_price(get_the_ID(), 'yes'));
                    }

                    ?>
                </div>

                <?php
                $i++;
            endwhile; ?>
            <?php
            if ($ajax_vehicle->found_posts < 3) {
                ?>
                <div class="item add-vehicle">
                    <div class="Vehicle-Feature-Image">
                        <i class="fa fa-car"></i>
                    </div>
                    <h3 class="Vehicle-Title">
                        <a href="<?php echo esc_url($vehicle_cp_bt_link); ?>"><span><?php esc_html_e('Add Car to Compare', 'autoshowroom'); ?></span></a>
                    </h3>
                    <div class="pcd-specs">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
    <?php

    wp_reset_postdata();
    exit();
}

/* Social Author */
function tz_autoshowroom_modify_contact_methods($profile_fields)
{
    // Add new fields
    $profile_fields['job'] = 'Job';
    $profile_fields['twitter'] = 'Twitter URL';
    $profile_fields['facebook'] = 'Facebook URL';
    $profile_fields['gplus'] = 'Google+ URL';
    $profile_fields['dribbble'] = 'Dribbble URL';
    $profile_fields['linkedin'] = 'Linkedin URL';
    return $profile_fields;
}

add_filter('user_contactmethods', 'tz_autoshowroom_modify_contact_methods');

/**************************************************************************************
 * Displays comment.
 */

if (!function_exists('tz_autoshowroom_comment')) :
    function tz_autoshowroom_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                // Display trackbacks differently than normal comments.
                ?>
                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <p><?php esc_html_e('Pingback:', 'autoshowroom'); ?><?php comment_author_link(); ?><?php edit_comment_link(esc_html__('(Edit)', 'autoshowroom'), '<span class="edit-link">', '</span>'); ?></p>
                <?php
                break;
            default :
                // Proceed with normal comments.
                global $post;
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <article id="comment-<?php comment_ID(); ?>" class="comment-body">
                    <div class="comment-meta comment-author">
                        <?php echo balanceTags(get_avatar($comment, 85)); ?>
                    </div><!-- .comment-meta -->

                    <?php if ('0' == $comment->comment_approved) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'autoshowroom'); ?></p>
                    <?php endif; ?>

                    <div class="comment-content">
                        <?php
                        printf('<h5 class="fn">%1$s</h5>',
                            get_comment_author_link()
                        );
                        ?>
                        <div class="tz-commentInfo">
                            <?php
                            printf('<a class="comments-datetime" href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                                esc_url(get_comment_link($comment->comment_ID)),
                                get_comment_time('c'),
                                /* translators: 1: date, 2: time */
                                sprintf(esc_html__('%1$s at %2$s', 'autoshowroom'), get_comment_date('d M, Y'), get_comment_time())
                            );
                            edit_comment_link(esc_html__('Edit', 'autoshowroom'));
                            comment_reply_link(array_merge($args, array('reply_text' => esc_html__('Reply', 'autoshowroom'), 'depth' => $depth, 'max_depth' => $args['max_depth'])));
                            ?>
                        </div>

                        <?php
                        comment_text();
                        ?>

                    </div><!-- .comment-content -->
                    <div class="clearfix"></div>
                </article><!-- #comment-## -->
                <?php
                break;
        endswitch; // end comment_type check
    }
endif;

/**************************************************************************************
 * Displays navigation comment.
 */

if (!function_exists('tz_autoshowroom_comment_nav')) :
    /**
     * Display navigation to next/previous comments when applicable.
     *
     * @since Twenty Fifteen 1.0
     */
    function tz_autoshowroom_comment_nav()
    {
        // Are there comments to navigate through?
        if (get_comment_pages_count() > 1 && get_option('page_comments')) :
            ?>
            <nav class="navigation comment-navigation">
                <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'autoshowroom'); ?></h2>
                <div class="nav-links">
                    <?php
                    if ($prev_link = get_previous_comments_link(esc_html__('Older Comments', 'autoshowroom'))) :
                        printf('<div class="nav-previous">%s</div>', $prev_link);
                    endif;

                    if ($next_link = get_next_comments_link(esc_html__('Newer Comments', 'autoshowroom'))) :
                        printf('<div class="nav-next">%s</div>', $next_link);
                    endif;
                    ?>
                </div><!-- .nav-links -->
            </nav><!-- .comment-navigation -->
        <?php
        endif;
    }
endif;

function tz_autoshowroom_move_comment_field_to_bottom($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter('comment_form_fields', 'tz_autoshowroom_move_comment_field_to_bottom');

/*method activie plugin*/
add_filter( 'plazart-installation_register', 'tz_autoshowroom_register_required_demos' );

if(phpversion() >8){
    function tz_autoshowroom_register_required_demos($value)
    {
        $value = array(
            'envatoid'      => 8596818,
            'productname'   => 'AutoShowroom WordPress Theme',
            'demo-imports'  => array(
                'wp_autoshowroom' => array(
// Pack Info
                    'slug' => 'wp_autoshowroom_default', // Produce code created on server
                    'title' => 'Home Version 1',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 1',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home1.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Mailchimp',
                            'slug' => 'mailchimp-for-wp',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_content_default',
                            'checked' => true,

                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_media',
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_widget',
                            'demo_type' => 'widget-importer',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_revo_home1',
                            'demo_type' => 'revslider',
                            'checked' => true,

                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_megamenu',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => 1,
                                'theme_location'    => 'primary'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Version 1', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home version 1'),
                            'slug' => 'wp_autoshowroom_home1',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_home2', // Produce code created on server
                    'title' => 'Home Version 2',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 2',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home2.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Mailchimp',
                            'slug' => 'mailchimp-for-wp',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_content_default',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',

                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_media',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_widget',
                            'demo_type' => 'widget-importer',
                            'parent_slug'   => 'wp_autoshowroom_default',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_revo_home2',
                            'demo_type' => 'revslider',
                            'checked' => true,

                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_megamenu_home2',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => 1,
                                'theme_location'    => 'primary'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Version 2', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home version 2'),
                            'slug' => 'wp_autoshowroom_homepage2',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_home3', // Produce code created on server
                    'title' => 'Home Version 3',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 3',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home3.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Mailchimp',
                            'slug' => 'mailchimp-for-wp',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_content_default',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',

                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_media',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_widget',
                            'demo_type' => 'widget-importer',
                            'parent_slug'   => 'wp_autoshowroom_default',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_megamenu_home3',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => 1,
                                'theme_location'    => 'primary'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Version 3', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home version 3'),
                            'slug' => 'wp_autoshowroom_homepage3',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_home4', // Produce code created on server
                    'title' => 'Home Version 4',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 4',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home4.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Mailchimp',
                            'slug' => 'mailchimp-for-wp',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_content_default',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',

                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_media',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_widget',
                            'demo_type' => 'widget-importer',
                            'parent_slug'   => 'wp_autoshowroom_default',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_revo_home4',
                            'demo_type' => 'revslider',
                            'checked' => true,

                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_megamenu',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => 1,
                                'theme_location'    => 'primary'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),
                        array(
                            'title' => esc_html__('Home Version 4', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home version 4'),
                            'slug' => 'wp_autoshowroom_homepage4',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_motorbike', // Produce code created on server
                    'title' => 'Home Motorbike',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Motorbike',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home5.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'motorbike.autoshowroom.co',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Mailchimp',
                            'slug' => 'mailchimp-for-wp',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact, menu and home motorbike', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_moto_content',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_moto_media',
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_motorbike_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_moto_widget',
                            'demo_type' => 'widget-importer',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_moto_slider',
                            'demo_type' => 'revslider',
                            'checked' => true,

                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_moto_menu',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => '1',
                                'theme_location'    => 'primary-home-motor'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Motorbike', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home Motorbike'),
                            'slug' => 'wp_autoshowroom_homemotorbike',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_home6', // Produce code created on server
                    'title' => 'Home Version 6',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 6',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home6.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Mailchimp',
                            'slug' => 'mailchimp-for-wp',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_content_default',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',

                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_media',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_widget',
                            'demo_type' => 'widget-importer',
                            'parent_slug'   => 'wp_autoshowroom_default',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_revo_home6',
                            'demo_type' => 'revslider',
                            'checked' => true,

                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_megamenu_home6',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => 1,
                                'theme_location'    => 'primary-home-6'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Version 6', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home version 6'),
                            'slug' => 'wp_autoshowroom_homepage6',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_home7', // Produce code created on server
                    'title' => 'Home Version 7',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 7',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home7.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Mailchimp',
                            'slug' => 'mailchimp-for-wp',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_content_default',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',

                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_media',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_widget',
                            'demo_type' => 'widget-importer',
                            'parent_slug'   => 'wp_autoshowroom_default',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_revo_home7',
                            'demo_type' => 'revslider',
                            'checked' => true,

                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_megamenu_home7',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => 1,
                                'theme_location'    => 'primary'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Version 7', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home version 7'),
                            'slug' => 'wp_autoshowroom_homepage7',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_home8', // Produce code created on server
                    'title' => 'Home Rental',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 8',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home8.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://rental.autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Mailchimp',
                            'slug' => 'mailchimp-for-wp',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_rental_autoshowroom_default_content',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_rental_autoshowroom_media',
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_rental_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_rental_autoshowroom_widgets',
                            'demo_type' => 'widget-importer',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_rental_autoshowroom_megamenu',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => '1',
                                'theme_location'    => 'primary-home-8'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Rental', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home rental'),
                            'slug' => 'wp_autoshowroom_homepage8',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_home9', // Produce code created on server
                    'title' => 'Home Service',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 9',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home9.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://autoshowroom.co/home-version-9/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Mailchimp',
                            'slug' => 'mailchimp-for-wp',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_content_default',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_media',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_widget',
                            'demo_type' => 'widget-importer',
                            'parent_slug'   => 'wp_autoshowroom_default',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_revo_home9',
                            'demo_type' => 'revslider',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_megamenu_home9',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => '1',
                                'theme_location'    => 'primary-home-9'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Service', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home service'),
                            'slug' => 'wp_autoshowroom_homepage9',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_boat', // Produce code created on server
                    'title' => 'Home Boat',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Boat',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home10.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://boat.autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (
                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Mailchimp',
                            'slug' => 'mailchimp-for-wp',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_default_content',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_boat_autoshowroom_media',
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_theme_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_widgets',
                            'demo_type' => 'widget-importer',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_revo_boat',
                            'demo_type' => 'revslider',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_boat_autoshowroom_megamenu',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => '1',
                                'theme_location'    => 'primary-home-10'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Boat', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home Boat'),
                            'slug' => 'wp_boat_autoshowroom_home',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_boat_home2', // Produce code created on server
                    'title' => 'Home Boat Version 2',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Boat Version 2',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        ),
                        array(
                            'title'     => 'Menu Home 11',
                            'location'  => 'primary-home-11'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home11.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://boat.autoshowroom.co/home-boat-version-2',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (
                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Mailchimp',
                            'slug' => 'mailchimp-for-wp',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_default_content',
                            'parent_slug'   => 'wp_autoshowroom_boat',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_boat_autoshowroom_media',
                            'parent_slug'   => 'wp_autoshowroom_boat',
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_theme_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'parent_slug'   => 'wp_autoshowroom_boat',
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_widgets',
                            'parent_slug'   => 'wp_autoshowroom_boat',
                            'demo_type' => 'widget-importer',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_revo_boat',
                            'demo_type' => 'revslider',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_boat_autoshowroom_megamenu',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => '1',
                                'theme_location'    => 'primary-home-11'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Boat Version 2', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home Boat'),
                            'slug' => 'wp_boat_autoshowroom_home2',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                )
            )
        );
        return $value;
    }
}else{
    function tz_autoshowroom_register_required_demos($value)
    {
        $value = array(
            'envatoid'      => 8596818,
            'productname'   => 'AutoShowroom WordPress Theme',
            'demo-imports'  => array(
                'wp_autoshowroom' => array(
// Pack Info
                    'slug' => 'wp_autoshowroom_default', // Produce code created on server
                    'title' => 'Home Version 1',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 1',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home1.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'DW Twitter',
                            'slug' => 'dw-twitter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Easy Sign Up',
                            'slug' => 'easy-sign-up',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_content_default',
                            'checked' => true,

                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_media',
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_widget',
                            'demo_type' => 'widget-importer',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_revo_home1',
                            'demo_type' => 'revslider',
                            'checked' => true,

                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_megamenu',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => 1,
                                'theme_location'    => 'primary'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Version 1', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home version 1'),
                            'slug' => 'wp_autoshowroom_home1',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_home2', // Produce code created on server
                    'title' => 'Home Version 2',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 2',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home2.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'DW Twitter',
                            'slug' => 'dw-twitter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Easy Sign Up',
                            'slug' => 'easy-sign-up',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_content_default',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',

                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_media',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_widget',
                            'demo_type' => 'widget-importer',
                            'parent_slug'   => 'wp_autoshowroom_default',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_revo_home2',
                            'demo_type' => 'revslider',
                            'checked' => true,

                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_megamenu_home2',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => 1,
                                'theme_location'    => 'primary'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Version 2', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home version 2'),
                            'slug' => 'wp_autoshowroom_homepage2',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_home3', // Produce code created on server
                    'title' => 'Home Version 3',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 3',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home3.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'DW Twitter',
                            'slug' => 'dw-twitter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Easy Sign Up',
                            'slug' => 'easy-sign-up',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_content_default',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',

                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_media',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_widget',
                            'demo_type' => 'widget-importer',
                            'parent_slug'   => 'wp_autoshowroom_default',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_megamenu_home3',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => 1,
                                'theme_location'    => 'primary'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Version 3', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home version 3'),
                            'slug' => 'wp_autoshowroom_homepage3',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_home4', // Produce code created on server
                    'title' => 'Home Version 4',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 4',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home4.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'DW Twitter',
                            'slug' => 'dw-twitter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Easy Sign Up',
                            'slug' => 'easy-sign-up',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_content_default',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',

                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_media',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_widget',
                            'demo_type' => 'widget-importer',
                            'parent_slug'   => 'wp_autoshowroom_default',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_revo_home4',
                            'demo_type' => 'revslider',
                            'checked' => true,

                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_megamenu',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => 1,
                                'theme_location'    => 'primary'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),
                        array(
                            'title' => esc_html__('Home Version 4', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home version 4'),
                            'slug' => 'wp_autoshowroom_homepage4',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_motorbike', // Produce code created on server
                    'title' => 'Home Motorbike',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Motorbike',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home5.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'motorbike.autoshowroom.co',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'DW Twitter',
                            'slug' => 'dw-twitter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Easy Sign Up',
                            'slug' => 'easy-sign-up',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact, menu and home motorbike', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_moto_content',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_moto_media',
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_motorbike_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_moto_widget',
                            'demo_type' => 'widget-importer',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_moto_slider',
                            'demo_type' => 'revslider',
                            'checked' => true,

                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_moto_menu',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => '1',
                                'theme_location'    => 'primary-home-motor'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Motorbike', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home Motorbike'),
                            'slug' => 'wp_autoshowroom_homemotorbike',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_home6', // Produce code created on server
                    'title' => 'Home Version 6',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 6',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home6.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'DW Twitter',
                            'slug' => 'dw-twitter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Easy Sign Up',
                            'slug' => 'easy-sign-up',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_content_default',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',

                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_media',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_widget',
                            'demo_type' => 'widget-importer',
                            'parent_slug'   => 'wp_autoshowroom_default',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_revo_home6',
                            'demo_type' => 'revslider',
                            'checked' => true,

                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_megamenu_home6',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => 1,
                                'theme_location'    => 'primary-home-6'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Version 6', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home version 6'),
                            'slug' => 'wp_autoshowroom_homepage6',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_home7', // Produce code created on server
                    'title' => 'Home Version 7',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 7',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home7.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'DW Twitter',
                            'slug' => 'dw-twitter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Easy Sign Up',
                            'slug' => 'easy-sign-up',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_content_default',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',

                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_media',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_widget',
                            'demo_type' => 'widget-importer',
                            'parent_slug'   => 'wp_autoshowroom_default',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_revo_home7',
                            'demo_type' => 'revslider',
                            'checked' => true,

                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_megamenu_home7',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => 1,
                                'theme_location'    => 'primary'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Version 7', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home version 7'),
                            'slug' => 'wp_autoshowroom_homepage7',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_home8', // Produce code created on server
                    'title' => 'Home Rental',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 8',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home8.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://rental.autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'DW Twitter',
                            'slug' => 'dw-twitter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Easy Sign Up',
                            'slug' => 'easy-sign-up',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_rental_autoshowroom_default_content',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_rental_autoshowroom_media',
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_rental_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_rental_autoshowroom_widgets',
                            'demo_type' => 'widget-importer',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_rental_autoshowroom_megamenu',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => '1',
                                'theme_location'    => 'primary-home-8'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Rental', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home rental'),
                            'slug' => 'wp_autoshowroom_homepage8',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_home9', // Produce code created on server
                    'title' => 'Home Service',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Version 9',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home9.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://autoshowroom.co/home-version-9/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (

                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'DW Twitter',
                            'slug' => 'dw-twitter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Easy Sign Up',
                            'slug' => 'easy-sign-up',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_content_default',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_autoshowroom_media',
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                            'parent_slug'   => 'wp_autoshowroom_default',
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_widget',
                            'demo_type' => 'widget-importer',
                            'parent_slug'   => 'wp_autoshowroom_default',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_autoshowroom_revo_home9',
                            'demo_type' => 'revslider',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_autoshowroom_megamenu_home9',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => '1',
                                'theme_location'    => 'primary-home-9'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Service', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home service'),
                            'slug' => 'wp_autoshowroom_homepage9',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_boat', // Produce code created on server
                    'title' => 'Home Boat',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Boat',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home10.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://boat.autoshowroom.co/',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (
                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'DW Twitter',
                            'slug' => 'dw-twitter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Easy Sign Up',
                            'slug' => 'easy-sign-up',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_default_content',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_boat_autoshowroom_media',
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_theme_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_widgets',
                            'demo_type' => 'widget-importer',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_revo_boat',
                            'demo_type' => 'revslider',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_boat_autoshowroom_megamenu',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => '1',
                                'theme_location'    => 'primary-home-10'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Boat', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home Boat'),
                            'slug' => 'wp_boat_autoshowroom_home',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                ),
                array(
// Pack Info
                    'slug' => 'wp_autoshowroom_boat_home2', // Produce code created on server
                    'title' => 'Home Boat Version 2',
                    'desc' => 'Auto Showroom Theme is clean and modern design which is useful for Car Dealer, Auto Dealer, Automotive WordPress website',
                    'front_page' => true,
                    'front_page_title'  => 'Home Boat Version 2',
                    'menu_locations'    => array(
                        array(
                            'title'     => 'Main Menu',
                            'location'  => 'primary'
                        ),
                        array(
                            'title'     => 'Menu Home 2',
                            'location'  => 'primary-home-2'
                        ),
                        array(
                            'title'     => 'Menu Home 3',
                            'location'  => 'primary-home-3'
                        ),
                        array(
                            'title'     => 'Menu Motorbike',
                            'location'  => 'primary-home-motor'
                        ),
                        array(
                            'title'     => 'Menu Home 6',
                            'location'  => 'primary-home-6'
                        ),
                        array(
                            'title'     => 'Menu Home 7',
                            'location'  => 'primary-home-7'
                        ),
                        array(
                            'title'     => 'Menu Home 8',
                            'location'  => 'primary-home-8'
                        ),
                        array(
                            'title'     => 'Menu Home 9',
                            'location'  => 'primary-home-9'
                        ),
                        array(
                            'title'     => 'Menu Home 10',
                            'location'  => 'primary-home-10'
                        ),
                        array(
                            'title'     => 'Menu Home 11',
                            'location'  => 'primary-home-11'
                        )
                    ),
// Pack Data
                    'thumb' => 'http://templaza.net/install/autoshowroom/home11.jpg',
                    'category' => 'wordpress',
                    'demo_url' => 'http://boat.autoshowroom.co/home-boat-version-2',
                    'doc_url' => 'http://www.templaza.com/docs/autoshowroom_wp/',
                    'plugins' => array
                    (
                        array(
                            'name' => esc_html__('TZ AutoShowroom', 'autoshowroom'), /* The plugin name */
                            'slug' => 'tz-autoshowroom', /* The plugin slug (typically the folder name) */
                            'source' => get_template_directory_uri() . '/plugins/tz-autoshowroom.zip', /* The plugin source */
                            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
                            'version' => '1.9.6', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
                            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
                            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
                            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
                        ),
                        array(
                            'name'     				=> 'Options Tree', // The plugin name
                            'slug'     				=> 'option-tree', // The plugin slug (typically the folder name)
                            'source'   				=> get_stylesheet_directory() . '/plugins/option-tree.zip', // The plugin source
                            'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
                            'version' 				=> '2.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Progression Car Dealer', // The plugin name
                            'slug' => 'progression-car-dealer-master', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/progression-car-dealer-master.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '1.9.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'Slider Revolution', // The plugin name
                            'slug' => 'revslider', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),
                        array(
                            'name' => 'WPBakery Visual Composer', // The plugin name
                            'slug' => 'js_composer', // The plugin slug (typically the folder name)
                            'source' => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
                            'required' => true, // If false, the plugin is only 'recommended' instead of required
                            'version' => '6.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                            'external_url' => '', // If set, overrides default API URL and points to an external URL
                        ),

                        array(
                            'name' => 'Max Mega Menu',
                            'slug' => 'megamenu',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Better Font Awesome',
                            'slug' => 'better-font-awesome',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Breadcrumb NavXT',
                            'slug' => 'breadcrumb-navxt',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Contact Form 7',
                            'slug' => 'contact-form-7',
                            'required' => true,
                        ),
                        array(
                            'name' => 'DW Twitter',
                            'slug' => 'dw-twitter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Easy Sign Up',
                            'slug' => 'easy-sign-up',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Newsletter',
                            'slug' => 'newsletter',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Shortcodes Ultimate',
                            'slug' => 'shortcodes-ultimate',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WooCommerce',
                            'slug' => 'woocommerce',
                            'required' => true,
                        ),
                        array(
                            'name' => 'WP-PageNavi',
                            'slug' => 'wp-pagenavi',
                            'required' => true,
                        ),
                        array(
                            'name' => 'YITH WooCommerce Wishlist',
                            'slug' => 'yith-woocommerce-wishlist',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Theme My Login',
                            'slug' => 'theme-my-login',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Ultimate Member',
                            'slug' => 'ultimate-member',
                            'required' => true,
                        ),
                        array(
                            'name' => 'Black Studio TinyMCE Widget',
                            'slug' => 'black-studio-tinymce-widget',
                            'required' => true,
                        ),

                    ),

                    'demo-datas' => array(
                        array(
                            'title' => esc_html__('Content Default', 'autoshowroom'),
                            'desc' => esc_html__('This will import posts, pages, contact and menu', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_default_content',
                            'parent_slug'   => 'wp_autoshowroom_boat',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Media', 'autoshowroom'),
                            'desc' => esc_html__('This will import Media data'),
                            'slug' => 'wp_boat_autoshowroom_media',
                            'parent_slug'   => 'wp_autoshowroom_boat',
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Theme Options', 'autoshowroom'),
                            'desc' => esc_html__('This will import theme options and will rewrite all current settings in Appearance » Theme Options.', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_theme_option', // The package type from server
                            'demo_type' => 'option-tree', // The type to call function import
                            'parent_slug'   => 'wp_autoshowroom_boat',
                            'checked' => true,
                        ),

                        array(
                            'title' => esc_html__('Widgets', 'autoshowroom'),
                            'desc' => esc_html__('This will import default widgets presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_widgets',
                            'parent_slug'   => 'wp_autoshowroom_boat',
                            'demo_type' => 'widget-importer',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Revolution Slider', 'autoshowroom'),
                            'desc' => esc_html__('This will import all sliders presented in demo site of this content package.', 'autoshowroom'),
                            'slug' => 'wp_boat_autoshowroom_revo_boat',
                            'demo_type' => 'revslider',
                            'checked' => true,
                        ),
                        array(
                            'title' => esc_html__('Mega Menu', 'autoshowroom'),
                            'desc' => esc_html__('This will import megamenu data'),
                            'slug' => 'wp_boat_autoshowroom_megamenu',
                            /* Options from Menus in Appearance*/
                            'options' => array(
                                'enabled'            => '1',
                                'theme_location'    => 'primary-home-11'
                            ),
                            'demo_type' => 'megamenu',
                            'checked'   => true,
                        ),
                        array(
                            'title' => esc_html__('Home Boat Version 2', 'autoshowroom'),
                            'desc' => esc_html__('This will import Home Boat'),
                            'slug' => 'wp_boat_autoshowroom_home2',
                            'front_page' => true,
                            'checked' => true,
                        ),
                    )
                )
            )
        );
        return $value;
    }
}


/*method activie plugin*/
require_once get_template_directory() . '/plugins/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'tz_autoshowroom_register_required_plugins');
function tz_autoshowroom_register_required_plugins()
{

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $tz_autoshowroom_plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme
        array(
            'name' => esc_html__('Plazart installation', 'autoshowroom'), /* The plugin name */
            'slug' => 'plazart-installation', /* The plugin slug (typically the folder name) */
            'source' => get_template_directory_uri() . '/plugins/plazart-installation.zip', /* The plugin source */
            'required' => true, /* If false, the plugin is only 'recommended' instead of required */
            'version' => '2.3', /* E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented */
            'force_activation' => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch */
            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins */
            'external_url' => '', /* If set, overrides default API URL and points to an external URL */
        ),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */

    $tz_autoshowroom_config = array(
        'id' => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php',            // Parent menu slug.
        'capability' => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true,                    // Show admin notices or not.
        'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message' => '',                      // Message to output right before the plugins table.
    );

    tgmpa($tz_autoshowroom_plugins, $tz_autoshowroom_config);

}

add_filter( 'um_ajax_get_members_data', 'tz_um_data_post_count' );
function tz_um_data_post_count($data_array)
{
    $currentID = $data_array['id'];
    /*count post*/
    $count_post = count_user_posts($currentID,'vehicle');
    $data_array['count_post'] = $count_post;
    /*rating*/
    $args = array(
        'author'            => $currentID,
        'post_type'         => 'vehicle',
        'posts_per_page'    => '',
        'orderby'           => '',
        'order'             => 'DESC'
    );
    $current_user_posts = get_posts($args);

    if (isset($current_user_posts) && $current_user_posts != ''):
        $count = 0;
        $sum = 0;
        foreach ($current_user_posts as $current) {

            $average_rating = get_post_meta($current->ID, 'tz-average-rating', true);
            if ($average_rating != '') {
                $count += 1;
                $sum += $average_rating;
            }
        }
        $data_array['count_review'] = $count;
    endif;

    if ($sum != '' && $count != ''):
        $countStar = ($sum / 10) / $count;
        $roundStar = '';
        switch ($countStar) {
            case ($countStar <= 0.24):
                $roundStar = "0";
                break;

            case ($countStar <= 0.74):
                $roundStar = "0.5";
                break;

            case ($countStar <= 1.24):
                $roundStar = "1";
                break;

            case ($countStar <= 1.74):
                $roundStar = "1.5";
                break;

            case ($countStar <= 2.24):
                $roundStar = "2";
                break;

            case ($countStar <= 2.74):
                $roundStar = "2.5";
                break;

            case ($countStar <= 3.24):
                $roundStar = "3";
                break;

            case ($countStar <= 3.74):
                $roundStar = "3.5";
                break;

            case ($countStar <= 4.24):
                $roundStar = "4";
                break;

            case ($countStar <= 4.74):
                $roundStar = "4.5";
                break;

            case ($countStar <= 5):
                $roundStar = "5";
                break;
        }
        $data_array['rating'] = $roundStar;
    endif;
    return $data_array;
}
add_filter( 'um_profile_query_make_posts', 'autoshowroom_query_make_posts', 10, 1 );
function autoshowroom_query_make_posts( $query_posts ) {
    $page = ! empty( $_POST['page'] ) ? $_POST['page'] : 0;
    if($page >=2){
        $pagenumber = ( $page - 1 ) * 10;
    }else{
        $pagenumber=0;
    }
    $query_posts = array(
        'post_type'         => 'vehicle',
        'posts_per_page'    => 10,
        'offset'            => $pagenumber,
        'author'            => um_get_requested_user(),
        'post_status'       => array( 'publish' )

    );
    return $query_posts;
}

function autoshowroom_general_admin_notice(){
    global $pagenow;
    if ( $pagenow == 'index.php' || $pagenow == 'themes.php' ) {
        echo '<div class="notice notice-warning is-dismissible">
            <p>AutoShowroom <strong>Big Update</strong> in 2021</p>
            <p>We are going to update <strong> AutoShowroom </strong>version 3 in 2021. You can check all changes here. <a class="button button-primary" target="_blank" href="https://www.templaza.com/blog/autoshowroom-3rd-generation-the-biggest-transformation.html">Read More</a></p>
         </div>';
    }
}
//add_action('admin_notices', 'autoshowroom_general_admin_notice');
add_filter( 'use_widgets_block_editor', '__return_false' );
?>