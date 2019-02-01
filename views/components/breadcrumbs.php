<?php
if ( 0 == get_theme_mod( 'forsite_breadcrumbs' ) ) {
	return;
} ?>

<?= Hybrid\Breadcrumbs\Trail::render( $args = [
	'list_tag'      => 'ol',
	'show_trail_end' => true,
	'labels' => [
        'title' => ''
    ]
] ); ?>
