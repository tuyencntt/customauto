<?php
/**
 * Created by PhpStorm.
 * User: HN
 * Date: 03/18/19
 * Time: 09:09 AM
 */
function autoshowroom_our_team( $atts, $content = null ) {
    $member_image = $employment = $name = $open_link = $phone = $email = $facebook_url = $twitter_url = $flickr_url = $googleplus_url = $skype_url = '';

    extract(shortcode_atts(array(

        'member_image'      =>  '',
        'speakers_image_square' =>  '',
        'employment'        =>  '',
        'name'              =>  '',
        'phone'             =>  '',
        'email'             =>  '',
        'open_link'         =>  '',
        'facebook_url'      =>  '',
        'twitter_url'       =>  '',
        'flickr_url'        =>  '',
        'googleplus_url'    =>  '',
        'skype_url'         =>  '',
    ), $atts));


    $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

    ob_start();
    ?>

    <div class="speaker_box tz_md_modal_show">
        <div class="autoshowroom_our_team_full" >
            <div class="autoshowroom_member_image">
                <?php echo wp_get_attachment_image( $member_image , 'full') ?>
                <div class="autoshowroom_member_content">
                    <h6 class="autoshowroom_phone">
                        <?php if($phone != '') { ?>
                            <span><?php echo esc_html__('Phone:','tz-autoshowroom') ?></span> <?php echo esc_html( $phone ); ?>
                        <?php }else{
                            echo esc_html__('','tz-autoshowroom');
                        }?>
                    </h6>
                    <h6 class="autoshowroom_email">
                        <?php if($email != '') { ?>
                        <span><?php echo esc_html__('Email:','tz-autoshowroom') ?></span> <?php echo esc_html( $email ); ?>
                    <?php }else{
                            echo esc_html__('','tz-autoshowroom');
                        } ?>
                    </h6>
                    <?php
                    if($content != ''){
                        ?>
                        <div class="autoshowroom-description-our-team">
                            <?php echo balanceTags($content);?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php if (  $facebook_url !='' || $twitter_url != '' || $flickr_url != '' || $googleplus_url != '' || $skype_url != '' ) : ?>

                        <div class="autoshowroom_social">

                            <?php if ( $facebook_url != '' ) : ?>
                                <a <?php echo ( $open_link == 'link_target' ? 'target="_blank"' : '' ) ?> href="<?php echo esc_url( $facebook_url ); ?>">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            <?php endif; ?>

                            <?php if ( $twitter_url != '' ) : ?>
                                <a <?php echo ( $open_link == 'link_target' ? 'target="_blank"' : '' ) ?> href="<?php echo esc_url( $twitter_url ); ?>">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            <?php endif; ?>

                            <?php if ( $flickr_url != '' ) : ?>
                                <a <?php echo ( $open_link == 'link_target' ? 'target="_blank"' : '' ) ?> href="<?php echo esc_url( $flickr_url ); ?>">
                                    <i class="fa fa-camera-retro"></i>
                                </a>
                            <?php endif; ?>

                            <?php if ( $googleplus_url != '' ) : ?>
                                <a <?php echo ( $open_link == 'link_target' ? 'target="_blank"' : '' ) ?> href="<?php echo esc_url( $googleplus_url ); ?>">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            <?php endif; ?>

                            <?php if ( $skype_url != '' ) : ?>
                                <a <?php echo ( $open_link == 'link_target' ? 'target="_blank"' : '' ) ?> href="<?php echo esc_url( $skype_url ); ?>">
                                    <i class="fab fa-skype"></i>
                                </a>
                            <?php endif; ?>

                        </div>

                    <?php endif; ?>
                </div>
            </div>
            <div class="autoshowroom_member">
                <div class="ds-table">
                        <h4 class="autoshowroomp_name">
                            <?php echo balanceTags( $name ); ?>
                        </h4>
                        <h5 class="autoshowroom_employment">
                            <?php echo balanceTags( $employment ); ?>
                        </h5>


                </div>
            </div>

        </div>
    </div>


    <?php

    $tz_autoshowroom  =   ob_get_contents();
    ob_end_clean();
    return $tz_autoshowroom;
}
add_shortcode('tz_our_team','autoshowroom_our_team');
?>
