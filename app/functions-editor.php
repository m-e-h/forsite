<?php
/**
 * Editor and Admin setup functions.
 *
 * This file holds some setup actions for scripts and styles as well as a helper
 * functions for work with assets.
 *
 * @package   Forsite
 * @author    Marty Helmick <info@martyhelmick.com>
 * @copyright 2018 Marty Helmick
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/m-e-h/forsite
 */

namespace Forsite;

/**
 * Set up theme support.  This is where calls to `add_theme_support()` happen.
 *
 * @link   https://github.com/WordPress/gutenberg/blob/master/docs/extensibility/theme-support.md
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	add_theme_support( 'customize-selective-refresh-widgets' );

	// add_theme_support( 'wp-block-styles' );

	// add_theme_support( 'responsive-embeds' );

	add_theme_support( 'align-wide' );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'dist/css/editor.css' );

	// Editor block font sizes.
	add_theme_support( 'editor-font-sizes', [
		[
			'name'      => __( 'Small', 'forsite' ),
			'shortName' => __( 'S', 'forsite' ),
			'size'      => 14,
			'slug'      => 'small'
		],
		[
			'name'      => __( 'Regular', 'forsite' ),
			'shortName' => __( 'M', 'forsite' ),
			'size'      => 16,
			'slug'      => 'regular'
		],
		[
			'name'      => __( 'Large', 'forsite' ),
			'shortName' => __( 'L', 'forsite' ),
			'size'      => 32,
			'slug'      => 'large'
		],
		[
			'name'      => __( 'Larger', 'forsite' ),
			'shortName' => __( 'XL', 'forsite' ),
			'size'      => 40,
			'slug'      => 'larger'
		]
	] );

	// Editor color palette.
	// add_theme_support( 'editor-color-palette', [
	// 	[
	// 		'name'  => __( 'strawberry', 'forsite' ),
	// 		'slug'  => 'strawberry',
	// 		'color' => '#c6262e'
	// 	],
	// 	[
	// 		'name'  => __( 'orange', 'forsite' ),
	// 		'slug'  => 'orange',
	// 		'color' => '#f37329',
	// 	],
	// 	[
	// 		'name'  => __( 'banana', 'forsite' ),
	// 		'slug'  => 'banana',
	// 		'color' => '#f9c440',
	// 	],
	// 	[
	// 		'name'  => __( 'lime', 'forsite' ),
	// 		'slug'  => 'lime',
	// 		'color' => '#68b723',
	// 	],
	// 	[
	// 		'name'  => __( 'blueberry', 'forsite' ),
	// 		'slug'  => 'blueberry',
	// 		'color' => '#3689e6'
	// 	],
	// 	[
	// 		'name'  => __( 'grape', 'forsite' ),
	// 		'slug'  => 'grape',
	// 		'color' => '#a56de2',
	// 	],
	// 	[
	// 		'name'  => __( 'cocoa', 'forsite' ),
	// 		'slug'  => 'cocoa',
	// 		'color' => '#715344',
	// 	],
	// 	[
	// 		'name'  => __( 'silver', 'forsite' ),
	// 		'slug'  => 'silver',
	// 		'color' => '#abacae',
	// 	],
	// 	[
	// 		'name'  => __( 'black', 'forsite' ),
	// 		'slug'  => 'black',
	// 		'color' => '#1a1a1a',
	// 	]
	// ] );

} );
