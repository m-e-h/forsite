<?= Hybrid\View\render( 'header' ); ?>

	<main id="main" class="app-main">

		<?= Hybrid\View\render( 'layouts', Hybrid\Template\hierarchy() ); ?>

	</main>

	<?= Hybrid\View\render( 'sidebar', 'primary', [ 'sidebar' => 'primary' ] ); ?>

<?= Hybrid\View\render( 'footer' ); ?>
