<main id="main" class="app-main o-grid u-content-width">

<?php Hybrid\View\display( 'components', 'archive-header' ); ?>

<?php if ( have_posts() ) : ?>

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<?php Hybrid\View\display( 'entries', Hybrid\Template\hierarchy() ); ?>

	<?php endwhile ?>

	<?php Hybrid\View\display( 'components', 'pagination-posts' ); ?>

	<?php
endif;
?>

</main>
