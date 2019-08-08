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
add_action(
	'after_setup_theme',
	function() {

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'align-wide' );

		add_theme_support(
			'editor-font-sizes',
			[
				[
					'name'      => __( 'Small' ),
					'shortName' => __( 'S' ),
					'size'      => 14,
					'slug'      => 'small',
				],
				[
					'name'      => __( 'Normal' ),
					'shortName' => __( 'N' ),
					'size'      => 16,
					'slug'      => 'normal',
				],
				[
					'name'      => __( 'Medium' ),
					'shortName' => __( 'M' ),
					'size'      => 20,
					'slug'      => 'medium',
				],
				[
					'name'      => __( 'Large' ),
					'shortName' => __( 'L' ),
					'size'      => 32,
					'slug'      => 'large',
				],
				[
					'name'      => __( 'Huge' ),
					'shortName' => __( 'XL' ),
					'size'      => 40,
					'slug'      => 'huge',
				],
			]
		);

		add_theme_support(
			'editor-color-palette',
			[
				[
					'name'  => __( 'Primary' ),
					'slug'  => 'theme-primary',
					'color' => get_theme_mod( 'primary_color', default_primary_color() ),
				],
				[
					'name'  => __( 'Accent' ),
					'slug'  => 'theme-secondary',
					'color' => get_theme_mod( 'accent_color', default_accent_color() ),
				],
				[
					'name'  => __( 'Site Background' ),
					'slug'  => 'theme-background',
					'color' => get_background_hex(),
				],
				[
					'name'  => __( 'Site Foreground' ),
					'slug'  => 'theme-foreground',
					'color' => get_theme_mod( 'foreground_color', default_foreground_color() ),
				],
				[
					'name'  => __( 'Red' ),
					'slug'  => 'vivid-red',
					'color' => '#e57278',
				],
				[
					'name'  => __( 'Green' ),
					'slug'  => 'vivid-green-cyan',
					'color' => '#00cc55',
				],
				[
					'name'  => __( 'Blue' ),
					'slug'  => 'vivid-cyan-blue',
					'color' => '#66b7f5',
				],
				[
					'name'  => __( 'Yellow' ),
					'slug'  => 'luminous-vivid-amber',
					'color' => '#ffef79',
				],
				[
					'name'  => __( 'Silver' ),
					'slug'  => 'theme-silver',
					'color' => '#dee2e6',
				],
				[
					'name'  => __( 'Gray' ),
					'slug'  => 'theme-gray',
					'color' => '#adb5bd',
				],
				[
					'name'  => __( 'Slate' ),
					'slug'  => 'theme-slate',
					'color' => '#495057',
				],
			]
		);

		// add_theme_support( 'wp-block-styles' );

		// add_theme_support( 'responsive-embeds' );

		// add_theme_support( 'editor-styles' );

		// add_editor_style( 'dist/css/editor-style.css' );

	}
);
