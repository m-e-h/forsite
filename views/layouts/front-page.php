<?php if ( have_posts() ) : ?>

	<?php
	while ( have_posts() ) :
		the_post();
		?>

	<article <?php Hybrid\Attr\display( 'entry' ); ?>>

		<div class="entry__content">
			<?php the_content(); ?>
		</div>

	</article>

	<?php endwhile ?>

	<?php
endif;
