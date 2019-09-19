<?php

namespace Forsite;

add_action( 'wp_default_scripts', __NAMESPACE__ . '\\dequeue_jquery_migrate' );
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\disable_devicepx' );
add_action( 'admin_menu', __NAMESPACE__ . '\\jetpack_rm_menu', 999 );
add_action( 'init', __NAMESPACE__ . '\\hybrid_head_cleanup' );
add_action( 'init', __NAMESPACE__ . '\\emoji_cleanup' );
add_filter('xmlrpc_methods', __NAMESPACE__ . '\\filter_xmlrpc_method', 10, 1);
add_filter('wp_headers', __NAMESPACE__ . '\\filter_headers', 10, 1);
add_filter('rewrite_rules_array', __NAMESPACE__ . '\\filter_rewrites');
add_filter('bloginfo_url', __NAMESPACE__ . '\\kill_pingback_url', 10, 2);
add_action('xmlrpc_call', __NAMESPACE__ . '\\kill_xmlrpc');

/**
 * Remove the migrate script from the list of jQuery dependencies.
 *
 * https://github.com/cedaro/dequeue-jquery-migrate/blob/develop/dequeue-jquery-migrate.php
 */
function dequeue_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$jquery_dependencies = $scripts->registered['jquery']->deps;

		$scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
	}
}

/**
 * Description: Disable Jetpack's Retina handling library.
 *
 * https://github.com/Automattic/jetpack-addons/tree/jeherve-disable-devicepx
 */
function disable_devicepx() {
	wp_dequeue_script( 'devicepx' );
}

/**
 * Only show Jetpack menu for admins.
 */
function jetpack_rm_menu() {
	if ( class_exists( 'Jetpack' ) && ! current_user_can( 'manage_options' ) && is_admin() && is_user_logged_in() ) {
		remove_menu_page( 'jetpack' );
	}
}

function hybrid_head_cleanup() {
	remove_action( 'wp_head', 'Hybrid\meta_charset', 0 );
	remove_action( 'wp_head', 'Hybrid\meta_viewport', 1 );
	remove_action( 'wp_head', 'Hybrid\meta_generator', 1 );
	remove_action( 'wp_head', 'Hybrid\link_pingback', 3 );

	// Remove WordPress generator meta.
	remove_action( 'wp_head', 'wp_generator' );

	// Remove Windows Live Writer manifest link.
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Remove the link to Really Simple Discovery service endpoint.
	remove_action( 'wp_head', 'rsd_link' );
}

function emoji_cleanup() {
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
function filter_xmlrpc_method($methods) {
  unset($methods['pingback.ping']);
  return $methods;
}

/**
 * Remove pingback header
 */
function filter_headers($headers) {
  if (isset($headers['X-Pingback'])) {
    unset($headers['X-Pingback']);
  }
  return $headers;
}

/**
 * Kill trackback rewrite rule
 */
function filter_rewrites($rules) {
  foreach ($rules as $rule => $rewrite) {
    if (preg_match('/trackback\/\?\$$/i', $rule)) {
      unset($rules[$rule]);
    }
  }
  return $rules;
}

/**
 * Kill bloginfo('pingback_url')
 */
function kill_pingback_url($output, $show) {
  if ($show === 'pingback_url') {
    $output = '';
  }
  return $output;
}

/**
 * Disable XMLRPC call
 */
function kill_xmlrpc($action) {
  if ($action === 'pingback.ping') {
    wp_die('Pingbacks are not supported', 'Not Allowed!', ['response' => 403]);
  }
}
