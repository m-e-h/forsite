<?php if ( ! is_singular('post') ) { return; } ?>

<footer class="entry__footer u-content-width">
	<?= Hybrid\Post\render_terms( [ 'taxonomy' => 'category' ] ) ?>
	<?= Hybrid\Post\render_terms( [ 'taxonomy' => 'post_tag' ] ) ?>
</footer>
