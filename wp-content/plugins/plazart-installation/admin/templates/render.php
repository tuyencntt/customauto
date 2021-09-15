<?php
/**
 * Base layout for all admin pages
 */

?>
<div id="plazart-installation" class="plazart-installation__wrap mr-wrap">
    <div class="container-fluid">
        <?php
        $current_page   = $this -> get_current_page();

        $this -> the_header($current_page);
        $this -> the_notices();
        $this -> the_nav($current_page);
        $this -> the_content($current_page);
        $this -> the_footer();
        ?>
    </div>
</div>
