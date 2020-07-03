<?php
declare( strict_types=1 );
/**
 * Forsite\PWA\Component class
 *
 * @package forsite
 */

namespace Forsite\PWA;

use Forsite\Component_Interface;
use Forsite\Templating_Component_Interface;
use function add_action;
use function add_theme_support;
use function is_offline;
use function is_500;

/**
 * Class for managing PWA support.
 *
 * @link https://wordpress.org/plugins/pwa/
 */
class Component implements Component_Interface, Templating_Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string {
		return 'pwa';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', [ $this, 'action_add_service_worker_support' ] );
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `forsite()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs.
	 */
	public function template_tags(): array {
		return [
			'is_offline' => [ $this, 'is_type_offline' ],
			'is_500' => [ $this, 'is_type_500' ],
		];
	}

	/**
	 *
	 * @return bool
	 */
	public function is_type_offline(): bool {
		if ( function_exists( 'is_offline' ) ) {
			return is_offline();
		}
		return false;
	}

	/**
	 *
	 * @return bool
	 */
	public function is_type_500(): bool {
		if ( function_exists( 'is_500' ) ) {
			return is_500();
		}
		return false;
	}

	/**
	 * Adds support for theme-specific service worker integrations.
	 */
	public function action_add_service_worker_support() {
		add_theme_support( 'service_worker', true );
	}
}
