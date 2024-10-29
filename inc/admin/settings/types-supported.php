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

function inblocks_display_types_supported() {
	$inblocks = new Instagram_Blocks();

	$types_supported = get_option( 'inblocks_types_supported', $inblocks->types_supported );

	$options_html = '';

	$types_available = array(
		'post' => 'post',
		'page' => 'page',
	);

	foreach ( $types_available as $type ) {
		$type_text = ucwords( $type );
		$selected  = '';

		if ( is_array( $types_supported ) && in_array( $type, $types_supported, true ) ) {
			$selected = 'selected';
		}

		$options_html .= "<option value=\"${type}\" ${selected}>${type_text}</option>";
	}
	?>
		<select id="inblocks_types_supported" name="inblocks_types_supported[]" multiple>
			<?php echo wp_kses( $options_html, json_decode( INBLOCKS_PLUGIN_ALLOWED_HTML_ARR, true ) ); ?>
		</select>
		<p class="description">
			<small>
				<?php echo esc_html__( 'Select supported types for the plugin.', 'instagram-blocks' ); ?>
			</small>
		</p>
	<?php
}

function inblocks_sanitize_types_supported( $types_supported ) {
	if ( empty( $_REQUEST['inblocks_nonce'] )
		|| ! wp_verify_nonce( $_REQUEST['inblocks_nonce'], 'inblocks_security' ) ) {
		return;
	}

	if ( empty( $types_supported ) ) {
		return;
	}

	// Don't use strict comparsions to check that arrays are equal.
	if ( get_option( 'inblocks_types_supported' ) != $types_supported ) {
		add_settings_error(
			'inblocks_settings_errors',
			'inblocks_types_supported',
			esc_html__( 'Supported types option was updated successfully.', 'instagram-blocks' ),
			'updated'
		);
	}

	return array_map( 'sanitize_text_field', $types_supported );
}
