<?php
/**
 * [Short Description]
 *
 * @package    DEVRY\INBLOCKS
 * @copyright  Copyright (c) 2024, Developry Ltd.
 * @license    https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since      1.1
 */

namespace DEVRY\INBLOCKS;

! defined( ABSPATH ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'Instagram_Blocks' ) ) {

	class Instagram_Blocks {
		// Instance of the INBLOCKS_Admin class.
		public $inblocks_admin;

		// Array of supported post types.
		public $types_supported;

		// Array of user access levels.
		public $user_access;

		// Compact mode for the menu options.
		public $compact_mode;

		/**
		 * Consturtor.
		 */
		public function __construct() {
			// Instantiate the INBLOCKS_Admin class.
			$this->inblocks_admin = new INBLOCKS_Admin;

			// Use some defaults for the Options, for initial plugin usage.
			$this->types_supported = array( 'post', 'page' );
			$this->user_access     = array( 'administrator' );
			$this->compact_mode    = ''; // No

			// Retrieve from options, if available; otherwise, use the default values.
			$this->types_supported = get_option( 'inblocks_types_supported', $this->types_supported );
			$this->user_access     = get_option( 'inblocks_user_access', $this->user_access );
			$this->compact_mode    = get_option( 'inblocks_compact_mode', $this->compact_mode );
		}

		/**
		 * Initializor.
		 */
		public function init() {
			add_action( 'wp_loaded', array( $this, 'on_loaded' ) );
		}

		/**
		 * Plugin loaded.
		 */
		public function on_loaded() {
			add_filter( 'block_categories_all', array( $this, 'add_instagram_category' ), 10, 2 );
		}

		/**
		 * Adds an Instagram category, 'InstaBlocks', to the list of post
		 * categories.
		 */
		public function add_instagram_category( $categories, $post ) {
			return array_merge(
				$categories,
				array(
					array(
						'slug'  => 'instablocks',
						'title' => esc_html__( 'InstaBlocks', 'instagram-blocks' ),
					),
				)
			);
		}

		/**
		 * Removes specified Instagram Blocks ('image', 'video', 'gallery') from
		 * the content of all supported post types.
		 */
		public function remove_from_content() {
			$blocks = array(
				'image',
				'video',
				'gallery',
			);

			$query = new \WP_Query(
				array(
					'post_type'      => $this->types_supported,
					'posts_per_page' => -1,
				)
			);

			if ( $query->have_posts() ) {
				$posts = $query->get_posts();

				foreach ( $posts as $post ) {
					if ( $post ) {
						$post_content_new = $post->post_content;

						foreach ( $blocks as $block ) {
							$post_content_new = preg_replace(
								"/<!--\s*wp:inblocks\/{$block}[^>]*-->.*?<!--\s*\/wp:inblocks\/{$block}\s*-->/s",
								'',
								$post_content_new
							);
						}

						wp_update_post(
							array(
								'ID'           => $post->ID,
								'post_content' => $post_content_new,
							)
						);
					}
				}
			}
		}
	}

	$inblocks = new Instagram_Blocks;
	$inblocks->init();
}
