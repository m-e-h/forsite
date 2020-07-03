<div class="site-info">
	&#169; <?= date( 'Y' ) ?> <a class="site-link" href="<?= esc_url( get_home_url() ); ?>" rel="home"><?= get_bloginfo( 'name' ); ?></a>
	<?= get_the_privacy_policy_link( '<span class="sep"> | </span>' ); ?>
</div>
