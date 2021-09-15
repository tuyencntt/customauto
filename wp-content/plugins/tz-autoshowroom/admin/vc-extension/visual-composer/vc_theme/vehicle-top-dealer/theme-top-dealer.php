<?php
function autoshowroom_top_dealer($atts) {
    $autoshowroom_layout_top_dealer =  $autoshowroom_limit_top_dealer = $autoshowroom_title_top_dealer =
    $autoshowroom_address_top_dealer = $autoshowroom_phone_top_dealer = $autoshowroom_cars_top_dealer =
    $autoshowroom_textbox_css ='';
    extract(shortcode_atts(array(
        'autoshowroom_layout_top_dealer'        => '2column',
        'autoshowroom_limit_top_dealer'         => '8',
        'autoshowroom_title_top_dealer'         => '',
        'autoshowroom_address_top_dealer'           => '',
        'autoshowroom_phone_top_dealer'         => '',
        'autoshowroom_textbox_css'              => '',
    ),$atts));
    ob_start();
    $autoshowroom_top_dealer_style = vc_shortcode_custom_css_class( $autoshowroom_textbox_css );
    $autoshowroom_class = '';

    global $cover_photos;
    $args=array(
        'role' => 'um_dealer',
        'profiles_per_page'=> -1,
        'meta_key' => 'account_status',
        'meta_value' => 'approved',
    );

    $dealer_users = get_users($args);
    ?>
    <div class="autoshowroom-top-dealer number-<?php echo esc_attr($autoshowroom_layout_top_dealer); ?> <?php echo esc_attr($autoshowroom_top_dealer_style); ?>">
        <div class="auto-members">
            <?php $x = ($autoshowroom_limit_top_dealer * 2) - 1; ?>
            <?php $i = 0; foreach( $dealer_users as $member) {
                $i++;
                um_fetch_user($member->ID); ?>
                <div class="um-member col-md-3 col-lg-6 col-xs-12 um-role-<?php echo um_user('role');  ?> <?php echo um_user('account_status'); ?> <?php if ($cover_photos) {
                    echo 'with-cover';
                } ?>">
                    <div class="um-member__wrapper">
                        <span class="um-member-status <?php echo um_user('account_status'); ?>"><?php echo um_user('account_status_name'); ?></span>
                        <?php
                        $default_size = str_replace('px', '', um_get_option('profile_photosize'));
                        $corner = um_get_option('profile_photocorner');
                        ?>
                        <div class="um-member-photo radius-<?php echo $corner; ?>">
                            <a href="<?php echo um_user_profile_url(); ?>"
                               title="<?php echo esc_attr(um_user('display_name')); ?>"><?php echo get_avatar(um_user('ID'), $default_size); ?></a>
                            <?php $currentID = $member->ID;
                            $args = array(
                                'author' => $currentID,
                                'post_type' => 'vehicle',
                                'posts_per_page' => '',
                                'orderby' => '',
                                'order' => 'DESC'
                            );
                            if($autoshowroom_address_top_dealer == 'show') {
                                $address = get_user_meta(um_user('ID'), 'tz_auto_address', true);
                            }
                            if($autoshowroom_phone_top_dealer == 'show') {
                                $phone = get_user_meta(um_user('ID'), 'tz_auto_phone', true);
                            }
                            $google_mapvalue = get_user_meta(um_user('ID'), 'tz_google_map', true);
                            ?>
                            <div class="um-member-card">
                                <?php if($autoshowroom_title_top_dealer == 'show'){ ?>
                                <div class="um-member-name">
                                    <a href="<?php echo um_user_profile_url(); ?>" title="<?php echo esc_attr(um_user('display_name')); ?>"><?php echo um_user('display_name', 'html'); ?></a>
                                </div>
                                <?php } ?>
                                <?php if (isset($address) && $address != ''): ?>
                                    <div class="um-member-address um-style">
                                        <span><i class="fa fa-map-marker"></i> <?php echo esc_html($address) ?> </span>
                                    </div>
                                <?php endif; ?>

                                <?php if(isset($phone) && $phone != ''):  ?>
                                    <div class="um-member-phone um-style">
                                        <span><i class="fa fa-phone"></i> <?php echo esc_html($phone)  ?> </span>
                                    </div>
                                <?php endif;  ?>

                                <?php if (isset($maps) && $maps != ''): ?>
                                    <div class="um-member-maps um-style">
                                        <!-- Trigger the modal with a button -->
                                        <span data-toggle="modal" data-target="#myModal"><i class="fa fa-map"
                                                                                            aria-hidden="true"></i> See Map  </span>

                                        <!-- Modal -->
                                        <div id="myModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="map"></div>
                                                        <script>
                                                            function initMap() {
                                                                var myLatlng = new google.maps.LatLng(<?php echo esc_attr($google_mapvalue); ?>);
                                                                var mapOptions = {
                                                                    zoom: 16,
                                                                    center: myLatlng
                                                                }
                                                                var map = new google.maps.Map(document.getElementById("map"), mapOptions);

                                                                var marker = new google.maps.Marker({
                                                                    position: myLatlng,
                                                                    title: "Hello World!"
                                                                });

                                                                // To add the marker to the map, call setMap();
                                                                marker.setMap(map);
                                                            }
                                                        </script>
                                                        <script async defer
                                                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTay4Xx4Y3Z7hfDVayualyZ9_hUqYctBs&callback=initMap">
                                                        </script>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                <?php endif; ?>

                                <?php do_action('um_members_just_after_name', um_user('ID'), $args); ?>

                                <?php do_action('um_members_after_user_name', um_user('ID'), $args); ?>

                            </div>
                            <?php
                            $current_user_posts = get_posts($args);
                            if (isset($current_user_posts) && $current_user_posts != ''):
                                $count = 0;
                                $countm = 0;
                                $sum = 0;
                                foreach ($current_user_posts as $current) {
                                    $average_rating = get_post_meta($current->ID, 'tz-average-rating', true);
                                    $month = date('m');
                                    $year = date('Y');
                                    $postmonth = get_the_date('m', $current->ID);
                                    $postyear = get_the_date('Y', $current->ID);

                                    if (isset($postmonth) && isset($postyear)):
                                        if ($year == $postyear) {
                                            if ($postmonth == $month) {
                                                $countm = $countm + 1;
                                            }
                                        }
                                    endif;

                                    if ($average_rating != '') {
                                        $count = $count + 1;
                                        $sum += $average_rating;
                                    }
                                }
                            endif;
                            if ($sum != '' && $count != ''):
                                $countstar = ($sum / 10) / $count;
                                $roundstar = 0;
                                switch ($countstar) {
                                    case ($countstar <= 0.24):
                                        $roundstar = "0";
                                        break;

                                    case ($countstar <= 0.74):
                                        $roundstar = "0.5";
                                        break;

                                    case ($countstar <= 1.24):
                                        $roundstar = "1";
                                        break;

                                    case ($countstar <= 1.74):
                                        $roundstar = "1.5";
                                        break;

                                    case ($countstar <= 2.24):
                                        $roundstar = "2";
                                        break;

                                    case ($countstar <= 2.74):
                                        $roundstar = "2.5";
                                        break;

                                    case ($countstar <= 3.24):
                                        $roundstar = "3";
                                        break;

                                    case ($countstar <= 3.74):
                                        $roundstar = "3.5";
                                        break;

                                    case ($countstar <= 4.24):
                                        $roundstar = "4";
                                        break;

                                    case ($countstar <= 4.74):
                                        $roundstar = "4.5";
                                        break;

                                    case ($countstar <= 5):
                                        $roundstar = "5";
                                        break;
                                }
                            endif;
                            ?>
                            <?php if (isset($roundstar) && $roundstar != '' && $count != 0): ?>
                                <div class="tz_auto_show_rating count-star">
                                    <?php if ($roundstar == '0.5'): ?>
                                        <span class="0starhalf"><i class="fa fa-star-half-o"></i></span>
                                    <?php endif; ?>

                                    <?php if ($roundstar >= '1'): ?>
                                        <span class="1star"><i class="fa fa-star"></i></span>
                                    <?php endif; ?>

                                    <?php if ($roundstar == '1.5'): ?>
                                        <span class="1starhalf"><i class="fa fa-star-half-o"></i></span>
                                    <?php endif; ?>

                                    <?php if ($roundstar >= '2'): ?>
                                        <span class="2star"><i class="fa fa-star"></i></span>
                                    <?php endif; ?>

                                    <?php if ($roundstar == '2.5'): ?>
                                        <span class="2starhalf"><i class="fa fa-star-half-o"></i></span>
                                    <?php endif; ?>

                                    <?php if ($roundstar >= '3'): ?>
                                        <span class="3star"><i class="fa fa-star"></i></span>
                                    <?php endif; ?>

                                    <?php if ($roundstar == '3.5'): ?>
                                        <span class="3starhalf"><i class="fa fa-star-half-o"></i></span>
                                    <?php endif; ?>

                                    <?php if ($roundstar >= '4'): ?>
                                        <span class="4star"><i class="fa fa-star"></i></span>
                                    <?php endif; ?>

                                    <?php if ($roundstar == '4.5'): ?>
                                        <span class="4starhalf"><i class="fa fa-star-half-o"></i></span>
                                    <?php endif; ?>

                                    <?php if ($roundstar == '5'): ?>
                                        <span class="5star"><i class="fa fa-star"></i></span>
                                    <?php endif; ?>
                                    <p>( <?php echo esc_attr($count); ?> <?php echo esc_html__('Reviews', 'autoshowroom'); ?>
                                        )</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php

                        ?>


                    </div>
                </div>

                <?php
                if(++$i > $x) break;
            }
            ?>
        </div>

    </div>



    <?php

    return ob_get_clean();
}
add_shortcode('autoshowroom-top-dealer','autoshowroom_top_dealer');
?>
