<?php
  /*
  *	---------------------------------------------------------------------
  *	This file create and contains the portfolio post_type meta elements
  *	---------------------------------------------------------------------
  */
  add_action('init', 'tzplazart_create_portfolio');
  function tzplazart_create_portfolio()
  {
    $labels = array(
      'name'               => _x('Portfolio', 'Portfolio General Name', 'tz-autoshowroom'),
      'singular_name'      => _x('Portfolio Item', 'Portfolio Singular Name', 'tz-autoshowroom'),
      'add_new'            => _x('Add New', 'Add New Portfolio Name', 'tz-autoshowroom'),
      'add_new_item'       => __('Add New Portfolio', 'tz-autoshowroom'),
      'edit_item'          => __('Edit Portfolio', 'tz-autoshowroom'),
      'new_item'           => __('New Portfolio', 'tz-autoshowroom'),
      'view_item'          => __('View Portfolio', 'tz-autoshowroom'),
      'search_items'       => __('Search Portfolio', 'tz-autoshowroom'),
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
      'supports'           => array('title', 'editor','author','excerpt', 'thumbnail','comments'), //'editor', 'excerpt', 'comments',
      'rewrite'            => array('slug' => 'portfolio', 'with_front' => false ),
      //'has_archive'        => 'portfolio'
    );
    register_post_type('portfolio', $args);
    register_taxonomy(
      "portfolio-category", array( "portfolio" ), array(
      "hierarchical"   => true,
      "label"          => "Portfolio Categories",
      "singular_label" => "Portfolio Categories",
      "rewrite"        => true ));
    register_taxonomy_for_object_type('portfolio-category', 'portfolio');

      // function tags
      register_taxonomy(
          "portfolio-tags",array("portfolio"), array(
              "hierarchical"   =>   '',
              "label"          =>   "Portfolio Tags",
              "singular_label" =>   "Portfolio Tags",
              "rewrite"        =>   ''
          )
      );
      register_taxonomy_for_object_type('protfolio-tags','portfolio');
  }

  // filter for portfolio first page
  add_filter("manage_edit-portfolio_columns", "tzplazart_show_portfolio_column");
  function tzplazart_show_portfolio_column($columns)
  {
    $columns = array(
      "cb"                 => "<input type=\"checkbox\" />",
      "title"              => "Title",
      "author"             => "Author",
      "portfolio-category" => "Portfolio Categories",
      "portfolio-tags"     => "Portfolio Tags",
      "date"               => "date" );

    return $columns;
  }

  add_action("manage_posts_custom_column", "tzplazart_portfolio_custom_columns");
  function tzplazart_portfolio_custom_columns($column)
  {
    global $post;
    switch ($column) {
      case "portfolio-category":
        echo get_the_term_list($post->ID, 'portfolio-category', '', ', ', '');
        break;
        case "portfolio-tags":
            echo get_the_term_list($post->ID, 'portfolio-tags', '', ', ', '');
            break;
    }
  }

  function get_portfolio_categories(){
    $taxonomy     = 'portfolio-category';
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

