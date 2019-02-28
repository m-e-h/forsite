<?php
/**
 * Editor and Admin setup functions.
 *
 * This file holds some setup actions for scripts and styles as well as a helper
 * functions for work with assets.
 *
 * @package   Forsite
 * @author    Marty Helmick <info@martyhelmick.com>
 * @copyright 2018 Marty Helmick
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/m-e-h/forsite
 */

namespace Forsite;

add_filter(
	'login_headerurl',
	function() {
		return home_url();
	}
);

add_filter(
	'login_headertitle',
	function() {
		return get_bloginfo( 'name' );
	}
);

add_action(
	'login_enqueue_scripts',
	function() {

		$logo_image = '';

		if ( has_custom_logo() ) {
			$logo_image = wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), ['100','100'] );
		} elseif ( has_site_icon() ) {
			$logo_image = get_site_icon_url( '100', home_url() . '/wp-admin/images/wordpress-logo.svg');
		}

		$logo_image = $logo_image ? "background-image: url({$logo_image})" : '';
		$bg_color   = get_background_color();
		$bg_image   = get_background_image();

		$style = "
			body.login {
				background-image: url({$bg_image});
				background-size: cover;
				background-color: #{$bg_color};
			}
			#login:after {
				content: '';
				background-color: #fff;
				width: 100%;
				height: 100%;
				position: absolute;
				top: 0;
				left: 0;
				opacity: .9;
				z-index: -1;
			}
			#login h1 a {
				{$logo_image}
			}
		";

		echo "<style>{$style}</style>";
	}
);
