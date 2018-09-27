<?php Hybrid\View\display( 'header' ); ?>

	<main id="main" class="app-main">

		<?php Hybrid\View\display( 'layouts', Hybrid\Template\hierarchy() ); ?>

	</main>

	<?php Hybrid\View\display( 'sidebar', 'primary', [ 'sidebar' => 'primary' ] ); ?>

<?php Hybrid\View\display( 'footer' ); ?>
