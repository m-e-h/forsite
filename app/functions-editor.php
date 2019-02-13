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

	add_theme_support( 'align-wide' );

	// Editor block font sizes.
	add_theme_support( 'editor-font-sizes', [
		[
			'name'      => __( 'Small' ),
			'shortName' => __( 'S' ),
			'size'      => 14,
			'slug'      => 'small'
		],
		[
			'name'      => __( 'Normal' ),
			'shortName' => __( 'N' ),
			'size'      => 16,
			'slug'      => 'normal'
		],
		[
			'name'      => __( 'Medium' ),
			'shortName' => __( 'M' ),
			'size'      => 20,
			'slug'      => 'medium'
		],
		[
			'name'      => __( 'Large' ),
			'shortName' => __( 'L' ),
			'size'      => 32,
			'slug'      => 'large'
		],
		[
			'name'      => __( 'Huge' ),
			'shortName' => __( 'XL' ),
			'size'      => 40,
			'slug'      => 'huge'
		]
	] );

	// add_theme_support( 'wp-block-styles' );

	// add_theme_support( 'responsive-embeds' );

	// add_theme_support( 'editor-styles' );

	// add_editor_style( 'dist/css/editor-style.css' );

	// Editor color palette.
	// add_theme_support( 'editor-color-palette', [
	// 	[
	// 		'name'  => __( 'strawberry' ),
	// 		'slug'  => 'strawberry',
	// 		'color' => '#c6262e'
	// 	],
	// 	[
	// 		'name'  => __( 'orange' ),
	// 		'slug'  => 'orange',
	// 		'color' => '#f37329',
	// 	],
	// 	[
	// 		'name'  => __( 'banana' ),
	// 		'slug'  => 'banana',
	// 		'color' => '#f9c440',
	// 	],
	// 	[
	// 		'name'  => __( 'lime' ),
	// 		'slug'  => 'lime',
	// 		'color' => '#68b723',
	// 	],
	// 	[
	// 		'name'  => __( 'blueberry' ),
	// 		'slug'  => 'blueberry',
	// 		'color' => '#3689e6'
	// 	],
	// 	[
	// 		'name'  => __( 'grape' ),
	// 		'slug'  => 'grape',
	// 		'color' => '#a56de2',
	// 	],
	// 	[
	// 		'name'  => __( 'cocoa' ),
	// 		'slug'  => 'cocoa',
	// 		'color' => '#715344',
	// 	],
	// 	[
	// 		'name'  => __( 'silver' ),
	// 		'slug'  => 'silver',
	// 		'color' => '#abacae',
	// 	],
	// 	[
	// 		'name'  => __( 'black' ),
	// 		'slug'  => 'black',
	// 		'color' => '#1a1a1a',
	// 	]
	// ] );

} );
