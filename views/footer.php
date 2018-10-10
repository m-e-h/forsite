<footer class="app-footer">

	<?php
	printf( esc_html__( '&#169; %1$s %2$s' ), date_i18n( 'Y' ), '<a href="' . esc_url( get_home_url() ) . '" class="site-link" rel="home">' . get_bloginfo( 'name' ) . '</a>' );
	?>

</footer>

<?php wp_footer(); ?>
