<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package forsite
 */

namespace Forsite;

if ( ! forsite()->is_primary_sidebar_active() ) {
	return;
}

forsite()->print_styles( 'forsite-sidebar', 'forsite-widgets' );

?>
<aside id="secondary" class="primary-sidebar widget-area">
	<?php forsite()->display_primary_sidebar(); ?>
</aside><!-- #secondary -->
