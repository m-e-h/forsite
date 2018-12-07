<?php
/**
 * Template tags.
 *
 * This file holds template tags for the theme. Template tags are PHP functions
 * meant for use within theme templates.
 *
 * @package   Forsite
 * @author    Marty Helmick <info@martyhelmick.com>
 * @copyright 2018 Marty Helmick
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/m-e-h/forsite
 */

namespace Forsite;

/**
 * Set the content-width as a CSS custom property.
 *
 * @access public
 * @return void
 */
add_action(
	'wp_head',
	function() {

		$content_width = isset( $GLOBALS['content_width'] ) ? $GLOBALS['content_width'] : '900px';

		$primary_color = get_theme_mod( 'primary_color', default_primary_color() );
		$accent_color = get_theme_mod( 'accent_color', default_accent_color() );
		$header_text_color = get_theme_mod( 'header_textcolor' );

		$style = "--color-1:{$primary_color};";
		$style .= "--color-2:{$accent_color};";
		$style .= "--header-text-color:#{$header_text_color};";
		$style .= "--content-width:{$content_width}px;";

		/* Put the final style output together. */
		$style = "\n" . '<style data-style="custom-properties">:root{' . trim( $style ) . '}</style>' . "\n";

		/* Output the custom style. */
		echo $style;
	}
);

/**
 * Returns the primary color.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $hex.
 * @return string
 */
function default_primary_color() {

	return apply_filters(
		'forsite/primary_color',
		'#2980b9'
	);
}

/**
 * Returns the accent color.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $hex.
 * @return string
 */
function default_accent_color() {

	return apply_filters(
		'forsite/accent_color',
		'#16a085'
	);
}

function forsite_sanitize_checkbox( $input ) {
	return ( 1 == $input ) ? 1 : '';
}
