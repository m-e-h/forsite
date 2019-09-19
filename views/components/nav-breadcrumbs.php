<?php

$wpseo_bc = get_option( 'wpseo_titles' );
if ( function_exists( 'yoast_breadcrumb' ) && $wpseo_bc['breadcrumbs-enable'] == true ) {

	yoast_breadcrumb( '<nav id="breadcrumbs" class="breadcrumbs">', '</nav>' );

} else {

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
}
