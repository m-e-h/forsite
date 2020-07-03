<?php
/**
 * Template part for displaying a post
 *
 * @package forsite
 */

namespace Forsite;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<?php
	get_template_part( 'views/content/entry_header', get_post_type() );

	if ( is_search() ) {
		get_template_part( 'views/content/entry_summary', get_post_type() );
	} else {
		get_template_part( 'views/content/entry_content', get_post_type() );
	}

	get_template_part( 'views/content/entry_footer', get_post_type() );
	?>
</article><!-- #post-<?php the_ID(); ?> -->

<?php
if ( is_singular( get_post_type() ) ) {
	// Show post navigation only when the post type is 'post' or has an archive.
	if ( 'post' === get_post_type() || get_post_type_object( get_post_type() )->has_archive ) {
		the_post_navigation(
			[
				'prev_text' => '<div class="post-navigation-sub"><span>' . esc_html__( 'Previous:', 'forsite' ) . '</span></div>%title',
				'next_text' => '<div class="post-navigation-sub"><span>' . esc_html__( 'Next:', 'forsite' ) . '</span></div>%title',
			]
		);
	}

	// Show comments only when the post type supports it and when comments are open or at least one comment exists.
	if ( post_type_supports( get_post_type(), 'comments' ) && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}
}