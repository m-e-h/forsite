<?php if ( ! Hybrid\is_plural() || is_front_page() ) { return; } ?>

<header class="archive__header">

	<?= $engine->render( 'views/components', 'nav-breadcrumbs' ); ?>

	<h1 class="archive__title u-h2"><?php the_archive_title() ?></h1>

	<?php if ( ! is_paged() && get_the_archive_description() ) : ?>

		<div class="archive__description">
			<?php the_archive_description() ?>
		</div>

	<?php endif ?>

</header>
