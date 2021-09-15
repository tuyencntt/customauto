<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   Progression_Player
 * @author    ProgressionStudios <contact@progressionstudios.com>
 * @license   GPL-2.0+
 * @link      http://progressionstudios.com
 * @copyright 2013 ProgressionStudios
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
delete_option( 'car_dealer_version' );
delete_option( 'car_dealer_installed_terms' );