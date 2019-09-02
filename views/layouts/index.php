<article <?= Hybrid\Attr\render( 'entry' ); ?>>

	<?= $engine->render( 'views/components', 'featured-image' ); ?>

	<header class="archive-entry__header">
		<?= Hybrid\Post\render_title( [ 'class' => 'entry__title u-h3' ] ); ?>
	</header>

	<div class="archive-entry__content">
		<?php the_content(); ?>
	</div>
</article>
