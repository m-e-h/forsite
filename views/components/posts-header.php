<?php if ( is_front_page() ) { return; } ?>

<header class="archive-header u-text-center u-1of1 u-p1 u-mb">

	<h1 class="archive-header__title u-h1"><?php the_archive_title() ?></h1>

	<?php if ( ! is_paged() && get_the_archive_description() ) : ?>

		<div class="archive-header__description">
			<?php the_archive_description() ?>
		</div>

	<?php endif ?>

</header>