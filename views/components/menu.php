<?php if ( ! has_nav_menu( $data->location ) ) {
	return; } ?>

	<nav class="menu menu--<?= esc_attr( $data->location ) ?>" id="js-menu--<?= esc_attr( $data->location ) ?>">

		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<svg xmlns="http://www.w3.org/2000/svg" class="icon menu-icon" viewBox="0 0 24 24"><path d="m21 6v2h-18v-2zm-18 12h18v-2h-18zm0-5h18v-2h-18z"/></svg>
		</button>

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
