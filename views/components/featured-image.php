<?php

if ( post_password_required() || ! has_post_thumbnail() ) {
	return;
}

if ( is_singular() ) : ?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail( 'full', [ 'class' => 'entry__image' ] ) ?>
	</div>

<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php
		the_post_thumbnail(
			'post-thumbnail',
			[ 'alt' => the_title_attribute( [ 'echo' => false ] ), 'class' => 'entry__image' ]
		);
		?>
	</a>

	<?php
endif; // End is_singular().
