<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="item col-md-4 col-lg-4 col-xs-12">
    <div class="item-wrapper">
        <?php
        $postID = $post->ID;
        $autoshowroom_portfolio_description_limit = ot_get_option('autoshowroom_TZVehicle_limit');
        $autoshowroom_portfolio_specifications_arr = ot_get_option('autoshowroom_TZVehicle_specs');
        $autoshowroom_speci_total = count($autoshowroom_portfolio_specifications_arr);
        $user = wp_get_current_user();
        $user_login = $user->ID;
        $dealer_id = um_user('ID');
        if($user_login == $dealer_id){
            ?>
            <a class="dealer_edit_vehicle" title="<?php echo esc_html_e('Edit','tz-autoshowroom');?>" href="<?php echo get_site_url(); ;?>/edit-car?car_id=<?php echo $post->ID;?>"><i class="fa fa-edit "></i> </a>
            <?php
            ?>
            <span class="dealer_delete_vehicle" title="<?php echo esc_html_e('Delete','tz-autoshowroom');?>" data-id="<?php echo $post->ID;?>"><i class="fa fa-times-circle "></i> </span>
            <?php
        }

        ?>

        <div class="Vehicle-Feature-Image">
            <?php if ( has_post_thumbnail( $post->ID ) ) {
                $image_id = get_post_thumbnail_id( $post->ID );
                $image_url = wp_get_attachment_image_src( $image_id, 'full', true ); ?>
                <a href="<?php echo esc_url( get_permalink( $post ) ); ?>">
                    <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
                </a>

            <?php }
            $pricesold = get_field('autoshowroom_vehicle_sold',$post->ID);
            $pricetext = get_field( 'pricetext',$post->ID);
            $pricelink = get_field( 'pricelink',$post->ID);
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
                echo balanceTags(tz_autoshowroom_filter_vehicle_price($post->ID,'yes'));
            }
            ?>
        </div>

        <h4 class="Vehicle-Title">
            <a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo esc_html( $post->post_title ); ?></a>
        </h4>
        <?php
        if($autoshowroom_portfolio_description_limit){
            $desc = substr(strip_tags($post->post_excerpt), 0, $autoshowroom_portfolio_description_limit);
            ?>
            <div class="vehicle-feature-des">
                <p><?php echo esc_attr($desc);?></p>
            </div>
        <?php } else{
            echo $post->post_excerpt;
        }
        ?>
        <?php echo balanceTags(tz_autoshowroom_get_vehicle_specs($postID,$autoshowroom_portfolio_specifications_arr));?>
    </div>
</div>