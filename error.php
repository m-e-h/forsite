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

forsite()->print_styles( 'forsite-content' );

?>
	<main id="primary" class="site-main">
		<?php get_template_part( 'template-parts/content/error' ); ?>
	</main><!-- #primary -->
<?php
get_footer();
