<?php
/**
 * Templates manager.
 *
 * This class is just a wrapper around the `Collection` class for adding a
 * specific type of data.  Essentially, we make sure that anything added to the
 * collection is in fact a `Template`.
 */

namespace TIP\Template;

use TIP\Collection;

/**
 * Template collection class.
 *
 * @since  5.0.0
 * @access public
 */
class Templates extends Collection {

	/**
	 * Add a new template.
	 *
	 * @since  5.0.0
	 * @access public
	 * @param  string $name
	 * @param  mixed  $value
	 * @return void
	 */
	public function add( $name, $value ) {

		parent::add( $name, new Template( $name, $value ) );
	}
}
