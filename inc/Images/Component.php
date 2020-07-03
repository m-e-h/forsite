<?php
declare( strict_types=1 );
/**
 * Forsite\Images\Component class
 *
 * @package forsite
 */

namespace Forsite\Images;

use Forsite\Component_Interface;
use WP_Post;
use function add_filter;
use function add_action;
use function add_theme_support;
use function add_image_size;

/**
 * Class for managing responsive image sizes.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string {
		return 'images';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', [ $this, 'action_add_post_thumbnail_support' ] );
		add_action( 'after_setup_theme', [ $this, 'action_add_image_sizes' ] );
		add_filter( 'wp_calculate_image_sizes', [ $this, 'filter_content_image_sizes_attr' ], 10, 2 );
		add_filter( 'wp_get_attachment_image_attributes', [ $this, 'filter_post_thumbnail_sizes_attr' ], 10, 3 );
	}

	/**
	 * Adds support for post thumbnails.
	 */
	public function action_add_post_thumbnail_support() {
		add_theme_support( 'post-thumbnails' );
	}

	/**
	 * Adds custom image sizes.
	 */
	public function action_add_image_sizes() {
		add_image_size( 'theme-featured', 720, 480, true );
		add_image_size( 'theme-square-med', 600, 600, true );
		add_image_size( 'theme-square-lg', 1024, 1024, true );
	}

	/**
	 * Custom image sizes attribute to enhance responsive images for content images.
	 *
	 * @param string $sizes A source size value for use in a 'sizes' attribute.
	 * @param array $size Image width and height in pixels.
	 * @return string Size value for use in a content image 'sizes' attribute.
	 */
	public function filter_content_image_sizes_attr( string $sizes, array $size ): string {
		$width = $size[0];

		if ( 740 <= $width ) {
			$sizes = '100vw';
		}

		if ( is_active_sidebar( 'primary' ) ) {
			$sizes = '(min-width: 960px) 75vw, 100vw';
		}

		return $sizes;
	}

	/**
	 * Custom image sizes attribute to enhance responsive images for post thumbnails.
	 *
	 * @param array $attr Attributes for the image markup.
	 * @param WP_Post $attachment Attachment post object.
	 * @param string|array $size Registered image size or flat array of height and width.
	 * @return array The filtered attributes for the image markup.
	 */
	public function filter_post_thumbnail_sizes_attr( array $attr, WP_Post $attachment, $size ): array {
		$attr['sizes'] = '100vw';

		return $attr;
	}
}
