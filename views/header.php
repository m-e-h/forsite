<!doctype html>
<html <?= Hybrid\Attr\render( 'html' ); ?>>

<head>
<?php wp_head(); ?>
</head>

<body <?= Hybrid\Attr\render( 'body' ); ?>>

	<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'forsite' ); ?></a>

	<header class="app-header">

		<div class="app-header__branding">
			<?= get_custom_logo(); ?>
			<?= Hybrid\Site\render_title( [ 'class' => 'u-h4 u-m0' ] ); ?>
			<?= Hybrid\Site\render_description(); ?>
		</div>

		<?= get_custom_header_markup(); ?>

		<?= Hybrid\View\render( 'components', 'menu', [ 'location' => 'primary' ] ); ?>

	</header>
