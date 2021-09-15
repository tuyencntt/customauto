<?php
/*
*	---------------------------------------------------------------------
*	This file create and contains the ourteam  post_type meta elements
*	---------------------------------------------------------------------
*/
add_action('init', 'tzplazart_create_ourteam');
function tzplazart_create_ourteam()
{
    $labels = array(
        'name'               => _x('Team Members', 'Team Members General Name', 'tz-autoshowroom'),
        'singular_name'      => _x('Ourteam Item', 'Team Members Singular Name', 'tz-autoshowroom'),
        'add_new'            => _x('Add New', 'Add New Team Members', 'tz-autoshowroom'),
        'add_new_item'       => __('Add New Team Members', 'tz-autoshowroom'),
        'edit_item'          => __('Edit Team Members', 'tz-autoshowroom'),
        'new_item'           => __('New Team Members', 'tz-autoshowroom'),
        'view_item'          => __('View Team Members', 'tz-autoshowroom'),
        'search_items'       => __('Search Team Members', 'tz-autoshowroom'),
        'not_found'          => __('Nothing found', 'tz-autoshowroom'),
        'not_found_in_trash' => __('Nothing found in Trash', 'tz-autoshowroom'),
        'parent_item_colon'  => ''
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'query_var'          => true,
        //'menu_icon' => PLUGIN_PATH . '/plazart/assets/images/portfolio-icon.png',
        'rewrite'            => true,
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor','author','excerpt', 'thumbnail'), //'editor', 'excerpt', 'comments',
        'rewrite'            => array('slug' => 'ourteam', 'with_front' => false ),
        //'has_archive'        => 'portfolio'
    );
    register_post_type('ourteam', $args);
    register_taxonomy(
        "ourteam-category", array( "ourteam" ), array(
        "hierarchical"   => true,
        "label"          => "Team Categories",
        "singular_label" => "Team Categories",
        "rewrite"        => true ));
    register_taxonomy_for_object_type('ourteam-category', 'ourteam');


}

// filter for portfolio first page
add_filter("manage_edit-ourteam_columns", "tzplazart_show_ourteam_column");
function tzplazart_show_ourteam_column($columns)
{
    $columns = array(
        "cb"                 => "<input type=\"checkbox\" />",
        "title"              => "Title",
        "author"             => "Author",
        "ourteam-category" => "Team Categories",
        "date"               => "date" );

    return $columns;
}

add_action("manage_posts_custom_column", "tzplazart_ourteam_custom_columns");
function tzplazart_ourteam_custom_columns($column)
{
    global $post;
    switch ($column) {
        case "ourteam-category":
            echo get_the_term_list($post->ID, 'ourteam-category', '', ', ', '');
            break;
    }
}

function tzplazart_ourteam_categories(){
    $taxonomy     = 'ourteam-category';
    $orderby      = 'name';
    $show_count   = 0;      // 1 for yes, 0 for no
    $pad_counts   = 0;      // 1 for yes, 0 for no
    $hierarchical = 1;      // 1 for yes, 0 for no
    $title        = '';
    $empty        = 0;

    $args = array(
        'taxonomy'     => $taxonomy,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'hide_empty'   => $empty
    );

    $categories = get_categories( $args );

    return $categories;
}

