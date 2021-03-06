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

use Forsite\Customize;

use function Forsite\sanitize_hex_color_add_hash;
/**
 * Set the content-width as a CSS custom property.
 *
 * @access public
 * @return void
 */
add_action(
	'wp_head',
	function() {

		$content_width = isset( $GLOBALS['content_width'] ) ? $GLOBALS['content_width'] : '900';

		$foreground_color  = get_theme_mod( 'foreground_color', default_foreground_color() );
		$background_color  = get_background_color();
		$background_color  = sanitize_hex_color_add_hash( $background_color );
		$primary_color     = get_theme_mod( 'primary_color', default_primary_color() );
		$accent_color      = get_theme_mod( 'accent_color', default_accent_color() );
		$header_text_color = get_theme_mod( 'header_color', $foreground_color );
		$header_text_color = sanitize_hex_color_add_hash( $header_text_color );
		$header_bg_color   = get_theme_mod( 'header_bg_color', default_header_bg_color() );

		$style_var  = '';
		$style_var .= "--background_color:{$background_color};";
		$style_var .= "--foreground_color:{$foreground_color};";
		$style_var .= "--color-1:{$primary_color};";
		$style_var .= "--color-2:{$accent_color};";
		$style_var .= "--header-text-color:{$header_text_color};";
		$style_var .= "--header-bg-color:{$header_bg_color};";
		$style_var .= "--content-width:{$content_width}px;";

		/* Put the final style output together. */
		$style = "
		<style data-style='theme-customized'>
			:root{ {$style_var} }
		</style>
		";

		/* Output custom style. */
		echo $style;
	}
);

add_action(
	'hybrid/templates/register',
	function( $templates ) {

		$templates->add(
			'template-full-width.php',
			[
				'label' => __( 'Full Width' ),
			]
		);

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

function get_background_hex() {

	$color = get_background_color();

	return sanitize_hex_color_add_hash( $color );
}

function default_background_color( $color = 0 ) {

	$color = $color ?: '#ffffff';

	return apply_filters(
		'forsite/background_color',
		sanitize_hex_color_add_hash( $color )
	);
}

function default_foreground_color( $color = 0 ) {

	$color = $color ?: '#3b3f43';

	return apply_filters(
		'forsite/foreground_color',
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

add_filter(
	'hybrid/attr/post/class/taxonomy',
	function( $taxonomies ) {

		$taxonomies[] = 'category';

		return $taxonomies;
	}
);


add_filter(
	'post_class',
	function( $classes ) {

		$author_class = sprintf( 'entry--author-%s', get_the_author_meta( 'user_nicename' ) );

		$key = array_search( $author_class, $classes );

		if ( $key ) {
			unset( $classes[ $key ] );
		}

		return $classes;

	}
);

// Fallback for the wp_body_open() function that was added in 5.2.
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
