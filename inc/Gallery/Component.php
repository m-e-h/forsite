<?php
/**
 * Forsite\Gallery\Images class
 *
 * @package forsite
 */

namespace Forsite\Gallery;

use Forsite\Component_Interface;
use Forsite\Templating_Component_Interface;
use function Forsite\forsite;
use function get_the_ID;
use function add_action;

/**
 * Class for managing gallery filter page.
 */
class Component implements Component_Interface, Templating_Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string {
		return 'gallery';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'wp_head', [ $this, 'action_add_filter_styles' ] );
		add_action( 'wp_footer', [ $this, 'action_add_lightbox_placeholder' ] );
		add_action( 'init', [ $this, 'attatchment_taxonomy' ] );
		add_action( 'restrict_manage_posts', [ $this, 'add_admin_filters' ], 10, 2 );
		add_action( 'init', [ $this, 'gallery_shortcodes' ] );
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `forsite()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs.
	 */
	public function template_tags(): array {
		return [
			'get_gallery_images' => [ $this, 'get_gallery_images' ],
		];
	}

	// Register Custom Taxonomy
	public function attatchment_taxonomy() {

		$labels = [
			'name' => _x( 'Media Categories', 'Taxonomy General Name', 'forsite' ),
			'singular_name' => _x( 'Media Category', 'Taxonomy Singular Name', 'forsite' ),
			'menu_name' => __( 'Media Categories', 'forsite' ),
			'all_items' => __( 'All Media Categories', 'forsite' ),
		];
		$args = [
			'labels' => $labels,
			'hierarchical' => true,
			'public' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud' => true,
			'show_in_rest' => true,
		];
		register_taxonomy( 'attachment_category', [ 'attachment' ], $args );

	}

	/**
	 *
	 * @param mixed $post_type
	 * @return void
	 */
	public function add_admin_filters( $post_type, $which ) {

		if ( 'attachment' !== $post_type ) {
			return;
		}

		$taxonomies_slugs = [
			'attachment_category',
		];

		// loop through the taxonomy filters array.
		foreach ( $taxonomies_slugs as $slug ) {
			$taxonomy = get_taxonomy( $slug );
			$selected = '';

			// if the current page is already filtered, get the selected term slug.
			$selected = isset( $_REQUEST[ $slug ] ) ? $_REQUEST[ $slug ] : '';

			// render a dropdown for the terms.
			wp_dropdown_categories(
				[
					'show_option_all' => $taxonomy->labels->all_items,
					'taxonomy' => $slug,
					'name' => $slug,
					'orderby' => 'name',
					'value_field' => 'slug',
					'selected' => $selected,
					'hierarchical' => true,
					// 'show_count' => true,
					'hide_empty' => false,
				]
			);
		}

	}

	public function action_add_filter_styles() {

		$category_terms = get_terms(
			[
				'taxonomy' => 'attachment_category',
				'parent' => 0,
				'hide_empty' => true,
			]
		);

		$filtered = '';

		foreach ( $category_terms as $category_term ) {
			$filtered .= "[data-show='{$category_term->slug}'] > :not(.{$category_term->slug}),";
		}

		$filtered = rtrim( $filtered, ',' );
		/* Put the final style output together. */
		$style = "
		<style data-style='theme-gallery-filter'>
			{$filtered} {transform: var(--filtered-transform, none); display: var(--filtered-display, block); position: var(--filtered-position, relative);opacity: var(--filtered-opacity, 1);max-height: var(--filtered-height, none);}
		</style>
		";

		/* Output custom style. */
		echo $style;
	}

	public function action_add_lightbox_placeholder() {
		?>
	<div class="galbox">
		<img src="" class="light-img size-full">

		<button class="galbox-close">
		<?php
		echo forsite()->svg(
			[
				'icon' => 'close',
				'size' => '1em',
			]
		);
		?>
		</button>

	</div>
		<?php
	}

	// Add Shortcode
	public function gallery_shortcodes() {
		add_shortcode( 'filtered_gallery', [ $this, 'filtered_gallery_shortcode' ] );
	}

	public function filtered_gallery_shortcode( $atts ) {

		// Attributes
		$atts = shortcode_atts(
			[
				'class' => '',
			],
			$atts,
			'filtered_gallery'
		);

		// // terms used in the filter bar.
		$categories = get_terms(
			[
				'taxonomy' => 'attachment_category',
				'parent' => 0,
				'orderby' => 'count',
				'order' => 'DESC',
				'hide_empty' => true,
			]
		);

		// Start building the filter bar and gallery.
		$filter_bar = '';

		// filter bar.
		foreach ( $categories as $category ) {

			$filter_bar .= "<li class='filter-item--{$category->slug}'>";

			$filter_bar .= "<button href='#' id='filter-{$category->slug}' data-filter='{$category->slug}' class='filter-gallery-btn'>{$category->name}</button>";

			$filter_bar .= '</li>';
		}

		$filter_bar = "<ul class='filter-items'><li class='btn filter-item--all'>All</li>{$filter_bar}</ul>";

		return $filter_bar . $this->get_gallery_images( $categories );
	}

	public function get_gallery_images( $categories ) {

		global $post;

		// query for the images.
		$args = [
			'post_type' => 'attachment',
			'post_status' => 'inherit',
			'posts_per_page' => -1,
			'order' => 'DESC',
			'orderby' => 'modified',
			'post_mime_type' => 'image/jpeg,image/gif,image/jpg,image/png',
		];

		if ( ! empty( $categories ) ) {

			$cats = [];
			foreach ( $categories as $category ) {
				$cats[] = $category->term_id;
			}

			$args['tax_query'] = [
				[
					'taxonomy' => 'attachment_category',
					'field' => 'term_id',
					'terms' => $cats,
				],
			];
		}

		$gallery_item = '';

		$posts = get_posts( $args );

		foreach ( $posts as $post ) {

			setup_postdata( $post );

			$caption = get_the_excerpt();
			$description = get_the_content();
			$classes = [];

			$category_terms = wp_get_post_terms( get_the_ID(), 'attachment_category' );

			foreach ( $category_terms as $term ) {
				$classes[] = "{$term->slug}";
			}

			$item_class = join( ' ', $classes );

			$gallery_item .= "<li class='filtered-gallery-item {$item_class}'>";
			$gallery_item .= wp_get_attachment_image( get_the_ID(), 'full', false, [ 'loading' => 'lazy','class' => 'filtered-gallery-image' ] );
			$gallery_item .= "<div class='filtered-item-text'>";
			$gallery_item .= "<p class='filtered-item-caption'>{$caption}</p>";
			$gallery_item .= "<p class='filtered-item-description'>{$description}</p>";
			$gallery_item .= '</div>';
			$gallery_item .= '</li>';

		}

		wp_reset_postdata();

		return '<ul class="filtered-gallery-grid">' . $gallery_item . '</ul>';
	}
}
