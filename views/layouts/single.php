<article <?= Hybrid\Attr\render( 'entry' ); ?>>

	<?= Hybrid\View\render( 'components', 'post-header' ); ?>

	<?= Hybrid\View\render( 'components', 'featured-image' ); ?>

		<?php the_content() ?>

		<?= Hybrid\View\render( 'components', 'post-pagination' ); ?>

	<?php edit_post_link( __( 'Edit &#x270F;', 'textdomain' ), '<div class="edit-link-container u-bold u-opacity u-content-width u-px1 u-text-right">', '</div>' ); ?>

	<?= Hybrid\View\render( 'components', 'post-footer' ); ?>

</article>

<?php comments_template() ?>
