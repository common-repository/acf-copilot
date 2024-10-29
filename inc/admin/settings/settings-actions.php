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
 * [AJAX] Reset plugin settings to their default values
 * and provide a success message.
 */
function inblocks_reset_settings() {
	$inblocks_admin = new INBLOCKS_Admin;

	delete_option( 'inblocks_types_supported' );
	delete_option( 'inblocks_user_access' );
	delete_option( 'inblocks_compact_mode' );

	$inblocks_admin->print_json_message(
		1,
		__( 'All options were reset to their default values.', 'instagram-blocks' )
	);
}

add_action( 'wp_ajax_inblocks_reset_settings', __NAMESPACE__ . '\inblocks_reset_settings' );
