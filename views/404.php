<!doctype html>
<html <?= Hybrid\Attr\render( 'html' ); ?> class="no-js">

	<head>
		<?php wp_head(); ?>
	</head>

	<body <?= Hybrid\Attr\render( 'body' ); ?>>

		<?= $engine->render( 'header' ); ?>

		<main id="main" class="app-main">

			<?= $engine->render( 'components', 'breadcrumbs' ); ?>

			<?= $engine->render( 'layouts', '404' ); ?>

		</main>

		<?= $engine->render( 'sidebar', 'primary', [ 'sidebar' => 'primary' ] ); ?>

		<?= $engine->render( 'footer' ); ?>

	</body>

</html>
