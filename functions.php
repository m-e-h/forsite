<?php

declare( strict_types=1 );
/**
 * Forsite functions and definitions
 *
 * This file must be parseable by PHP 5.2.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package forsite
 */

// Include WordPress shims.
require get_template_directory() . '/inc/wordpress-shims.php';

// Setup autoloader (via Composer or custom).
if ( file_exists( get_template_directory() . '/vendor/autoload.php' ) ) {
	include get_template_directory() . '/vendor/autoload.php';
}

// Load the `forsite()` entry point function.
require get_template_directory() . '/inc/functions.php';

/**
 *
 * @param string $slug
 * @param string $name
 * @param array $templates
 * @return array $templates
 */
function meh_get_template_part( string $slug, string $name, $templates )
{
	var_dump($templates);
	//$templates = [ 'file.php' ];
	//return $templates;


}
//add_action( 'get_template_part', 'meh_get_template_part', 90, 3 );

// Initialize the theme.
call_user_func( 'Forsite\forsite' );
