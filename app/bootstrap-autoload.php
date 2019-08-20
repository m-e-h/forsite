<?php
/**
 * Autoload bootstrap file.
 *
 * This file is used to autoload classes and functions necessary for the theme
 * to run. Classes utilize the PSR-4 autoloader in Composer which is defined in
 * `composer.json`.
 *
 * @package   Forsite
 * @author    Marty Helmick <info@martyhelmick.com>
 * @copyright 2018 Marty Helmick
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/m-e-h/forsite
 */

namespace Forsite;

# -----------------------------------------------------------------------------
# Run the Composer autoloader.
# -----------------------------------------------------------------------------
#
# Auto-load any projects via the Composer autoloader. Be sure to check if the
# file exists in case someone's using Composer to load their dependencies in
# a different directory. This also autoloads our theme's classes.

if ( file_exists( get_parent_theme_file_path( 'vendor/autoload.php' ) ) ) {
	require_once( get_parent_theme_file_path( 'vendor/autoload.php' ) );
}

# -----------------------------------------------------------------------------
# Autoload functions files.
# -----------------------------------------------------------------------------
#
# Load any functions-files from the `/app` folder that are needed. Add
# additional files to the array without the `.php` extension.

array_map( function( $file ) {
	require_once( get_parent_theme_file_path( "app/{$file}.php" ) );
}, [
	'functions-assets',
	'functions-setup',
	'functions-color',
	'functions-editor',
	'functions-template',
	'functions-login-logo',
	'functions-cleanup',
] );
