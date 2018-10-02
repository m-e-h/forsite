<article <?php Hybrid\Attr\display( 'entry' ); ?>>

	<header class="entry__header u-text-center">
		<?php Hybrid\Post\display_title(); ?>
	</header>

	<div class="entry__content">
		<?php the_content(); ?>
		<?php Hybrid\View\display( 'components', 'pagination-post' ); ?>
	</div>

</article>
