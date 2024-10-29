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

function inblocks_add_settings_menu() {
	$inblocks = new Instagram_Blocks();

	if ( '' === $inblocks->compact_mode ) {
		add_menu_page(
			esc_html__( 'Instagram Blocks', 'instagram-blocks' ),
			esc_html__( 'Instagram Blocks', 'instagram-blocks' ),
			'manage_options',
			INBLOCKS_SETTINGS_SLUG,
			__NAMESPACE__ . '\inblocks_display_settings_page',
			'dashicons-instagram'
		);
	} else {
		add_submenu_page(
			'themes.php',
			esc_html__( 'Instagram Blocks', 'instagram-blocks' ),
			esc_html__( 'Instagram Blocks', 'instagram-blocks' ),
			'manage_options',
			INBLOCKS_SETTINGS_SLUG,
			__NAMESPACE__ . '\inblocks_display_settings_page'
		);
	}
}

add_action( 'admin_menu', __NAMESPACE__ . '\inblocks_add_settings_menu', 1000 );
