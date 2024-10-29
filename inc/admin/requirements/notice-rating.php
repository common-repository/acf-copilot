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
 * Display a notice encouraging users to rate the plugin
 * on WordPress.org and provide options to dismiss the notice.
 */
function inblocks_display_rating_notice() {
	if ( ! get_option( 'inblocks_rating_notice', '' ) ) {
		$inblocks = new Instagram_Blocks();

		$admin_page = ( '' === $inblocks->compact_mode ) ? 'admin.php' : 'themes.php';
		?>
			<div class="notice notice-info is-dismissible inblocks-admin">
				<h3><?php echo esc_html( INBLOCKS_PLUGIN_NAME ); ?></h3>
				<p>
					<?php
					printf(
						wp_kses(
							/* translators: %1$s is replaced with by giving it 5 stars rating */
							__( '✨💪🔌 Could you please kindly help the plugin in your turn %1$s? (Thank you in advance) ' ),
							json_decode( INBLOCKS_PLUGIN_ALLOWED_HTML_ARR, true )
						),
						'<strong>' . esc_html__( 'by giving it 5 stars rating', 'instagram-blocks' ) . '</strong>'
					);
					?>
				</p>
				<div class="button-group">
					<a href="<?php echo esc_url( INBLOCKS_PLUGIN_WPORG_RATE ); ?>" target="_blank" class="button button-primary">
						<?php echo esc_html__( 'Rate us @ WordPress.org', 'instagram-blocks' ); ?>
						<i class="dashicons dashicons-external"></i>
					</a>
					<a href="<?php echo esc_url( add_query_arg( array( 'page' => 'inblocks_settings', 'action' => 'inblocks_dismiss_rating_notice', '_wpnonce' => wp_create_nonce( 'inblocks_rating_notice_nonce' ) ), admin_url( $admin_page ) ) ); ?>" class="button">
						<?php echo esc_html__( 'I already did', 'instagram-blocks' ); ?>
					</a>
					<a href="<?php echo esc_url( add_query_arg( array( 'page' => 'inblocks_settings', 'action' => 'inblocks_dismiss_rating_notice', '_wpnonce' => wp_create_nonce( 'inblocks_rating_notice_nonce' ) ), admin_url( $admin_page ) ) ); ?>" class="button">
						<?php echo esc_html__( "Don't show this notice again!", 'instagram-blocks' ); ?>
					</a>
				</div>
			</div>
		<?php
	}
}

add_action( 'admin_notices', __NAMESPACE__ . '\inblocks_display_rating_notice' );
