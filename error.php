<?php
/**
 * The template for displaying offline & 500 pages (internal server errors)
 *
 * @link https://github.com/GoogleChromeLabs/pwa-wp/wiki/Service-Worker#offline--500-error-handling
 *
 * @package forsite
 */

namespace Forsite;

if ( forsite()->is_offline() ) {
	// Prevent showing nav menus.
	add_filter( 'pre_wp_nav_menu', '__return_empty_string' );
}

get_header();

?>
	<main id="main" class="site-main">
		<?php get_template_part( 'views/content/error' ); ?>
	</main><!-- #main -->
<?php
get_footer();
