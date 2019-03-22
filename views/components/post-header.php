<?php if ( is_home() || is_front_page() ) {	return; } ?>

<header class="entry__header">

	<?= Hybrid\Post\render_terms(
		[
			'taxonomy' => 'category',
			'sep'      => ' &middot; ',
			'class'    => 'entry__terms entry__terms--category u-caps u-h6 u-text-muted',
		]
	) ?>

	<?= Hybrid\Post\render_title( [ 'class' => 'entry__title u-h1 u-mb' ] ); ?>

	<?php if ( is_singular( 'post' ) ) : ?>

		<?= Hybrid\View\render( 'components', 'post-info' ); ?>

	<?php endif; ?>

</header>
