<article <?php Hybrid\Attr\display( 'entry' ); ?>>

	<header class="entry__header">
		<?php Hybrid\Post\display_title(); ?>
	</header>

	<?php Hybrid\Media\display( [ 'type' => 'audio' ] ); ?>

	<div class="entry__content">
		<?php the_content(); ?>
		<?php Hybrid\View\display( 'components', 'post-pagination' ); ?>
	</div>

	<div class="media-meta media-meta--audio">

		<h3 class="media-meta__title"><?php esc_html_e( 'Audio Info', 'forsite' ); ?></h3>

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
				'artist', [
					'tag'   => 'li',
					'label' => __( 'Artist', 'forsite' ),
				]
			);
			?>
			<?php
			Hybrid\Media\display_meta(
				'album', [
					'tag'   => 'li',
					'label' => __( 'Album', 'forsite' ),
				]
			);
			?>
			<?php
			Hybrid\Media\display_meta(
				'track_number', [
					'tag'   => 'li',
					'label' => __( 'Track Number', 'forsite' ),
				]
			);
			?>
			<?php
			Hybrid\Media\display_meta(
				'year', [
					'tag'   => 'li',
					'label' => __( 'Year', 'forsite' ),
				]
			);
			?>
			<?php
			Hybrid\Media\display_meta(
				'genre', [
					'tag'   => 'li',
					'label' => __( 'Genre', 'forsite' ),
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
