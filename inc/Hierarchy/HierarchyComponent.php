<?php
/**
 * TIP\Template\HierarchyComponent class
 *
 * @package tip
 */

namespace TIP\Template;

use TIP\Component_Interface;
use TIP\Templating_Component_Interface;
use TIP\Template\Hierarchy;
use TIP\Proxies\App;

/**
 * Class for managing colors.
 */
class HierarchyComponent implements Component_Interface, Templating_Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'hierarchycomponent';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `tip()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs.
	 */
	public function template_tags() : array {
		return [
			'inherit' => [ $this, 'inherit' ],
			'locate' => [ $this, 'locate' ],
			'path' => [ $this, 'path' ],
			'locations' => [ $this, 'locations' ],
			'filter_templates' => [ $this, 'filter_templates' ],
		];
	}

	/**
	 * Returns the global hierarchy. This is a wrapper around the values stored via
	 * the template hierarchy object.
	 *
	 * @since  5.0.0
	 * @access public
	 * @return array
	 */
	public function inherit() {

		return apply_filters(
			'tip/template/hierarchy',
			App::resolve( Hierarchy::class )->hierarchy()
		);
	}

	/**
	 * A better `locate_template()` function than what core WP provides. Note that
	 * this function merely locates templates and does no loading. Use the core
	 * `load_template()` function for actually loading the template.
	 *
	 * @since  5.0.0
	 * @access public
	 * @param  array|string $templates
	 * @return string
	 */
	public function locate( $templates ) {
		$located = '';

		foreach ( (array) $templates as $template ) {

			foreach ( $this->locations() as $location ) {

				$file = trailingslashit( $location ) . $template;

				if ( file_exists( $file ) ) {
					$located = $file;
					break 2;
				}
			}
		}

		return $located;
	}

	/**
	 * Returns the relative path to where templates are held in the theme.
	 *
	 * @since  5.0.0
	 * @access public
	 * @param  string $file
	 * @return string
	 */
	public function path( $file = '' ) {

		$file = ltrim( $file, '/' );
		$path = apply_filters( 'tip/template/path', '' );

		return $file ? trailingslashit( $path ) . $file : $path;
	}

	/**
	 * Returns an array of locations to look for templates.
	 *
	 * Note that this won't work with the core WP template hierarchy due to an
	 * issue that hasn't been addressed since 2010.
	 *
	 * @link   https://core.trac.wordpress.org/ticket/13239
	 * @since  5.0.0
	 * @access public
	 * @return array
	 */
	public function locations() {

		$path = ltrim( $this->path(), '/' );

		// Add active theme path.
		$locations = [ get_theme_file_path( $path ) ];

		return (array) apply_filters( 'tip/template/locations', $locations );
	}

	/**
	 * Filters an array of templates and prefixes them with the view path.
	 *
	 * @since  5.0.0
	 * @access public
	 * @param  array $templates
	 * @return array
	 */
	public function filter_templates( $templates ) {

		$path = $this->path();

		if ( $path ) {
			array_walk(
				$templates,
				function( &$template, $key ) use ( $path ) {

					$template = ltrim( str_replace( $path, '', $template ), '/' );

					$template = "{$path}/{$template}";
				}
			);
		}

		return $templates;
	}
}
