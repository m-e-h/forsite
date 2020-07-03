<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package forsite
 */

namespace Forsite;

get_header();

?>
	<main id="main" class="site-main">
		<?php get_template_part( 'views/content/error', '404' ); ?>
	</main><!-- #main -->
<?php
get_footer();
