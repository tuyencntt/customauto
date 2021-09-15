<?php
/* *
 * widgets contact info
 **/
class autoshowroom_contact_info extends WP_Widget{

    /*function construct*/
    public function __construct() {
        parent::__construct(
            'contact_info', esc_html__('Contact info','tz-autoshowroom'),
            array('description'=> esc_html__('Display Contact info', 'tz-autoshowroom'))
        );
    }

    /**
     * font-end widgets
     */
    public function widget($args, $instance) {
        extract($args);
        $autoshowroom_title = apply_filters('widget_title', $instance['autoshowroom_title']);

        echo balanceTags($before_widget);

        if($autoshowroom_title) {
            echo balanceTags($before_title).esc_html($autoshowroom_title).balanceTags($after_title);
        }

        ?>
        <div class="tzwidget-contact">
            <?php  if($instance['autoshowroom_description']): ?>
                <p class="tzContact_description"> <?php  echo esc_html($instance['autoshowroom_description']);  ?> </p>
            <?php  endif; ?>
            <?php  if($instance['autoshowroom_address']): ?>
                <span class="tzContact_address"><i class="fa fa-map-marker"></i><?php  echo esc_html($instance['autoshowroom_address']);  ?></span>
            <?php  endif; ?>
            <?php  if($instance['autoshowroom_phone']): ?>
                <span class="tzContact_phone"><i class="fa fa-phone"></i><?php echo esc_html($instance['autoshowroom_phone']); ?></span>
            <?php  endif; ?>
            <?php if($instance['autoshowroom_email']): ?>
                <span class="tzContact_email"><i class="fa fa-envelope-o"></i><?php echo esc_html($instance['autoshowroom_email']); ?></span>
            <?php endif; ?>
        </div>
        <?php
        echo balanceTags($after_widget);
    }

    /**
     * Back-end widgets form
     */
    public function form($instance){
        $instance =   wp_parse_args($instance,array(
            'autoshowroom_title'       =>  'Contact info',
            'autoshowroom_description' =>  'Description',
            'autoshowroom_address'     =>  'Ha Noi, Viet Nam',
            'autoshowroom_phone'       =>  '+0123456789',
            'autoshowroom_email'       =>  'info@templaza.com',
        ));
        ?>
        <p>
            <label for=<?php echo esc_attr($this->get_field_id('autoshowroom_title')); ?>><?php  esc_html_e('Title:','tz-autoshowroom') ; ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('autoshowroom_title')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('autoshowroom_title')); ?>" value="<?php echo esc_attr($instance['autoshowroom_title']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('autoshowroom_description')); ?>"><?php  esc_html_e('Description','tz-autoshowroom'); ?></label>
            <textarea name="<?php echo esc_attr($this->get_field_name('autoshowroom_description')); ?>" id="<?php echo esc_attr($this->get_field_id('autoshowroom_description')); ?>" class="widefat" placeholder=""><?php echo esc_attr($instance['autoshowroom_description']); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('autoshowroom_address')); ?>"><?php  esc_html_e('Address:','tz-autoshowroom'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('autoshowroom_address')) ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('autoshowroom_address')) ?>" value="<?php echo esc_attr($instance['autoshowroom_address']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('autoshowroom_phone')); ?>"><?php  esc_html_e( 'Phone:', 'tz-autoshowroom' ); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('autoshowroom_phone')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('autoshowroom_phone')); ?>" value="<?php echo esc_attr($instance['autoshowroom_phone']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('autoshowroom_email')) ?>"><?php  esc_html_e('Email:', 'tz-autoshowroom'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('autoshowroom_email')); ?>" name="<?php echo esc_attr($this->get_field_name('autoshowroom_email')); ?>" class="widefat" value="<?php echo esc_attr($instance['autoshowroom_email']); ?>" />
        </p>
        <?php
    }

    /**
     * function update widget
     */
    public function update( $new_instance, $old_instance ) {
        $instance                             =   $old_instance;
        $instance['autoshowroom_title']            =   $new_instance['autoshowroom_title'];
        $instance['autoshowroom_description']      =   $new_instance['autoshowroom_description'];
        $instance['autoshowroom_address']          =   $new_instance['autoshowroom_address'];
        $instance['autoshowroom_phone']            =   $new_instance['autoshowroom_phone'];
        $instance['autoshowroom_email']            =   $new_instance['autoshowroom_email'];
        return $instance;
    }
}
function autoshowroom_register_contact_info(){
    register_widget('autoshowroom_contact_info');
}
add_action('widgets_init','autoshowroom_register_contact_info');
?>