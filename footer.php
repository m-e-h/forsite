<footer id="footer" class="app-footer">

	<?= $engine->render( 'sidebar', 'footer', [ 'sidebar' => 'footer' ] ); ?>

	<div class="site-info u-1of1 u-p1 u-text-center">
		&#169; <?= date( 'Y' ) ?> <a class="site-link" href="<?= esc_url( get_home_url() ); ?>" rel="home"><?= get_bloginfo( 'name' ); ?></a>
	</div>

</footer>

<?php wp_footer(); ?>

</body>

</html>
