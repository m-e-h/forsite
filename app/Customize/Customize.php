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
use function Forsite\asset;
use function Forsite\default_primary_color;
use function Forsite\default_accent_color;

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
		add_action( 'customize_register', [ $this, 'registerPanels' ] );
		add_action( 'customize_register', [ $this, 'registerSections' ] );
		add_action( 'customize_register', [ $this, 'registerSettings' ] );
		add_action( 'customize_register', [ $this, 'registerControls' ] );
		add_action( 'customize_register', [ $this, 'registerPartials' ] );

		// Enqueue scripts and styles.
		// add_action( 'customize_controls_enqueue_scripts', [ $this, 'controlsEnqueue' ] );
		add_action( 'customize_preview_init', [ $this, 'previewEnqueue' ] );
	}


	public function registerPanels( WP_Customize_Manager $wp_customize ) {}
	public function registerSections( WP_Customize_Manager $wp_customize ) {}

	/**
	 * Callback for registering settings.
	 *
	 * @link   https://developer.wordpress.org/themes/customize-api/customizer-objects/#settings
	 * @since  1.0.0
	 * @access public
	 * @param  WP_Customize_Manager  $wp_customize  Instance of the customize manager.
	 * @return void
	 */
	public function registerSettings( WP_Customize_Manager $wp_customize ) {

		//Primary color.
		$wp_customize->add_setting(
			'primary_color',
			[
				'default'           => default_primary_color(),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			]
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

				// Accent color.
		$wp_customize->add_setting(
			'forsite_breadcrumbs',
			[
				'default'           => 0,
				'transport'         => 'postMessage',
				'sanitize_callback' => 'forsite_sanitize_checkbox',
			]
		);

	}

	/**
	 * Callback for registering controls.
	 *
	 * @since  1.0.0
	 * @param  WP_Customize_Manager  $wp_customize
	 * @return void
	 */
	public function registerControls( WP_Customize_Manager $wp_customize ) {

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

		$wp_customize->add_control(
			'breadcrumbs_show',
			[
				'label'    => __( 'Display Breadcrumbs' ),
				'type'     => 'checkbox',
				'section'  => 'jetpack_content_options',
				'settings' => 'forsite_breadcrumbs',
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
				'selector'        => '.app-header__title-link',
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
	 * scripts/styles for the the controls frame.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function controlsEnqueue() {

		wp_enqueue_script(
			'forsite-customize-controls',
			asset( 'js/customize-controls.js' ),
			[ 'customize-controls' ],
			null,
			true
		);

		wp_enqueue_style(
			'forsite-customize-controls',
			asset( 'css/customize-controls.css' ),
			[],
			null
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
			asset( 'js/customize-view.js' ),
			[ 'customize-preview' ],
			null,
			true
		);
	}
}
