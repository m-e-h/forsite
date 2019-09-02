<?php if ( ! is_active_sidebar( $data->sidebar ) ) { return; } ?>

<aside <?= Hybrid\Attr\render( 'sidebar', $data->sidebar ); ?>>

	<?php dynamic_sidebar( $data->sidebar ); ?>

</aside>
