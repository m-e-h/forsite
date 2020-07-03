<?php
/**
 * Forsite\Login_Style\Component class
 *
 * @package forsite
 */

namespace Forsite\Login_Style;

use Forsite\Component_Interface;
use function Forsite\forsite;
use function add_action;
use function add_filter;

/**
 * Class for managing the appearance of the login page.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string {
		return 'login_style';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'login_enqueue_scripts', [ $this, 'action_login_scripts' ] );
		add_filter( 'login_headerurl', [ $this, 'filter_headerurl' ] );
		add_filter( 'login_headertext', [ $this, 'filter_headertext' ] );
	}

	/**
	 * Change the link URL of the header logo above login form.
	 */
	public function filter_headerurl() {
		return home_url();
	}

	/**
	 * Change the link text of the header logo above the login form.
	 */
	public function filter_headertext() {
		return get_bloginfo( 'name' );
	}

	/**
	 * Enqueue scripts and styles for the login page.
	 */
	public function action_login_scripts() {
		$prime_color = forsite()->default_primary_color();
		if ( has_custom_logo() ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$image = wp_get_attachment_image_src( $custom_logo_id, 'full' );
			$logo_image = $image[0];
		} elseif ( has_site_icon() ) {
			$logo_image = get_site_icon_url( '100', home_url() . '/wp-admin/images/wordpress-logo.svg' );
		}
		$logo_image = $logo_image ?: '';
		$bg_color = forsite()->get_background_hex();
		$text_color = forsite()->default_foreground_color();
		$bg_image = wp_get_attachment_url( get_theme_mod( 'login_background_image', '' ) );
		$bg_image = $bg_image ?: get_background_image();

		$style = '';
		$style .= "body.login {
				color: {$text_color};
				background-color: {$bg_color};
			}";

		if ( $logo_image ) {
			$style .= "#login h1 a {
				background-image: url({$logo_image});
				width: auto;
				background-size: contain;
			}";
		}

		if ( $bg_image ) {
			$style .= "body.login {
				background-image: linear-gradient(black,black),url({$bg_image});
				background-size: cover;
				background-blend-mode: saturation;
				background-color: transparent;
			}
			#login:after {
				content: '';
				background-color: {$bg_color};
				width: 100%;
				height: 100%;
				position: absolute;
				top: 0;
				left: 0;
				opacity: 0.92;
				z-index: -1;}";
		}

		$style .= "#wp-submit.button-primary {
			background: {$prime_color};
			border-color: {$prime_color};
			border-radius: 0;
			color: #fff;
			text-decoration: none;
			text-shadow: none;
		}
		#wp-submit.button-primary:hover {
			box-shadow: inset 0 -10em 0 0 rgba(0, 0, 0, 0.05);
		}
		:root:root .wp-pwd .button-secondary {
			color: inherit;
			opacity: 0.4;
		}
		:root:root .wp-pwd .button-secondary:hover {
			color: inherit;
			opacity: 0.5;
		}
		#loginform {
			background-color: {$bg_color};
			box-shadow: 0 40px 40px rgba(0, 0, 0, 0.1);
			border-width: 0;
		}
		:root:root #login a {
			color: inherit;
		}
		:root:root #login a:hover {
			color: {$prime_color};
		}
		input:not(#wp-submit) {
			border-radius: 0;
			border-color: #d1d1d1;
		}
		input:not(#wp-submit):focus {
			border-color: {$prime_color};
			box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
		}";

		echo "<style>{$style}</style>";
	}
}
