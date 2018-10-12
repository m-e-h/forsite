<?php if ( ! has_nav_menu( $data->location ) ) { return; } ?>

	<nav <?= Hybrid\Attr\render( 'menu', $data->location ) ?>>

		<h3 class="menu__title screen-reader-text">
			<?= Hybrid\Menu\render_name( $data->location ) ?>
		</h3>

		<?php wp_nav_menu( [
			'theme_location' => $data->location,
			'container'      => '',
			'menu_id'        => '',
			'menu_class'     => 'menu__items',
			'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			'item_spacing'   => 'discard'
		] ) ?>

	</nav>
