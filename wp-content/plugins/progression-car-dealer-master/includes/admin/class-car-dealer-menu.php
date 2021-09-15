<?php
/*
Plugin URI: http://codeseekah.com/2012/03/01/custom-post-type-archives-in-wordpress-menus-2/
Description: Easily Add Custom Post Type Archives to the Nav Menus
Version: 1.1
Author: soulseekah
Author URI: http://codeseekah.com
License: GPL2

    Copyright 2012  soulseekah  (twitter: @soulseekah)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

    This code comes with no guarantees
*/

if (!class_exists("Custom_Post_Type_Archive_Menu_Links")) :

class Custom_Post_Type_Archive_Menu_Links {

  /* boot'er up */
  public static function init(){

    // Set-up Action and Filter Hooks
    add_action( 'admin_head-nav-menus.php', array(__CLASS__, 'inject_cpt_archives_menu_meta_box' ));
    add_filter( 'wp_get_nav_menu_items', array(__CLASS__, 'cpt_archive_menu_filter'), 10, 3 );
  }

  /* inject cpt archives meta box */

  public static function inject_cpt_archives_menu_meta_box() {
    add_meta_box( 'add-cpt', __( 'Car Dealer Archive', 'progression-car-dealer' ), array(__CLASS__, 'wp_nav_menu_cpt_archives_meta_box'), 'nav-menus', 'side', 'default' );
  }

  /* render custom post type archives meta box */
  public static function wp_nav_menu_cpt_archives_meta_box() {
    global $nav_menu_selected_id;
    /* get custom post types with archive support */
    $post_type = get_post_type_object( 'vehicle' );

    /* hydrate the necessary object properties for the walker */
    $post_type->classes = array();
    $post_type->type = 'custom';
    $post_type->object_id = $post_type->name;
    $post_type->title = $post_type->labels->name . ' ' . __( 'Archive', 'default' );
    $post_type->object = 'cpt-archive';
    $post_type->menu_item_parent = 0;
    $post_type->url = get_post_type_archive_link( $post_type->name );
    $post_type->target = 0;
    $post_type->attr_title = 0;
    $post_type->xfn = 0;
    $post_type->db_id = 0;


    $walker = new Walker_Nav_Menu_Checklist( array() );

    ?>
    <div id="cpt-archive" class="posttypediv">
      <div id="tabs-panel-cpt-archive" class="tabs-panel tabs-panel-active">
        <ul id="ctp-archive-checklist" class="categorychecklist form-no-clear">
          <?php
            echo walk_nav_menu_tree( array_map('wp_setup_nav_menu_item', array($post_type)), 0, (object) array( 'walker' => $walker) );
          ?>
        </ul>
      </div><!-- /.tabs-panel -->
    </div>
    <p class="button-controls">
      <span class="add-to-menu">
        <input type="submit"<?php disabled( $nav_menu_selected_id, 0 ); ?> class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e('Add to Menu'); ?>" name="add-ctp-archive-menu-item" id="submit-cpt-archive" />
        <span class="spinner"></span>
      </span>
    </p>
    <?php
  }


  /* take care of the urls */
  public static function cpt_archive_menu_filter( $items, $menu, $args ) {
    /* alter the URL for cpt-archive objects */
    foreach ( $items as &$item ) {

      if ( $item->object != 'cpt-archive' ) continue;
      $item->url = get_post_type_archive_link( $item->type );

      /* set current */
      if ( get_query_var( 'post_type' ) == $item->type ) {
        $item->classes []= 'current-menu-item';
        $item->current = true;
      }
    }

    return $items;
  }


} // end class
endif;

/**
* Launch the whole plugin
*/
if (class_exists("Custom_Post_Type_Archive_Menu_Links")) Custom_Post_Type_Archive_Menu_Links::init();
