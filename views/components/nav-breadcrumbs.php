<?php
// if ( function_exists( 'yoast_breadcrumb' ) ) {
// 	yoast_breadcrumb( '<nav id="breadcrumbs" class="breadcrumbs">', '</nav>' );
// }

Hybrid\Breadcrumbs\Trail::display(
	$args = [
		'list_tag'        => 'ol',
		'show_trail_end'  => false,
		'container_class' => get_theme_mod( 'forsite_breadcrumbs', true ) ? 'breadcrumbs' : 'breadcrumbs screen-reader-text',
		'labels'          => [
			'title' => '',
			'home'  => 'Home',
		],
	]
);
