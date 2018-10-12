<article <?php Hybrid\Attr\display( 'entry' ); ?>>

	<header class="entry__header">
		<?php Hybrid\Post\display_title(); ?>
	</header>

	<?php Hybrid\Media\display( [ 'type' => 'video' ] ); ?>

	<div class="entry__content">
		<?php the_content(); ?>
		<?php Hybrid\View\display( 'components', 'post-pagination' ); ?>
	</div>

	<div class="media-meta media-meta--video">

		<h3 class="media-meta__title"><?php esc_html_e( 'Video Info', 'forsite' ); ?></h3>

		<ul class="media-meta__items">
			<?php
			Hybrid\Media\display_meta(
				'length_formatted', [
					'tag'   => 'li',
					'label' => __( 'Run Time', 'forsite' ),
				]
			);
			?>
			<?php
			Hybrid\Media\display_meta(
				'dimensions', [
					'tag'   => 'li',
					'label' => __( 'Dimensions', 'forsite' ),
				]
			);
			?>
			<?php
			Hybrid\Media\display_meta(
				'file_name', [
					'tag'   => 'li',
					'label' => __( 'Name', 'forsite' ),
				]
			);
			?>
			<?php
			Hybrid\Media\display_meta(
				'mime_type', [
					'tag'   => 'li',
					'label' => __( 'Mime Type', 'forsite' ),
				]
			);
			?>
			<?php
			Hybrid\Media\display_meta(
				'file_type', [
					'tag'   => 'li',
					'label' => __( 'Type', 'forsite' ),
				]
			);
			?>
			<?php
			Hybrid\Media\display_meta(
				'file_size', [
					'tag'   => 'li',
					'label' => __( 'Size', 'forsite' ),
				]
			);
			?>
		</ul>

	</div>

</article>
