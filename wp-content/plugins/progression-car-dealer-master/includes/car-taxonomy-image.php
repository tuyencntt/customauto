<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('admin_init', 'car_dealer_init');
define('CAR_DEALER_NO_IMAGE', CAR_DEALER_PLUGIN_URL."/assets/images/no_image.png");
function car_dealer_init() {
    $car_dealder_taxonomies = array('make','vehicle_type');
    if (is_array($car_dealder_taxonomies)) {
        foreach ($car_dealder_taxonomies as $car_dealder_taxonomy) {

            add_action($car_dealder_taxonomy.'_add_form_fields', 'car_dealer_taxonomy_field');
            add_action($car_dealder_taxonomy.'_edit_form_fields', 'car_dealer_edit_taxonomy_field');
            add_filter( 'manage_edit-' . $car_dealder_taxonomy . '_columns', 'car_dealer_taxonomy_columns' );
            add_filter( 'manage_' . $car_dealder_taxonomy . '_custom_column', 'car_dealer_taxonomy_column', 10, 3 );
        }
    }
    add_action('model_edit_form_fields', 'car_dealer_edit_taxonomy_model_field');

}

// add image field in add form
function car_dealer_taxonomy_field() {
    if (get_bloginfo('version') >= 3.5)
        wp_enqueue_media();
    else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('thickbox');
    }

    echo '<div class="form-field">
		<label for="taxonomy_image">' . __('Image', 'categories-images') . '</label>
		<input type="text" name="taxonomy_image" id="taxonomy_image" value="" />
		<br/>
		<button class="car_dealer_upload_image_button button">' . __('Upload/Add image', 'categories-images') . '</button>
	</div>'.car_dealer_script();
}

// add image field in edit form
function car_dealer_edit_taxonomy_field($taxonomy) {
    if (get_bloginfo('version') >= 3.5)
        wp_enqueue_media();
    else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('thickbox');
    }

    $term_arr='';
    if($taxonomy->taxonomy == 'make'){
        $vehicle_type = get_field( 'vehicle_type', 'make_'. $taxonomy->term_id );
        $terms = get_terms( array(
            'taxonomy' => 'vehicle_type',
            'hide_empty' => false,
        ) );
        if(is_array($vehicle_type)){
            $vehicle_type =$vehicle_type;
        }else{
            $vehicle_type = explode(',',$vehicle_type);
        }
        if($terms){
            $term_arr = '<select name="vehicle_type[]" class="vehicle_type" multiple="multiple">';
            foreach ($terms as $term){
                if(in_array($term->term_id,$vehicle_type) || in_array($term->slug,$vehicle_type)){
                    $term_arr .= '<option selected value='.$term->term_id.'>'.$term->name.'</option>';
                }else{
                    $term_arr .= '<option value='.$term->term_id.'>'.$term->name.'</option>';
                }
            }
            $term_arr.='</select>';
            $term_arr.='<p class="description">'.__( 'Press and hold the CTRL key and click items in the list to select multiple items. ', 'progression-car-dealer' ).'</p>';
        }else{
            $term_arr='';
        }
    }

    if (car_dealer_taxonomy_image_url( $taxonomy->term_id, NULL, TRUE ) == CAR_DEALER_NO_IMAGE)
        $image_url = "";
    else
        $image_url = car_dealer_taxonomy_image_url( $taxonomy->term_id, NULL, TRUE );
    $html_content= '<tr class="form-field">
		<th scope="row" valign="top"><label for="taxonomy_image">' . __('Image', 'categories-images') . '</label></th>
		<td>
		<img class="taxonomy-image" src="' . car_dealer_taxonomy_image_url( $taxonomy->term_id, 'medium', TRUE ) . '"/><br/>
		<input type="text" name="taxonomy_image" id="taxonomy_image" value="'.$image_url.'" /><br />
		<button class="car_dealer_upload_image_button button">' . __('Upload/Add image', 'categories-images') . '</button>
		<button class="car_dealer_remove_image_button button">' . __('Remove image', 'categories-images') . '</button>
		</td>
	</tr>'.car_dealer_script();
    if($taxonomy->taxonomy == 'make') {
        $html_content .= '<tr class="form-field">
		<th scope="row" valign="top"><label for="taxonomy_image">' . __('Vehicle Type', 'categories-images') . '</label></th>
		<td>
		' . $term_arr . '
		</td>
	</tr>';
    }

    echo $html_content;
}
// add image field in edit form
function car_dealer_edit_taxonomy_model_field($taxonomy) {

    if($taxonomy->taxonomy == 'model'){
        $makes = get_field( 'make', 'model_'. $taxonomy->term_id );
        if(is_object($makes)){
            $makeids = $makes->term_id;
        }else{
//            $make_term = get_term_by('id',$makes,'make');
            $makeids = $makes;
        }
        if(is_array($makeids)){
            $vehicle_make = $makeids;
        }else{
            $vehicle_make = explode(',',$makeids);
        }

        $terms_make = get_terms( array(
            'taxonomy' => 'make',
            'hide_empty' => false,
        ) );
        if($terms_make){
            $terms_make_arr = '<select name="make[]" class="make" multiple="multiple">';
//            $terms_make_arr .= '<option>'.$makeids.'</option>';
            foreach ($terms_make as $make){
                if(isset($makes) && in_array($make->term_id,$vehicle_make) || in_array($make->slug,$vehicle_make)){
                    $terms_make_arr .= '<option selected value='.$make->term_id.'>'.$make->name.'</option>';
                }else{
                    $terms_make_arr .= '<option value='.$make->term_id.'>'.$make->name.'</option>';
                }
            }
            $terms_make_arr.='</select>';
            $terms_make_arr.='<p class="description">'.__( 'Press and hold the CTRL key and click items in the list to select multiple items. ', 'progression-car-dealer' ).'</p>';
        }else{
            $terms_make_arr='';
        }
        $html_content = '<tr class="form-field">
		<th scope="row" valign="top"><label for="make">' . __('Make', 'categories-images') . '</label></th>
		<td>
		' . $terms_make_arr . '
		</td>
	    </tr>';
        echo $html_content;
    }
}

