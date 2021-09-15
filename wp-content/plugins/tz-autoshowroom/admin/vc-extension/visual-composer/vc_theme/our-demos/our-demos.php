<?php
/*
 * Element tz-feature-item
 * */
/**
 * @param $atts
 * @param null $content
 * @return string
 */
function autoshowroom_our_demos($atts, $content = null)
{
    $our_demos_params = '';
    extract(shortcode_atts(array(
        'our_demos_params' => '',
    ), $atts));
    ob_start();
    ?>

    <div class="our-demos our-demos-container ">
        <div class="our-demos-row row">
            <?php
            if (!empty(vc_param_group_parse_atts($atts['our_demos_params']))):
                $i = 0;
                foreach (vc_param_group_parse_atts($atts['our_demos_params']) as $params):
                    $i++;
                    $demo_label = isset($params['demo_label']) ? $params['demo_label'] : '';
                    ?>

                    <div class="ourdemos__item col-md-6 col-lg-4 col-xs-12 <?php if ($params['status'] == 0): echo 'comingsoon'; endif; ?>">
                        <div class="content">
                            <?php
                            if ($demo_label != '') {
                                if ($demo_label == 'New') {
                                    $new = 'new';
                                } else {
                                    $new = '';
                                }
                                ?>
                                <span class="trend <?php echo esc_attr($new); ?>"><?php echo esc_attr($demo_label); ?></span>
                                <?php
                            }
                            ?>
                            <?php
                            if ($params['status'] != 0):
                                if ($params['image'] != ''):
                                    ?>
                                    <a target="<?php echo esc_url(vc_build_link($params['url'])['target']); ?>"
                                       href="<?php echo esc_url(vc_build_link($params['url'])['url']); ?>"
                                       title="<?php echo esc_attr(vc_build_link($params['url'])['title']); ?>">
                                        <?php
                                        echo wp_get_attachment_image($params['image'], 'full', "", array("class" => "img-responsive"));
                                        ?>
                                    </a>
                                <?php

                                endif;
                            else:
                                if ($params['image'] != ''):
                                    echo '<div class="img-commingsoon">';
                                    echo wp_get_attachment_image($params['image'], 'full', "", array("class" => "img-responsive"));
                                    echo '</div>';
                                else : ?>
                                    <img src="<?php echo PLUGIN_PATH . 'assets/images/comingsoon.jpg' ?>"
                                         alt="<?php echo esc_html__('commingsoon', 'tz-autoshowroom') ?>"/>
                                <?php
                                endif; ?>
                                <h3><?php echo esc_html__('Coming Soon', 'tz-autoshowroom'); ?></h3>
                            <?php
                            endif;
                            ?>
                        </div>
                        <?php if ($params['status'] != 0): ?>
                            <?php if ($params['title'] != ''): ?>
                                <h4 class="title"><?php if ($i < 10): echo esc_html('0') . esc_html($i);
                                    else: echo esc_html($i); endif; ?></h4>
                                <p class="description"><?php echo $params['title']; ?></p>
                            <?php endif; ?>
                        <?php else: ?>
                            <h4 class="title"><?php if ($i < 10): echo esc_html('0') . esc_html($i);
                                else: echo esc_html($i); endif; ?></h4>
                            <?php if ($params['title'] != ''): ?>
                                <p class="description"><?php echo $params['title']; ?></p>
                            <?php else: ?>
                                <p class="description"><?php echo esc_html__('COMINGSOON', 'tz-autoshowroom'); ?></p>
                            <?php
                            endif; ?>

                        <?php endif; ?>

                    </div>

                <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode('autoshowroom-our-demos', 'autoshowroom_our_demos');
?>