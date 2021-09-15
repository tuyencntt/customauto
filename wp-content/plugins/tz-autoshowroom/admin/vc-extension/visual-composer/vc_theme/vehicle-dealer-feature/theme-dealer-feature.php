<?php

function autoshowroom_feature_dealer( $atts )
{
    $autoshowroom_type_dealer = $autoshowroom_features_vehicles
        = $autoshowroom_vehicle_title
        = $autoshowroom_vehicle_description
        = $autoshowroom_vehicle_description_limit
        = $autoshowroom_vehicle_specifications = $autoshowroom_specifications_values = $autoshowroom_limit = $autoshowroom_vehicle_oderby = $autoshowroom_vehicle_oder = $tz_size
        = $el_class = '';
    extract(shortcode_atts(array(
        'autoshowroom_type_dealer'                 =>  'title',
        'autoshowroom_features_vehicles'            =>  '',
        'autoshowroom_vehicle_title'                =>  'show',
        'autoshowroom_vehicle_description'          =>  'show',
        'autoshowroom_vehicle_description_limit'    =>  '',
        'autoshowroom_vehicle_specifications'       =>  'show',
        'autoshowroom_specifications_values'        =>  '',
        'autoshowroom_limit'                        =>  '6',
        'autoshowroom_vehicle_oderby'               =>  'title',
        'autoshowroom_vehicle_oder'                 =>  'asc',
        'tz_size'                                   =>  'large',
        'el_class'                                  =>  ''
    ), $atts));
    ob_start();
    $showmsrp       = ot_get_option('autoshowroom_Detail_show_msrp','yes');
    $ids = array_filter( str_replace(" ",'',explode(',', $autoshowroom_features_vehicles) ));
    $roleids = get_users( array('role' => 'subscriber' ,'fields' => 'ID') );
    if($autoshowroom_type_dealer == 'title') {
        $query_args = array(
            'post_type' => 'vehicle',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page' => -1,
            'post__in' => $ids,
            'orderby' => 'post__in'
        );
    }elseif($autoshowroom_type_dealer == 'new'){
        $query_args = array(
            'post_type'=>'vehicle',
            'post_status'=>'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $autoshowroom_limit,
            'orderby' => $autoshowroom_vehicle_oderby,
            'order' => $autoshowroom_vehicle_oder,
//            'author' => implode(',', $roleids),
            'meta_query' => array(
                array(
                    'key' => 'condition',
                    'value' => 'new',
                ),
            ),
        );
    }else{
        $query_args = array(
            'post_type'=>'vehicle',
            'post_status'=>'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $autoshowroom_limit,
            'orderby' => $autoshowroom_vehicle_oderby,
            'order' => $autoshowroom_vehicle_oder,
//            'author' => implode(',', $roleids),
            'meta_query' => array(
                array(
                    'key' => 'condition',
                    'value' => 'used',
                ),
            ),
        );
    }

    $vehicles = new WP_Query( $query_args );
    $autoshowroom_specifications_arr = explode(",",$autoshowroom_specifications_values);
    $autoshowroom_speci_total = count($autoshowroom_specifications_arr);
    if ( $vehicles->have_posts() ) : ?>
        <div class="features TZ-Dealer-Feature <?php if( $el_class != '' ) echo esc_attr($el_class); ?>">

            <?php while ( $vehicles->have_posts() ) : $vehicles->the_post();
                ?>
                <div class="item">
                    <div class="Vehicle-Feature-Image">
                        <a href="<?php echo get_permalink(); ?>">
                            <?php the_post_thumbnail( $tz_size); ?>
                        </a>
                        <?php
                        $pricesold = get_field('autoshowroom_vehicle_sold',get_the_ID());
                        $pricetext = get_field( 'pricetext',get_the_ID());
                        $pricelink = get_field( 'pricelink',get_the_ID());
                        if($pricesold=='sold'){ ?>
                            <p class="pcd-pricing">
                                <span class="pcd-price"><?php echo esc_html__('SOLD','tz-autoshowroom');?></span>
                            </p>
                            <?php
                        }elseif($pricesold == 'upcoming'){ ?>
                            <p class="pcd-pricing">
                                <span class="pcd-price"><?php echo esc_html__('Upcoming','tz-autoshowroom');?></span>
                            </p>
                            <?php
                        } elseif($pricetext !='') { ?>
                            <p class="pcd-pricing">
                                <?php
                                if($pricelink !=''){ ?>
                                <a class="priceurl" href="<?php echo esc_url($pricelink);?>">
                                    <?php }
                                    ?>

                                    <span class="pcd-price"><?php echo esc_attr($pricetext);?></span>
                                    <?php
                                    if($pricelink !=''){ ?>
                                </a>
                            <?php }
                            ?>
                            </p>
                            <?php
                        }else
                        {
                            echo balanceTags(tz_autoshowroom_filter_vehicle_price(get_the_ID(),$showmsrp));
                        }
                        ?>
                    </div>
                    <?php if($autoshowroom_vehicle_title=='show'){ ?>
                        <h4 class="Vehicle-Title">
                            <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                    <?php } ?>
                    <div class="author-img">
                        <a href="<?php echo balanceTags(get_author_posts_url(get_the_author_meta('ID')));?>"><?php echo balanceTags(get_avatar( get_the_author_meta('ID'),45)); ?></a>
                    </div>
                    <?php
                    if($autoshowroom_vehicle_description=='show'){
                        if($autoshowroom_vehicle_description_limit){ ?>
                            <div class="vehicle-feature-des">
                                <p><?php echo substr(strip_tags(get_the_excerpt()), 0, $autoshowroom_vehicle_description_limit);?></p>
                            </div>
                        <?php } else{
                            echo '<p class="vehicle-feature-excerpt">' .  get_the_excerpt() . '</p>';
                        }
                    }?>
                    <div class="vehicle-specs-<?php echo esc_attr__($autoshowroom_speci_total);?>">
                        <?php echo tz_autoshowroom_get_vehicle_specs(get_the_ID(),$autoshowroom_specifications_arr);?>
                    </div>

                </div>
            <?php endwhile; ?>
        </div>

    <?php endif;
    wp_reset_postdata();
    ?>

    <?php
    $autoshowroom_feature_vehicle = ob_get_contents();
    ob_end_clean();
    return $autoshowroom_feature_vehicle;
}
add_shortcode('autoshowroom-feature-dealer', 'autoshowroom_feature_dealer');

?>