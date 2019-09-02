<?php if ( ! is_singular('post') ) { return; } ?>

<footer class="entry__footer">
	<?= Hybrid\Post\render_terms( [ 'taxonomy' => 'post_tag' ] ) ?>
</footer>


