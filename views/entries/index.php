<article <?= Hybrid\Attr\render( 'entry' ) ?>>

	<?php the_post_thumbnail( 'medium', [ 'class' => 'entry__image' ] ); ?>

	<header class="entry__header">
		<?= Hybrid\Post\render_title( [ 'class' => 'u-h4' ] ); ?>
	</header>

	<?php the_excerpt() ?>

</article>
