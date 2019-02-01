<div class="entry__info u-h6 u-text-muted">

	<?= Hybrid\Post\render_author( ['before' => '<span class="entry__byline">by ', 'after' => ' | </span>'] ) ?>

	<?= Hybrid\Post\render_date( ['before' => '<span class="entry__posted-on">', 'after' => '</span>'] ) ?>

	<?= Hybrid\Post\render_comments_link( ['before' => '<span class="entry__comments-count u-mx1">&#x1F4AC;', 'after' => '</span>'] ); ?>

</div>
