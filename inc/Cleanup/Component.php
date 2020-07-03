<?php
/**
 * Forsite\Cleanup\Component class
 *
 * @package forsite
 */

namespace Forsite\Cleanup;

use Forsite\Component_Interface;
use function add_action;
use function add_filter;

/**
 * Class for adding basic theme support, most of which is mandatory to be implemented by all themes.
 *
 * Exposes template tags:
 * * `forsite()->get_version()`
 * * `forsite()->get_asset_version( string $filepath )`
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string {
		return 'cleanup';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'wp_default_scripts', [ $this, 'dequeue_jquery_migrate' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'disable_devicepx' ] );
		add_action( 'admin_menu', [ $this, 'jetpack_rm_menu' ], 999 );
		add_action( 'init', [ $this, 'wp_head_cleanup' ] );
		add_action( 'init', [ $this, 'emoji_cleanup' ] );
		add_filter( 'xmlrpc_methods', [ $this, 'filter_xmlrpc_method' ], 10, 1 );
		add_filter( 'wp_headers', [ $this, 'filter_headers' ], 10, 1 );
		add_filter( 'rewrite_rules_array', [ $this, 'filter_rewrites' ] );
		add_filter( 'bloginfo_url', [ $this, 'kill_pingback_url' ], 10, 2 );
		add_action( 'xmlrpc_call', [ $this, 'kill_xmlrpc' ] );
	}

	/**
	 * Remove the migrate script from the list of jQuery dependencies.
	 *
	 * https://github.com/cedaro/dequeue-jquery-migrate/blob/develop/dequeue-jquery-migrate.php
	 */
	public function dequeue_jquery_migrate( $scripts ) {
		if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
			$jquery_dependencies = $scripts->registered['jquery']->deps;

			$scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, [ 'jquery-migrate' ] );
		}
	}

	/**
	 * Description: Disable Jetpack's Retina handling library.
	 *
	 * https://github.com/Automattic/jetpack-addons/tree/jeherve-disable-devicepx
	 */
	public function disable_devicepx() {
		wp_dequeue_script( 'devicepx' );
	}

	/**
	 * Only show Jetpack menu for admins.
	 */
	public function jetpack_rm_menu() {
		if ( class_exists( 'Jetpack' ) && ! current_user_can( 'manage_options' ) && is_admin() && is_user_logged_in() ) {
			remove_menu_page( 'jetpack' );
		}
	}

	public function wp_head_cleanup() {

		// Remove WordPress generator meta.
		remove_action( 'wp_head', 'wp_generator' );

		// Remove Windows Live Writer manifest link.
		remove_action( 'wp_head', 'wlwmanifest_link' );

		// Remove the link to Really Simple Discovery service endpoint.
		remove_action( 'wp_head', 'rsd_link' );
	}

	/**
	 * Remove emoji markup.
	 *
	 * @return void
	 */
	public function emoji_cleanup() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'emoji_svg_url', '__return_false' );
	}

	/**
	 * Disables trackbacks/pingbacks
	 *
	 * https://github.com/roots/soil
	 */

	/**
	 * Disable pingback XMLRPC method
	 */
	public function filter_xmlrpc_method( $methods ) {
		unset( $methods['pingback.ping'] );
		return $methods;
	}

	/**
	 * Remove pingback header
	 */
	public function filter_headers( $headers ) {
		if ( isset( $headers['X-Pingback'] ) ) {
			unset( $headers['X-Pingback'] );
		}
		return $headers;
	}

	/**
	 * Kill trackback rewrite rule
	 */
	public function filter_rewrites( $rules ) {
		foreach ( $rules as $rule => $rewrite ) {
			if ( preg_match( '/trackback\/\?\$$/i', $rule ) ) {
				unset( $rules[ $rule ] );
			}
		}
		return $rules;
	}

	/**
	 * Kill bloginfo('pingback_url')
	 */
	public function kill_pingback_url( $output, $show ) {
		if ( 'pingback_url' === $show ) {
			$output = '';
		}
		return $output;
	}

	/**
	 * Disable XMLRPC call
	 */
	public function kill_xmlrpc( $action ) {
		if ( 'pingback.ping' === $action ) {
			wp_die( 'Pingbacks are not supported', 'Not Allowed!', [ 'response' => 403 ] );
		}
	}

}
