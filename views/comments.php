<?php if ( post_password_required() || ( ! have_comments() && ! comments_open() ) ) {
	return;
} ?>

<section id="comments" class="comments">

	<?php if ( have_comments() ) : ?>

		<h2 class="comments__title u-h4"><?php comments_number() ?></h2>

		<?= $engine->render( 'components', 'comments-pagination' ) ?>

		<ol class="comments__list">

			<?php wp_list_comments( [
				'callback' => function( $comment, $args, $depth ) {
					$engine->display( 'components', Hybrid\Comment\hierarchy(), compact( 'comment', 'args', 'depth' ) );
				}
			] ) ?>

		</ol>

	<?php endif ?>

	<?php if ( ! comments_open() ) : ?>

		<p class="comments__closed">
			<?php esc_html_e( 'Comments are closed.', 'forsite' ) ?>
		</p>

	<?php endif ?>

	<?php comment_form() ?>

</section>
