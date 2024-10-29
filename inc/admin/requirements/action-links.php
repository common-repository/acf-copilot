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
 * Add settings link after plugin activation under Plugins.
 */
function inblocks_add_action_links( $links, $file_path ) {
	if ( INBLOCKS_PLUGIN_BASENAME === $file_path ) {
		$inblocks = new Instagram_Blocks();

		$admin_page = ( '' === $inblocks->compact_mode )
			? 'admin.php?page=inblocks_settings'
			: 'themes.php?page=inblocks_settings';

		$links['inblocks-settings'] = '<a href="' . esc_url( admin_url( $admin_page ) ) . '">'
			. esc_html__( 'Settings', 'instagram-blocks' )
			. '</a>';
		$links['inblocks-upgrade']  = '<a href="https://bit.ly/3IzRyDm" target="_blank">'
		. esc_html__( 'Go Pro', 'instagram-blocks' )
		. '</a>';

		return array_reverse( $links );
	}

	return $links;
}
