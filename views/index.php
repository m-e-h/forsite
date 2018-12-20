<!doctype html>
<html <?= Hybrid\Attr\render( 'html' ); ?> class="no-js">

	<head>
		<?php wp_head(); ?>
	</head>

	<body <?= Hybrid\Attr\render( 'body' ); ?>>

		<?= Hybrid\View\render( 'header' ); ?>

		<?= Hybrid\View\render( 'layouts', Hybrid\Template\hierarchy() ); ?>

		<?= Hybrid\View\render( 'sidebar', 'primary', [ 'sidebar' => 'primary' ] ); ?>

		<?= Hybrid\View\render( 'footer' ); ?>

	</body>

</html>
