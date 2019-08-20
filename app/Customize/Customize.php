<?php
/**
 * Customize class.
 *
 * @package   Forsite
 */

namespace Forsite\Customize;

use WP_Customize_Manager;
use WP_Customize_Color_Control;
use Hybrid\Contracts\Bootable;
use function Forsite\default_primary_color;
use function Forsite\default_accent_color;
use function Forsite\default_header_bg_color;
use function Forsite\default_foreground_color;

/**
 * Handles setting up everything we need for the customizer.
 *
 * @link   https://developer.wordpress.org/themes/customize-api
 * @since  1.0.0
 * @access public
 */
class Customize implements Bootable {

	/**
	 * Adds actions on the appropriate customize action hooks.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		add_action( 'customize_register', [ $this, 'registerControls' ] );
		add_action( 'customize_register', [ $this, 'registerPartials' ] );

		// Enqueue scripts and styles.
		add_action( 'customize_preview_init', [ $this, 'previewEnqueue' ] );
	}

	/**
	 * Callback for registering settings & controls.
	 *
	 * @since  1.0.0
	 * @param  WP_Customize_Manager  $wp_customize
	 * @return void
	 */
	public function registerControls( WP_Customize_Manager $wp_customize ) {

		// $wp_customize->add_section(
		// 	'fonts',
		// 	[
		// 		'title'    => __( 'Fonts' ),
		// 		'priority' => 40,
		// 	]
		// );

		// $wp_customize->add_setting(
		// 	'primary_font',
		// 	[
		// 		'default'           => 'Open Sans',
		// 		'sanitize_callback' => 'wp_kses_post',
		// 	]
		// );

		// $wp_customize->add_control(
		// 	'primary_font',
		// 	array(
		// 		'label'   => __( 'Primary Font' ),
		// 		'section' => 'fonts',
		// 		'type'    => 'select',
		// 		'choices' => [
		// 			'Josefin Sans',
		// 			'Lato',
		// 			'Merriweather',
		// 			'Open Sans',
		// 			'PT Sans',
		// 			'Roboto',
		// 			'Source Sans Pro',
		// 			'Source Serif Pro',
		// 			'Ubuntu',
		// 		],
		// 	)
		// );

		// $wp_customize->add_setting(
		// 	'display_font',
		// 	[
		// 		'default'           => 'Raleway',
		// 		'sanitize_callback' => 'wp_kses_post',
		// 	]
		// );

		// $wp_customize->add_control(
		// 	'display_font',
		// 	array(
		// 		'label'   => __( 'Display Font' ),
		// 		'section' => 'fonts',
		// 		'type'    => 'select',
		// 		'choices' => [
		// 			'Architects Daughter',
		// 			'Asap',
		// 			'Cabin',
		// 			'Josefin Sans',
		// 			'Lato',
		// 			'Merriweather',
		// 			'Montserrat',
		// 			'Oswald',
		// 			'Playfair Display',
		// 			'Raleway',
		// 			'Roboto',
		// 			'Roboto Slab',
		// 			'Ubuntu',
		// 		],
		// 	)
		// );

		// Foreground text color.
		$wp_customize->add_setting(
			'foreground_color',
			[
				'default'           => default_foreground_color(),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'foreground_color',
				[
					'label'    => __( 'Foreground Color (text)' ),
					'section'  => 'colors',
					'settings' => 'foreground_color',
				]
			)
		);

		//Primary color.
		$wp_customize->add_setting(
			'primary_color',
			[
				'default'           => default_primary_color(),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'primary_color',
				[
					'label'    => __( 'Primary Color' ),
					'section'  => 'colors',
					'settings' => 'primary_color',
				]
			)
		);

		// Accent color.
		$wp_customize->add_setting(
			'accent_color',
			[
				'default'           => default_accent_color(),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'accent_color',
				[
					'label'    => __( 'Accent Color' ),
					'section'  => 'colors',
					'settings' => 'accent_color',
				]
			)
		);

		// Header background color.
		$wp_customize->add_setting(
			'header_bg_color',
			[
				'default'           => default_header_bg_color(),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'header_bg_color',
				[
					'label'    => __( 'Header Background Color' ),
					'section'  => 'colors',
					'settings' => 'header_bg_color',
				]
			)
		);

		// Header text color.
		$wp_customize->add_setting(
			'header_color',
			[
				'default'           => get_theme_mod( 'foreground_color', default_foreground_color() ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'header_color',
				[
					'label'    => __( 'Header Text Color' ),
					'section'  => 'colors',
					'settings' => 'header_color',
				]
			)
		);

		$wp_customize->add_panel(
			'forsite_options',
			[
				'title'    => __( 'Theme Settings' ),
				'priority' => 160,
			]
		);

		$wp_customize->add_section(
			'forsite_content',
			[
				'title'    => esc_html__( 'Post Content' ),
				'priority' => 90,
				'panel'    => 'forsite_options',
			]
		);

		$wp_customize->add_section(
			'forsite_breadcrumbs',
			[
				'title'    => esc_html__( 'Breadcrumbs' ),
				'priority' => 90,
				'panel'    => 'forsite_options',
			]
		);

		$wp_customize->add_setting(
			'forsite_archive_excerpt',
			[
				'default'           => 'content',
				'sanitize_callback' => 'wp_kses_post',
			]
		);

		$wp_customize->add_control(
			'forsite_archive_excerpt',
			[
				'label'   => __( 'Post Archive Content' ),
				'section' => 'forsite_content',
				'type'    => 'radio',
				'choices' => [
					'content' => 'Full Post Content',
					'excerpt' => 'Post Excerpt',
				],
			]
		);

		// Breadcrumbs.
		$wp_customize->add_setting(
			'forsite_archive_img',
			[
				'default'           => false,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint',
			]
		);

		$wp_customize->add_control(
			'forsite_archive_img',
			[
				'label'   => __( 'Display the featured image on archive pages?' ),
				'type'    => 'checkbox',
				'section' => 'forsite_content',
			]
		);

		// Breadcrumbs.
		$wp_customize->add_setting(
			'forsite_breadcrumbs_display',
			[
				'default'           => true,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint',
			]
		);

		$wp_customize->add_control(
			'forsite_breadcrumbs_display',
			[
				'label'   => __( 'Display Breadcrumbs' ),
				'type'    => 'checkbox',
				'section' => 'forsite_breadcrumbs',
			]
		);

	}

	/**
	 * Callback for registering partials.
	 *
	 * @since  1.0.0
	 * @param  WP_Customize_Manager  $wp_customize
	 * @return void
	 */
	public function registerPartials( WP_Customize_Manager $wp_customize ) {

		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'header_text' )->transport     = 'postMessage';

		if ( ! isset( $wp_customize->selective_refresh ) ) {
			return;
		}

		$wp_customize->selective_refresh->add_partial(
			'blogname',
			[
				'selector'        => '.app-header__title',
				'render_callback' => function() {
					return get_bloginfo( 'name', 'display' );
				},
			]
		);

		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			[
				'selector'        => '.app-header__description',
				'render_callback' => function() {
					return get_bloginfo( 'description', 'display' );
				},
			]
		);

	}

	/**
	 * scripts/styles for the live preview frame.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function previewEnqueue() {

		wp_enqueue_script(
			'forsite-customize-preview',
			get_theme_file_uri( 'dist/customize-view.js' ),
			[ 'customize-preview' ],
			null,
			true
		);
	}
}
