<?php
/**
 * [Short description]
 *
 * @package    DEVRY\INBLOCKS
 * @copyright  Copyright (c) 2024, Developry Ltd.
 * @license    https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since      1.0
 */

namespace DEVRY\INBLOCKS;

! defined( ABSPATH ) || exit; // Exit if accessed directly.

/**
 * Activate plugin trigger.
 */
function inblocks_activate_plugin( $plugin_file_path ) {
	if ( INBLOCKS_PLUGIN_BASENAME === $plugin_file_path ) {
		if ( get_option( 'inblocks_rating_notice', '' ) ) {
		}
	}
}

add_action( 'activated_plugin', __NAMESPACE__ . '\inblocks_activate_plugin' );

/**
 * Deactivate plugin trigger.
 */
function inblocks_deactivate_plugin( $plugin_file_path ) {
	if ( INBLOCKS_PLUGIN_BASENAME === $plugin_file_path ) {
		delete_option( 'inblocks_rating_notice' );
		delete_option( 'inblocks_upgrade_notice' );
	}
}

add_action( 'deactivated_plugin', __NAMESPACE__ . '\inblocks_deactivate_plugin' );
