<?php
/**
 * Asset-related functions and filters.
 *
 * @package   Forsite
 * @author    Marty Helmick <info@martyhelmick.com>
 * @copyright 2018 Marty Helmick
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/m-e-h/forsite
 */

namespace Forsite;

use Hybrid\App;
use function Hybrid\Font\enqueue as enqueue_font;

/**
 * Enqueue scripts/styles for the front end.
 *
 * @link   https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 * @link   https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {

		// Enqueue theme scripts.
		wp_enqueue_script( 'forsite-script', get_theme_file_uri( 'dist/main.js' ), false, false, true );

		// Enqueue theme styles.
		if ( is_script_debug() ) {
			wp_enqueue_style( 'forsite-style', asset( 'style.css' ), false, null );
		} else {
			wp_enqueue_style( 'forsite-style', asset( 'dist/main.css' ), false, null );
		}

		// Load WordPress' comment-reply script where appropriate.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Hybrid Fonts https://github.com/justintadlock/hybrid-font
		enqueue_font( 'forsite', [
			'family' => [
				'open-sans'      => 'Open+Sans:300,300i,400,400i,600,600i,700,700i'
			],
			'display' => 'swap'
		] );

	}
);

/**
 * Enqueue scripts/styles for the editor.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action(
	'enqueue_block_editor_assets',
	function() {

		// Enqueue theme editor styles.
		wp_enqueue_style( 'forsite-editor-style', get_parent_theme_file_uri( 'dist/editor-style.css' ), false );

	}
);

/**
 * Helper function for cache busting. If used when you enqueue a script
 * or style, it'll append an ID to the filename.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $path  A relative path/file to append to the `public` folder.
 * @return string
 */
function asset( $path ) {

	// Make sure to trim any slashes from the front of the path.
	$path = '/' . ltrim( $path, '/' );

	// Cache the filetime so that we only read it in once.
	static $file_ver = null;

	if ( null === $file_ver ) {
		if ( ! is_child_theme() || is_script_debug() ) {
			$file_ver = filemtime( get_parent_theme_file_path( $path ) );
		} else {
			$file_ver = wp_get_theme()->get( 'Version' );
		}
	}

	return get_parent_theme_file_uri( "{$path}?ver={$file_ver}" );
}

function is_script_debug() {
	return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG;
}
