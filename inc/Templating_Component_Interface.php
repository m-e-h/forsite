<?php
/**
 * Forsite\Templating_Component_Interface interface
 *
 * @package forsite
 */

namespace Forsite;

/**
 * Interface for a theme component that exposes template tags.
 */
interface Templating_Component_Interface {

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `forsite()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs.
	 */
	public function template_tags() : array;
}
