<?php if ( ! has_nav_menu( $data->location ) ) {
	return; } ?>

	<nav class="menu menu--<?= esc_attr( $data->location ) ?>" id="js-menu--<?= esc_attr( $data->location ) ?>">

		<?php
		wp_nav_menu(
			[
				'theme_location' => $data->location,
				'container'      => '',
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'menu__items',
			]
		)
		?>

	</nav>
