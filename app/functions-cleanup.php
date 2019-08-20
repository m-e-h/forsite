<?php
/**
 * Remove the migrate script from the list of jQuery dependencies.
 *
 * https://github.com/cedaro/dequeue-jquery-migrate/blob/develop/dequeue-jquery-migrate.php
 */

add_action( 'wp_default_scripts', 'forsite_dequeue_jquery_migrate' );
add_action( 'wp_enqueue_scripts', 'forsite_disable_devicepx' );
add_action( 'admin_menu', 'forsite_jetpack_rm_menu', 999 );
add_action( 'init', 'forsite_hybrid_head_cleanup' );
add_action( 'init', 'forsite_emoji_cleanup' );

function forsite_dequeue_jquery_migrate( $scripts ) {
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
function forsite_disable_devicepx() {
	wp_dequeue_script( 'devicepx' );
}

/**
 * Only show Jetpack menu for admins.
 */
function forsite_jetpack_rm_menu() {
	if ( class_exists( 'Jetpack' ) && ! current_user_can( 'manage_options' ) && is_admin() && is_user_logged_in() ) {
		remove_menu_page( 'jetpack' );
	}
}

function forsite_hybrid_head_cleanup() {
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

function forsite_emoji_cleanup() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'emoji_svg_url', '__return_false' );
}
