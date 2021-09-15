<?php
$show_condition='show';
?>
<div class="container-addcar">
    <h1><?php echo get_the_title();?></h1>
    <form method="post" action="" name="insert_vehicle" id="insert_vehicle" enctype="multipart/form-data">
        <?php wp_nonce_field('inser_post_from_front', 'verify_insert_post'); ?>
        <div class="form-group">
            <label for="title"><?php echo esc_html__('Title:','progression-car-dealer') ?></label>
            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
        </div>
        <div class="excerpt">
            <textarea name="car_excerpt" rows="5" placeholder="Excerpt"></textarea>
        </div>
        <div class="form-group special-group">
            <label for="title"><?php echo esc_html__('Description:','progression-car-dealer') ?></label>
            <?php
            $content = '';
            $editor_id = 'mycustomeditor';
            $settings = array( 'media_buttons' => false );
            wp_editor($content, $editor_id,$settings);
            ?>
        </div>
        <div class="row group-input vehicle-new-form">
            <div class="vehicle-info col-md-3">
                <label><?php echo esc_html__('Vehicle Type','progression-car-dealer') ?></label>
                <?php
                $taxonomies = 'vehicle_type';
                $vehicle_makes = get_terms( $taxonomies,array('hide_empty' => false) );
                if($vehicle_makes ){
                    ?>
                    <select name="vehicle_type" class="submit-vehicle-type car_dealer_field_vehicle_type" required>
                        <option value=""><?php echo esc_html__('None','progression-car-dealer') ?></option>
                        <?php
                        foreach ($vehicle_makes as $cat){
                            ?>
                            <option data-type="<?php echo esc_attr($cat->slug);?>" value="<?php echo esc_attr($cat->slug);?>"><?php echo esc_attr($cat->name); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                }
                ?>
            </div>

            <div class="vehicle-info col-md-3">
                <label><?php echo esc_html__('Make','progression-car-dealer') ?></label>
                <?php
                $taxonomies = 'make';
                $vehicle_makes = get_terms( $taxonomies,array('hide_empty' => false)  );
                if($vehicle_makes ){
                    ?>
                    <select name="make" class="submit-vehicle-make car_dealer_field_make" required>
                        <option value=""><?php echo esc_html__('None','progression-car-dealer') ?></option>
                        <?php
                        foreach ($vehicle_makes as $make){
                            $id = $make->term_id;
                            $type_vehicle = get_field( 'vehicle_type', 'make_'. $id );
                            $car_type='';
                            if($type_vehicle){
                                if(is_object($type_vehicle)){
                                    $car_type = $type_vehicle->slug;
                                }else{
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
                            ?>
                            <option data-type ="<?php echo esc_attr($car_type);?>" data-make="<?php echo esc_attr($make->slug);?>" value="<?php echo esc_attr($make->slug);?>"><?php echo esc_attr($make->name); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                }
                ?>
            </div>
            <div class="vehicle-info col-md-3">
                <label><?php echo esc_html__('Model','progression-car-dealer') ?></label>
                <?php
                $taxonomies = 'model';
                $vehicle_makes = get_terms( $taxonomies,array('hide_empty' => false)  );
                if($vehicle_makes ){
                    ?>
                    <select name="model" class="submit-vehicle-model car_dealer_field_model" required>
                        <option value=""><?php echo esc_html__('None','progression-car-dealer') ?></option>
                        <?php
                        foreach ($vehicle_makes as $cat){
                            $id = $cat->term_id;
                            $make_vehicle = get_field( 'make', 'model_'. $id );
                            $car_type='';
                            if($make_vehicle){
                                if(is_object($make_vehicle)){
                                    $car_type = $make_vehicle->slug;
                                }else{
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
                            ?>
                            <option data-make="<?php echo esc_attr($car_type);?>" value="<?php echo esc_attr($cat->slug);?>"><?php echo esc_attr($cat->name); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                }
                ?>
            </div>
            <div class="vehicle-info vehicle-price col-md-3">

                <label><?php echo esc_html__('Price','progression-car-dealer');?></label>
                <input type="number" placeholder="Example: 50000" name="vehicle_price"/>

            </div>
        </div>

        <div class="vehicle-spec">
            <?php
            global $car_dealer;
            if ( is_plugin_active( 'progression-car-dealer-master/progression-car-dealer.php' ) ) {
                $fields = $car_dealer->fields->get_registered_fields('specs');
                arsort($fields);
                foreach ( $fields as $k => $field ) {
                    $label =  $field['label'];
                    $name  = $field['name'];
                    $fieldtype = $field['type'];

                    if ( 'text' === $fieldtype ) {
                        $field_html = '';
                        $query_var         = get_query_var( $field['name'] );
                        $field_html .= '<div class="form-group"><p class="field field-'. $field['name'] .' fieldtype-'. $fieldtype .'"><label title="'. $field['instructions'] .'"><b>'. $field['label'] .': </b><br></label>';
                        if ( $field['default_value'] ) {
                            $field_html .= '<input name="auto_'. $field['name'] .'" type="text" value="' . $field['default_value'] . '"/>';
                        } else {
                            $field_html .= '<input name="auto_'. $field['name'] .'" type="text" value=""/>';
                        }
                        $field_html .= '</p></div>';
                        echo $field_html;
                    }
                }
            }
            ?>
            <div class="vehicle-info vehicle-price">
                <label><?php echo esc_html__('Price text','progression-car-dealer');?></label>
                <input type="text" placeholder="Example: Contact" name="vehicle_price_text"/>
            </div>
            <?php

            if ( is_plugin_active( 'progression-car-dealer-master/progression-car-dealer.php' ) ) {
                $fields = $car_dealer->fields->get_registered_fields('specs');
                arsort($fields);
                foreach ( $fields as $k => $field ) {
                    $label =  $field['label'];
                    $name  = $field['name'];
                    $fieldtype = $field['type'];

                    if ( 'number' === $fieldtype ) {

                        $field_html = '';

                        $step 			= str_replace(',', '.', $field['step']);
                        $query_var 		= get_query_var( $field['name'] );

                        $field_html .= '<p class="field field-'. $field['name'] .' fieldtype-'. $fieldtype .'"><label title="'. $field['instructions'] .'"><b>'. $field['label'] .': </b><br></label>';

                        if ( $field['prepend'] ) {
                            $field_html .= '<span class="pcd-unit_prepend"> '. $field['prepend'] . ' </span>';
                        }

                        $field_html .= '<input name="auto_'. $field['name'] .'" value="" type="number"/> ';

                        if ( $field['append'] ) {
                            $field_html .= '<span class="pcd-unit_append"> '. $field['append'] . ' </span>';
                        }
                        $field_html .= '</p>';
                        echo $field_html;

                    }
                    if ( 'radio' === $fieldtype || 'checkbox' === $fieldtype ) {

                        $field_html = '';

                        $field_html .= '<p class="field field-'. $field['name'] .' fieldtype-'. $fieldtype .'"><label title="'. $field['instructions'] .'"><b>'. $field['label'] .': </b></label><br>';
                        $d=1;
                        foreach ( $field['choices'] as $choice_value => $choice_label ) {
                            if($d==1) {
                                $field_html .= '<label class="choice choice-' . $choice_value . '">
					            <input type="radio" name="auto_' . $field['name'] . '" value="' . $choice_value . '" required><label class="input-style"></label><span class="check"></span> ' . __($choice_label,'progression-car-dealer') . ' </label><br>';
                            }else{
                                $field_html .= '<label class="choice choice-' . $choice_value . '">
					            <input type="radio" name="auto_' . $field['name'] . '" value="' . $choice_value . '"><label class="input-style"></label><span class="check"></span> ' . __($choice_label,'progression-car-dealer') . ' </label><br>';
                            }
                            $d++;
                        }
                        $field_html .= '</p>';
                        echo $field_html;
                    }
                }
            }
            ?>

            <p class="field field-upcomming fieldtype-radio">
                <label title=""><b><?php echo esc_html__('Vehicle Sold:','progression-car-dealer') ?> </b></label><br>
                <label class="choice choice-upcoming">
                    <input name="autoshowroom_vehicle_sold" value="upcoming" required="" type="radio">
                    <label class="input-style"></label>
                    <span class="check"></span> <?php echo esc_html__('Upcoming','progression-car-dealer') ?>
                </label><br>
                <label class="choice choice-sold">
                    <input name="autoshowroom_vehicle_sold" value="sold" type="radio">
                    <label class="input-style"></label>
                    <span class="check"></span> <?php echo esc_html__('Sold','progression-car-dealer') ?>
                </label><br>
                <label class="choice choice-no">
                    <input name="autoshowroom_vehicle_sold" value="no" type="radio">
                    <label class="input-style"></label><span class="check"></span> <?php echo esc_html__('None','progression-car-dealer') ?>
                </label><br>
            </p>

            <div class="clearfix"></div>
        </div>

        <div class="row features-bottom">
            <div class="vehicle-feature col-md-4">
                <label for="file"><?php echo esc_html__('Featured Image:','progression-car-dealer') ?></label>
                <input id="uploadFile" placeholder="<?php echo esc_html__('No file choosen','progression-car-dealer') ?>" disabled="disabled" />
                <div class="fileUpload">
                    <span><?php echo esc_html__('Choose file','progression-car-dealer') ?></span>
                    <input id="uploadBtn" type="file" class="required"  name="feature_image" accept="image/*">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="file"><?php echo esc_html__('Car Brochure','progression-car-dealer') ?></label>
                <input id="uploadFile_brochure" placeholder="<?php echo esc_html__('No file choose','progression-car-dealer') ?>"  />
                <div class="fileUpload">
                    <span><?php echo esc_html__('Choose file','progression-car-dealer') ?></span>
                    <input id="uploadBtn_brochure" type="file" class="form-control"  name="brochure">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="file"><?php echo esc_html__('Gallery','progression-car-dealer') ?></label>
                <input id="uploadFile_gallery" placeholder="<?php echo esc_html__('No file choose','progression-car-dealer') ?>" />
                <div class="fileUpload">
                    <span><?php echo esc_html__('Choose file','progression-car-dealer') ?></span>
                    <input id="uploadBtn_gallery" type="file" name="gallery[]" accept="image/*" multiple>
                </div>
            </div>

        </div>

        <button type="submit" class="btn btn-default" id="submitpost" ><?php echo esc_html__('Submit','progression-car-dealer') ?></button>
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