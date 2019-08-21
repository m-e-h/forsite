<article class="entry entry--error u-text-center">

	<header class="entry__header u-text-center u-1of1 u-p u-mt u-mb">

		<h1 class="entry__title u-h0 u-text-muted">
			<?php esc_html_e( '404' ); ?>
		</h1>

	</header>

	<div class="entry__content u-h5">
		<h4>
			<?= __( 'It seems we can&rsquo;t find what you&rsquo;re looking for.<br>Perhaps searching will help.' ); ?>
		</h4>

		<?php get_search_form(); ?>

	</div>

</article>
