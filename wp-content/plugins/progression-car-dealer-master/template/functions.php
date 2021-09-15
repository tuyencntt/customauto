<?php
/**
 * Change the vehicle content
 * By default the_content() is overwritten by 4 shortcodes:
 * [vehicle_description], [vehicle_specs], [vehicle_price] and [vehicle_gallery]
 *
 * Hook to the 'the_vehicle_content' filter to output your own markup.
 * To manipulate of the output of the shortcodes see their filters (next example)
 */
add_filter( 'the_vehicle_content', 'my_vehicle_content' );
function my_vehicle_content( ) {

	$content = '';

	/* 1. The Price */
	$content .= do_shortcode( '[vehicle_price]' );

	/* 2. The Specifications */
	$content .= do_shortcode( '[vehicle_specs]' );

	/* 3. The Description - remove the comment from the next line to display description */
	// $content .= do_shortcode( '[vehicle_description]' );

	/* 4. The Gallery - takes the same attibutes as the built-in Gallery
	 * http://codex.wordpress.org/Gallery_Shortcode
	*/
	$content .= do_shortcode( '[vehicle_gallery columns="4" link="file"]' );

	return $content;
}

/**
 * Display the specs in a custom html table
 */

add_filter( 'pcd/get_specs', 'my_spec_table', 10, 3 );

function my_spec_table( $html, $specs ) {

	ob_start(); ?>

	<table>
		<thead>
			<tr>
				<th>Spec</th>
				<th>Value</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $specs as $spec) : ?>
			<tr>
				<th><?php echo $spec['label'] ?></th>
				<td><?php echo $spec['value'] ?></td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<?php return ob_get_clean();
}

?>