<?php
/*
 * Element tz-feature-item
 * */

/**
 * @param $atts
 * @param null $content
 * @return string
 */
function autoshowroom_customers_say($atts, $content = null)
{
    $name = $title = $comment = '';
    extract(shortcode_atts(array(
        'name' => '',
        'title' => '',
        'comment' => '',
    ), $atts));
    ob_start();
    ?>
    <div class="customersay grid">
        <div class="item">
            <?php if ($name) : ?>
                <h6 class="name">
                    <img src="<?php echo get_template_directory_uri() . '/images/icon_customer_say.png' ?>" alt="">
                    <?php
                    echo esc_html($name);
                    ?>
                </h6>
            <?php endif; ?>
            <div class="vote">
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <?php if ($title) : ?>
                    <p class="title">
                        <?php
                        echo esc_html($title);
                        ?>
                    </p>
                <?php endif; ?>
                <?php if ($comment) : ?>
                    <p class="vote-content">
                        <?php
                        echo balanceTags($comment);
                        ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('autoshowroom-customers-say', 'autoshowroom_customers_say');
?>