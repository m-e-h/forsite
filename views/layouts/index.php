<article <?= Hybrid\Attr\render( 'archive-entry' ) ?>>

	<?= Hybrid\View\render( 'components', 'featured-image' ); ?>

	<header class="archive-entry__header">
		<?= Hybrid\Post\render_title( [ 'class' => 'entry__title u-h4' ] ); ?>
	</header>

	<?php the_excerpt() ?>

</article>
