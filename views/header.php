<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'forsite' ); ?></a>

<header class="app-header">

	<?= $engine->render( 'components', 'header-branding' ); ?>

	<?= $engine->render( 'components', 'menu', [ 'location' => 'primary' ] ); ?>

</header>
