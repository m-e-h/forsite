<article <?= Hybrid\Attr\render( 'entry' ) ?>>

	<?= Hybrid\View\render( 'components', 'featured-image' ); ?>

	<header class="entry__header">
		<?= Hybrid\Post\render_title( [ 'class' => 'u-h4' ] ); ?>
	</header>

	<?php the_excerpt() ?>

</article>
