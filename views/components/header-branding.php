<div class="app-header__branding">

	<?= get_custom_logo(); ?>

	<?= Hybrid\Site\render_title( [ 'class' => display_header_text() ? 'app-header__title' : 'app-header__title screen-reader-text' ] ); ?>

	<?= Hybrid\Site\render_description( [ 'class' => display_header_text() ? 'app-header__description' : 'app-header__description screen-reader-text' ] ); ?>

</div>
