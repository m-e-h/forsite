<?php
declare( strict_types=1 );
/**
 * Forsite\Accessibility\Component class
 *
 * @package forsite
 */

namespace Forsite\Accessibility;

use Forsite\Component_Interface;
use function Forsite\forsite;
use WP_Post;
use function add_action;
use function add_filter;
use function wp_enqueue_script;
use function get_theme_file_uri;
use function get_theme_file_path;
use function wp_script_add_data;
use function wp_localize_script;

/**
 * Class for improving accessibility among various core features.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string {
		return 'accessibility';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'wp_enqueue_scripts', [ $this, 'action_enqueue_navigation_script' ] );
		add_filter( 'nav_menu_link_attributes', [ $this, 'filter_nav_menu_link_attributes_aria_current' ], 10, 2 );
		add_filter( 'page_menu_link_attributes', [ $this, 'filter_nav_menu_link_attributes_aria_current' ], 10, 2 );
	}

	/**
	 * Enqueues a script that improves navigation menu accessibility.
	 */
	public function action_enqueue_navigation_script() {

		// If the AMP plugin is active, return early.
		if ( forsite()->is_amp() ) {
			return;
		}

		// Enqueue the navigation script.
		wp_enqueue_script(
			'forsite-navigation',
			get_theme_file_uri( '/assets/js/navigation.min.js' ),
			[],
			forsite()->get_asset_version( get_theme_file_path( '/assets/js/navigation.min.js' ) ),
			false
		);
		wp_script_add_data( 'forsite-navigation', 'async', true );
		wp_script_add_data( 'forsite-navigation', 'precache', true );
		wp_localize_script(
			'forsite-navigation',
			'ForsiteThemeScreenReaderText',
			[
				'expand' => __( 'Expand child menu', 'forsite' ),
				'collapse' => __( 'Collapse child menu', 'forsite' ),
			]
		);
	}

	/**
	 * Filters the HTML attributes applied to a menu item's anchor element.
	 *
	 * Checks if the menu item is the current menu item and adds the aria "current" attribute.
	 *
	 * @param array   $atts The HTML attributes applied to the menu item's `<a>` element.
	 * @param WP_Post $item The current menu item.
	 * @return array Modified HTML attributes
	 */
	public function filter_nav_menu_link_attributes_aria_current( array $atts, WP_Post $item ): array {
		if ( isset( $item->current ) ) {
			if ( $item->current ) {
				$atts['aria-current'] = 'page';
			}
		} elseif ( ! empty( $item->ID ) ) {
			global $post;

			if ( ! empty( $post->ID ) && (int) $post->ID === (int) $item->ID ) {
				$atts['aria-current'] = 'page';
			}
		}

		return $atts;
	}
}
