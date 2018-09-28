<?php if ( ! is_active_sidebar( $data->sidebar ) ) {
	return;
} ?>

<aside <?= Hybrid\Attr\render( 'sidebar', $data->sidebar ); ?>>

	<h3 class="sidebar__title screen-reader-text">
		<?= Hybrid\Sidebar\render_name( $data->sidebar ); ?>
	</h3>

	<?php dynamic_sidebar( $data->sidebar ); ?>

</aside>
