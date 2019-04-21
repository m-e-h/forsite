<article <?= Hybrid\Attr\render( 'archive-entry' ); ?>>

	<?= Hybrid\View\render( 'components', 'featured-image' ); ?>

	<header class="archive-entry__header">
		<?= Hybrid\Post\render_title( [ 'class' => 'entry__title u-h3' ] ); ?>
	</header>

	<?php
	the_content(
		sprintf(
			wp_kses(
				__( '<span class="ellipsis-more">&#8230;</span><span class="screen-reader-text"> "%s"</span>', '_s' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		)
	);
	?>
</article>
