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
add_action( 'wp_head', function() {

	$content_width = isset( $GLOBALS['content_width'] ) ? $GLOBALS['content_width'] : false;

	if ( $content_width ) { ?>
		<style>:root{--content-width:<?= "{$content_width}px" ?>};</style>
	<?php
	}

});

/**
 * Returns the metadata separator.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $sep  String to separate metadata.
 * @return string
 */
function sep( $sep = '' ) {

	return apply_filters(
		'forsite/sep',
		sprintf(
			' <span class="sep">%s</span> ',
			$sep ?: esc_html_x( '&middot;', 'meta separator', 'forsite' )
		)
	);
}
