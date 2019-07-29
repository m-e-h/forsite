<article <?= Hybrid\Attr\render( 'entry' ); ?>>

	<?= Hybrid\View\render( 'components', 'post-header' ); ?>

	<?= Hybrid\View\render( 'components', 'featured-image' ); ?>

	<div class="full-width-template u-1of1 u-px1">

		<?php the_content() ?>

	</div>

	<?= Hybrid\View\render( 'components', 'post-pagination' ); ?>

	<?php edit_post_link( __( 'Edit &#x270E;' ), '<div class="edit-link-container u-print-none u-content-width u-px1 u-text-right">', '</div>', null, 'post-edit-link u-link u-h6' ); ?>

	<?= Hybrid\View\render( 'components', 'post-footer' ); ?>

	<?php comments_template() ?>

</article>
