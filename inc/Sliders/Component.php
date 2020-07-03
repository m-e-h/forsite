<?php
/**
 * Forsite\Sliders\Component class
 *
 * @package forsite
 */

namespace Forsite\Sliders;

use WP_Query;
use Forsite\Component_Interface;
use Hybrid\Carbon\Image;
use function add_action;
use function wp_json_encode;

/**
 * Class for integrating blocks.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string {
		return 'sliders';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'init', [ $this, 'action_sliders_register_block' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'action_enqueue_sliders_script' ] );
	}

	public function action_enqueue_sliders_script() {

		// register slide scripts.
		wp_register_script( 'forsite-slider', get_theme_file_uri( 'dist/flickity.pkgd.min.js' ), false, false, true );

		// Enqueue slide scripts.
		wp_enqueue_script( 'forsite-slider' );
	}

	/**
	 * Registers all block assets so that they can be enqueued.
	 */
	public function action_sliders_register_block() {

		register_block_type(
			'forsite/slider-posts',
			[
				'style' => 'forsite-blocks',
				'editor_script' => 'forsite-blocks',
				'render_callback' => [ $this, 'render_slider_posts_block' ],
			]
		);

		register_block_type(
			'forsite/slider-products',
			[
				'style' => 'forsite-blocks',
				'editor_script' => 'forsite-blocks',
				'attributes' => [
					'align' => [
						'type' => 'string',
						'enum' => [ 'left', 'center', 'right', 'wide', 'full' ],
					],
					'className' => [
						'type' => 'string',
					],
				],
				'render_callback' => [ $this, 'render_slider_products_block' ],
			]
		);

		register_block_type(
			'forsite/testimonial-list',
			[
				'style' => 'forsite-blocks',
				'editor_script' => 'forsite-blocks',
				'attributes' => [
					'reverseOrder' => [
						'type' => 'boolean',
						'default' => false,
					],
				],
				'render_callback' => [ $this, 'render_slider_testimonials_block' ],
			]
		);
	}

	/**
	 * Server rendering for forsite-sliders.
	 */
	public function render_slider_posts_block( $attributes ) {

		$class = 'wp-block-post-carousel';

		if ( isset( $attributes['align'] ) ) {
			$class .= " align{$attributes['align']}";
		}

		if ( isset( $attributes['className'] ) ) {
			$class .= " {$attributes['className']}";
		}

		$posts_to_show = 10; // $attributes['postsToShow']

		$slider_args = [
			'cellAlign' => 'left',
			'contain' => true,
			'wrapAround' => true,
			'groupCells' => 3,
		];

		$data_flickity = wp_json_encode( $slider_args );

		$args = [
			'posts_per_page' => $posts_to_show,
			'category' => 0,
			'post_parent' => 0,
			'post_type' => 'post',
			'post_status' => 'publish',
			'suppress_filters' => false,
		];

		$slide_query = new WP_Query( $args );

		ob_start();
		if ( $slide_query->have_posts() ) :
			while ( $slide_query->have_posts() ) :
				$slide_query->the_post();
				?>

				<div class="entry-wrapper carousel-cell u-1of2">
				<?php

				Image::display(
					[ 'featured', 'attached' ],
					[
						'size' => 'forsite-square-med',
						'alt' => the_title_attribute( [ 'echo' => false ] ),
						'class' => 'wp-post-image',
						'link' => true,
						'link_class' => 'post-thumbnail post-thumbnail-link',
					]
				);
				?>
			<div class="has-sub-font-size u-text-muted u-mt1">
				<time class="entry-date published"><?php echo esc_attr( get_the_date() ); ?></time>
			</div>
				<?php the_title( '<h3 class="entry__title archive-entry__title"><a href="' . esc_url( get_permalink() ) . '" class="entry__permalink" rel="bookmark">', '</a></h3>' ); ?>
				</div><!-- .entry-wrapper -->
				<?php
			endwhile;

		endif;
		wp_reset_postdata();

		$slides = ob_get_clean();

		return "<div class='{$class} carousel' data-flickity='{$data_flickity}'>{$slides}</div>";
	}

	/**
	 * Server rendering for Product sliders.
	 */
	public function render_slider_products_block( $attributes ) {

		$class = 'wp-block-products-carousel';

		if ( isset( $attributes['align'] ) ) {
			$class .= " align{$attributes['align']}";
		}

		if ( isset( $attributes['className'] ) ) {
			$class .= " {$attributes['className']}";
		}

		// $args = [
		// 	'posts_per_page' => $attributes['postsToShow'],
		// 	'category' => 0,
		// 	'post_parent' => 0,
		// 	'post_type' => 'product',
		// 	'post_status' => 'publish',
		// 	'suppress_filters' => false,
		// 	'orderby' => 'menu_order',
		// 	'order' => 'DESC',
		// 	'tax_query' => [
		// 		[
		// 			'taxonomy' => 'product_tag',
		// 			'field' => 'slug',
		// 			'terms' => 'featured',
		// 		],
		// 	],
		// ];
		// $slide_query = new WP_Query( $args );

		$slider_args = [
			'cellAlign' => 'left',
			'contain' => true,
			'wrapAround' => true,
			'groupCells' => true,
		];

		$data_flickity = wp_json_encode( $slider_args );

		$all_cats = get_terms(
			[
				'taxonomy' => 'product_cat',
				'parent' => 0,
				'exclude' => 15,
				'hide_empty' => true,
			]
		);

		ob_start();
		if ( ! is_wp_error( $all_cats ) && ! empty( $all_cats ) ) :

			$term_link = get_permalink( wc_get_page_id( 'shop' ) );

			$header_markup = "<div class='u-flex u-flex-jb u-flex-center is-style-display-font u-mb1 u-titlecase'><h5>Categories</h5><a href='{$term_link}' class='btn is-style-btn-small-outline'>View Catalog</a></div>";

			foreach ( $all_cats as $the_cat ) {

				$thumbnail_id = get_term_meta( $the_cat->term_id, 'featured_cat_img_id', true );
				$thumbnail_id = $thumbnail_id ?: get_term_meta( $the_cat->term_id, 'thumbnail_id', true );
				$image = wp_get_attachment_url( $thumbnail_id );
				?>

				<div class="entry-wrapper carousel-cell u-1of2">

				<img src="<?php echo $image; ?>" class="woocommerce-placeholder wp-post-image" alt="Placeholder">

				<?php echo '<div class="entry__title has-small-font-size"><a href="' . get_term_link( $the_cat->term_id ) . '" class="entry__permalink" rel="bookmark">' . $the_cat->name . '</a></div>'; ?>
				</div><!-- .entry-wrapper -->
				<?php
			}

		endif;
		wp_reset_postdata();

		$slides = ob_get_clean();

		return "{$header_markup}<div class='{$class} carousel' data-flickity='{$data_flickity}'>{$slides}</div>";
	}

	/**
	 * Server rendering for testimonial-sliders.
	 */
	public function render_slider_testimonials_block( $attributes ) {

		$class = 'wp-block-testimonials-carousel';

		if ( isset( $attributes['alignWide'] ) ) {
			$class .= " align{$attributes['alignWide']}";
		}

		$order = 'DESC';
		if ( isset( $attributes['reverseOrder'] ) ) {
			if ( true === $attributes['reverseOrder'] ) {
				$order = 'ASC';
			}
		}

		if ( isset( $attributes['className'] ) ) {
			$class .= " {$attributes['className']}";
		}

		$posts_to_show = 20; // $attributes['postsToShow']

		$slider_args = [
			'cellAlign' => 'left',
			'contain' => true,
			'wrapAround' => true,
			'groupCells' => false,
		];

		$data_flickity = wp_json_encode( $slider_args );

		$args = [
			'posts_per_page' => $posts_to_show,
			'category' => 0,
			'post_parent' => 0,
			'post_type' => 'testimonial',
			'post_status' => 'publish',
			'suppress_filters' => false,
			'orderby' => 'menu_order',
			'order' => $order,
		];

		$slide_query = new WP_Query( $args );

		ob_start();
		if ( $slide_query->have_posts() ) :
			while ( $slide_query->have_posts() ) :
				$slide_query->the_post();
				?>

				<div class="entry-wrapper carousel-cell u-1of1">
					<?php the_content(); ?>
				</div><!-- .entry-wrapper -->

				<?php
			endwhile;

		endif;
		wp_reset_postdata();

		$slides = ob_get_clean();

		return "<div class='{$class} carousel' data-flickity='{$data_flickity}'>{$slides}</div>";
	}
}
