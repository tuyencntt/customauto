<?php

function autoshowroom_vehicle_search( $atts )
{
    $autoshowroom_search_title
        = $autoshowroom_search_type
        = $autoshowroom_search_fields
        = $autoshowroom_button_search
        = $autoshowroom_search_position
        = $autoshowroom_search_top
        = $autoshowroom_search_layout
        = $autoshowroom_search_animation
        = $autoshowroom_search_label
        = $autoshowroom_condition
        = $el_class ='';
    extract(shortcode_atts(array(
        'autoshowroom_search_type'               =>  'type1',
        'autoshowroom_search_title'              =>  'Find Your Car',
        'autoshowroom_search_layout'             =>  'vertical',
        'autoshowroom_search_fields'             =>  '',
        'autoshowroom_button_search'             =>  'Search',
        'autoshowroom_search_label'              =>  '',
        'autoshowroom_condition'                 =>  'all',
        'autoshowroom_search_position'           =>  'none',
        'autoshowroom_search_top'                =>  150,
        'autoshowroom_search_animation'          =>  '',
        'el_class'                               =>  ''
    ), $atts));
    ob_start();
    $search_label = 'search-label-'.$autoshowroom_search_label;
    $autoshowroom_search_form_fields = str_replace(" ",'',$autoshowroom_search_fields);
    if($autoshowroom_search_type == 'type1') {
        if ($autoshowroom_search_layout == 'vertical') { ?>
            <div class="TZ-Vehicle-Search-Vertical <?php echo esc_attr($autoshowroom_search_position); ?> <?php if ($el_class != '') echo esc_attr($el_class); ?>"
                <?php if ($autoshowroom_search_position == 'quicksearch_top_left'
                    || $autoshowroom_search_position == 'quicksearch_top_right'
                    || $autoshowroom_search_position == 'quicksearch_top_center') { ?>
                    style="top:<?php echo esc_attr($autoshowroom_search_top); ?>px"
                <?php } else { ?>
                    style="bottom:<?php echo esc_attr($autoshowroom_search_top); ?>px"
                <?php } ?>
            >
                <?php if ($autoshowroom_search_title != '') { ?>
                    <h3><?php echo balanceTags($autoshowroom_search_title) ?></h3>
                <?php } ?>
                <?php echo do_shortcode('[vehicle_searchform include="' . $autoshowroom_search_form_fields . '" button="' . esc_attr($autoshowroom_button_search) . '"]'); ?>
            </div>
        <?php } else { ?>
            <?php if ($autoshowroom_search_title != '') { ?>
                <h3><?php echo balanceTags($autoshowroom_search_title) ?></h3>
            <?php } ?>
            <div class="TZ-Vehicle-Search-Horizontal <?php echo esc_attr($search_label); ?> <?php echo esc_attr($autoshowroom_search_position); ?> <?php if ($el_class != '') echo esc_attr($el_class); ?>">
                <?php echo do_shortcode('[vehicle_searchform include="' . $autoshowroom_search_form_fields . '" button="' . esc_attr($autoshowroom_button_search) . '"]'); ?>
            </div>
        <?php }
    }elseif($autoshowroom_search_type == 'type3' && $autoshowroom_search_layout == 'vertical') { ?>
        <div class="tz-autoshoowroom-vehicle-search container">
            <div class="tz-autoshoowroom-vehicle-search-border">
                <div class="tz-vehicle-search type3 <?php echo esc_attr($autoshowroom_search_position); ?> <?php if ($el_class != '') echo esc_attr($el_class); ?>"
                    <?php if ($autoshowroom_search_position == 'quicksearch_top_left'
                        || $autoshowroom_search_position == 'quicksearch_top_right'
                        || $autoshowroom_search_position == 'quicksearch_top_center') { if ($autoshowroom_search_top != ''){?>
                        style="top:<?php echo esc_attr($autoshowroom_search_top); ?>px"
                    <?php }} else {if ($autoshowroom_search_top != ''){ ?>
                        style="bottom:<?php echo esc_attr($autoshowroom_search_top); ?>px"
                    <?php }} ?>
                >
                    <?php if ($autoshowroom_search_title != '') { ?>
                        <h3><span><?php echo balanceTags($autoshowroom_search_title) ?></span></h3>
                    <?php } ?>
                    <?php echo do_shortcode('[vehicle_searchform include="' . $autoshowroom_search_form_fields . '" button="' . esc_attr($autoshowroom_button_search) . '"]'); ?>
                </div>
            </div>
        </div>
        <?php
    }else{ ?>
        <div class="tz-vehicle-search type2 <?php echo esc_attr($search_label); ?> <?php echo esc_attr($autoshowroom_search_position); ?> <?php if ($el_class != '') echo esc_attr($el_class); ?>"
             data-condition="<?php echo esc_attr($autoshowroom_condition); ?>">
            <?php echo do_shortcode('[vehicle_searchform include="' . $autoshowroom_search_form_fields . ',condition" button="' . esc_attr($autoshowroom_button_search) . '"]'); ?>
        </div>
        <?php
    }
    $autoshowroom_feature_vehicle = ob_get_contents();
    ob_end_clean();
    return $autoshowroom_feature_vehicle;
}
add_shortcode('autoshowroom-vehicle-search', 'autoshowroom_vehicle_search');
?>