<?php

$wrapper_tag = 'ol';
$container_class = get_theme_mod( 'forsite_breadcrumbs', true ) ? 'breadcrumbs' : 'breadcrumbs screen-reader-text';

function hybrid_crumb_args() {
	$wrapper_tag = 'ol';
$container_class = get_theme_mod( 'forsite_breadcrumbs', true ) ? 'breadcrumbs' : 'breadcrumbs screen-reader-text';
	$args = [
		'list_tag'        => $wrapper_tag,
		'show_trail_end'  => false,
		'container_class' => $container_class,
		'labels'          => [
			'title' => '',
			'home'  => 'Home',
		],
	];
	return $args;
}

/**
 * Yoast breadcrumb wrapper for all items.
 */
add_filter('wpseo_breadcrumb_output_wrapper','crumb_wrapper');

function crumb_wrapper( $wrapper ) {

	$wrapper_tag = 'ol';
	$wrapper = $wrapper_tag;

	return $wrapper;
}

/**
 * Yoast breadcrumb wrapper for individual items.
 */
add_filter(
	'wpseo_breadcrumb_single_link_wrapper',
	function( $element ) {
		$element = 'li';

		return $element;
	}
);

/**
 * Yoast breadcrumb seperator.
 */
add_filter(
	'wpseo_breadcrumb_separator',
	function( $separator ) {
		$separator = '/';

		return $separator;
	}
);
