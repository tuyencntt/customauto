<?php

defined( 'ABSPATH' ) || exit;

?>
<div id="plzinst-dashboard-widgets-wrap">

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="p-3 bg-white shadow-sm h-100"><?php echo $this -> load_template('license');?></div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-3 bg-white shadow-sm h-100"><?php echo $this -> load_template('info');?></div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-3 bg-white shadow-sm h-100"><?php echo $this -> load_template('support');?></div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-3 bg-white shadow-sm h-100"><?php echo $this -> load_template('social');?></div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-3 bg-white shadow-sm h-100"><?php echo $this -> load_template('feed');?></div>
        </div>
    </div>


</div>
