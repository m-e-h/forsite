<article <?php Hybrid\Attr\display( 'entry' ); ?>>

	<header class="entry__header u-text-center">
		<?php Hybrid\Post\display_title(); ?>
	</header>

	<div class="entry__content">
		<?php the_content(); ?>
		<?= Hybrid\View\render( 'components', 'pagination-post' ); ?>
	</div>

</article>
