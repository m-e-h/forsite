<div class="app-header__branding<?= has_custom_logo() || display_header_text() ? null : ' screen-reader-text' ?>">

	<?php echo get_custom_logo(); ?>

	<div class="app-header__text<?= display_header_text() ? null : ' screen-reader-text' ?>">

		<?php echo Hybrid\Site\render_title( [ 'class' => 'app-header__title u-h4 u-m0' ] ); ?>

		<?php echo Hybrid\Site\render_description(); ?>

	</div>

</div>
