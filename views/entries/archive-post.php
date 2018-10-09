<article <?php Hybrid\Attr\display( 'entry' ); ?>>

	<?php the_post_thumbnail( 'forsite-medium', [ 'class' => 'entry__image' ] ); ?>

	<header class="entry__header">
		<?php Hybrid\Post\display_title(); ?>

		<div class="entry__byline">
			<?php Hybrid\Post\display_author(); ?>
			<?php Hybrid\Post\display_date( [ 'before' => Forsite\sep() ] ); ?>
			<?php Hybrid\Post\display_comments_link( [ 'before' => Forsite\sep() ] ); ?>
		</div>
	</header>

	<div class="entry__content">
	<h1>Archive Post</h1>
		<?php
		if ( has_excerpt() ) {
			the_excerpt();
		} else {
			the_content();
		}
		?>
	</div>

</article>
