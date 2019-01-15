<?php if ( ! is_singular('post') ) { return; } ?>

<footer class="entry__footer u-content-width">
	<?= Hybrid\Post\render_terms( [ 'taxonomy' => 'category' ] ) ?>
	<?= Hybrid\Post\render_terms( [ 'taxonomy' => 'post_tag' ] ) ?>

	<?php edit_post_link( __( 'Edit', 'textdomain' ), null, null, null, 'u-abs u-right0 post-edit-link' ); ?>
</footer>


