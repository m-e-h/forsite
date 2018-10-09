<article <?php Hybrid\Attr\display( 'entry', '', [ 'class' => 'o-cell' ] ); ?>>

	<?php the_post_thumbnail( 'medium', [ 'class' => 'entry__image' ] ); ?>

	<header class="entry__header">
		<?php Hybrid\Post\display_title( [ 'class' => 'u-h4' ] ); ?>
	</header>

	<div class="entry__content">
		<?php
		if ( has_excerpt() && ! is_singular() ) {
			the_excerpt();
		} else {
			the_content();
		}
		?>
	</div>

</article>
