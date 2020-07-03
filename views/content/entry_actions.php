<?php
/**
 * Template part for displaying a post's comment and edit links
 *
 * @package forsite
 */

namespace Forsite;

?>
<div class="entry-actions">
	<?php
	if ( ! is_singular( get_post_type() ) && ! post_password_required() && post_type_supports( get_post_type(), 'comments' ) && comments_open() ) {
		?>
		<span class="comments-link">
			<?php
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'forsite' ),
						[
							'span' => [
								'class' => [],
							],
						]
					),
					get_the_title()
				)
			);
			?>
		</span>
		<?php
	}

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: post title */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'forsite' ),
				[
					'span' => [
						'class' => [],
					],
				]
			),
			get_the_title()
		),
		'<span class="edit-link">',
		' </span>'
	);
	?>
</div><!-- .entry-actions -->
