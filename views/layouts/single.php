<?php if ( have_posts() ) : ?>

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<?php Hybrid\View\display( 'entries', Hybrid\Template\hierarchy() ); ?>

	<?php endwhile ?>

	<?php
endif;
