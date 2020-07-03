<?php
declare( strict_types=1 );
/**
 * Forsite\Assets\Component class
 *
 * @package forsite
 */

namespace Forsite\Assets;

use Forsite\Component_Interface;
use Forsite\Templating_Component_Interface;
use function add_action;
use function wp_enqueue_style;
use function get_theme_file_uri;
use function add_query_arg;
use function is_child_theme;
use function get_parent_theme_file_path;
use function get_parent_theme_file_uri;
use function wp_get_theme;

/**
 * Class for managing scripts and styles.
 *
 * Exposes template tags:
 * * `forsite()->is_script_debug()`
 * * `forsite()->asset()`
 */
class Component implements Component_Interface, Templating_Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string {
		return 'assets';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'wp_enqueue_scripts', [ $this, 'action_enqueue_scripts' ] );
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `forsite()`.
	 */
	public function template_tags(): array {
		return [
			'is_script_debug' => [ $this, 'is_script_debug' ],
			'asset' => [ $this, 'asset' ],
		];
	}

	/**
	 * Registers or enqueues scripts and styles.
	 */
	public function action_enqueue_scripts() {

		wp_enqueue_style( 'theme_font', $this->font_url(), false, null );

		// Enqueue theme scripts.
		wp_enqueue_script( 'forsite-script', get_theme_file_uri( 'dist/js/main.js' ), false, false, true );

		// Enqueue theme styles.
		if ( $this->is_script_debug() ) {
			wp_enqueue_style( 'forsite-style', $this->asset( 'style.css' ), false, null );
		} else {
			wp_enqueue_style( 'forsite-style', $this->asset( 'dist/css/main.css' ), false, null );
		}
	}

	/**
	 * Returns Google Fonts url to enqueue.
	 *
	 * @return string URL.
	 */
	public function font_url(): string {
		$url = '';
		$fonts = [];
		$display = 'swap';

		// $fonts['0'] = 'Work+Sans:ital,wght@0,100;0,200;0,300;1,100;1,200';
		// $fonts['1'] = 'Literata';

		if ( ! empty( $fonts ) ) {

			$url = add_query_arg(
				[
					'family' => implode( '&family=', $fonts ),
					'display' => $display,
				], 'https://fonts.googleapis.com/css2'
			);
		}

		return esc_url( $url );
	}

	/**
	 * Conditional check to determine if we are in script debug mode.
	 *
	 * @access public
	 * @return bool
	 */
	public function is_script_debug(): bool {
		return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG;
	}

	/**
	 * Helper function for cache busting. Append an ID to the filename.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param string $path A relative path/file to append to the `dist` folder.
	 * @return string
	 */
	public function asset( string $path ): string {

		// Make sure to trim any slashes from the front of the path.
		$path = '/' . ltrim( $path, '/' );

		// Cache the filetime so that we only read it in once.
		static $file_ver = null;

		if ( null === $file_ver ) {
			if ( ! is_child_theme() || $this->is_script_debug() ) {
				$file_ver = filemtime( get_parent_theme_file_path( $path ) );
			} else {
				$file_ver = wp_get_theme()->get( 'Version' );
			}
		}

		return get_parent_theme_file_uri( "{$path}?ver={$file_ver}" );
	}
}
