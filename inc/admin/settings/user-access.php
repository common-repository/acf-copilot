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

function inblocks_display_user_access() {
	$inblocks = new Instagram_Blocks();

	$user_access = get_option( 'inblocks_user_access', $inblocks->user_access );

	$options_html = '';

	$roles_available = array_keys( get_editable_roles() );

	foreach ( $roles_available as $role ) {
		$role_text = ucwords( $role );
		$selected  = '';

		if ( is_array( $user_access ) && in_array( $role, $user_access, true ) ) {
			$selected = 'selected';
		}

		$options_html .= "<option value=\"{$role}\" {$selected}>{$role_text}</option>";
	}
	?>
		<select id="inblocks-user-access" name="inblocks_user_access[]" multiple>
			<?php echo wp_kses( $options_html, json_decode( INBLOCKS_PLUGIN_ALLOWED_HTML_ARR, true ) ); ?>
		</select>
		<p class="description">
			<small>
				<?php echo esc_html__( 'Select user access capabilities.', 'instagram-blocks' ); ?>
			</small>
		</p>
	<?php
}

function inblocks_sanitize_user_access( $user_access ) {
	if ( empty( $_REQUEST['inblocks_nonce'] )
		|| ! wp_verify_nonce( $_REQUEST['inblocks_nonce'], 'inblocks_security' ) ) {
		return;
	}

	if ( empty( $user_access ) ) {
		return;
	}

	if ( get_option( 'inblocks_user_access' ) != $user_access ) {
		add_settings_error(
			'inblocks_settings_errors',
			'inblocks_user_access',
			esc_html__( 'User access was updated successfully.', 'instagram-blocks' ),
			'updated'
		);
	}

	return array_map( 'sanitize_text_field', $user_access );
}
