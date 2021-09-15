<?php
  /*
  *	---------------------------------------------------------------------
  *	This file create and contains the agency post_type meta elements
  *	---------------------------------------------------------------------
  */
  add_action('init', 'tzplazart_create_agency');
  function tzplazart_create_agency()
  {
    $labels = array(
      'name'               => _x('Agency', 'Agency General Name', 'tz-autoshowroom'),
      'singular_name'      => _x('Agency Item', 'Agency Singular Name', 'tz-autoshowroom'),
      'add_new'            => _x('Add New', 'Add New Agency Name', 'tz-autoshowroom'),
      'add_new_item'       => __('Add New Agency', 'tz-autoshowroom'),
      'edit_item'          => __('Edit Agency', 'tz-autoshowroom'),
      'new_item'           => __('New Agency', 'tz-autoshowroom'),
      'view_item'          => __('View Agency', 'tz-autoshowroom'),
      'search_items'       => __('Search Agency', 'tz-autoshowroom'),
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
      'rewrite'            => true,
      'capability_type'    => 'post',
      'hierarchical'       => false,
      'menu_position'      => 5,
      'supports'           => array('title', 'editor','author','excerpt', 'thumbnail'), //'editor', 'excerpt', 'comments',
      'rewrite'            => array('slug' => 'agency', 'with_front' => false ),
      //'has_archive'        => 'portfolio'
    );
    register_post_type('agency', $args);
    register_taxonomy(
      "agency-category", array( "agency" ), array(
      "hierarchical"   => true,
      "label"          => "Agency Categories",
      "singular_label" => "Agency Categories",
      "rewrite"        => true ));
    register_taxonomy_for_object_type('agency-category', 'agency');

    // Remember to flush_rewrite_rules(); or visit WordPress permalink structure settings page
//    add_rewrite_rule('([^/]+)/agency-category/page/([0-9]+)?$','index.php?agency-category=$matches[1]&paged=$matches[2]','top');
//    add_rewrite_rule('([^/]+)/agency-category?','index.php?agency-category=$matches[1]','top');
  }

  // filter for portfolio first page
  add_filter("manage_edit-agency_columns", "tzplazart_show_agency_column");
  function tzplazart_show_agency_column($columns)
  {
    $columns = array(
      "cb"                 => "<input type=\"checkbox\" />",
      "title"              => "Title",
      "author"             => "Author",
      "agency-category"    => "Agency Categories",
      "date"               => "date" );

    return $columns;
  }

  add_action("manage_posts_custom_column", "tzplazart_agency_custom_columns");
  function tzplazart_agency_custom_columns($column)
  {
    global $post;
    switch ($column) {
      case "agency-category":
        echo get_the_term_list($post->ID, 'agency-category', '', ', ', '');
        break;
        case "agency-tags":
            echo get_the_term_list($post->ID, 'agency-tags', '', ', ', '');
            break;
    }
  }

  function get_agency_categories(){
    $taxonomy     = 'agency-category';
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

//http://wordpress.templaza.net/test/autoshowroom/?agency-category=agencies
