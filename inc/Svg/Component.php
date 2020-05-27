<?php
/**
 * Forsite\Svg\Component class
 *
 * @package forsite
 */

namespace Forsite\Svg;

use Forsite\Component_Interface;
use Forsite\Templating_Component_Interface;

/**
 * Class for managing colors.
 */
class Component implements Component_Interface, Templating_Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'svg';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `forsite()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs.
	 */
	public function template_tags() : array {
		return [
			'svg' => [ $this, 'svg' ],
			'display_svg' => [ $this, 'display_svg' ],
		];
	}

	public function svg_shortcodes() {
		add_shortcode( 'svg_image', [ $this, 'svg_image_shortcode' ] );
	}

	/**
	 * Returns the SVG file contents.
	 *
	 * @param array $args
	 * @return string
	 */
	public function svg( $args = [] ) {

		// Make sure $args are an array.
		if ( empty( $args ) ) {
			return esc_html__( 'Please define default parameters in the form of an array.', 'uuups' );
		}

		$svg = '';

		// Set defaults.
		$defaults = [
			'icon' => 'link',
			'path' => false,
			'class' => false,
			'size' => false,
			'decor-only' => true,
			'focusable' => false,
		];

		// Parse args.
		$args = wp_parse_args( $args, $defaults );

		$icons = $args['icon'];

		// Make sure $icons are an array.
		if ( is_array( $icons ) ) {
			foreach ( $icons as $icon ) {
				// Set ARIA.
				$aria_label = ' role="img" aria-label="' . esc_attr( $icon ) . '"';
				$aria_hidden = ' aria-hidden="true"';
				$is_info = $args['decor-only'] ? $aria_hidden : $aria_label;
				$is_size = $args['size'] ? ' width="' . $args['size'] . '"' : '';

				$svg_content = file_get_contents( $this->path( "{$icon}.svg" ) );

				$svg .= str_replace( '<svg', '<svg focusable="false" class="' . esc_attr( $args['class'] ) . ' v-image v-' . $icon . '"' . $is_info . $is_size, $svg_content );
			}
		} else { // Single icon.
			// Set ARIA.
			$aria_label = ' role="img" aria-label="' . esc_attr( $icons ) . '"';
			$aria_hidden = ' aria-hidden="true"';
			$is_info = $args['decor-only'] ? $aria_hidden : $aria_label;
				$is_size = $args['size'] ? ' width="' . $args['size'] . '"' : '';

			if ( $args['path'] ) {
				$svg_content = file_get_contents( $args['path'] );
			} else {
				$svg_content = file_get_contents( $this->path( "{$icons}.svg" ) );
			}

			$svg = str_replace( '<svg', '<svg focusable="false" class="' . esc_attr( $args['class'] ) . ' v-image v-' . $icons . '"' . $is_info . $is_size, $svg_content );
		}

		return $svg ?: false;
	}

	/**
	 * Displays the SVG.
	 *
	 * @param string $icons.
	 * @return void
	 */
	public function display_svg( $icons ) {
		echo $this->svg( $icons );
	}

	/**
	 * Returns the path to the SVG folder or file if set.
	 *
	 * @return string
	 */
	public function path( $file = '' ) {

		$file = trim( $file, '/' );

		return get_theme_file_path( $file ? "dist/images/{$file}" : 'dist/images' );
	}
}
