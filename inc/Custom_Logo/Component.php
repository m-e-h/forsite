<?php
/**
 * Forsite\Custom_Logo\Component class
 *
 * @package forsite
 */

namespace Forsite\Custom_Logo;

use Forsite\Component_Interface;
use function Forsite\forsite;
use function add_action;
use function add_theme_support;
use function apply_filters;

/**
 * Class for adding custom logo support.
 *
 * @link https://codex.wordpress.org/Theme_Logo
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'custom_logo';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', [ $this, 'action_add_custom_logo_support' ] );
		add_filter( 'get_custom_logo', [ $this, 'get_best_logo' ] );
	}

	/**
	 * Adds support for the Custom Logo feature.
	 */
	public function action_add_custom_logo_support() {
		add_theme_support(
			'custom-logo',
			apply_filters(
				'forsite_custom_logo_args',
				[
					'height' => 250,
					'width' => 250,
					'flex-width' => false,
					'flex-height' => false,
				]
			)
		);
	}

	/**
	 * If it's an SVG logo, use it inline.
	 *
	 * @return string — Custom logo markup.
	 */
	public function get_best_logo() {

		if ( ! has_custom_logo() ) {
			return;
		}

		$html = '';
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id );
		$file = pathinfo( $image[0] );
		$upload_dir = wp_get_upload_dir();

		// Strangely wp_upload_dir doesn’t return https for SSL websites.
		$url = is_ssl() ? str_replace( 'http://', 'https://', $upload_dir['baseurl'] ) : $upload_dir['baseurl'];

		// Get the relative path for the svg so we can add it to the basedir.
		$image_rel_path = str_replace( [ home_url( $url ), $url ], '', $image[0] );
		$image_path = $upload_dir['basedir'] . $image_rel_path;

		// Inline the SVG if it's there.
		if ( file_exists( $image_path ) && 'svg' == $file['extension'] ) {

			$html = sprintf(
				'<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>',
				esc_url( home_url( '/' ) ),
				forsite()->svg(
					[
						'path' => $image_path,
						'icon' => $file['filename'],
					]
				)
			);

		}

		return $html;
	}
}
