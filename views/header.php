<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'forsite' ); ?></a>

<header class="app-header">

	<div class="app-header__branding u-text-center">
		<?= get_custom_logo(); ?>
		<?= Hybrid\Site\render_title( [ 'class' => 'u-h4 u-m0' ] ); ?>
		<?= Hybrid\Site\render_description(); ?>
	</div>

	<?= Hybrid\View\render( 'components', 'menu', [ 'location' => 'primary' ] ); ?>

</header>

<?= Hybrid\View\render( 'components', 'breadcrumbs' ); ?>
