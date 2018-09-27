<!doctype html>
<html <?php Hybrid\Attr\display( 'html' ); ?>>

<head>
<?php wp_head(); ?>
</head>

<body <?php Hybrid\Attr\display( 'body' ); ?>>

	<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'forsite' ); ?></a>

	<header class="app-header">

		<div class="app-header__branding">
			<?php the_custom_logo(); ?>
			<?php Hybrid\Site\display_title( [ 'class' => 'u-h4' ] ); ?>
			<?php Hybrid\Site\display_description(); ?>
		</div>

		<?php the_custom_header_markup(); ?>

		<?php Hybrid\View\display( 'components', 'menu', [ 'location' => 'primary' ] ); ?>

	</header>
