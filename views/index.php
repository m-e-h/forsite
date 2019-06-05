<!doctype html>
<html <?= Hybrid\Attr\render( 'html' ); ?> class="no-js">

	<head>
		<?php wp_head(); ?>
	</head>

	<body <?= Hybrid\Attr\render( 'body' ); ?>>

		<?php wp_body_open(); ?>

		<?= Hybrid\View\render( 'header' ); ?>

		<main id="main" class="app-main">

			<?= Hybrid\View\render( 'components', 'posts-header' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?= Hybrid\View\render( 'layouts', Hybrid\Template\hierarchy() ); ?>

			<?php endwhile ?>

			<?= Hybrid\View\render( 'components', 'posts-pagination' ); ?>

		</main>

		<?= Hybrid\View\render( 'sidebar', 'primary', [ 'sidebar' => 'primary' ] ); ?>

		<?= Hybrid\View\render( 'footer' ); ?>

	</body>

</html>
