<?php
/**
 * Color Functions.
 *
 * @package   Forsite
 * @author    Marty Helmick <info@martyhelmick.com>
 * @copyright 2018 Marty Helmick
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/m-e-h/forsite
 */

namespace Forsite;

function sanitize_hex_color_add_hash( $color ) {
	if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
		return '#' . $unhashed;
	}

	return sanitize_hex_color( $color );
}

/**
 * Converts a hex color to RGB.  Returns the RGB values as an array.
 *
 * @param string    hex
 * @return array    rgb value
 */
function hex_to_rgb( $hex ) {

	$color = trim( $hex, '#' );

	if ( strlen( $color ) == 3 ) {

		$r = hexdec( $color[0] . $color[0] );
		$g = hexdec( $color[1] . $color[1] );
		$b = hexdec( $color[2] . $color[2] );

	} elseif ( strlen( $color ) == 6 ) {

		$r = hexdec( $color[0] . $color[1] );
		$g = hexdec( $color[2] . $color[3] );
		$b = hexdec( $color[4] . $color[5] );

	} elseif ( strlen( $color ) == 8 ) {

		$r = hexdec( $color[0] . $color[1] );
		$g = hexdec( $color[2] . $color[3] );
		$b = hexdec( $color[4] . $color[5] );
		$a = hexdec( $color[6] . $color[7] );

		return [ $r, $g, $b, $a ];

	} else {

		return [];

	}

	return [ $r, $g, $b ];
}

/**
 * Converts a RGB to HSL.  Returns the HSL values as an array.
 *
 * @param string    rgb
 * @return array    hsl value
 */
function rgbToHsl( $rgb = [] ) {

		// Make sure it's RGB
	if ( empty( $rgb ) || ! isset( $rgb['R'] ) || ! isset( $rgb['G'] ) || ! isset( $rgb['B'] ) ) {
		throw new Exception( 'Param was not an RGB array' );
	}

	$varR = $r;
	$varG = $g;
	$varB = $b;

	$r = ( $rgb[0] / 255 );
	$g = ( $rgb[1] / 255 );
	$b = ( $rgb[2] / 255 );

	$max = max( $r, $g, $b );
	$min = min( $r, $g, $b );

	$h;
	$s;
	$l = ( $max + $min ) / 2;
	$d = $max - $min;

	if ( $d == 0 ) {
		$h = $s = 0; // achromatic
	} else {
		$s = $d / ( 1 - abs( 2 * $l - 1 ) );

		switch ( $max ) {
			case $r:
				$h = 60 * fmod( ( ( $g - $b ) / $d ), 6 );
				if ( $b > $g ) {
					$h += 360;
				}
				break;

			case $g:
				$h = 60 * ( ( $b - $r ) / $d + 2 );
				break;

			case $b:
				$h = 60 * ( ( $r - $g ) / $d + 4 );
				break;
		}
	}

	return array( round( $h, 2 ), round( $s, 2 ), round( $l, 2 ) );
}

function hslToRgb( $h, $s, $l ) {
	$r;
	$g;
	$b;

	$c = ( 1 - abs( 2 * $l - 1 ) ) * $s;
	$x = $c * ( 1 - abs( fmod( ( $h / 60 ), 2 ) - 1 ) );
	$m = $l - ( $c / 2 );

	if ( $h < 60 ) {
		$r = $c;
		$g = $x;
		$b = 0;
	} elseif ( $h < 120 ) {
		$r = $x;
		$g = $c;
		$b = 0;
	} elseif ( $h < 180 ) {
		$r = 0;
		$g = $c;
		$b = $x;
	} elseif ( $h < 240 ) {
		$r = 0;
		$g = $x;
		$b = $c;
	} elseif ( $h < 300 ) {
		$r = $x;
		$g = 0;
		$b = $c;
	} else {
		$r = $c;
		$g = 0;
		$b = $x;
	}

	$r = ( $r + $m ) * 255;
	$g = ( $g + $m ) * 255;
	$b = ( $b + $m ) * 255;

	return array( floor( $r ), floor( $g ), floor( $b ) );
}
