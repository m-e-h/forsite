<?php
$engine = Hybrid\App::resolve( 'view/engine' );
$color = get_theme_mod( 'primary_color', Forsite\default_primary_color() );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="<?= $color ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<?= $engine->render( 'header' ); ?>

	<main id="main" class="app-main">

		<?= $engine->render( 'components', 'posts-header' ); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?= $engine->render( 'layouts', Hybrid\Template\hierarchy() ); ?>

		<?php endwhile ?>

		<?php if ( ! have_posts() ) : ?>
			<?= $engine->render( 'layouts', '404' ); ?>
		<?php endif ?>

		<?= $engine->render( 'components', 'posts-pagination' ); ?>

	</main>

	<?= $engine->render( 'sidebar', 'primary', [ 'sidebar' => 'primary' ] ); ?>

	<?= $engine->render( 'footer' ); ?>

</body>

</html>
