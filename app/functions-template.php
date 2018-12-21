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

		$primary_color     = get_theme_mod( 'primary_color', default_primary_color() );
		$accent_color      = get_theme_mod( 'accent_color', default_accent_color() );
		$header_text_color = get_theme_mod( 'header_textcolor' );
		$header_bg_color   = get_theme_mod( 'header_bg_color', default_header_bg_color() );

		$style_var  = '';
		$style_var .= "--color-1:{$primary_color};";
		$style_var .= "--color-2:{$accent_color};";
		$style_var .= display_header_text() ? "--header-text-color:{$header_text_color};" : '';
		$style_var .= "--header-bg-color:{$header_bg_color};";
		$style_var .= "--content-width:{$content_width}px;";

		$style_rule  = '';
		$style_rule .= display_header_text() ? '' : '.app-header__title, .app-header__description{ clip: rect(0, 0, 0, 0);position: absolute; }';

		/* Put the final style output together. */
		$style = "
		<style data-style='theme-customized'>
			:root{ {$style_var} }
			$style_rule
		</style>
		";

		/* Output custom style. */
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
function default_primary_color( $color = 0 ) {

	$color = $color ?: '#2980b9';

	return apply_filters(
		'forsite/primary_color',
		sanitize_hex_color_add_hash( $color )
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
function default_accent_color( $color = 0 ) {

	$color = $color ?: '#16a085';

	return apply_filters(
		'forsite/accent_color',
		sanitize_hex_color_add_hash( $color )
	);
}

/**
 * Returns the header_bg color.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $hex.
 * @return string
 */
function default_header_bg_color( $color = 0 ) {

	$color = $color ?: '#ffffff';

	return apply_filters(
		'forsite/header_bg_color',
		sanitize_hex_color_add_hash( $color )
	);
}

function forsite_sanitize_checkbox( $input ) {
	return ( 1 == $input ) ? 1 : '';
}

function sanitize_hex_color_add_hash( $color ) {
	if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
		return '#' . $unhashed;
	}

	return sanitize_hex_color( $color );
}
