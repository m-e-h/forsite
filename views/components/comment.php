<li <?= Hybrid\Attr\render( 'comment' ) ?>>

	<header class="comment__header">
		<?= get_avatar( $data->comment, '60', '', '', [ 'class' => 'comment__avatar' ] ) ?>

		<div class="comment__meta">
			<?php Hybrid\Comment\display_author( [ 'after' => '<br>' ] ) ?>
			<?php Hybrid\Comment\display_permalink( [
				'text' => sprintf(
					// Translators: 1 is the comment date and 2 is the time.
					esc_html__( '%1$s at %2$s', 'forsite' ),
					Hybrid\Comment\render_date(),
					Hybrid\Comment\render_time()
				)
			] ) ?>
		</div>
		<?php Hybrid\Comment\display_edit_link() ?>
	</header>

	<div class="comment__content">

		<?php if ( ! Hybrid\Comment\is_approved() ) : ?>

			<p class="comment__moderation">
				<?php esc_html_e( 'Your comment is awaiting moderation.', 'forsite' ) ?>
			</p>

		<?php endif ?>

		<?php comment_text() ?>
	</div>

	<?php Hybrid\Comment\display_reply_link( [ 'class' => 'comment__reply btn' ] ) ?>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
