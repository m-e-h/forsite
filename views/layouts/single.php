<main id="main" class="app-main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?= Hybrid\View\render( 'entries', Hybrid\Template\hierarchy() ); ?>

	<?php endwhile ?>

</main>
