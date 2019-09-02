<?php if ( is_home() || is_front_page() ) {	return; } ?>

<header class="entry__header">

	<?= $engine->render( 'views/components', 'nav-breadcrumbs' ); ?>

	<?= Hybrid\Post\render_title( [ 'class' => 'entry__title u-h2' ] ); ?>

	<?php if ( is_singular( 'post' ) ) : ?>

		<?= $engine->render( 'views/components', 'post-info' ); ?>

	<?php endif; ?>

</header>
