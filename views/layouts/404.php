<div class="entry entry--error">

	<h1 class="entry__title">
		<?php esc_html_e( '404', 'forsite' ); ?>
	</h1>

	<div class="entry__content">
		<p>
			<?php esc_html_e( 'The page you were looking for isn\'t here. Perhaps searching can help.', 'forsite' ); ?>
		</p>

		<?php get_search_form(); ?>
	</div>

</div>
