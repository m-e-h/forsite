<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package forsite
 */

namespace Forsite;

get_header();

?>
	<main id="main" class="site-main">
		<?php
		if ( have_posts() ) {

			get_template_part( 'views/content/page_header' );

			while ( have_posts() ) {
				the_post();

				get_template_part( 'views/content/entry', get_post_type() );
			}

			if ( ! is_singular() ) {
				get_template_part( 'views/content/pagination' );
			}
		} else {
			get_template_part( 'views/content/error' );
		}
		?>
	</main><!-- #main -->
<?php
get_sidebar();
get_footer();
