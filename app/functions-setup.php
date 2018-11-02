<?php
/**
 * Theme setup functions.
 *
 * This file holds basic theme setup functions executed on appropriate hooks
 * with some opinionated priorities based on theme dev, particularly working
 * with child theme devs/users, over the years. I've also decided to use
 * anonymous functions to keep these from being easily unhooked. WordPress has
 * an appropriate API for unregistering, removing, or modifying all of the
 * things in this file. Those APIs should be used instead of attempting to use
 * `remove_action()`.
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
 * @link   https://developer.wordpress.org/reference/functions/add_theme_support/
 * @link   https://developer.wordpress.org/themes/basics/theme-functions/
 * @link   https://developer.wordpress.org/reference/functions/load_theme_textdomain/
 * @link   https://github.com/WordPress/gutenberg/blob/master/docs/extensibility/theme-support.md
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	// Sets the theme content width. This variable is also set in the
	// `src/scss/settings/_dimensions.scss` file.
	$GLOBALS['content_width'] = apply_filters( 'forsite_content_width', 900 );

	// Load theme translations.
	load_theme_textdomain( 'forsite', get_parent_theme_file_path( 'src/lang' ) );

	// Automatically add the `<title>` tag.
	add_theme_support( 'title-tag' );

	// Automatically add feed links to `<head>`.
	add_theme_support( 'automatic-feed-links' );

	// Adds featured image support.
	add_theme_support( 'post-thumbnails' );

	// Add selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Wide and full alignment. The styles for alignment is housed in the
	// `src/scss/utilities/_alignment.scss` file.
	add_theme_support( 'align-wide' );

	add_theme_support( 'editor-styles' );

	add_editor_style( 'dist/css/editor.css' );

	// Outputs HTML5 markup for core features.
	add_theme_support( 'html5', [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form'
	] );

	// Add custom logo support.
	add_theme_support( 'custom-logo', [
		'height'      => 100,
		'width'       => 100,
		'flex-width'  => false,
		'flex-height' => false,
		'header-text' => '',
	] );

	// Editor color palette. These colors are also defined in the
	// `src/scss/settings/_colors.scss` file.
	add_theme_support( 'editor-color-palette', [
		[
			'name'  => __( 'strawberry', 'forsite' ),
			'slug'  => 'strawberry',
			'color' => '#c6262e'
		],
		[
			'name'  => __( 'orange', 'forsite' ),
			'slug'  => 'orange',
			'color' => '#f37329',
		],
		[
			'name'  => __( 'banana', 'forsite' ),
			'slug'  => 'banana',
			'color' => '#f9c440',
		],
		[
			'name'  => __( 'lime', 'forsite' ),
			'slug'  => 'lime',
			'color' => '#68b723',
		],
		[
			'name'  => __( 'blueberry', 'forsite' ),
			'slug'  => 'blueberry',
			'color' => '#3689e6'
		],
		[
			'name'  => __( 'grape', 'forsite' ),
			'slug'  => 'grape',
			'color' => '#a56de2',
		],
		[
			'name'  => __( 'cocoa', 'forsite' ),
			'slug'  => 'cocoa',
			'color' => '#715344',
		],
		[
			'name'  => __( 'silver', 'forsite' ),
			'slug'  => 'silver',
			'color' => '#abacae',
		],
		[
			'name'  => __( 'slate', 'forsite' ),
			'slug'  => 'slate',
			'color' => '#485a6c',
		],
		[
			'name'  => __( 'black', 'forsite' ),
			'slug'  => 'black',
			'color' => '#1a1a1a',
		]
	] );

	// Editor block font sizes. These font sizes are also defined in the
	// `src/scss/settings/_fonts.scss` file.
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

}, 5 );

/**
 * Adds support for the custom background feature. This is in its own function
 * hooked to `after_setup_theme` so that we can give it a later priority.  This
 * is so that child themes can more easily overwrite this feature.  Note that
 * overwriting the background should be done *before* rather than after.
 *
 * @link   https://developer.wordpress.org/reference/functions/add_theme_support/#custom-background
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	add_theme_support( 'custom-background', [
		'default-image'          => '',
		'default-position-x'     => 'center',
		'default-position-y'     => 'center',
		'default-size'           => 'cover',
		'default-repeat'         => 'no-repeat',
		'default-attachment'     => 'fixed',
		'default-color'          => 'ffffff',
		'wp-head-callback'       => '_custom_background_cb'
	] );

}, 15 );

/**
 * Register menus.
 *
 * @link   https://developer.wordpress.org/reference/functions/register_nav_menus/
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'init', function() {

	register_nav_menus( [
		'primary' => esc_html_x( 'Primary', 'nav menu location', 'forsite' )
	] );

}, 5 );

/**
 * Register image sizes. Even if adding no custom image sizes or not adding
 * "thumbnails," it's still important to call `set_post_thumbnail_size()` so
 * that plugins that utilize the `post-thumbnail` size will have a properly-sized
 * thumbnail that matches the theme design.
 *
 * @link   https://developer.wordpress.org/reference/functions/set_post_thumbnail_size/
 * @link   https://developer.wordpress.org/reference/functions/add_image_size/
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'init', function() {

	// Set the `post-thumbnail` size.
	set_post_thumbnail_size( 178, 100, true );

	// Register custom image sizes.
	add_image_size( 'forsite-medium', 750, 422, true );

}, 5 );

/**
 * Register sidebars.
 *
 * @link   https://developer.wordpress.org/reference/functions/register_sidebar/
 * @link   https://developer.wordpress.org/reference/functions/register_sidebars/
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'widgets_init', function() {

	$args = [
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>'
	];

	register_sidebar( [
		'id'   => 'primary',
		'name' => esc_html_x( 'Primary', 'sidebar', 'forsite' )
	] + $args );

	register_sidebar( [
		'id'   => 'footer',
		'name' => esc_html_x( 'Footer', 'sidebar', 'forsite' )
	] + $args );

}, 5 );
