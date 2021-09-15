jQuery(document).ready(function() {
    "use strict";
    /* counter */

    // Fun Facts
    function count($this,number_count){
        var current = parseInt($this.html(), 10);
        current = current + parseInt(number_count); /* Where 50 is increment */

        $this.html(++current);
        if(current > $this.data('count')){
            $this.html($this.data('count'));
        } else {
            setTimeout(function(){count($this,number_count)}, 50);
        }
    }

    jQuery(".stat-count").each(function() {
        var number_count = jQuery(this).parents('.autoshowroom-counter').attr('data-number');
        jQuery(this).data('count', parseInt(jQuery(this).html(), 10));
        jQuery(this).html('0');
        count(jQuery(this),number_count);
    });
});