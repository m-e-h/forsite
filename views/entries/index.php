<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<?php the_post_thumbnail( 'forsite-medium', [ 'class' => 'entry__image' ] ) ?>

	<header class="entry__header">
		<?php Hybrid\Post\display_title() ?>
	</header>

	<div class="entry__content">
		<?php the_content(); ?>
	</div>

</article>
