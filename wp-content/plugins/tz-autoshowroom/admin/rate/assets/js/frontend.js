jQuery(document).ready(function($) {
    // Invoke Rating Plugin
	$('p.tz-field').each(function() {
		$('input.star', $(this)).rating({
			cancel: 'Cancel',
			cancelValue: 0,
			callback: function(rating) {
				var parentElement = $(this).closest('.tz-field');
				$('input[type=hidden]', $(parentElement)).val(rating);
			}
		});
	});

});