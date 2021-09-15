<?php
/* *
 * widgets social
 **/
class tzinteriart_social extends WP_Widget{

    /*function construct*/
    public function __construct() {
        parent::__construct(
            'social', esc_html__('Social Widget','tz-interiart'),
            array('description'=> esc_html__('Display social.', 'tz-interiart'))
        );
    }

    /**
     * font-end widgets
     */
    public function widget($args, $instance) {
        extract($args);
        $tzmusika_title = apply_filters('widget_title', $instance['title']);

        echo balanceTags($before_widget);

        if($tzmusika_title) {
            echo balanceTags($before_title).esc_html($tzmusika_title).balanceTags($after_title);
        }

        ?>
        <div class="tzwidget-social">
            <?php  if($instance['facebook_url']): ?>
                <a href="<?php echo esc_url($instance['facebook_url']);?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <?php  endif; ?>

            <?php  if($instance['twitter_url']): ?>
                <a href="<?php echo esc_url($instance['twitter_url']);?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <?php  endif; ?>

            <?php  if($instance['google_plus_url']): ?>
                <a href="<?php echo esc_url($instance['google_plus_url']);?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
            <?php  endif; ?>

            <?php  if($instance['instagram_url']): ?>
                <a href="<?php echo esc_url($instance['instagram_url']);?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <?php  endif; ?>

            <?php  if($instance['pinterest_url']): ?>
                <a href="<?php echo esc_url($instance['pinterest_url']);?>" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
            <?php  endif; ?>

            <?php  if($instance['youtube_url']): ?>
                <a href="<?php echo esc_url($instance['youtube_url']);?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
            <?php  endif; ?>

            <?php  if($instance['linkedin_url']): ?>
                <a href="<?php echo esc_url($instance['linkedin_url']);?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
            <?php  endif; ?>

            <?php  if($instance['feed_url']): ?>
                <a href="<?php echo esc_url($instance['feed_url']);?>" target="_blank"><i class="fa fa-rss-square" aria-hidden="true"></i></a>
            <?php  endif; ?>

            <?php  if($instance['skype_url']): ?>
                <a href="<?php echo esc_url($instance['skype_url']);?>" target="_blank"><i class="fa fa-skype" aria-hidden="true"></i></a>
            <?php  endif; ?>

            <?php  if($instance['flickr_url']): ?>
                <a href="<?php echo esc_url($instance['flickr_url']);?>" target="_blank"><i class="fa fa-flickr" aria-hidden="true"></i></a>
            <?php  endif; ?>

            <?php  if($instance['vimeo_url']): ?>
                <a href="<?php echo esc_url($instance['vimeo_url']);?>" target="_blank"><i class="fa fa-vimeo" aria-hidden="true"></i></a>
            <?php  endif; ?>

            <?php  if($instance['tumblr_url']): ?>
                <a href="<?php echo esc_url($instance['tumblr_url']);?>" target="_blank"><i class="fa fa-tumblr" aria-hidden="true"></i></a>
            <?php  endif; ?>

        </div>
        <?php
        echo balanceTags($after_widget);
    }

