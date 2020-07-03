<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <meta name="theme-color" content=" Forsite\forsite()->default_primary_color(); ?>"> -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'forsite' ); ?></a>

	<header id="masthead" class="site-header">
		<?php get_template_part( 'views/components/custom_header' ); ?>

		<?php get_template_part( 'views/components/header-branding' ); ?>

		<?php get_template_part( 'views/components/header-nav' ); ?>
	</header>
