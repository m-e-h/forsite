<?php if ( ! is_singular('post') ) { return; } ?>

<?= Hybrid\Pagination\render( 'post', [
	'show_all'    => true,
	'prev_next'   => false,
	'title_text'  => __( 'Pages:', 'forsite' ),
	'title_class' => 'pagination__title'
] );
