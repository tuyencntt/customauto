<?php

$show_condition = 'show';
$carID = get_query_var('car_id');
$user = wp_get_current_user();
$user_login = $user->ID;
$auth = get_post($carID); // gets author from post
$authid = $auth->post_author;
if ($user_login != $authid) {
    return;
}
$post_to_edit = get_post($carID);
?>
<div class="container">
    <h2><?php echo esc_html__('Edit car', 'progression-car-dealer'); ?></h2>
    <form method="post" action="" name="insert_vehicle" id="insert_vehicle" enctype="multipart/form-data">
        <?php wp_nonce_field('inser_post_from_front', 'verify_insert_post'); ?>
        <div class="form-group">
            <label for="title"><?php echo esc_html__('Title:', 'progression-car-dealer') ?></label>
            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title"
                   value="<?php echo $post_to_edit->post_title; ?>">
        </div>
        <div class="excerpt">
            <textarea name="car_excerpt" rows="5"
                      placeholder="Excerpt"><?php echo $post_to_edit->post_excerpt; ?></textarea>
        </div>
        <div class="form-group special-group">
            <label for="title"><?php echo esc_html__('Description:', 'progression-car-dealer') ?></label>
            <?php
            $content = $post_to_edit->content;
            $editor_id = 'mycustomeditor';
            $settings = array('media_buttons' => false);
            wp_editor($content, $editor_id, $settings);
            ?>
        </div>
        <div class="row group-input vehicle-new-form">
            <div class="vehicle-info col-md-3">
                <label><?php echo esc_html__('Vehicle Type', 'progression-car-dealer') ?></label>
                <?php
                $vehicle_type = get_the_terms($carID, 'vehicle_type');
                $type = $vehicle_type[0]->term_id;
                $taxonomies = 'vehicle_type';
                $vehicle_makes = get_terms($taxonomies, array('hide_empty' => false));
                if ($vehicle_makes) {
                    ?>
                    <select name="vehicle_type" class="submit-vehicle-type car_dealer_field_vehicle_type" required>
                        <option value=""><?php echo esc_html__('None', 'progression-car-dealer') ?></option>
                        <?php
                        foreach ($vehicle_makes as $cat) {
                            if ($type == $cat->term_id) {
                                ?>
                                <option selected data-type="<?php echo esc_attr($cat->slug); ?>"
                                        value="<?php echo esc_attr($cat->slug); ?>"><?php echo esc_attr($cat->name); ?></option>
                                <?php
                            } else {
                                ?>
                                <option data-type="<?php echo esc_attr($cat->slug); ?>"
                                        value="<?php echo esc_attr($cat->slug); ?>"><?php echo esc_attr($cat->name); ?></option>
                            <?php }
                        }
                        ?>
                    </select>
                    <?php
                }
                ?>
            </div>
            <div class="vehicle-info col-md-3">
                <label><?php echo esc_html__('Make', 'progression-car-dealer') ?></label>
                <?php
                $vehicle_mk = get_the_terms($carID, 'make');
                $mk = $vehicle_mk[0]->term_id;
                $taxonomies = 'make';
                $vehicle_makes = get_terms($taxonomies, array('hide_empty' => false));
                if ($vehicle_makes) {
                    ?>
                    <select name="make" class="submit-vehicle-make car_dealer_field_make" required>
                        <option value=""><?php echo esc_html__('None', 'progression-car-dealer') ?></option>
                        <?php
                        foreach ($vehicle_makes as $make) {
                            $id = $make->term_id;
                            $type_vehicle = get_field('vehicle_type', 'make_' . $id);
                            $car_type = '';
                            if ($type_vehicle) {
                                if (is_object($type_vehicle)) {
                                    $car_type = $type_vehicle->slug;
                                } else {
                                    if(is_array($type_vehicle)){
                                        $d=1;
                                        foreach ($type_vehicle as $mitem){
                                            $term = get_term( $mitem, 'vehicle_type' );
                                            if($d==1){
                                                $car_type =$term->slug;
                                            }else{
                                                $car_type .= ','.$term->slug;
                                            }
                                            $d++;
                                        }
                                    }else{
                                        $type_vehicle = explode(',',$type_vehicle);
                                        $d=1;
                                        foreach ($type_vehicle as $mitem){
                                            $term = get_term( $mitem, 'vehicle_type' );
                                            if($d==1){
                                                $car_type =$term->slug;
                                            }else{
                                                $car_type .= ','.$term->slug;
                                            }
                                            $d++;
                                        }
                                    }
                                }
                            }
                            if ($mk == $make->term_id) {
                                ?>
                                <option selected data-type="<?php echo esc_attr($car_type); ?>"
                                        data-make="<?php echo esc_attr($make->slug); ?>"
                                        value="<?php echo esc_attr($make->slug); ?>"><?php echo esc_attr($make->name); ?></option>
                                <?php
                            } else {
                                ?>
                                <option data-type="<?php echo esc_attr($car_type); ?>"
                                        data-make="<?php echo esc_attr($make->slug); ?>"
                                        value="<?php echo esc_attr($make->slug); ?>"><?php echo esc_attr($make->name); ?></option>
                            <?php }
                        }
                        ?>
                    </select>
                    <?php
                }
                ?>
            </div>
            <div class="vehicle-info col-md-3">
                <label><?php echo esc_html__('Model', 'progression-car-dealer') ?></label>
                <?php
                $vehicle_mod = get_the_terms($carID, 'model');

                $mod = $vehicle_mod[0]->term_id;
                $taxonomies = 'model';
                $vehicle_makes = get_terms($taxonomies, array('hide_empty' => false));
                if ($vehicle_makes) {
                    ?>
                    <select name="model" class="submit-vehicle-model car_dealer_field_model" required>
                        <option value=""><?php echo esc_html__('None', 'progression-car-dealer') ?></option>
                        <?php
                        foreach ($vehicle_makes as $cat) {
                            $id = $cat->term_id;
                            $make_vehicle = get_field('make', 'model_' . $id);
                            $car_type = '';
                            if ($make_vehicle) {
                                if (is_object($make_vehicle)) {
                                    $car_type = $make_vehicle->slug;
                                } else {
                                    if(is_array($make_vehicle)){
                                        $d=1;
                                        foreach ($make_vehicle as $mitem){
                                            $term = get_term( $mitem, 'make' );
                                            if($d==1){
                                                $car_type =$term->slug;
                                            }else{
                                                $car_type .= ','.$term->slug;
                                            }
                                            $d++;
                                        }
                                    }else{
                                        $make_vehicle = explode(',',$make_vehicle);
                                        $d=1;
                                        foreach ($make_vehicle as $mitem){
                                            $term = get_term( $mitem, 'make' );
                                            if($d==1){
                                                $car_type =$term->slug;
                                            }else{
                                                $car_type .= ','.$term->slug;
                                            }
                                            $d++;
                                        }
                                    }
                                }
                            }
                            if ($mod == $cat->term_id) {
                                ?>
                                <option selected data-make="<?php echo esc_attr($car_type); ?>"
                                        value="<?php echo esc_attr($cat->slug); ?>"><?php echo esc_attr($cat->name); ?></option>
                                <?php
                            } else {
                                ?>
                                <option data-make="<?php echo esc_attr($car_type); ?>"
                                        value="<?php echo esc_attr($cat->slug); ?>"><?php echo esc_attr($cat->name); ?></option>
                            <?php }
                        }
                        ?>
                    </select>
                    <?php
                }
                ?>
            </div>
            <div class="vehicle-info vehicle-price col-md-3">
                <?php
                $price = get_field('price', $carID);
                ?>

                <label><?php echo esc_html__('Price', 'progression-car-dealer'); ?></label>
                <input type="number" value="<?php echo $price; ?>" placeholder="insert your price example:50000"
                       name="vehicle_price"/>

            </div>
        </div>

        <div class="vehicle-spec">
            <?php
            global $car_dealer;
            if (is_plugin_active('progression-car-dealer-master/progression-car-dealer.php')) {
                $fields = $car_dealer->fields->get_registered_fields('specs');
                arsort($fields);
                foreach ($fields as $k => $field) {
                    $label = $field['label'];
                    $name = $field['name'];
                    $fieldtype = $field['type'];

                    if ('text' === $fieldtype) {
                        $field_html = '';
                        $auto_text_val = get_field($name, $carID);
                        $query_var = get_query_var($field['name']);
                        $field_html .= '<div class="form-group "><p class="field field-' . $field['name'] . ' fieldtype-' . $fieldtype . '"><label title="' . $field['instructions'] . '"><b>' . $field['label'] . ': </b><br></label>';
                        if ($auto_text_val) {
                            $field_html .= '<input name="auto_' .$field['name'] . '" value="' . $auto_text_val . '" type="text"/> ';
                        } else {
                            $field_html .= '<input name="auto_' . $field['name'] . '" type="text"/> ';
                        }
                        $field_html .= '</p></div>';
                        echo $field_html;
                    }
                }
            }
            ?>
            <div class="vehicle-info vehicle-price">
                <?php
                $pricetxt = get_field('pricetext', $carID);
                ?>
                <label><?php echo esc_html__('Price text', 'progression-car-dealer'); ?></label>
                <input type="text" value="<?php echo $pricetxt; ?>"
                       placeholder="insert your text price example: Contact" name="vehicle_price_text"/>
            </div>
            <?php
            global $car_dealer;
            if (is_plugin_active('progression-car-dealer-master/progression-car-dealer.php')) {
                $fields = $car_dealer->fields->get_registered_fields('specs');
                arsort($fields);
                foreach ($fields as $k => $field) {
                    $label = $field['label'];
                    $name = $field['name'];
                    $fieldtype = $field['type'];

                    if ('number' === $fieldtype) {

                        $field_html = '';
                        $num_val = get_field($name, $carID);

                        $step = str_replace(',', '.', $field['step']);
                        $query_var = get_query_var($field['name']);

                        $field_html .= '<p class="field field-' . $field['name'] . ' fieldtype-' . $fieldtype . '"><label title="' . $field['instructions'] . '"><b>' . $field['label'] . ': </b><br></label>';

                        if ($field['prepend']) {
                            $field_html .= '<span class="pcd-unit_prepend"> ' . $field['prepend'] . ' </span>';
                        }
                        if ($num_val) {
                            $field_html .= '<input name="auto_' . $field['name'] . '" value="' . $num_val . '" type="number"/> ';
                        } else {
                            $field_html .= '<input name="auto_' . $field['name'] . '" type="number"/> ';
                        }

                        if ($field['append']) {
                            $field_html .= '<span class="pcd-unit_append"> ' . $field['append'] . ' </span>';
                        }
                        $field_html .= '</p>';
                        echo $field_html;

                    }
                    if ('radio' === $fieldtype || 'checkbox' === $fieldtype) {

                        $field_html = '';

                        $ra_val = get_field($name, $carID);

                        $field_html .= '<p class="field field-' . $field['name'] . ' fieldtype-' . $fieldtype . '"><label title="' . $field['instructions'] . '"><b>' . $field['label'] . ': </b></label><br>';
                        $d = 1;
                        foreach ($field['choices'] as $choice_value => $choice_label) {
                            if ($d == 1) {
                                if ($ra_val == $choice_value) {
                                    $selected = 'checked';
                                } else {
                                    $selected = '';
                                }
                                $field_html .= '<label class="choice choice-' . $choice_value . '">
                                <input type="radio" ' . $selected . ' name="auto_' . $field['name'] . '" value="' . $choice_value . '" required><label class="input-style"></label><span class="check"></span> ' . $choice_label . ' </label><br>';
                            } else {
                                if ($ra_val == $choice_value) {
                                    $selected = 'checked';
                                } else {
                                    $selected = '';
                                }
                                $field_html .= '<label class="choice choice-' . $choice_value . '">
                                <input type="radio" ' . $selected . ' name="auto_' . $field['name'] . '" value="' . $choice_value . '"><label class="input-style"></label><span class="check"></span> ' . $choice_label . ' </label><br>';
                            }
                            $d++;
                        }
                        $field_html .= '</p>';
                        echo $field_html;

                    }
                }
            }
            $vehicle_sold = get_post_meta($carID, 'autoshowroom_vehicle_sold', true);
            ?>
            <p class="field field-upcomming fieldtype-radio">
                <label title=""><b><?php echo esc_html__('Vehicle Sold:','progression-car-dealer') ?> </b></label><br>
                <label class="choice choice-upcoming">
                    <?php if($vehicle_sold == 'upcoming'){
                        ?>
                        <input name="autoshowroom_vehicle_sold" checked value="upcoming" required="" type="radio">
                    <?php
                    }else{
                        ?>
                        <input name="autoshowroom_vehicle_sold" value="upcoming" required="" type="radio">
                    <?php
                    }
                    ?>

                    <label class="input-style"></label>
                    <span class="check"></span> <?php echo esc_html__('Upcoming','progression-car-dealer') ?>
                </label><br>
                <label class="choice choice-sold">

                    <?php if($vehicle_sold == 'sold'){
                        ?>
                        <input name="autoshowroom_vehicle_sold" checked value="sold" type="radio">
                        <?php
                    }else{
                        ?>
                        <input name="autoshowroom_vehicle_sold"  value="sold" type="radio">
                        <?php
                    }
                    ?>
                    <label class="input-style"></label>
                    <span class="check"></span> <?php echo esc_html__('Sold','progression-car-dealer') ?>
                </label><br>
                <label class="choice choice-no">
                    <?php if($vehicle_sold == 'no'){
                        ?>
                        <input name="autoshowroom_vehicle_sold" checked value="no" type="radio">
                        <?php
                    }else{
                        ?>
                        <input name="autoshowroom_vehicle_sold"  value="no" type="radio">
                        <?php
                    }
                    ?>

                    <label class="input-style"></label><span class="check"></span> <?php echo esc_html__('None','progression-car-dealer') ?>
                </label><br>
            </p>

            <div class="clearfix"></div>
        </div>

        <div class="row features-bottom">
            <div class="vehicle-feature feature_image_pre col-md-4">
                <?php
                $feature_img = get_the_post_thumbnail_url($carID, 'medium');
                ?>
                <label for="file"><?php echo esc_html__('Featured Image:', 'progression-car-dealer') ?></label>
                <input id="uploadFile"
                       placeholder="<?php echo esc_html__('No file choosen', 'progression-car-dealer') ?>"
                       disabled="disabled"/>
                <div class="fileUpload">
                    <span><?php echo esc_html__('Choose file', 'progression-car-dealer') ?></span>
                    <input id="uploadBtn" type="file" value="<?php echo esc_url($feature_img); ?>"
                           name="feature_image" accept="image/*">
                </div>
                <?php
                if ($feature_img) {
                    $post_thumbnail_id = get_post_thumbnail_id($carID);
                    ?>
                    <div class="img_pre" data-id="<?php echo $carID; ?>">
                        <img src="<?php echo esc_url($feature_img); ?>" alt=""/>
                        <span data-id="<?php echo $carID; ?>" class="img_delete"><i
                                    class="fa fa-times-circle"></i> </span>
                    </div>

                    <?php
                }
                ?>
            </div>
            <div class="form-group col-md-4">
                <?php
                $brochu = get_post_meta($carID, 'autoshowroom_vehicle_brochure', true);
                ?>
                <label for="file"><?php echo esc_html__('Car Brochure', 'progression-car-dealer') ?></label>
                <input id="uploadFile_brochure"
                       placeholder="<?php echo esc_html__('No file choose', 'progression-car-dealer') ?>"
                       disabled="disabled"/>
                <div class="fileUpload">
                    <span><?php echo esc_html__('Choose file', 'progression-car-dealer') ?></span>
                    <input id="uploadBtn_brochure" type="file" class="form-control"  name="brochure">
                </div>
                <?php
                if ($brochu) {
                    ?>
                    <div class="brochure">
                        <a href="<?php echo esc_url(get_post_meta($carID, 'autoshowroom_vehicle_brochure', true)); ?>">
                            <?php echo esc_html__('Brochure'); ?>
                        </a>
                        <!--                    <span data-id="--><?php //echo $carID;
                        ?><!--" class="img_delete"><i class="fa fa-times-circle"></i> </span>-->
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="form-group col-md-4">
                <?php
                $autoshowroom_gallery = get_post_meta($carID, 'images');
                ?>
                <label for="file"><?php echo esc_html__('Gallery', 'progression-car-dealer') ?></label>
                <input id="uploadFile_gallery"
                       placeholder="<?php echo esc_html__('No file choose', 'progression-car-dealer') ?>"
                       disabled="disabled"/>
                <div class="fileUpload">
                    <span><?php echo esc_html__('Choose file', 'progression-car-dealer') ?></span>
                    <input id="uploadBtn_gallery" type="file"  name="gallery[]" accept="image/*" multiple>
                </div>
                <?php
                if ($autoshowroom_gallery[0]) {
                    foreach ($autoshowroom_gallery[0] as $image) { ?>
                        <div class="gallery_pre_item" data-id="<?php echo $image; ?>">
                            <img src="<?php echo esc_url(wp_get_attachment_url($image)); ?>"
                                 alt="<?php echo esc_attr(get_the_title($carID)); ?>"/>
                            <!--                            <span class="delete_img_gallery"><i class="fa fa-times-circle"></i> </span>-->
                        </div>
                    <?php }
                }
                ?>
            </div>

        </div>

        <button type="submit" class="btn btn-default"
                id="submitpost"><?php echo esc_html__('Submit', 'progression-car-dealer') ?></button>
    </form>
</div>
<script>
    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
    };
    document.getElementById("uploadBtn_brochure").onchange = function () {
        document.getElementById("uploadFile_brochure").value = this.value;
    };
    document.getElementById("uploadBtn_gallery").onchange = function () {
        document.getElementById("uploadFile_gallery").value = this.value;
    };
</script>