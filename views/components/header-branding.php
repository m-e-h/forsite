<div class="app-header__branding<?= Forsite\render_if( ! has_custom_logo() && ! display_header_text(), true, ' screen-reader-text') ?>">

	<?php echo get_custom_logo(); ?>

	<div class="app-header__text<?= Forsite\render_if( display_header_text(), false, ' screen-reader-text') ?>">

		<?php echo Hybrid\Site\render_title( [ 'class' => 'app-header__title u-h4 u-m0' ] ); ?>

		<?php echo Hybrid\Site\render_description(); ?>

	</div>

</div>
