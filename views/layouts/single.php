<main id="main" class="app-main">

	<?= Hybrid\View\render( 'components', 'breadcrumbs' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?= Hybrid\View\render( 'entries', Hybrid\Template\hierarchy() ); ?>

	<?php endwhile ?>

</main>
