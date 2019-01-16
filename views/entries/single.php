<article <?= Hybrid\Attr\render( 'entry' ); ?>>

	<?= Hybrid\View\render( 'components', 'post-header' ); ?>

	<div class="entry__content">

		<?php the_content() ?>

		<?= Hybrid\View\render( 'components', 'post-pagination' ); ?>

	</div>

	<?php edit_post_link( __( 'Edit &#x270F;', 'textdomain' ), '<div class="edit-link-container u-bold u-opacity u-content-width u-px1 u-text-right">', '</div>' ); ?>

	<?= Hybrid\View\render( 'components', 'post-footer' ); ?>

</article>

<?php comments_template() ?>
