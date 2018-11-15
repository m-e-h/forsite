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


# Compatibility check.
#
# Check that the site meets the minimum requirements for the theme before
# proceeding if this is a theme for public release. If building for a client
# that meets these requirements, this code is unnecessary.

if ( version_compare( $GLOBALS['wp_version'], '4.9.6', '<' ) || version_compare( PHP_VERSION, '5.6', '<' ) ) {

	require_once( get_parent_theme_file_path( 'app/bootstrap-compat.php' ) );
	return;
}


# Bootstrap the theme.
#
# Load the bootstrap files. Note that autoloading should happen first so that
# any classes/functions are available that we might need.

require_once( get_parent_theme_file_path( 'app/bootstrap-autoload.php' ) );


# Create a new application.
#
# Access this instance with `\Hybrid\app()` function after the app has booted.

$forsite = new \Hybrid\Core\Application();


# Register service providers with the application.
#
# Before booting the app, add any necessary service providers.

$forsite->provider( \Forsite\Providers\AppServiceProvider::class );


# Perform bootstrap actions.
#
# Creates an action hook for child themes (or plugins) to hook into the
# bootstrapping process and add their own bindings before the app is booted by
# passing the application instance to the action callback.

do_action( 'forsite/bootstrap', $forsite );


# Bootstrap the application.
#
# Calls the application `boot()` method, which launches the application.

$forsite->boot();


# Move views/ to a top level folder.

add_filter(
	'hybrid/template/path',
	function( $path ) {
		return 'views';
	}
);
