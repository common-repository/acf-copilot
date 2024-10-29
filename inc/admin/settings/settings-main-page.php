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

$inblocks_admin = new INBLOCKS_Admin;

$has_user_cap = $inblocks_admin->check_user_cap();

?>
<div class="inblocks-admin">
	<div class="inblocks-loading-bar"></div>
	<div id="inblocks-output" class="notice is-dismissible inblocks-output"></div>
	<?php settings_errors( 'inblocks_settings_errors' ); ?>

	<div class="inblocks-pro">
		<h4>
			<?php echo esc_html__( 'Get the PRO version today!', 'instagram-blocks' ); ?>
		</h4>

		<p>
			<?php echo esc_html__( 'With the PRO version you will get a lot more features with better performance and quicker recovery process.', 'instagram-blocks' ); ?>
		</p>

		<table>
			<tr>
				<th><?php echo esc_html__( 'Feature', 'instagram-blocks' ); ?></th>
				<th><?php echo esc_html__( 'Free', 'instagram-blocks' ); ?></th>
				<th><?php echo esc_html__( 'PRO', 'instagram-blocks' ); ?></th>
			</tr>
			<tr>
				<td><?php echo esc_html__( 'InstaBlocks', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'image only', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'image, video & gallery', 'instagram-blocks' ); ?></td>
			</tr>
			<tr>
				<td><?php echo esc_html__( 'Integrated Instagram Auth', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'no', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'yes', 'instagram-blocks' ); ?></td>
			</tr>
			<tr>
				<td><?php echo esc_html__( 'Image Block', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'yes', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'yes', 'instagram-blocks' ); ?></td>
			</tr>
			<tr>
				<td><?php echo esc_html__( 'Video and Gallery Blocks', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'no', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'yes', 'instagram-blocks' ); ?></td>
			</tr>
			<tr>
				<td><?php echo esc_html__( 'Block Edit Mode', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'no', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'yes', 'instagram-blocks' ); ?></td>
			</tr>
			<tr>
				<td><?php echo esc_html__( 'Block Preview Mode', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'yes', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'yes', 'instagram-blocks' ); ?></td>
			</tr>
			<tr>
				<td><?php echo esc_html__( 'Embed Custom Controls', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'limited', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'all', 'instagram-blocks' ); ?></td>
			</tr>
			<tr>
				<td><?php echo esc_html__( 'Heading and Caption Controls', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'no', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'yes', 'instagram-blocks' ); ?></td>
			</tr>
			<tr>
				<td><?php echo esc_html__( 'Built-in Block Editor Controls', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'yes', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'yes', 'instagram-blocks' ); ?></td>
			</tr>
			<tr>
				<td><?php echo esc_html__( 'Insert Public URLs', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'yes', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'yes', 'instagram-blocks' ); ?></td>
			</tr>
			<tr>
				<td><?php echo esc_html__( 'Priority email support', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'no', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'yes', 'instagram-blocks' ); ?></td>
			</tr>
			<tr>
				<td><?php echo esc_html__( 'Regular plugin updates', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'delayed', 'instagram-blocks' ); ?></td>
				<td><?php echo esc_html__( 'first release', 'instagram-blocks' ); ?></td>
			</tr>
		</table>

		<p class="button-group">
			<a
				class="button button-primary button-pro"
				href="https://bit.ly/49TyR9K"
				target="_blank"
			>
				<?php echo esc_html__( 'GET PRO VERSION', 'instagram-blocks' ); ?>
			</a>
			<a
				class="button button-primary button-watch-video"
				href="https://www.youtube.com/watch?v=ePlPkyjaazA"
				target="_blank"
			>
				<?php echo esc_html__( 'Watch Video', 'instagram-blocks' ); ?>
			</a>
		</p>
	</div>

	<h2>
		<?php echo esc_html__( 'Instagram Blocks', 'instagram-blocks' ); ?>
	</h2>

	<p>
		<?php
		printf(
			wp_kses(
				__( 'Loading Instagram media into your WordPress posts and pages within the Block Editor has never been easier.' ),
				json_decode( INBLOCKS_PLUGIN_ALLOWED_HTML_ARR, true )
			),
		);
		?>
	</p>

	<hr />

	<form method="post" action="<?php echo esc_url( admin_url( 'options.php' ) ); ?>">
		<?php wp_nonce_field( 'inblocks_security', 'inblocks_nonce' ); ?>
		<?php
			settings_fields( INBLOCKS_SETTINGS_SLUG );
			do_settings_sections( INBLOCKS_SETTINGS_SLUG );
		?>
		<p class="submit button-group">
			<button
				type="submit"
				class="button button-primary"
				id="inblocks-save-settings"
				name="inblocks-save-settings"
			>
				<?php echo esc_html__( 'Save', 'instagram-blocks' ); ?>
			</button>
			<button
				type="button"
				class="button"
				id="inblocks-reset-settings"
				name="inblocks-reset-settings"
			>
				<?php echo esc_html__( 'Reset', 'instagram-blocks' ); ?>
			</button>
		</p>
	</form>

	<br clear="all" />

	<hr />

	<div class="inblocks-support-credits">
		<p>
			<?php
			printf(
				wp_kses(
					/* translators: %1$s is replaced with "Link to WP.org support forums" */
					__( 'If something is not clear, please open a ticket on the official plugin %1$s. All tickets should be addressed within a couple of working days.', 'instagram-blocks' ),
					json_decode( INBLOCKS_PLUGIN_ALLOWED_HTML_ARR, true )
				),
				'<a href="' . esc_url( INBLOCKS_PLUGIN_WPORG_RATE ) . '" target="_blank">' . esc_html__( 'Support Forum', 'instagram-blocks' ) . '</a>'
			);
			?>
		</p>
		<p>
			<strong><?php echo esc_html__( 'Please rate us', 'instagram-blocks' ); ?></strong>
			<a href="<?php echo esc_url( INBLOCKS_PLUGIN_WPORG_RATE ); ?>" target="_blank">
				<img src="<?php echo esc_url( INBLOCKS_PLUGIN_DIR_URL ); ?>assets/dist/img/rate.png" alt="Rate us @ WordPress.org" />
			</a>
		</p>
		<p>
			<strong><?php echo esc_html__( 'Having issues?', 'instagram-blocks' ); ?></strong> 
			<a href="<?php echo esc_url( INBLOCKS_PLUGIN_WPORG_RATE ); ?>" target="_blank">
				<?php echo esc_html__( 'Create a Support Ticket', 'instagram-blocks' ); ?>
			</a>
		</p>
		<p>
			<strong><?php echo esc_html__( 'Developed by', 'instagram-blocks' ); ?></strong>
			<a href="https://<?php echo esc_url( INBLOCKS_PLUGIN_DOMAIN ); ?>" target="_blank">
				<?php echo esc_html__( 'Krasen Slavov @ Developry', 'instagram-blocks' ); ?>
			</a>
		</p>
	</div>

	<hr />

	<p>
		<small>
			<?php
			printf(
				wp_kses(
					/* translators: %1$s is replaced with "Link to Patreon" */
					__( '* For the price of a cup of coffee per month, you can help and support me on %1$s in continuing to develop and maintain all of my free WordPress plugins, every little bit helps and is greatly appreciated!', 'instagram-blocks' ),
					json_decode( INBLOCKS_PLUGIN_ALLOWED_HTML_ARR, true )
				),
				'<a href="https://patreon.com/krasenslavov" target="_blank">' . esc_html__( 'Patreon', 'instagram-blocks' ) . '</a>'
			);
			?>
		</small>
	</p>
</div>
