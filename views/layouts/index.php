<article <?= Hybrid\Attr\render( 'archive-entry' ) ?>>

	<?= Hybrid\View\render( 'components', 'featured-image' ); ?>

	<header class="archive-entry__header u-m05">
		<?= Hybrid\Post\render_title( [ 'class' => 'entry__title u-h3 u-m0' ] ); ?>
	</header>

	<?php the_excerpt() ?>

</article>
