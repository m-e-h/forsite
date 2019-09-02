<article <?= Hybrid\Attr\render( 'entry' ); ?>>

	<?= $engine->render( 'views/components', 'header-post' ); ?>

	<?= $engine->render( 'views/components', 'featured-image' ); ?>

	<div class="full-width-template u-1of1 u-px1">

		<?php the_content() ?>

	</div>

	<?= $engine->render( 'views/components', 'nav-pagination', [ 'type' => 'post' ] ); ?>

	<?php edit_post_link( __( 'Edit &#x270E;' ), '<div class="edit-link-container u-print-none u-content-width u-px1 u-text-right">', '</div>', null, 'post-edit-link u-link u-h6' ); ?>

	<?= $engine->render( 'views/components', 'footer-post' ); ?>

	<?php comments_template() ?>

</article>