    /**
     * Back-end widgets form
     */
    public function form($instance){
        $instance =   wp_parse_args($instance,array(
            'title' => 'Social Widget',
            'facebook_url' => 'https://www.facebook.com/templaza',
            'twitter_url' => 'https://twitter.com/templazavn',
            'google_plus_url' => 'https://plus.google.com/+Templaza/',
            'instagram_url' => 'info@templaza.com',
            'pinterest_url' => 'templaza.com',
            'youtube_url'  => 'http://www.youtube.com/channel/UCykS6SX6L2GOI-n3IOPfTVQ',
            'linkedin_url' => 'templaza.com',
            'feed_url' => 'templaza.com',
            'skype_url' => 'templaza.com',
            'flickr_url' => 'templaza.com',
            'vimeo_url' => 'templaza.com',
            'tumblr_url' => 'templaza.com',
        ));
        ?>
        <p>
            <label for=<?php echo esc_attr($this->get_field_id('title')); ?>><?php  esc_html_e('Title:','tz-musika') ; ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('facebook_url')); ?>"><?php  esc_html_e('Facebook Url:','tz-musika'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('facebook_url')) ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('facebook_url')) ?>" value="<?php echo esc_attr($instance['facebook_url']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('twitter_url')); ?>"><?php  esc_html_e('Facebook Url:','tz-musika'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('twitter_url')) ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('twitter_url')) ?>" value="<?php echo esc_attr($instance['twitter_url']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('google_plus_url')); ?>"><?php  esc_html_e( 'Google Plus Url:', 'tz-musika' ); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('google_plus_url')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('google_plus_url')); ?>" value="<?php echo esc_attr($instance['google_plus_url']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('instagram_url')) ?>"><?php  esc_html_e('Instagram Url:', 'tz-musika'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('instagram_url')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram_url')); ?>" class="widefat" value="<?php echo esc_attr($instance['instagram_url']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('pinterest_url')) ?>"><?php  esc_html_e('Pinterest Url:', 'tz-musika'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('pinterest_url')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest_url')); ?>" class="widefat" value="<?php echo esc_attr($instance['pinterest_url']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('youtube_url')) ?>"><?php  esc_html_e('Youtube Url:', 'tz-musika'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('youtube_url')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube_url')); ?>" class="widefat" value="<?php echo esc_attr($instance['youtube_url']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('linkedin_url')) ?>"><?php  esc_html_e('Linkedin Url:', 'tz-musika'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('linkedin_url')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin_url')); ?>" class="widefat" value="<?php echo esc_attr($instance['linkedin_url']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('feed_url')) ?>"><?php  esc_html_e('Feed Url:', 'tz-musika'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('feed_url')); ?>" name="<?php echo esc_attr($this->get_field_name('feed_url')); ?>" class="widefat" value="<?php echo esc_attr($instance['feed_url']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('skype_url')) ?>"><?php  esc_html_e('Skype Url:', 'tz-musika'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('skype_url')); ?>" name="<?php echo esc_attr($this->get_field_name('skype_url')); ?>" class="widefat" value="<?php echo esc_attr($instance['skype_url']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('flickr_url')) ?>"><?php  esc_html_e('Flickr Url:', 'tz-musika'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('flickr_url')); ?>" name="<?php echo esc_attr($this->get_field_name('flickr_url')); ?>" class="widefat" value="<?php echo esc_attr($instance['flickr_url']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('vimeo_url')) ?>"><?php  esc_html_e('Vimeo Url:', 'tz-musika'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('vimeo_url')); ?>" name="<?php echo esc_attr($this->get_field_name('vimeo_url')); ?>" class="widefat" value="<?php echo esc_attr($instance['vimeo_url']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('tumblr_url')) ?>"><?php  esc_html_e('Tumblr Url:', 'tz-musika'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('tumblr_url')); ?>" name="<?php echo esc_attr($this->get_field_name('tumblr_url')); ?>" class="widefat" value="<?php echo esc_attr($instance['tumblr_url']); ?>" />
        </p>
        <?php
    }

    /**
     * function update widget
     */
    public function update( $new_instance, $old_instance ) {
        $instance                     =   $old_instance;
        $instance['title']            =   $new_instance['title'];
        $instance['facebook_url']     =   $new_instance['facebook_url'];
        $instance['twitter_url']      =   $new_instance['twitter_url'];
        $instance['google_plus_url']  =   $new_instance['google_plus_url'];
        $instance['instagram_url']    =   $new_instance['instagram_url'];
        $instance['pinterest_url']    =   $new_instance['pinterest_url'];
        $instance['youtube_url']      =   $new_instance['youtube_url'];
        $instance['linkedin_url']     =   $new_instance['linkedin_url'];
        $instance['feed_url']         =   $new_instance['feed_url'];
        $instance['skype_url']        =   $new_instance['skype_url'];
        $instance['flickr_url']       =   $new_instance['flickr_url'];
        $instance['vimeo_url']        =   $new_instance['vimeo_url'];
        $instance['tumblr_url']       =   $new_instance['tumblr_url'];
        return $instance;
    }
}
function tzinteriart_register_social(){
    register_widget('tzinteriart_social');
}
add_action('widgets_init','tzinteriart_register_social');
?>