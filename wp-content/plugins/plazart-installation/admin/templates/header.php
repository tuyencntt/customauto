<?php
/**
 * Base layout for all admin pages
 */

?>

<div class="plazart-installation__header">
    <h1 class="title"><?php echo  wp_get_theme()->get('Name')? wp_get_theme()->get('Name')
            .__(' demo data import', $this -> text_domain):__('Plazart Installation', $this -> text_domain); ?></h1>
    <div class="sub-title">
        <span class="desc-meta"><?php echo __("Version ", $this -> text_domain).self::get_plugin_version(); ?></span>
    </div>
</div>