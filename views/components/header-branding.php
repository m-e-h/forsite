<div class="site-branding">
	<?php the_custom_logo(); ?>

	<?php
	if ( is_front_page() && is_home() ) {
		?>
		<h1 class="site-title"><a href="<?= esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php
	} else {
		?>
		<p class="site-title"><a href="<?= esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php
	}
	?>

	<?php
	$forsite_description = get_bloginfo( 'description', 'display' );
	if ( $forsite_description || is_customize_preview() ) {
		?>
		<p class="site-description">
			<?= $forsite_description; ?>
		</p>
		<?php
	}
	?>
</div><!-- .site-branding -->
