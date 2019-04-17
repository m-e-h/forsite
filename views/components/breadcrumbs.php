
<?= Hybrid\Breadcrumbs\Trail::render( $args = [
	'list_tag'      => 'ol',
	'show_trail_end' => true,
	'container_class' => get_theme_mod( 'forsite_breadcrumbs', true ) ? 'breadcrumbs' : 'breadcrumbs screen-reader-text',
	'labels' => [
        'title' => ''
    ]
] ); ?>
