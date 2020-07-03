<?php
/**
 * Template part for displaying a post's header
 *
 * @package forsite
 */

namespace Forsite;

?>

<header class="entry-header">
	<?php
	get_template_part( 'views/content/entry_title', get_post_type() );

	get_template_part( 'views/content/entry_meta', get_post_type() );

	if ( ! is_search() ) {
		get_template_part( 'views/content/entry_thumbnail', get_post_type() );
	}
	?>
</header><!-- .entry-header -->
