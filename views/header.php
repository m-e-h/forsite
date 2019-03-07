<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'forsite' ); ?></a>

<header class="app-header">

	<?= Hybrid\View\render( 'components', 'header-branding' ); ?>

	<?= Hybrid\View\render( 'components', 'menu', [ 'location' => 'primary' ] ); ?>

</header>
