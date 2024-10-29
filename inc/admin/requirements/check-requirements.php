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

! defined( ABSPATH ) || exit; // Exit if accessed directly

/**
 * Stop plugin activation if minimum requirement aren't met & display error notice.
 */
function inblocks_check_requirements() {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';

	if ( version_compare( PHP_VERSION, INBLOCKS_MIN_PHP_VERSION ) >= 0
		&& version_compare( $GLOBALS['wp_version'], INBLOCKS_MIN_WP_VERSION ) >= 0 ) {
		load_plugin_textdomain( INBLOCKS_PLUGIN_TEXTDOMAIN, false, INBLOCKS_PLUGIN_BASENAME . 'lang' );

		add_action(
			'plugin_action_links',
			__NAMESPACE__ . '\inblocks_add_action_links',
			10,
			2
		);

		add_action(
			'admin_enqueue_scripts',
			__NAMESPACE__ . '\inblocks_enqueue_admin_assets'
		);

		add_action(
			'enqueue_block_assets', // 'enqueue_block_editor_assets',
			__NAMESPACE__ . '\inblocks_enqueue_block_editor_assets'
		);
	} else {
		$message = sprintf(
			wp_kses(
				/* translators: %1$s is replaced with "Plugin Name" */
				/* translators: %2$s is replaced with "Min PHP Version" */
				/* translators: %3$s is replaced with "Min WP Version" */
				__( '%1$s requires a minimum of PHP %2$s and WordPress %3$s', 'instagram-blocks' ),
				json_decode( INBLOCKS_PLUGIN_ALLOWED_HTML_ARR, true )
			),
			'<strong>' . INBLOCKS_PLUGIN_NAME . '</strong>',
			'<em>' . INBLOCKS_MIN_PHP_VERSION . '</em>',
			'<em>' . INBLOCKS_MIN_WP_VERSION . '</em>.<br />'
		);

		$message .= sprintf(
			wp_kses(
				/* translators: %1$s is replaced with "PHP Version" */
				/* translators: %2$s is replaced with "WordPress Version" */
				__( 'You are currently running PHP %1$s and WordPress %2$s.', 'instagram-blocks' ),
				json_decode( INBLOCKS_PLUGIN_ALLOWED_HTML_ARR, true )
			),
			'<strong>' . PHP_VERSION . '</strong>',
			'<strong>' . $GLOBALS['wp_version'] . '</strong>'
		);

		printf(
			/* translators: %1$s is replaced with PHP and WordPress message check */
			'<div class="notice notice-error is-dismissible"><p>%1$s</p></div>',
			wp_kses( $message, json_decode( WFL_PLUGIN_ALLOWED_HTML_ARR, true ) )
		);

		deactivate_plugins( INBLOCKS_PLUGIN_BASENAME );
	}
}

add_action( 'admin_init', __NAMESPACE__ . '\inblocks_check_requirements' );
