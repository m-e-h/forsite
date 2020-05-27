<?php
/**
 * Template hierarchy service provider.
 *
 * This is the service provider for the template hierarchy. It's used to register
 * the template hierarchy with the container and boot it when needed.
 */

namespace TIP\Template;

use TIP\Template\Hierarchy as TemplateHierarchy;
use TIP\ServiceProvider;

/**
 * Template hierarchy provider class.
 *
 * @since  5.0.0
 * @access public
 */
class HierarchyServiceProvider extends ServiceProvider {

	/**
	 * Registration callback that adds a single instance of the template
	 * hierarchy to the container.
	 *
	 * @since  5.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		$this->app->singleton( TemplateHierarchy::class, Hierarchy::class );

		$this->app->alias( TemplateHierarchy::class, 'template/hierarchy' );
	}

	/**
	 * Boots the hierarchy by firing its hooks in the `boot()` method.
	 *
	 * @since  5.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		$this->app->resolve( 'template/hierarchy' )->boot();
	}
}
