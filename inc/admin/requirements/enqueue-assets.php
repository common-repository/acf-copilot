<?php
/**
 * [Short description]
 *
 * @package    DEVRY\INBLOCKS
 * @copyright  Copyright (c) 2024, Developry Ltd.
 * @license    https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since      1.1
 */

namespace DEVRY\INBLOCKS;

! defined( ABSPATH ) || exit; // Exit if accessed directly.

/**
 * Enqueue admin assets (styles and scripts) for the plugin.
 */
function inblocks_enqueue_admin_assets() {
	if ( ! is_admin() ) {
		return;
	}

	$inblocks = new Instagram_Blocks;

	// Load assets only for page page staring with prefix inblocks-.
	// $screen = get_current_screen();
	// if ( strpos( $screen->id, 'inblocks_' ) ) {}

	wp_enqueue_style(
		'inblocks-admin',
		INBLOCKS_PLUGIN_DIR_URL . 'assets/dist/css/inblocks-admin.min.css',
		array(),
		INBLOCKS_PLUGIN_VERSION,
		'all'
	);

	wp_enqueue_script(
		'inblocks-admin',
		INBLOCKS_PLUGIN_DIR_URL . 'assets/dist/js/inblocks-admin.min.js',
		array( 'jquery' ),
		INBLOCKS_PLUGIN_VERSION,
		true
	);

	wp_localize_script(
		'inblocks-admin',
		'inblocks',
		array(
			'plugin_url'    => INBLOCKS_PLUGIN_DIR_URL,
			'plugin_domain' => INBLOCKS_PLUGIN_DOMAIN,
			'ajax_url'      => esc_url( admin_url( 'admin-ajax.php' ) ),
			'ajax_nonce'    => wp_create_nonce( 'inblocks-ajax-nonce' ),
		)
	);
}

/**
 * Enqueue frontend assets (styles and scripts) for the plugin.
 */
function inblocks_enqueue_frontend_assets() {
	$inblocks_admin = new INBLOCKS_Admin;

	wp_enqueue_style(
		'inblocks-frontend',
		INBLOCKS_PLUGIN_DIR_URL . 'assets/dist/css/inblocks-frontend.min.css',
		array(),
		INBLOCKS_PLUGIN_VERSION,
		'all'
	);

	wp_enqueue_script(
		'inblocks-frontend',
		INBLOCKS_PLUGIN_DIR_URL . '/assets/dist/js/inblocks-frontend.min.js',
		array(),
		INBLOCKS_PLUGIN_VERSION,
		true
	);
}

/**
 * Hook into the theme setup process to enqueue frontend assets for the plugin.
 */
function inblocks_after_theme_setup() {
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\inblocks_enqueue_frontend_assets', 1001 );
}

add_action( 'after_setup_theme', __NAMESPACE__ . '\inblocks_after_theme_setup' );

/**
 * Enqueue block editor assets (styles and scripts) for the plugin.
 */
function inblocks_enqueue_block_editor_assets() {
	if ( ! is_admin() ) {
		return;
	}

	global $post;

	$inblocks       = new Instagram_Blocks;
	$inblocks_admin = new INBLOCKS_Admin;

	if ( null !== $post
		&& property_exists( $post, 'post_type' )
		&& in_array( $post->post_type, $inblocks->types_supported, true ) // Post type supported.
		&& array_intersect( wp_get_current_user()->roles, $inblocks->user_access ) ) { // Has user access.
		wp_enqueue_style(
			'inblocks-instagram-block',
			INBLOCKS_PLUGIN_DIR_URL . 'assets/dist/css/inblocks-instagram-block.min.css',
			array(),
			INBLOCKS_PLUGIN_VERSION,
			'all'
		);

		wp_enqueue_script(
			'inblocks-instagram-block',
			INBLOCKS_PLUGIN_DIR_URL . '/assets/dist/js/inblocks-instagram-block.min.js',
			array( 'wp-block-editor', 'wp-blocks', 'wp-editor', 'wp-i18n', 'wp-data', 'wp-element', 'wp-components', 'wp-compose' ),
			INBLOCKS_PLUGIN_VERSION,
			true
		);

		// Localize the defaults for the block editor.
		wp_localize_script(
			'inblocks-instagram-block',
			'inblocks',
			array(
				'plugin_url'        => INBLOCKS_PLUGIN_DIR_URL,
				'plugin_domain'     => INBLOCKS_PLUGIN_DOMAIN,
				'site_url'          => esc_url( home_url() ),
				'admin_url'         => esc_url( admin_url() ),
				'ajax_url'          => esc_url( admin_url( 'admin-ajax.php' ) ),
				'ajax_nonce'        => wp_create_nonce( 'inblocks-ajax-nonce' ),
				'block_preview_img' => esc_url( INBLOCKS_PLUGIN_IMG_URL . 'block-preview.jpg' ),
			)
		);
	}
}

add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\inblocks_enqueue_block_editor_assets' );
