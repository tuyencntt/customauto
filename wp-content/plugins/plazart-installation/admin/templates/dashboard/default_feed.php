<?php
defined( 'ABSPATH' ) || exit;
?>
<div class="rss-widget">
    <h6 class="border-bottom border-gray pb-2 mb-3">Latest from our blog</h6>
    <?php wp_widget_rss_output(array(
        'url' 			=> 'https://www.templaza.com/blog/?format=feed&type=rss',
        'title' 		=> __( 'Latest From Templaza', $this -> text_domain ),
        'items'        	=> 5,
        'show_summary' 	=> 0,
        'show_author'  	=> 0,
        'show_date'    	=> 1,
    )); ?>
</div>

