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

function inblocks_display_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'You do not have sufficient permissions to access this page.' );
	}

	add_settings_section(
		INBLOCKS_SETTINGS_SLUG,
		'Settings',
		'',
		INBLOCKS_SETTINGS_SLUG
	);

	// Instagram Blocks fields.
	add_settings_field(
		'inblocks_types_supported',
		'<label for="inblocks-types-supported">'
			. esc_html__( 'Types Supported', 'instagram-blocks' )
			. '</label>',
		__NAMESPACE__ . '\inblocks_display_types_supported',
		INBLOCKS_SETTINGS_SLUG,
		INBLOCKS_SETTINGS_SLUG,
	);

	add_settings_field(
		'inblocks_user_access',
		'<label for="inblocks-user-access">'
			. esc_html__( 'User Access', 'instagram-blocks' )
			. '</label>',
		__NAMESPACE__ . '\inblocks_display_user_access',
		INBLOCKS_SETTINGS_SLUG,
		INBLOCKS_SETTINGS_SLUG,
	);

	add_settings_field(
		'inblocks_compact_mode',
		'<label for="inblocks-compact-mode">'
			. esc_html__( 'Compact Mode', 'instagram-blocks' )
			. '</label>',
		__NAMESPACE__ . '\inblocks_display_compact_mode',
		INBLOCKS_SETTINGS_SLUG,
		INBLOCKS_SETTINGS_SLUG,
	);

	require_once INBLOCKS_PLUGIN_DIR_PATH . 'inc/admin/settings/settings-main-page.php';
}
