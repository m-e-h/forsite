<main id="main" class="app-main o-grid u-content-width">

	<?= Hybrid\View\render( 'components', 'posts-header' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?= Hybrid\View\render( 'entries', Hybrid\Template\hierarchy() ); ?>

	<?php endwhile ?>

	<?= Hybrid\View\render( 'components', 'posts-pagination' ); ?>

</main>
