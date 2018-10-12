<?php if ( ! is_singular('post') ) { return; } ?>

<footer class="entry__footer u-content-width">
	<?php Hybrid\Post\display_terms( [ 'taxonomy' => 'category' ] ) ?>
	<?php Hybrid\Post\display_terms( [ 'taxonomy' => 'post_tag', 'before' => Forsite\sep() ] ) ?>
</footer>
