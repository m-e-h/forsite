<article <?= Hybrid\Attr\render( 'entry' ); ?>>

	<?= Hybrid\View\render( 'components', 'post-header' ); ?>

	<div class="entry__content">
		<?php the_content() ?>
		<?= Hybrid\View\render( 'components', 'post-pagination' ); ?>
	</div>

	<?= Hybrid\View\render( 'components', 'post-footer' ); ?>

</article>

<?php comments_template() ?>
