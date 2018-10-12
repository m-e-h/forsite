<footer class="app-footer u-pt">

	<?= Hybrid\View\render( 'sidebar', 'footer', [ 'sidebar' => 'footer' ] ); ?>

	<div class="site-info u-1of1 u-p1 u-text-center">
		<?php
		printf( esc_html__( '&#169; %1$s %2$s' ), date_i18n( 'Y' ), '<a href="' . esc_url( get_home_url() ) . '" class="site-link" rel="home">' . get_bloginfo( 'name' ) . '</a>' );
		?>
	</div>

</footer>

<?php wp_footer(); ?>
