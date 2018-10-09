<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header u-text-center">
		<?php Hybrid\Post\display_title() ?>

		<div class="entry__byline">
			<?php Hybrid\Post\display_author() ?>
			<?php Hybrid\Post\display_date( [ 'before' => Forsite\sep() ] ) ?>
			<?php Hybrid\Post\display_comments_link( [ 'before' => Forsite\sep() ] ) ?>
		</div>
	</header>

	<div class="entry__content">
		<?php the_content() ?>
		<?= Hybrid\View\render( 'components', 'pagination-post' ); ?>
	</div>

	<footer class="entry__footer u-container">
		<?php Hybrid\Post\display_terms( [ 'taxonomy' => 'category' ] ) ?>
		<?php Hybrid\Post\display_terms( [ 'taxonomy' => 'post_tag', 'before' => Forsite\sep() ] ) ?>
	</footer>

</article>

<?php comments_template() ?>
