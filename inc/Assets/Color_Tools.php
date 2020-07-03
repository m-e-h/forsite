<?php
declare( strict_types=1 );
/**
 * Forsite\Assets\Color_Tools class
 *
 * @package forsite
 */

namespace Forsite\Assets;

use Forsite\Component_Interface;
use Forsite\Templating_Component_Interface;

/**
 * Class for managing colors.
 */
class Color_Tools implements Component_Interface, Templating_Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string {
		return 'color_tools';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `forsite()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags(): array {
		return [
			'sanitize_hex_color_add_hash' => [ $this, 'sanitize_hex_color_add_hash' ],
			'default_primary_color' => [ $this, 'default_primary_color' ],
			'default_accent_color' => [ $this, 'default_accent_color' ],
			'get_background_hex' => [ $this, 'get_background_hex' ],
			'default_background_color' => [ $this, 'default_background_color' ],
			'default_foreground_color' => [ $this, 'default_foreground_color' ],
			'hex_to_rgb' => [ $this, 'hex_to_rgb' ],
		];
	}

	/**
	 * Makes sure a hex color is returned with a #.
	 *
	 * @param string $color .
	 * @return string #hex.
	 */
	public function sanitize_hex_color_add_hash( string $color ): string {
		if ( $unhashed = sanitize_hex_color_no_hash( $color ) == true ) {
			return '#' . $unhashed;
		}

		return sanitize_hex_color( $color );
	}

	/**
	 * Default primary color hex.
	 *
	 * @param  string $color = #hex.
	 * @return string #hex.
	 */
	public function default_primary_color( string $color = '#74b74a' ): string {

		if ( ! is_customize_preview() ) {
			return get_theme_mod( 'primary_color', $color );
		}
		return $this->sanitize_hex_color_add_hash( $color );
	}

	/**
	 * Default accent color hex.
	 *
	 * @param string $color .
	 * @return string #hex.
	 */
	public function default_accent_color( string $color = '#b74a4a' ): string {

		if ( ! is_customize_preview() ) {
			return get_theme_mod( 'accent_color', $color );
		}
		return $this->sanitize_hex_color_add_hash( $color );
	}

	/**
	 * Default background color hex.
	 *
	 * @return string #hex.
	 */
	public function get_background_hex(): string {

		$color = get_background_color();

		$color = $color ?: 'ffffff';

		return $this->sanitize_hex_color_add_hash( $color );
	}

	/**
	 * Default background color hex.
	 *
	 * @param string $color .
	 * @return string #hex.
	 */
	public function default_background_color( string $color = '#ffffff' ): string {

		if ( ! is_customize_preview() ) {
			$color = get_background_color() ?: 'ffffff';
		}

		return $this->sanitize_hex_color_add_hash( $color );
	}

	/**
	 * Default foreground color hex.
	 *
	 * @param string $color .
	 * @return string #hex.
	 */
	public function default_foreground_color( string $color = '#000000' ): string {

		if ( ! is_customize_preview() ) {
			return get_theme_mod( 'foreground_color', $color );
		}
		return $this->sanitize_hex_color_add_hash( $color );
	}

	/**
	 * Converts a hex color to RGB.  Returns the RGB values as an array.
	 *
	 * @param string $hex .
	 * @return array rgb value
	 */
	public function hex_to_rgb( string $hex ): array {

		$color = trim( $hex, '#' );

		if ( strlen( $color ) == 3 ) {

			$r = hexdec( $color[0] . $color[0] );
			$g = hexdec( $color[1] . $color[1] );
			$b = hexdec( $color[2] . $color[2] );

		} elseif ( strlen( $color ) == 6 ) {

			$r = hexdec( $color[0] . $color[1] );
			$g = hexdec( $color[2] . $color[3] );
			$b = hexdec( $color[4] . $color[5] );

		} elseif ( strlen( $color ) == 8 ) {

			$r = hexdec( $color[0] . $color[1] );
			$g = hexdec( $color[2] . $color[3] );
			$b = hexdec( $color[4] . $color[5] );
			$a = hexdec( $color[6] . $color[7] );

			return [ $r, $g, $b, $a ];

		} else {

			return [];

		}

		return [ $r, $g, $b ];
	}
}
