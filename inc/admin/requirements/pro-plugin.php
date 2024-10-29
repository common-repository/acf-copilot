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
 * Don't allow to have both Free and Pro active at the same time.
 */
function inblocks_check_pro_plugin() {
	// Deactitve the Pro version if active.
	if ( is_plugin_active( 'instagram-blocks/instagram-blocks.php' ) ) {
		deactivate_plugins( 'instagram-blocks/instagram-blocks.php', true );
	}
}

register_activation_hook( INBLOCKS_PLUGIN_BASENAME, __NAMESPACE__ . '\inblocks_check_pro_plugin' );

/**
 * Display a promotion for the pro plugin.
 */
function inblocks_display_upgrade_notice() {
	if ( get_option( 'inblocks_upgrade_notice' ) && get_transient( 'inblocks_upgrade_plugin' ) ) {
		return;
	}

	$inblocks = new Instagram_Blocks();

	$admin_page = ( '' === $inblocks->compact_mode ) ? 'admin.php' : 'themes.php';
	?>
		<div class="notice notice-success is-dismissible inblocks-admin">
			<h3><?php echo esc_html__( 'Instagram Blocks PRO 🚀' ); ?></h3>
			<p>
				<?php
				printf(
					wp_kses(
						/* translators: %1$s is replaced with Found the free version helpful */
						/* translators: %2$s is replaced with Instagram Blocks Pro */
						__( '✨🎉📢 %1$s? Would you be interested in learning more about the benefits of upgrading to the %2$s? ' ),
						json_decode( INBLOCKS_PLUGIN_ALLOWED_HTML_ARR, true )
					),
					'<strong>' . esc_html__( 'Found the free version helpful', 'instagram-blocks' ) . '</strong>',
					'<strong>' . esc_html__( 'Instagram Blocks Pro', 'instagram-blocks' ) . '</strong>'
				);
				?>
				<!-- <br /> -->
				<?php
				// printf(
				// 	wp_kses(
				// 		/* translators: %1$s is replaced with promo code */
				// 		/* translators: %2$s is replaced with 10% off */
				// 		__( 'Use the %1$s code and get %2$s your purchase!' ),
				// 		json_decode( INBLOCKS_PLUGIN_ALLOWED_HTML_ARR, true )
				// 	),
				// 	'<code>' . esc_html__( 'INBLOCKS10', 'instagram-blocks' ) . '</code>',
				// 	'<strong>' . esc_html__( '10% off', 'instagram-blocks' ) . '</strong>'
				// );
				?>
			</p>
			<div class="button-group">
				<a href="https://bit.ly/3TBKQTu" target="_blank" class="button button-primary button-success">
					<?php echo esc_html__( 'Go Pro', 'instagram-blocks' ); ?>
					<i class="dashicons dashicons-external"></i>
				</a>
				<a href="<?php echo esc_url( add_query_arg( array( 'page' => 'inblocks_settings', 'action' => 'inblocks_dismiss_upgrade_notice', '_wpnonce' => wp_create_nonce( 'inblocks_upgrade_notice_nonce' ) ), admin_url( $admin_page ) ) ); ?>" class="button">
					<?php echo esc_html__( 'I already did', 'instagram-blocks' ); ?>
				</a>
				<a href="<?php echo esc_url( add_query_arg( array( 'page' => 'inblocks_settings', 'action' => 'inblocks_dismiss_upgrade_notice', '_wpnonce' => wp_create_nonce( 'inblocks_upgrade_notice_nonce' ) ), admin_url( $admin_page ) ) ); ?>" class="button">
					<?php echo esc_html__( "Don't show this notice again!", 'instagram-blocks' ); ?>
				</a>
			</div>
		</div>
	<?php
	delete_option( 'inblocks_upgrade_notice' );

	// Set the transient to last for 30 days.
	set_transient( 'inblocks_upgrade_plugin', true, 30 * DAY_IN_SECONDS );
}

add_action( 'admin_notices', __NAMESPACE__ . '\inblocks_display_upgrade_notice' );

