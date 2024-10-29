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

function inblocks_register_setting_fields() {
	register_setting( INBLOCKS_SETTINGS_SLUG, 'inblocks_types_supported', __NAMESPACE__ . '\inblocks_sanitize_types_supported' );
	register_setting( INBLOCKS_SETTINGS_SLUG, 'inblocks_user_access', __NAMESPACE__ . '\inblocks_sanitize_user_access' );
	register_setting( INBLOCKS_SETTINGS_SLUG, 'inblocks_compact_mode', __NAMESPACE__ . '\inblocks_sanitize_compact_mode' );
}

add_action( 'admin_init', __NAMESPACE__ . '\inblocks_register_setting_fields' );
