<article <?= Hybrid\Attr\render( 'entry' ); ?>>

	<?= $engine->render( 'components', 'post-header' ); ?>

	<?= $engine->render( 'components', 'featured-image' ); ?>

		<?php the_content() ?>

		<?= $engine->render( 'components', 'post-pagination' ); ?>

	<?php edit_post_link( __( 'Edit &#x270E;' ), '<div class="edit-link-container u-print-none u-content-width u-px1 u-text-right">', '</div>', null, 'post-edit-link u-link u-h6' ); ?>

	<?= $engine->render( 'components', 'post-footer' ); ?>

	<?php comments_template() ?>

</article>
