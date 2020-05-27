<?php
/**
 * Template part for displaying the page content when an error has occurred
 *
 * @package forsite
 */

namespace Forsite;

?>
<section class="error">
	<?php get_template_part( 'template-parts/content/page_header' ); ?>

	<div class="page-content">
		<?php
		if ( is_404() ) {
			get_template_part( 'template-parts/content/error', '404' );
		} elseif ( is_home() && current_user_can( 'publish_posts' ) ) {
			?>
			<p>
				<?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'forsite' ),
						[
							'a' => [
								'href' => [],
							],
						]
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
			</p>
			<?php
		} elseif ( is_search() ) {
			?>
			<p>
				<?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'forsite' ); ?>
			</p>
			<?php
		} elseif ( forsite()->is_offline() ) {

			if ( function_exists( 'wp_service_worker_error_message_placeholder' ) ) {
				wp_service_worker_error_message_placeholder();
			}
		} elseif ( forsite()->is_500() ) {

			if ( function_exists( 'wp_service_worker_error_message_placeholder' ) ) {
				wp_service_worker_error_message_placeholder();
			}
			if ( function_exists( 'wp_service_worker_error_details_template' ) ) {
				wp_service_worker_error_details_template();
			}
		} else {
			?>
			<p>
				<?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'forsite' ); ?>
			</p>
			<?php
		}

		get_search_form();
		?>
	</div><!-- .page-content -->
</section><!-- .error -->
