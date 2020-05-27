<?php
/**
 * Template part for displaying a pagination
 *
 * @package forsite
 */

namespace Forsite;

the_posts_pagination(
	[
		'mid_size'           => 2,
		'prev_text'          => _x( 'Previous', 'previous set of search results', 'forsite' ),
		'next_text'          => _x( 'Next', 'next set of search results', 'forsite' ),
		'screen_reader_text' => __( 'Page navigation', 'forsite' ),
	]
);
