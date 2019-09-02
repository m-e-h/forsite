<?php
if ( ! $data->type ) { return; }

Hybrid\Pagination\display( $data->type, [
	'prev_text'  => __( '&larr; Previous' ),
	'next_text'  => __( 'Next &rarr;' ),
	'title_text' => __( "{$data->type} navigation" )
] );

if ( is_singular( $data->type ) ) {
	the_post_navigation(
		array(
	'prev_text'  => __( '&larr; <span class="u-h6 post-title">%title</span>' ),
	'next_text'  => __( '<span class="u-h6 post-title">%title</span> &rarr;' ),
		)
	);
}
