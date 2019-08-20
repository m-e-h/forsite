<?php
$type = false;

if ( wp_attachment_is( 'image' ) ) {
	$type = 'image';
}

if ( wp_attachment_is( 'video' ) ) {
	$type = 'video';
}

if ( wp_attachment_is( 'audio' ) ) {
	$type = 'audio';
}
?>

<article <?= Hybrid\Attr\render( 'entry' ); ?>>

	<?= $engine->render( 'components', 'post-header' ); ?>

	<div class="entry__content">

		<?= wp_get_attachment_image( get_the_ID(), 'large', false, [ 'class' => 'aligncenter' ] ); ?>

		<?= $type ? Hybrid\Media\render( [ 'type' => $type ] ) : false; ?>

		<div class="media-meta">

			<h3 class="media-meta__title"><?php esc_html_e( 'Info', 'forsite' ); ?></h3>

			<ul class="media-meta__items">
				<?= $engine->render( 'components', 'media-meta' ); ?>
			</ul>

		</div>

	</div>

</article>
