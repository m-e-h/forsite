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
					'label'    => __( 'Primary Theme Color' ),
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

		if ( ! $wp_customize->get_section( 'jetpack_content_options' ) ) {
			$wp_customize->add_section(
				'jetpack_content_options',
				array(
					'title'    => esc_html__( 'Content Options' ),
					'priority' => 90,
				)
			);
		}

		// Breadcrumbs.
		$wp_customize->add_setting(
			'forsite_breadcrumbs',
			[
				'default'           => true,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint',
			]
		);

		$wp_customize->add_control(
			'forsite_breadcrumbs',
			[
				'label'    => __( 'Display Breadcrumbs' ),
				'type'     => 'checkbox',
				'section'  => 'jetpack_content_options',
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

		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

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
