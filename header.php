<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="<?= $color1 ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'forsite' ); ?></a>

	<header class="app-header">

		<?= $engine->render( 'views/components', 'header-branding' ); ?>

		<?= $engine->render( 'views/components', 'nav-menu', [ 'location' => 'primary' ] ); ?>

	</header>
