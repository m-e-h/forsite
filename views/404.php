<!doctype html>
<html <?= Hybrid\Attr\render( 'html' ); ?> class="no-js">

	<head>
		<?php wp_head(); ?>
	</head>

	<body <?= Hybrid\Attr\render( 'body' ); ?>>

		<?= Hybrid\View\render( 'header' ); ?>

		<main id="main" class="app-main">

			<?= Hybrid\View\render( 'components', 'breadcrumbs' ); ?>

			<?= Hybrid\View\render( 'layouts', '404' ); ?>

		</main>

		<?= Hybrid\View\render( 'sidebar', 'primary', [ 'sidebar' => 'primary' ] ); ?>

		<?= Hybrid\View\render( 'footer' ); ?>

	</body>

</html>
