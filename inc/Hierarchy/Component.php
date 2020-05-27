<?php
/**
 * Forsite\AMP\Component class
 *
 * @package forsite
 */

namespace Forsite\AMP;

use Forsite\Component_Interface;
use Forsite\Templating_Component_Interface;
use function add_action;

/**
 * Class for managing AMP support.
 *
 * Exposes template tags:
 * * `forsite()->is_amp()`
 * * `forsite()->using_amp_live_list_comments()`
 *
 * @link https://wordpress.org/plugins/amp/
 */
class Component implements Component_Interface, Templating_Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'amp';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'wp_loaded', [ $this, 'gutenberg_add_template_loader_filters' ] );
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `forsite()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs.
	 */
	public function template_tags() : array {
		return [
			'is_amp' => [ $this, 'is_amp' ],
		];
	}

	/**
	 * Return a list of all overrideable default template types.
	 *
	 * @see get_query_template
	 *
	 * https://github.com/WordPress/gutenberg/blob/master/lib/template-loader.php
	 *
	 * @return string[] List of all overrideable default template types.
	 */
	public function get_template_types() {
		return [
			'index',
			'404',
			'archive',
			'author',
			'category',
			'tag',
			'taxonomy',
			'date',
			'embed',
			'home',
			'front-page',
			'privacy-policy',
			'page',
			'search',
			'single',
			'singular',
			'attachment',
		];
	}

	/**
	 * Adds necessary filters to use 'wp_template' posts instead of theme template files.
	 */
	public function gutenberg_add_template_loader_filters() {
		if ( ! post_type_exists( 'wp_template' ) ) {
			return;
		}

		foreach ( $this->get_template_types() as $template_type ) {
			if ( 'embed' === $template_type ) { // Skip 'embed' for now because it is not a regular template type.
				continue;
			}
			add_filter( str_replace( '-', '', $template_type ) . '_template', 'gutenberg_override_query_template', 20, 3 );
		}
	}

	/**
	 * Get the template hierarchy for a given template type.
	 *
	 * Internally, this filters into the "{$type}_template_hierarchy" hook to record the type-specific template hierarchy.
	 *
	 * @param string $template_type A template type.
	 * @return string[] A list of template candidates, in descending order of priority.
	 */
	public function get_template_hierachy( $template_type ) {
		if ( ! in_array( $template_type, $this->get_template_types(), true ) ) {
			return [];
		}

		$get_template_function = 'get_' . str_replace( '-', '_', $template_type ) . '_template'; // front-page -> get_front_page_template.
		$template_hierarchy_filter = str_replace( '-', '', $template_type ) . '_template_hierarchy'; // front-page -> frontpage_template_hierarchy.

		$result = [];
		$template_hierarchy_filter_function = function( $templates ) use ( &$result ) {
			$result = $templates;
			return $templates;
		};

		add_filter( $template_hierarchy_filter, $template_hierarchy_filter_function, 20, 1 );
		call_user_func( $get_template_function ); // This invokes template_hierarchy_filter.
		remove_filter( $template_hierarchy_filter, $template_hierarchy_filter_function, 20 );

		return $result;
	}

}
