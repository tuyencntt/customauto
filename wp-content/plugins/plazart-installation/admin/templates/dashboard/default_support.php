<?php
defined( 'ABSPATH' ) || exit;

use PlazartInstallation\AdminFunctions;
?>
<h6 class="border-bottom border-gray pb-2 mb-3">Support</h6>
<strong><?php echo __('Need Some Help?', $this -> text_domain); ?></strong>
<p><?php echo __('We would love to be of any assistance.', $this -> text_domain); ?></p>
<div class="action">
    <a href="http://localhost/templaza_plus/joomla/index.php/help/envato-client.html" class="btn btn-primary">
        <span class="dashicons dashicons-sos"></span> <?php echo __('Send Ticket', $this -> text_domain); ?>
    </a>
    <a href="https://www.templaza.com/Forums.html" class="btn btn-warning">
        <span class="dashicons dashicons-format-status"></span> <?php echo __('Forum', $this -> text_domain); ?>
    </a>
</div>