// upload using wordpress upload
function car_dealer_script() {
    return '<script type="text/javascript">
	    jQuery(document).ready(function($) {
			var wordpress_ver = "'.get_bloginfo("version").'", upload_button;
			$(".car_dealer_upload_image_button").click(function(event) {
				upload_button = $(this);
				var frame;
				if (wordpress_ver >= "3.5") {
					event.preventDefault();
					if (frame) {
						frame.open();
						return;
					}
					frame = wp.media();
					frame.on( "select", function() {
						// Grab the selected attachment.
						var attachment = frame.state().get("selection").first();
						frame.close();
						if (upload_button.parent().prev().children().hasClass("tax_list")) {
							upload_button.parent().prev().children().val(attachment.attributes.url);
							upload_button.parent().prev().prev().children().attr("src", attachment.attributes.url);
						}
						else
							$("#taxonomy_image").val(attachment.attributes.url);
					});
					frame.open();
				}
				else {
					tb_show("", "media-upload.php?type=image&amp;TB_iframe=true");
					return false;
				}
			});

			$(".car_dealer_remove_image_button").click(function() {
				$(".taxonomy-image").attr("src", "'.CAR_DEALER_NO_IMAGE.'");
				$("#taxonomy_image").val("");
				$(this).parent().siblings(".title").children("img").attr("src","' . CAR_DEALER_NO_IMAGE . '");
				$(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
				return false;
			});

			if (wordpress_ver < "3.5") {
				window.send_to_editor = function(html) {
					imgurl = $("img",html).attr("src");
					if (upload_button.parent().prev().children().hasClass("tax_list")) {
						upload_button.parent().prev().children().val(imgurl);
						upload_button.parent().prev().prev().children().attr("src", imgurl);
					}
					else
						$("#taxonomy_image").val(imgurl);
					tb_remove();
				}
			}

			$(".editinline").click(function() {
			    var tax_id = $(this).parents("tr").attr("id").substr(4);
			    var thumb = $("#tag-"+tax_id+" .thumb img").attr("src");

				if (thumb != "' . CAR_DEALER_NO_IMAGE . '") {
					$(".inline-edit-col :input[name=\'taxonomy_image\']").val(thumb);
				} else {
					$(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
				}

				$(".inline-edit-col .title img").attr("src",thumb);
			});
	    });
	</script>';
}

// save our taxonomy image while edit or save term
add_action('edit_term','car_dealer_save_taxonomy_image');
add_action('create_term','car_dealer_save_taxonomy_image');
function car_dealer_save_taxonomy_image($term_id) {

    if(isset($_POST['taxonomy_image']))
        update_option('car_dealer_taxonomy_image'.$term_id, $_POST['taxonomy_image'], NULL);

    if(isset($_POST['vehicle_type'])){
        $asign_type ='';
        $d=1;
        foreach ($_POST['vehicle_type'] as $selectedOption){
            if($d==1){
                $asign_type .= $selectedOption;
            }else{
                $asign_type .= ','.$selectedOption;
            }
            $d++;
        }
        update_option('make_'.$term_id.'_',$asign_type);
        update_field( 'vehicle_type',$asign_type,'make_'. $term_id );
    }


    if(isset($_POST['make'])){
        $asign_make ='';
        $d=1;
        foreach ($_POST['make'] as $selectedOption){
            if($d==1){
                $asign_make .= $selectedOption;
            }else{
                $asign_make .= ','.$selectedOption;
            }
            $d++;
        }
        update_option('model_'.$term_id.'_',$asign_make);
        update_field( 'make',$asign_make,'model_'. $term_id );
    }

}

// get attachment ID by image url
function car_dealer_get_attachment_id_by_url($image_src) {
    global $wpdb;
    $query = $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid = %s", $image_src);
    $id = $wpdb->get_var($query);
    return (!empty($id)) ? $id : NULL;
}

// get taxonomy image url for the given term_id (Place holder image by default)
function car_dealer_taxonomy_image_url($term_id = NULL, $size = 'full', $return_placeholder = FALSE) {
    if (!$term_id) {
        if (is_category())
            $term_id = get_query_var('cat');
        elseif (is_tax()) {
            $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $term_id = $current_term->term_id;
        }
    }

    $taxonomy_image_url = get_option('car_dealer_taxonomy_image'.$term_id);
    if(!empty($taxonomy_image_url)) {
        $attachment_id = car_dealer_get_attachment_id_by_url($taxonomy_image_url);
        if(!empty($attachment_id)) {
            $taxonomy_image_url = wp_get_attachment_image_src($attachment_id, $size);
            $taxonomy_image_url = $taxonomy_image_url[0];
        }
    }

    if ($return_placeholder)
        return ($taxonomy_image_url != '') ? $taxonomy_image_url : CAR_DEALER_NO_IMAGE;
    else
        return $taxonomy_image_url;
}

function car_dealer_quick_edit_custom_box($column_name, $screen, $name) {
    if ($column_name == 'thumb')
        echo '<fieldset>
		<div class="thumb inline-edit-col">
			<label>
				<span class="title"><img src="" alt="Thumbnail"/></span>
				<span class="input-text-wrap"><input type="text" name="taxonomy_image" value="" class="tax_list" /></span>
				<span class="input-text-wrap">
					<button class="car_dealer_upload_image_button button">' . __('Upload/Add image', 'categories-images') . '</button>
					<button class="car_dealer_remove_image_button button">' . __('Remove image', 'categories-images') . '</button>
				</span>
			</label>
		</div>
	</fieldset>';
}

/**
 * Thumbnail column added to category admin.
 *
 * @access public
 * @param mixed $columns
 * @return void
 */
function car_dealer_taxonomy_columns( $columns ) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['thumb'] = __('Image', 'categories-images');

    unset( $columns['cb'] );

    return array_merge( $new_columns, $columns );
}

/**
 * Thumbnail column value added to category admin.
 *
 * @access public
 * @param mixed $columns
 * @param mixed $column
 * @param mixed $id
 * @return void
 */
function car_dealer_taxonomy_column( $columns, $column, $id ) {
    if ( $column == 'thumb' )
        $columns = '<span><img src="' . car_dealer_taxonomy_image_url($id, 'thumbnail', TRUE) . '" alt="' . __('Thumbnail', 'categories-images') . '" class="wp-post-image" /></span>';

    return $columns;
}

// Change 'insert into post' to 'use this image'
function car_dealer_change_insert_button_text($safe_text, $text) {
    return str_replace("Insert into Post", "Use this image", $text);
}

// Style the image in category list
if ( strpos( $_SERVER['SCRIPT_NAME'], 'edit-tags.php' ) > 0 ) {
    add_action('quick_edit_custom_box', 'car_dealer_quick_edit_custom_box', 10, 3);
    add_filter("attribute_escape", "car_dealer_change_insert_button_text", 10, 2);
}

// display taxonomy image for the given term_id
function car_dealer_taxonomy_image($term_id = NULL, $size = 'full', $attr = NULL, $echo = TRUE) {
    if (!$term_id) {
        if (is_category())
            $term_id = get_query_var('cat');
        elseif (is_tax()) {
            $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $term_id = $current_term->term_id;
        }
    }

    $taxonomy_image_url = get_option('car_dealer_taxonomy_image'.$term_id);
    if(!empty($taxonomy_image_url)) {
        $attachment_id = car_dealer_get_attachment_id_by_url($taxonomy_image_url);
        if(!empty($attachment_id))
            $taxonomy_image = wp_get_attachment_image($attachment_id, $size, FALSE, $attr);
        else {
            $image_attr = '';
            if(is_array($attr)) {
                if(!empty($attr['class']))
                    $image_attr .= ' class="'.$attr['class'].'" ';
                if(!empty($attr['alt']))
                    $image_attr .= ' alt="'.$attr['alt'].'" ';
                if(!empty($attr['width']))
                    $image_attr .= ' width="'.$attr['width'].'" ';
                if(!empty($attr['height']))
                    $image_attr .= ' height="'.$attr['height'].'" ';
                if(!empty($attr['title']))
                    $image_attr .= ' title="'.$attr['title'].'" ';
            }
            $taxonomy_image = '<img src="'.$taxonomy_image_url.'" '.$image_attr.'/>';
        }
    }

    if ($echo)
        echo $taxonomy_image;
    else
        return $taxonomy_image;
}