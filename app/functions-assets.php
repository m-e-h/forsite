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
		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			wp_enqueue_style( 'forsite-style', asset( 'style.css' ), false, null );
		} else {
			wp_enqueue_style( 'forsite-style', asset( 'dist/main.css' ), false, null );
		}

		// Load WordPress' comment-reply script where appropriate.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

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
	static $filechange = null;

	if ( null === $filechange ) {
		$filechange = filemtime( get_parent_theme_file_path( $path ) );
	}

	return get_parent_theme_file_uri( "{$path}?id={$filechange}" );
}
