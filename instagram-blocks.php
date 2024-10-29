<?php
/**
 * Plugin Name: Custom Blocks for Instagram
 * Plugin URI: https://instablocksplugin.com/
 * Description: Loading Instagram media into your WordPress posts and pages within the Block Editor has never been easier.
 * Version: 1.0.7
 * Author: Krasen Slavov
 * Author URI: https://developry.com/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: instagram-blocks
 * Domain Path: /lang
 *
 * Copyright (c) 2018 - 2023 Developry Ltd. (email: contact@developry.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301 USA
 */

namespace DEVRY\INBLOCKS;

! defined( ABSPATH ) || exit; // Exit if accessed directly.

define( __NAMESPACE__ . '\INBLOCKS_ENV', 'prod' ); // Use prod, dev options.

define( __NAMESPACE__ . '\INBLOCKS_MIN_PHP_VERSION', '7.2' );
define( __NAMESPACE__ . '\INBLOCKS_MIN_WP_VERSION', '5.0' );

define( __NAMESPACE__ . '\INBLOCKS_PLUGIN_UUID', 'inblocks' );
define( __NAMESPACE__ . '\INBLOCKS_PLUGIN_TEXTDOMAIN', 'instagram-blocks' );
define( __NAMESPACE__ . '\INBLOCKS_PLUGIN_NAME', esc_html__( 'Custom Blocks for Instagram', 'instagram-blocks' ) );
define( __NAMESPACE__ . '\INBLOCKS_PLUGIN_VERSION', '1.0.7' );
define( __NAMESPACE__ . '\INBLOCKS_PLUGIN_DOMAIN', 'instablocksplugin.com' );
define( __NAMESPACE__ . '\INBLOCKS_PLUGIN_DOCS', 'https://instablocksplugin.com/help' );

define( __NAMESPACE__ . '\INBLOCKS_PLUGIN_WPORG_SUPPORT', 'https://wordpress.org/support/plugin/acf-copilot/#new-topic' );
define( __NAMESPACE__ . '\INBLOCKS_PLUGIN_WPORG_RATE', 'https://wordpress.org/support/plugin/acf-copilot/reviews/#new-post' );

define( __NAMESPACE__ . '\INBLOCKS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( __NAMESPACE__ . '\INBLOCKS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( __NAMESPACE__ . '\INBLOCKS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

define(
	__NAMESPACE__ . '\INBLOCKS_PLUGIN_ALLOWED_HTML_ARR',
	wp_json_encode(
		array(
			'br'     => array(),
			'strong' => array(),
			'em'     => array(),
			'a'      => array(
				'href'   => array(),
				'target' => array(),
				'name'   => array(),
			),
			'option' => array(
				'value'    => array(),
				'selected' => array(),
			),
		)
	)
);

if ( 'dev' === INBLOCKS_ENV ) {
	define( __NAMESPACE__ . '\INBLOCKS_PLUGIN_IMG_URL', INBLOCKS_PLUGIN_DIR_URL . 'assets/dev/images/' );
} else {
	define( __NAMESPACE__ . '\INBLOCKS_PLUGIN_IMG_URL', INBLOCKS_PLUGIN_DIR_URL . 'assets/dist/img/' );
}

require_once INBLOCKS_PLUGIN_DIR_PATH . 'inc/admin/admin.php';
require_once INBLOCKS_PLUGIN_DIR_PATH . 'inc/library/class-inblocks-admin.php';
require_once INBLOCKS_PLUGIN_DIR_PATH . 'inc/library/class-instagram-blocks.php';
