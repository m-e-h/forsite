<?php if ( false === $type ) {
	return; } ?>

<ul class="media-meta__items">

	<?php
	// Image
	if ( 'image' === $type ) {
		Hybrid\Media\display_meta(
			'created_timestamp',
			[
				'tag'   => 'li',
				'label' => __( 'Date', 'forsite' ),
			]
		);

		Hybrid\Media\display_meta(
			'camera',
			[
				'tag'   => 'li',
				'label' => __( 'Camera', 'forsite' ),
			]
		);

		Hybrid\Media\display_meta(
			'aperture',
			[
				'tag'   => 'li',
				'label' => __( 'Aperture', 'forsite' ),
			]
		);

		Hybrid\Media\display_meta(
			'focal_length',
			[
				'tag'   => 'li',
				'label' => __( 'Focal Length', 'forsite' ),
			]
		);

		Hybrid\Media\display_meta(
			'iso',
			[
				'tag'   => 'li',
				'label' => __( 'ISO', 'forsite' ),
			]
		);

		Hybrid\Media\display_meta(
			'shutter_speed',
			[
				'tag'   => 'li',
				'label' => __( 'Shutter Speed', 'forsite' ),
			]
		);
	}
	?>

	<?php
	// Video & Image
	if ( 'video' === $type || 'image' === $type ) {
		Hybrid\Media\display_meta(
			'dimensions',
			[
				'tag'   => 'li',
				'label' => __( 'Dimensions', 'forsite' ),
			]
		);
	}
	?>


	<?php
	// Video & Audio
	if ( 'video' === $type || 'audio' === $type ) {
		Hybrid\Media\display_meta(
			'length_formatted',
			[
				'tag'   => 'li',
				'label' => __( 'Run Time', 'forsite' ),
			]
		);
	}
	?>

	<?php
	// Audio
	if ( 'audio' === $type ) {
		Hybrid\Media\display_meta(
			'artist',
			[
				'tag'   => 'li',
				'label' => __( 'Artist', 'forsite' ),
			]
		);

		Hybrid\Media\display_meta(
			'album',
			[
				'tag'   => 'li',
				'label' => __( 'Album', 'forsite' ),
			]
		);

		Hybrid\Media\display_meta(
			'track_number',
			[
				'tag'   => 'li',
				'label' => __( 'Track Number', 'forsite' ),
			]
		);

		Hybrid\Media\display_meta(
			'year',
			[
				'tag'   => 'li',
				'label' => __( 'Year', 'forsite' ),
			]
		);

		Hybrid\Media\display_meta(
			'genre',
			[
				'tag'   => 'li',
				'label' => __( 'Genre', 'forsite' ),
			]
		);
	}
	?>

	<?php
	// All
	Hybrid\Media\display_meta(
		'file_name',
		[
			'tag'   => 'li',
			'label' => __( 'Name', 'forsite' ),
		]
	);

	Hybrid\Media\display_meta(
		'mime_type',
		[
			'tag'   => 'li',
			'label' => __( 'Mime Type', 'forsite' ),
		]
	);

	Hybrid\Media\display_meta(
		'file_type',
		[
			'tag'   => 'li',
			'label' => __( 'Type', 'forsite' ),
		]
	);

	Hybrid\Media\display_meta(
		'file_size',
		[
			'tag'   => 'li',
			'label' => __( 'Size', 'forsite' ),
		]
	);
	?>
</ul>
