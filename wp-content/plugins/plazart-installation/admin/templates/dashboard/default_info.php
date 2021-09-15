<?php
defined( 'ABSPATH' ) || exit;

use PlazartInstallation\AdminFunctions;

$plugin = AdminFunctions::get_my_plugin_data();
?>
<div class="information">
    <h6 class="border-bottom border-gray pb-2 mb-3"><?php echo __('Plugin Information', $this -> text_domain); ?></h6>
    <div class="title">
        <?php echo $plugin['Name'];?> - <span><?php echo $plugin['Description'];?></span>
    </div>
    <ul class="">
        <li class="">
            <div class="key"><?php echo __('Version', $this -> text_domain);?>:</div>
            <div><?php echo $plugin['Version'];?></div>
        </li>
        <li class="">
            <div class="key"><?php echo __('FanPage', $this -> text_domain);?>:</div>
            <div><a href="<?php echo $plugin['FanPage'];?>" target="_blank"><?php echo $plugin['FanPage'];?></a></div>
        </li>
        <li class="">
            <div class="key"><?php echo __('Twitter', $this -> text_domain);?>:</div>
            <div><a href="<?php echo $plugin['Twitter'];?>" target="_blank"><?php echo $plugin['Twitter'];?></a></div>
        </li>
        <li class="">
            <div class="key"><?php echo __('Google', $this -> text_domain);?>:</div>
            <div><a href="<?php echo $plugin['Google'];?>" target="_blank"><?php echo $plugin['Google'];?></a></div>
        </li>
    </ul>
</div>

