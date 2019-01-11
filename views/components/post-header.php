<?php if ( is_home() || is_front_page() ) { return; } ?>

<header class="entry__header u-text-center u-1of1 u-mb">

	<?= Hybrid\Post\render_title([ 'class' => 'entry__title u-h1' ]) ?>

	<?php if ( is_singular('post') ) : ?>

		<?= Hybrid\View\render( 'components', 'post-info' ); ?>

	<?php endif; ?>

</header>
