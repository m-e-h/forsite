<?php
/**
 * Theme functions file.
 *
 * This file is used to bootstrap the theme.
 *
 * @package   Forsite
 * @author    Marty Helmick <info@martyhelmick.com>
 * @copyright 2018 Marty Helmick
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/m-e-h/forsite
 */

// Bootstrap the theme.
require_once( get_parent_theme_file_path( 'app/bootstrap-autoload.php' ) );

// Create a new application.
$forsite = new \Hybrid\Core\Application();

// Register service providers with the application.
$forsite->provider( \Forsite\Customize\Provider::class );

// Creates an action hook for child themes (or plugins).
// Passes application instance to the action callback.
do_action( 'forsite/bootstrap', $forsite );

// Bootstrap the application.
$forsite->boot();

// Move views/ to a top level folder.
add_filter(
	'hybrid/template/path',
	function( $path ) {
		return 'views';
	}
);
